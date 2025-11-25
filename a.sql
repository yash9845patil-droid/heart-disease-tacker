CREATE DATABASE IF NOT EXISTS heart_db;
USE heart_db;

DROP TABLE IF EXISTS dataset;
CREATE TABLE dataset (
  id INT AUTO_INCREMENT PRIMARY KEY,
  age INT NOT NULL,
  gender TINYINT NOT NULL,
  bp INT NOT NULL,
  cholesterol INT NOT NULL,
  maxhr INT NOT NULL,
  heart_disease TINYINT NOT NULL
);

INSERT INTO dataset (age, gender, bp, cholesterol, maxhr, heart_disease) VALUES
(63,1,145,233,150,1),
(37,1,130,250,187,0),
(41,0,130,204,172,0),
(56,1,120,236,178,1),
(57,0,120,354,163,1),
(57,1,140,192,148,0),
(56,0,140,294,153,1),
(44,1,120,263,173,0),
(52,1,172,199,162,1),
(57,1,150,168,174,0),
(54,0,140,239,160,1),
(48,1,130,275,139,1),
(49,1,130,266,171,0),
(64,1,110,211,144,1),
(58,0,150,283,162,0),
(50,1,120,219,158,1),
(58,1,120,340,156,1),
(66,0,150,226,114,1),
(43,1,150,247,171,0),
(69,0,140,239,151,1);

DROP TABLE IF EXISTS predictions;
CREATE TABLE predictions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  age INT NOT NULL,
  gender TINYINT NOT NULL,
  bp INT NOT NULL,
  cholesterol INT NOT NULL,
  maxhr INT NOT NULL,
  predicted_label TINYINT NOT NULL,
  prediction_text VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
