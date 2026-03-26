-- Drop tables if they exist (order matters because of dependency)
DROP TABLE IF EXISTS alumni;
DROP TABLE IF EXISTS users;


-- USERS TABLE
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- ALUMNI TABLE
CREATE TABLE alumni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    course VARCHAR(100),
    batch VARCHAR(20),
    job VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Foreign key (optional but good practice)
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);