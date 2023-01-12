<?php
include './controller/session_start.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Welcome
  </title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <?php
  if ($login == false) {
    header('location: /login.php');
  } ?>
  <!-- <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a> -->
  <?php
  include "layout/header.layout.php";
  ?>
  <div class="search_container pt-350 d-flex">

    <div class="form-outline">
      <input type="search" class="text-right" id="q" placeholder="Search..." value="" name="q"
        form="search_form" autofocus>
    </div>
    <button type="submit" class="btn btn-lg btn-primary" form="search_form">
      <i class="fa fa-search"></i>
    </button>
    <form action="/search.php" class="" id="search_form" method="get">
    </form>
  </div>
  <!--Load Cloudflare jquery.min.js online-->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <!--Load index.js from the resource folder-->
  <script src="js/index.js"></script>

</body>

</html>