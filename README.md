# Synaps's Website

<p align="center">
  <a href="#" target="_blank">
    <img src="https://github.com/sanjanarathnyke/Restaurent/blob/main/public/assets/images/logo/logo-white.png" alt="Smart Restaurant Logo">
  </a>
</p>

## Description

This is a smart restaurant website project that integrates IoT technology to enhance the dining experience. The project is built using a combination of HTML, CSS, Blade, PHP, and JavaScript.

## Features

- **Online Menu:** View the restaurant's menu online with detailed descriptions and images.
- **Table Reservation:** Easily reserve a table through the website.
- **Order Management:** Manage orders efficiently with real-time updates.
- **IoT Integration:** Utilize IoT devices to provide a seamless dining experience.
- **Responsive Design:** The website is fully responsive and works on all devices.
- **Prediction Model:** Predictive features powered by a machine learning model.

## Installation

To get a local copy up and running, follow these simple steps.

### Prerequisites

- PHP >= 7.4
- Composer
- Node.js & npm
- Python >= 3.6 (for prediction feature)

### Installation Steps

1. Clone the repo
   ```sh
   git clone https://github.com/sanjanarathnyke/Restaurent.git
   ```

2. Install Composer dependencies
   ```sh
   composer install
   ```

3. Install NPM packages
   ```sh
   npm install
   ```

4. Copy the example environment file and modify it according to your setup
   ```sh
   cp .env.example .env
   ```

5. Generate an application key
   ```sh
   php artisan key:generate
   ```

6. Run the database migrations
   ```sh
   php artisan migrate
   ```

7. (Optional) Seed the database with sample data
   ```sh
   php artisan db:seed
   ```

8. Start the local development server
   ```sh
   php artisan serve
   ```

### Running Predictions

To run the prediction model, follow these steps:

1. Check out the `ML` branch
   ```sh
   git checkout ML
   ```

2. Copy the prediction file (`app.py`) to your local machine and navigate to the directory
   ```sh
   cp path/to/ML/app.py local_directory/
   cd local_directory/
   ```

3. Install the required Python packages
   ```sh
   pip install -r requirements.txt
   ```

4. Run the prediction script
   ```sh
   python app.py
   ```

   The prediction model will run on `http://localhost:5000`, and you should be able to see the prediction values in your terminal or browser.

## Usage

- Access the website at `http://localhost:8000`
- Navigate through the menu, make reservations, manage orders, and view predictions.

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.
