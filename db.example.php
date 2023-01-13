<?php
/* Database connection settings */
$host = "localhost";  //default host on your local computer
$user = "thereal2_db_user";       //default Username of MySql
$pass = "xxw@8c0Ct7Ds"; //edit this value with your db password
$db = "thereal2_ad_db";     //edit this value with your db name
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);