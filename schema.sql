CREATE DATABASE IF NOT EXISTS booking_event;
USE booking_event;

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  phone VARCHAR(50),
  event_date DATE NOT NULL,
  event_type VARCHAR(100) NOT NULL,
  package VARCHAR(100) NOT NULL,
  guests INT DEFAULT 0,
  message TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


