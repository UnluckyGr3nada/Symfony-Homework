CREATE DATABASE IF NOT EXISTS meteo_db;
USE meteo_db;

CREATE TABLE IF NOT EXISTS weather_forecasts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    forecast_date DATE NOT NULL,
    city VARCHAR(100) NOT NULL,
    period VARCHAR(100) NOT NULL,
    summary VARCHAR(255) NOT NULL,
    summary_id INT NOT NULL,
    temp_min INT NOT NULL,
    temp_max INT NOT NULL,
    comment TEXT
); 