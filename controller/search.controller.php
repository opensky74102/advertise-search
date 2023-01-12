<?php
if ($_SERVER['SCRIPT_NAME'] !== '/search.php') {
  header('location:/');
}
if (!isset($_REQUEST['q']) || ($_REQUEST['q'] == '')) {
  $search_q = "";
  $searched = false;
} else {

  require "db.php";

  if (!empty($mysqli->error)) {
    $_SESSION['msg']["msg_s"] = 'error';
    $_SESSION['msg']["msg_c"] = $mysqli->error;
  } else {
    $search_q = ($_REQUEST['q']);
    $post_res = $mysqli->query("SELECT *, MATCH(keywords) AGAINST('$search_q') AS score FROM posts WHERE MATCH(keywords) AGAINST('$search_q') ORDER BY pay desc,  score DESC,created_at asc");
    if ($post_res == null) {
      $num_rows = 0;
    } else {
      $num_rows = $post_res->num_rows;
    }

    if ($num_rows < 1) {
      $res = [];
    } else {
      // $res = $post_res->fetch_array();
      // var_dump($res);
    }

  }
  $searched = true;
}