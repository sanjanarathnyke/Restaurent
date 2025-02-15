from flask import Flask, request, jsonify
import joblib
import pandas as pd

app = Flask(__name__)

# Function to preprocess new data
def preprocess_new_data(new_data):
    # Convert 'order_date' to datetime format
    new_data["order_date"] = pd.to_datetime(new_data["order_date"], format="%Y-%m-%d", errors="coerce")  
    # Extract day of the week from 'order_date'
    new_data["day_of_week"] = new_data["order_date"].dt.day_name()
    # Convert 'order_time' to datetime format and extract the hour of the day
    new_data["order_time"] = pd.to_datetime(new_data["order_time"], format="%H:%M:%S", errors="coerce")
    new_data["hour_of_day"] = new_data["order_time"].dt.hour  

    # Group by 'hour_of_day' and 'day_of_week'
    new_data_ml = new_data.groupby(["hour_of_day", "day_of_week"])["order_id"].count().reset_index()
    new_data_ml = new_data_ml.rename(columns={"order_id": "total_orders"})
    new_data_ml = pd.get_dummies(new_data_ml, columns=["day_of_week"], drop_first=True)

    return new_data_ml

# Function to make predictions using the trained model
def make_predictions(new_data_ml):
    # Load the trained model
    model = joblib.load("restaurant_peak_time_model.pkl")

    # Ensure the new data has the same features as the training data
    X_new = new_data_ml.drop(columns=["total_orders"], errors="ignore")

    # Make predictions
    predictions = model.predict(X_new)

    # Add predictions to the new data
    new_data_ml["predicted_orders"] = predictions

    return new_data_ml

# Function to identify peak times
def identify_peak_times(new_data_ml):
    # Sort by predicted orders to find the peak times
    peak_times = new_data_ml.sort_values(by="predicted_orders", ascending=False)
    return peak_times

# API route to receive data and make predictions
@app.route("/predict-peak-times", methods=["POST"])
def predict_peak_times():
    try:
        # Get JSON data from Laravel request
        data = request.get_json()

        # Validate data
        if not data or "order_details" not in data:
            return jsonify({"error": "Invalid request, missing 'order_details'"}), 400

        # Convert order details to Pandas DataFrame
        new_data = pd.DataFrame(data["order_details"])

        # Preprocess new data
        new_data_ml = preprocess_new_data(new_data)

        # Make predictions using the trained model
        predictions_data = make_predictions(new_data_ml)

        # Identify peak times
        peak_times = identify_peak_times(predictions_data)

        # Convert to JSON and return
        return jsonify(peak_times.to_dict(orient="records")), 200

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(debug=True)
