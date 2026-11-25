CREATE DATABASE IF NOT EXISTS school_bus_tracking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE school_bus_tracking;

-- The four assigned entities are users, buses, routes and trips.
-- GPS coordinates are stored on buses so the project does not add a fifth table.
CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  email VARCHAR(120) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','parent','driver') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS buses (
  bus_id INT AUTO_INCREMENT PRIMARY KEY,
  plate_no VARCHAR(30) NOT NULL UNIQUE,
  driver_name VARCHAR(120) NOT NULL,
  capacity INT NOT NULL,
  last_latitude DECIMAL(10,7) NULL,
  last_longitude DECIMAL(10,7) NULL,
  location_updated_at DATETIME NULL,
  CONSTRAINT chk_bus_capacity CHECK (capacity > 0)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS routes (
  route_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  origin VARCHAR(160) NOT NULL,
  destination VARCHAR(160) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS trips (
  trip_id INT AUTO_INCREMENT PRIMARY KEY,
  bus_id INT NOT NULL,
  route_id INT NOT NULL,
  start_time DATETIME NOT NULL,
  end_time DATETIME NULL,
  status ENUM('scheduled','active','completed','cancelled') NOT NULL DEFAULT 'scheduled',
  CONSTRAINT fk_trip_bus FOREIGN KEY (bus_id) REFERENCES buses(bus_id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_trip_route FOREIGN KEY (route_id) REFERENCES routes(route_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;
