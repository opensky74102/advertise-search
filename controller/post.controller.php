<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $s = true;
  $paid = "0";
  $title = "";
  $content = "";
  $url = "";
  $keywords = "";
  if (isset($_POST['paid']) && ($_POST['paid'] !== '')) {
    $paid = $_POST['paid'];
  } else {
    $s = false;
  }
  if (isset($_POST['title']) && ($_POST['title'] !== '')) {
    $title = $_POST['title'];
  } else {
    $s = false;
  }
  if (isset($_POST['content']) && ($_POST['content'] !== '')) {
    $content = $_POST['content'];
  } else {
    $s = false;
  }
  if (isset($_POST['url']) && ($_POST['url'] !== '')) {
    $url = $_POST['url'];
  } else {
    $s = false;
  }
  if (isset($_POST['keywords'])) {
    $keywords = $_POST['keywords'];
  } else {
    $s = false;
  }
  if (!$s) {
    $_SESSION['msg']["msg_s"] = 'error';
    $_SESSION['msg']["msg_c"] = 'You should fill all fields correctly';
    $_SESSION['postdata'] = $_POST;
    header("location: " . $_SERVER['HTTP_REFERER']);
    return;
  } else {
    require_once "../db.php";
    if (!empty($mysqli->error)) {
      $_SESSION['msg']["msg_s"] = 'error';
      $_SESSION['msg']["msg_c"] = $mysqli->error;
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }
    $email = $_SESSION['email'];
    $user_res = $mysqli->query("SELECT * FROM users WHERE email='" . $email . "'");
    if ($user_res->num_rows == 0) {
      $_SESSION['msg']['msg_s'] = "error";
      $_SESSION['msg']['msg_c'] = "User with that email doesn't exist!";
      header("location: /login.php");
      return;
    }
    $user = $user_res->fetch_assoc();
    $keywords = preg_replace('/[^A-Za-z0-9\-]/', ' ', $keywords);
    $keywords = preg_replace('/\s+/', ',', $keywords);
    $keywords_arr = explode(",", $keywords);
    echo (count($keywords_arr) > ($user['payment']) / 20) && ($paid == '20');
    if ((count($keywords_arr) > ($user['payment']) / 20) && ($paid == '20')) {
      $_SESSION['msg']['msg_s'] = "error";
      $_SESSION['msg']['msg_c'] = "You have limited keywords for paid ads";
      $_SESSION['postdata'] = $_POST;
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }
    $user_id = $user['id'];
    $now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO posts (user_id, title, content, ad_link, keywords, pay)"
      . " VALUES ('$user_id', '".htmlspecialchars($title, ENT_QUOTES)."','".htmlspecialchars($content, ENT_QUOTES)."','".htmlspecialchars($url, ENT_QUOTES)."', '".htmlspecialchars($keywords, ENT_QUOTES)."', '$paid')";
    if (($mysqli->query($sql))) {
      $_SESSION['msg']['msg_s'] = 'success';
      $_SESSION['msg']['msg_c'] = $paid == '0' ? 'New free ad posting success!' : 'New paid ad posting success!';
      header("location: /");
      return;
    } else {
      $_SESSION['msg']['msg_s'] = 'error';
      $_SESSION['msg']['msg_c'] = 'posting failed!';
      $_SESSION['postdata'] = $_POST;
      header("location: " . $_SERVER['HTTP_REFERER']);
      return;
    }
  }
} else {
  header("location:/login.php");
  return;
}