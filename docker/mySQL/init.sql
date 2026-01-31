DROP DATABASE IF EXISTS laravel_db;

CREATE DATABASE laravel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE laravel_db;

create table diary(
    id int primary key AUTO_INCREMENT,
    date int not null,
    title varchar(255) not null,
    highlight text,
    record text,
    thanks text,
    photo varchar(255)
);

INSERT INTO diary (date, title, highlight, record, thanks, photo) VALUES
(20240601, 'First Diary', 'Had a great day!', 'Today I started learning Docker and MySQL integration.', 'Thankful for the resources available online.', 'photo1.jpg'),
(20240602, 'Second Diary', 'Learned about docker-compose.', 'Set up a multi-container application using docker-compose.', 'Grateful for the supportive community.', 'photo2.jpg'),
(20240603, 'Third Diary', 'Explored MySQL initialization scripts.', 'Created an init.sql file to set up the database schema.', 'Appreciate the documentation provided by MySQL.', 'photo3.jpg');

SELECT * FROM diary;