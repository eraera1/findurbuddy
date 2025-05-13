CREATE TABLE user_profiles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  bio TEXT,
  profile_picture VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id)
);