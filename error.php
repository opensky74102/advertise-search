<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<!--Display Site Logo at The Top-->
<a href="#"><img src="img/logo.png"></a> 

<div class="form">
    <h1 class="fs-4">Error</h1>
    <p class="h4 fw-light">
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: /" );
    endif;
    ?>
    </p>     
    <a href="index.php" class="text-decoration-none"><button class="button button-block gradient-custom">Home</button></a>
</div>
</body>
</html>
