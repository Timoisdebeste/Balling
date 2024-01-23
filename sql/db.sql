CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL,
    role VARCHAR(11),
    password VARCHAR(255) NOT NULL
);

CREATE TABLE videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    size INT NOT NULL
    likes VARCHAR(255) NOT NULL,
);

CREATE TABLE video_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Assuming you have user authentication, store the user ID here
    video_id INT,
    UNIQUE KEY unique_like (user_id, video_id),
    FOREIGN KEY (user_id) REFERENCES users(id), -- Assuming a users table
    FOREIGN KEY (video_id) REFERENCES videos(id)
);