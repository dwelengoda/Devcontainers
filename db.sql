CREATE TABLE parking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_number VARCHAR(20) NOT NULL,
    vehicle_type VARCHAR(50),
    entry_time DATETIME DEFAULT CURRENT_TIMESTAMP
);
