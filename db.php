<?php
/* Database connection settings */
$host = 'localhost';  //default host on your local computer
$user = 'root';       //default Username of MySql
$pass = ''; //edit this value with your db password
$db = 'ads_db';     //edit this value with your db name
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);