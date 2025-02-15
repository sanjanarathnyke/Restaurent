import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.model_selection import train_test_split, GridSearchCV
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_absolute_error, mean_squared_error

# Load the dataset
file_path = "sample_data.csv"  # Change to your dataset path
df = pd.read_csv(file_path)

# Convert 'order_date' to datetime format
df["order_date"] = pd.to_datetime(df["order_date"], format="%d/%m/%Y", errors="coerce")

# Extract day of the week from 'order_date'
df["day_of_week"] = df["order_date"].dt.day_name()

# Convert 'order_time' to datetime format and extract the hour of the day
df["order_time"] = pd.to_datetime(df["order_time"], format="%H:%M:%S", errors="coerce")
df["hour_of_day"] = df["order_time"].dt.hour  # Extracts the hour

# --- Exploratory Data Analysis (EDA) ---
# 1. Item Popularity
item_popularity = df.groupby("pizza_name")["quantity"].sum().reset_index()
item_popularity = item_popularity.sort_values(by="quantity", ascending=False)

# 2. Peak Hours
peak_hours = df.groupby("hour_of_day")["order_id"].count().reset_index()
peak_hours = peak_hours.rename(columns={"order_id": "total_orders"})

# 3. Peak Days
peak_days = df.groupby("day_of_week")["order_id"].count().reset_index()
peak_days = peak_days.rename(columns={"order_id": "total_orders"})

# # Plot Peak Hours
# plt.figure(figsize=(10,5))
# sns.barplot(x=peak_hours["hour_of_day"], y=peak_hours["total_orders"], palette="coolwarm")
# plt.xlabel("Hour of Day")
# plt.ylabel("Total Orders")
# plt.title("Peak Ordering Hours")
# plt.show()

# # Plot Peak Days
# plt.figure(figsize=(10,5))
# sns.barplot(x=peak_days["day_of_week"], y=peak_days["total_orders"], order=[
#     "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
# ], palette="coolwarm")
# plt.xlabel("Day of the Week")
# plt.ylabel("Total Orders")
# plt.title("Peak Ordering Days")
# plt.show()


# --- 🟢 Prepare Data for ML Model ---
df_ml = df.groupby(["hour_of_day", "day_of_week"])["order_id"].count().reset_index()
df_ml = df_ml.rename(columns={"order_id": "total_orders"})

# Convert categorical 'day_of_week' to numerical
df_ml = pd.get_dummies(df_ml, columns=["day_of_week"], drop_first=True)

# Train-Test Split
X = df_ml.drop(columns=["total_orders"])
y = df_ml["total_orders"]
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# --- 🟢 Train Initial Model ---
model = RandomForestRegressor(n_estimators=100, random_state=42)
model.fit(X_train, y_train)
y_pred = model.predict(X_test)

# Evaluate Initial Model
mae = mean_absolute_error(y_test, y_pred)
rmse = np.sqrt(mean_squared_error(y_test, y_pred))
print(f"Initial Model - MAE: {mae:.2f}, RMSE: {rmse:.2f}")

# --- 🟢 Hyperparameter Tuning ---
param_grid = {
    "n_estimators": [50, 100, 200],
    "max_depth": [None, 10, 20],
    "min_samples_split": [2, 5, 10],
    "min_samples_leaf": [1, 2, 4]
}

grid_search = GridSearchCV(
    RandomForestRegressor(random_state=42),
    param_grid,
    cv=3,
    scoring="neg_mean_absolute_error",
    n_jobs=-1
)
grid_search.fit(X_train, y_train)

# Best Model & Parameters
best_params = grid_search.best_params_
best_model = grid_search.best_estimator_
y_pred_best = best_model.predict(X_test)

# Evaluate Tuned Model
mae_best = mean_absolute_error(y_test, y_pred_best)
rmse_best = np.sqrt(mean_squared_error(y_test, y_pred_best))

print(f"Best Parameters: {best_params}")
print(f"Tuned Model - MAE: {mae_best:.2f}, RMSE: {rmse_best:.2f}")

import joblib

# Save the best model
joblib.dump(best_model, 'restaurant_peak_time_model.pkl')