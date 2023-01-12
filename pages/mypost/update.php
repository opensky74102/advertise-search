<?php
include "../../controller/session_start.php";
require_once "../../db.php";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['id']) && $_GET['id'] != '') {
    $post_id = $_GET['id'];
  } else {
    header("location: " . $_SERVER['HTTP_REFERER']);
    return;
  }
} else {
  header("location: /");
}
$paid = '0';
$title = '';
$content = '';
$url = "";
$keywords = "";
if (isset($_SESSION['postdata']) && $_SESSION['postdata']) {
  $p = $_SESSION['postdata'];
  unset($_SESSION['postdata']);
  $paid = $p['paid'];
  $title = $p['title'];
  $content = $p['content'];
  $url = $p['url'];
  $keywords = $p['keywords'];
} else {
  $post_res = $mysqli->query("SELECT * FROM posts WHERE id='" . $post_id . "'");

  if ($post_res->num_rows == 0) {
    $_SESSION['msg']['msg_s'] = "error";
    $_SESSION['msg']['msg_c'] = "Post with that this Id doesn't exist!";
    header("location: " . $_SERVER['HTTP_REFERER']);
    return;
  }
  $post = $post_res->fetch_assoc();
  $paid = $post['pay'];
  $title = $post['title'];
  $content = $post['content'];
  $url = $post['ad_link'];
  $keywords = $post['keywords'];
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
    <div class="post_form">
      <form id="add_post" action="/controller/mypost.controller.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <select name="paid" id="paid">
          <?php if ($paid == 0.00) { ?>
            <option value='0.00' selected>Free</option>
            <option value='20.00'>Paid</option>
          <?php } else { ?>
            <option value='0.00'>Free</option>
            <option value='20.00' selected>Paid</option>
          <?php } ?>
        </select>
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
          <button class="btn btn-primary border-0 gradient-custom">Update</button>

        </div>
      </form>
    </div>
  </div>



</body>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<!--Load index.js from the resource folder-->
<script src="../../js/index.js"></script>
<script src="../../js/post.js"></script>

</html>