<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != 1) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  $login = false;
  header("location:/login.php");
} else if (!isset($_SESSION['active']) || $_SESSION['active'] == 0) {
  $_SESSION['message'] = "Account is unverified, please confirm your email by clicking on the email link!";
  $login = false;
  header("location:/login.php");

} else {
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
  $email = $_SESSION['email'];
  $active = $_SESSION['active'];
  $login = true;
}
?>