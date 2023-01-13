<?php
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login'])) {
    require './controller/login.controller.php';

  } elseif (isset($_POST['register'])) {
    require './controller/register.controller.php';
  } elseif (isset($_POST['google_login'])) {
    require './controller/google_login.php';
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Signup - Login</title>
  <?php include './css/css.html'; ?>
</head>
<body>
  <?php
  if (isset($_SESSION['message']) && strlen($_SESSION['message']) > 0) {
    $err = $_SESSION['message'];
    echo "<div class='position-absolute m-4 col-sm-4 col-lg-3 col-8 end-0'>
    <div class='alert-custom'>
      <span>".$_SESSION['message']."</span>
    </div>
  </div>";
    unset($_SESSION['message']);
  } ?>
  <div id="half-body">
    <div class="form">
      <ul class="tab-group">
        <li class="tab">
          <a href="#signup" class="gradient-custom">Sign Up</a>
        </li>
        <li class="tab active">
          <a href="#login" class="gradient-custom">Log In</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="login">
          <form action="login.php" method="post" autocomplete="off">
            <div class="field-wrap">
              <input type="email" name="email" placeholder="Email Address" />
            </div>

            <div class="field-wrap">
              <input type="password" autocomplete="off" name="password" placeholder=" Password" />
            </div>

            <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>

            <button class="button button-block gradient-custom" name="login">Log In</button>
            <br>
            <button class="button button-block gradient-custom" name="google_login">Login with Google</button>

          </form>
        </div>

        <form action="error.php" method="post" style="display:hidden" id='google_login_form'>
        </form>


        <div id="signup">
          <form action="login.php" method="post" autocomplete="off">

            <div class="top-row">
              <div class="field-wrap">
                <input type="text" autocomplete="off" name='firstname' placeholder="First Name" />
              </div>

              <div class="field-wrap">
                <input type="text" autocomplete="off" name='lastname' placeholder="Last Name" />
              </div>
            </div>

            <div class="field-wrap">
              <input type="email" autocomplete="off" name='email' placeholder="Email" />
            </div>

            <div class="field-wrap">
              <input type="password" autocomplete="off" name='password' placeholder="Password" />
            </div>

            <button type="submit" class="button button-block gradient-custom mt-4" name="register">Create an
              account</button>

          </form>

        </div>

      </div>
    </div>


  </div>
  <footer>
    All right reserved @copyright
  </footer>

  <!--Load Cloudflare jquery.min.js online-->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <!--Load index.js from the resource folder-->
  <script src="js/index.js"></script>


</body>

</html>