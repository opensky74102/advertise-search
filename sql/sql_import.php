<?php
/*******Other way round!!! *********/

//connection variables
$host = 'localhost';
$user = 'root';
$password = '';
$db="test";

//create mysql connection
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    die();
}

//create the database
// if (!$mysqli->query('CREATE DATABASE accounts')) {
//     printf("Errormessage: %s\n", $mysqli->error);
// }

//create users table with all the fields
$mysqli->query('
CREATE TABLE `test`.`users` 
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(50) NOT NULL,
     `lastname` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `hash` VARCHAR(32) NOT NULL,
    `active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`) 
);') or die($mysqli->error);

// create users table with all the fields
$mysqli->query('
CREATE TABLE `test`.`posts`(
    `id` int(8) NOT NULL AUTO_INCREMENT,
    `author_id` int NOT NULL,
    `title` text NOT NULL,
    `content` text NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT ,
    `updated_at` timestamp CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` timestamp NOT NULL DEFAULT,
    
    PRIMARY KEY (`id`)
) ALTER TABLE `posts`
ADD FOREIGN KEY (`authour_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;') or die($mysqli->error);
// $mysqli->query('
// CREATE TABLE `test`.`postsdddd`(
//     `id` int(8) NOT NULL AUTO_INCREMENT,
//     `author_id` int NOT NULL,
//     `title` text(255) NOT NULL,
//     `content` text NOT NULL,
//     PRIMARY KEY (`id`)
// );') or die($mysqli->error);

?>