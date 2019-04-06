CREATE DATABASE TNLdb;
USE TNLdb;
CREATE TABLE IF NOT EXISTS event (
    id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    place_name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    start_time DATETIME NOT NULL,
    event_url VARCHAR(255),
    picture_url VARCHAR(255),
    picture TEXT,
    PRIMARY KEY (id)
)  ENGINE=INNODB;
