DROP TABLE IF EXISTS profiles;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','editor','user') NOT NULL DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_users_email ON users(email);

CREATE TABLE profiles (
    user_id INT PRIMARY KEY,
    nickname VARCHAR(60),
    hunter_rank INT DEFAULT 1,
    prefs_json JSON NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);