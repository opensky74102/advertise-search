<?php
  include "../../controller/session_start.php";
  if ($login == false) {
    header('location:/');
  }
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['p']) && $_GET['p'] == 'free') {
      $paid = 0;
    } elseif (isset($_GET['p']) && $_GET['p'] == 'paid') {
      $paid = 20;
    } else {
      $paid = 0;
    }
  } else {
    header("location: /index.php");
  }
  $title = '';
  $content = '';
  $url = "";
  $keywords = "";
  if (isset($_SESSION['postdata']) && $_SESSION['postdata']) {
    $p = $_SESSION['postdata'];
    unset($_SESSION['postdata']);
    $title = $p['title'];
    $content = $p['content'];
    $url = $p['url'];
    $keywords = $p['keywords'];
  } else {

  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome </title>
  <?php include "../../css/css.html"; ?>
</head>

<body>
  <?php
  include "../../layout/header.layout.php";
  ?>
  <div class="post_container">
    <?php
    if (isset($_SESSION['msg']['msg_s']) && ($_SESSION['msg']['msg_s'] == 'error')) {
      $err = $_SESSION['msg']['msg_c'];
      $_SESSION['msg']['msg_s'] = '';
      echo "<div class='d-flex justify-content-center'>
      <div class=''><div class='alert-custom'><span>" . $err . "</span></div></div></div>";
    } ?>
    <div class="post_form">
      <form id="add_post" action="/controller/post.controller.php" method="post">
        <input type="hidden" name="paid" value="<?php echo $paid; ?>">
        <div class="post_title">
          <input type="text" name="title" class="" id="title" placeholder="Input your ad tile"
            value="<?php echo $title; ?>">
        </div>
        <div class="post_content">
          <!-- <span class="text-black">Content</span> -->
          <textarea name="content" class="text-primary" id="content" cols="30" rows="10"
            placeholder="Input your ad content"><?php echo $content; ?></textarea>
        </div>
        <div class="post_url">
          <input type="text" name="url" class="" id="url" placeholder="Input your ad url" value="<?php echo $url; ?>">
        </div>
        <div class="post_keywords">
          <input type="text" name="keywords" class="" id="keywords" placeholder="Enter keywords separated by commas."
            value="<?php echo $keywords; ?>">
        </div>
        <div class="post_footer">
          <a class="btn btn-primary border-0 gradient-custom" href="/">Home</a>
          <button class="btn btn-primary border-0 gradient-custom">Submit</button>

        </div>
      </form>
    </div>
  </div>



</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<!--Load index.js from the resource folder-->
<script src="../../js/index.js"></script>
<script src="../../js/post.js"></script>

</html>