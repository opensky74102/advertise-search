<?php
include "../../controller/session_start.php";
include "../../db.php";

if (!isset($_SESSION['email']) || $_SESSION['email'] == '') {
  header('location: /');
  return;
}

$user_res = $mysqli->query("SELECT * FROM users WHERE email='" . $email . "'");

if ($user_res->num_rows == 0) {
  $_SESSION['msg']['msg_s'] = "error";
  $_SESSION['msg']['msg_c'] = "User with that email doesn't exist!";
  header("location: /");
  return;
}
$user = $user_res->fetch_assoc();

$mypostsql = "SELECT * FROM posts WHERE user_id='" . $user['id'] . "'";

$post_res = $mysqli->query($mypostsql);

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
  <div class="container">
    <table class="table" style="margin-top: 150px;">
      <thead class="thead-dark">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Title</th>
          <th scope="col">Url</th>
          <th scope="col">Type</th>
          <th scope="col">Keywords</th>
        </tr>
      </thead>
      <tbody class="text-secondary">
        <?php
        $i = 1;
        while ($row = $post_res->fetch_assoc()) {
          ?>
          <tr data-href="<?php echo 'update.php?id=' . $row['id']; ?>">
            <th scope="row">
              <?php echo $i++; ?>
            </th>
            <td>
              <?php echo $row['title']; ?>
            </td>
            <td><a class="text-secondary" href="<?php echo '' . $row['ad_link']; ?>" target="_blank">
                <?php echo substr($row['ad_link'], 0, 6); ?>
              </a></td>
            <td>
              <?php echo ($row['pay'] > 0) ? "<span class='badge badge-primary bg-primary'>Type</span>" : "<span class='badge badge-info bg-info'>Free</span>"; ?>
            </td>
            <td><?php echo $row['keywords']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<!--Load index.js from the resource folder-->
<script src="../../js/index.js"></script>

</html>