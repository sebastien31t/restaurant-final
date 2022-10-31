-- DROP DATABASE IF EXISTS `db_outlet`;

CREATE DATABASE IF NOT EXISTS `db_outlet`;

USE `db_obierti`;

CREATE TABLE IF NOT EXISTS `category`(
    `id_category` SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `designation` VARCHAR(70)
);

CREATE TABLE IF NOT EXISTS `user`(
    `id_user` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `pseudo` VARCHAR(30) NOT NULL UNIQUE,
    `mail`VARCHAR(100) NOT NULL UNIQUE,
    `phone` VARCHAR (10) NOT NULL UNIQUE,
    `creation` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `password` VARCHAR(255) NOT NULL,
    `actif` BOOLEAN DEFAULT 1,
    `admin` BOOLEAN DEFAULT 0,
    `token` INT(11) NOT NULL,
    `time_token` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `post`(
    `id_post` INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `idx_user` INT(11) NOT NULL,
    `idx_category` SMALLINT NOT NULL,
    `title_post` VARCHAR(75) UNIQUE NOT NULL,
    `content_post` TEXT NOT NULL,
    `post_image` VARCHAR(255),
    `alt_image` VARCHAR(100),
    FOREIGN KEY (`idx_user`) REFERENCES `user`(`id_user`),
    FOREIGN KEY (`idx_category`) REFERENCES `category` (`id_category`)
);

CREATE TABLE IF NOT EXISTS `comment`(
    `id_comment` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `idx_user` INT(11) NOT NULL,
    `idx_post` INT(11) UNSIGNED NOT NULL,
    `title_comment` VARCHAR(75) NOT NULL,
    `content_comment` TEXT NOT NULL,
    FOREIGN KEY (`idx_user`) REFERENCES `user`(`id_user`),
    FOREIGN KEY (`idx_post`) REFERENCES `post`(`id_post`)
);

CREATE TABLE IF NOT EXISTS `hour`(
    `id_hour` SMALLINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `des_hour` VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS `book`(
    `id_book` INT(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `book_day` DATETIME NOT NULL,
    `table` SMALLINT NOT NULL
);
