CREATE DATABASE UsDb;

USE UsDb;

CREATE TABLE users (
    userId INT PRIMARY KEY AUTO_INCREMENT,
    Full_Name VARCHAR(255),
    email VARCHAR(255),
    phone_Number VARCHAR(15),
    User_Name VARCHAR(50),
    Password VARCHAR(255),
    UserType VARCHAR(50),
    AccessTime TIMESTAMP,
    profile_Image VARCHAR(255),
    Address TEXT
);
CREATE TABLE articles (
    articleId INT PRIMARY KEY AUTO_INCREMENT,
    authorId INT,
    article_title VARCHAR(255),
    article_full_text TEXT,
    article_created_date TIMESTAMP,
    article_last_update TIMESTAMP,
    article_display ENUM('yes', 'no'),
    article_order INT ,
    FOREIGN KEY (authorId) REFERENCES users(userId)
);
