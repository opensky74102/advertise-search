<?php
/* Displays all successful messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Success</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<!--Display Site Logo at The Top-->
<div class="form">
    <h1><?= 'Success'; ?></h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    endif;
    ?>
    </p>
    <a  class="button button-block gradient-custom text-decoration-none text-center" href="/" style="line-height:50px;">Home</a>
</div>
</body>
</html>
