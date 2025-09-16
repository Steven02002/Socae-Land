USE socaeDB;
CREATE TABLE `users`(
`id` INT NOT NULL AUTO_INCREMENT, 
`first_name` VARCHAR(40) NOT NULL, 
`last_name` VARCHAR(40) NOT NULL,
`email` VARCHAR(40) NOT NULL,
`password` VARCHAR(60) NOT NULL,
`confirmed` TINYINT(1) DEFAULT NULL,
`token` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
`admin` TINYINT(1) DEFAULT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `speakers`(
`id` INT NOT NULL AUTO_INCREMENT,
`first_name` VARCHAR(40) NOT NULL,
`last_name` VARCHAR(40) NOT NULL,
`city` VARCHAR(20) NOT NULL,
`country` VARCHAR(20) NOT NULL,
`image` VARCHAR(32) NULL,
`tags` VARCHAR(120) NOT NULL,
`social_medias` TEXT,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `areas` (
`id` INT NOT NULL AUTO_INCREMENT,
`name_area` varchar(45) NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `members`(
`id` INT NOT NULL AUTO_INCREMENT,
`area_id` INT NOT NULL,
`first_name` VARCHAR(40) NOT NULL,
`last_name` VARCHAR(40) NOT NULL,
`image` VARCHAR(32) NULL,
`social_medias` TEXT,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `fk_members_areas` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`)
);

CREATE TABLE `categories` (
`id` INT NOT NULL AUTO_INCREMENT,
`category_name` varchar(45) NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `events` (
`id` INT NOT NULL AUTO_INCREMENT,
`event_name` VARCHAR(120) NOT NULL,
`description` TEXT NOT NULL,
`date` VARCHAR(120) NOT NULL,
`hour` VARCHAR(120) NOT NULL,
`location` VARCHAR(120) NOT NULL,
`link` VARCHAR(250) NOT NULL,
`category_id` INT NOT NULL,
`speaker_id` INT NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `fk_events_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
CONSTRAINT `fk_events_speakers` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`)
);

CREATE TABLE `contents` (
`id` INT NOT NULL AUTO_INCREMENT,
`title` VARCHAR(50) NULL,
`content_name` VARCHAR(30) NULL,
`description` VARCHAR(300) NULL,
`subtitle` VARCHAR(50) NULL,
`image1` VARCHAR(32) NULL,
`image2` VARCHAR(32) NULL,
`image3` VARCHAR(32) NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `news_categories` (
`id` INT NOT NULL AUTO_INCREMENT,
`category_name` varchar(15) NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `news` (
`id` INT NOT NULL AUTO_INCREMENT,
`title` VARCHAR(50) NOT NULL,
`description` TEXT NOT NULL,
`image` VARCHAR(32) NOT NULL,
`link` VARCHAR(200) NOT NULL,
`category_id` INT NOT NULL, 
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `fk_news_news_categories` FOREIGN KEY (`category_id`) REFERENCES `news_categories` (`id`)
);

CREATE TABLE `materials` (
`id` INT NOT NULL AUTO_INCREMENT,
`name_material` VARCHAR(40) NULL,
`url_material` VARCHAR(300) NULL,
`image` VARCHAR(32) NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `articles` (
`id` INT NOT NULL AUTO_INCREMENT,
`title_article` VARCHAR(150) NULL,
`description_article` VARCHAR(300) NULL,
`url_article` VARCHAR(900) NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `tools` (
`id` INT NOT NULL AUTO_INCREMENT,
`title` varchar(45) NOT NULL,
`description` varchar(45) NOT NULL,
`image` varchar(32) NOT NULL,
`link` varchar(100) NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `activities` (
`id` INT NOT NULL AUTO_INCREMENT,
`image` varchar(45) NOT NULL,
`description` varchar(45) NOT NULL,
`status` TINYINT(1) DEFAULT 1,
`register_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
`last_update` DATETIME DEFAULT NULL,
PRIMARY KEY (`id`)
);

INSERT INTO areas (name_area)
VALUES('Innovación'), ('Marketing'), ('People Development'), ('Investigación Científica');

INSERT INTO categories (category_name)
VALUES ('Conferencia'), ('Curso');

INSERT INTO contents (title, content_name, description, subtitle, image1)
VALUES ('Sociedad Científica', 'Description', 'Ejemplo de la descripción', 'Subtitulo de ejemplo', 'a207c9134bed44c17ed88a707f086157'),
	   ('Acera de Nosotros', 'About_us', 'Ejemplo de descripción', 'Subtitulo', '125601fdea4339b52effd60f565395e3');
       
INSERT INTO news_categories (category_name)
VALUES ('Inicio'), ('Innovación');
