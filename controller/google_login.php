<?php
  require_once "Classes/Google_Auth.php";

  $google_auth = new Google_Auth();

  $google_auth->getLoginUrl();
  header("location: ".$google_auth->getLoginUrl());
  // echo $google_auth->getLoginUrl();