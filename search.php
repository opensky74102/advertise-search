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
  <?php include 'layout/search.layout.php'; ?>

  <div class="search_bar_container pt-150 d-flex">

    <div class="form-outline">
      <input type="search" class="text-right" id="q" placeholder="Search..." value="<?php echo $search_q; ?>" name="q"
        form="search_form" autofocus>
    </div>
    <button type="submit" class="btn btn-lg btn-primary" form="search_form">
      <i class="fa fa-search"></i>
    </button>
    <form action="/search.php" class="" id="search_form" method="get">
    </form>
  </div>
  <?php if ($searched == false) { ?>
  <?php } elseif (!isset($post_res) || $num_rows == 0) { ?>
  <?php } else { ?>
    <div class="gsc-box">
      <?php while ($item = $post_res->fetch_assoc()) { ?>
        <div class="gsc-item">
          <div class="gsc-item-title">
            <h5 class="text-start"><a class="item-link" href="<?php echo $item['ad_link']; ?>">
                <?php echo strlen($item['title']) > 100 ? substr($item['title'], 0, 100) . "..." : $item['title']; ?>
              </a></h5>
          </div>
          <div class="gsc-item-content">
            <p class="text-start text-black">
              <?php echo strlen($item['content']) > 400 ? substr($item['content'], 0, 400) . "..." : $item['content']; ?>
            </p>
          </div>
          <div class="gsc-item-keywords">
            <?php
            $words = explode(',', $item['keywords']);
            for ($i = 0; $i < count($words); $i++) {
              if (strlen($words[$i]) != 0) {
                ?>
                <span class="badge fs-6 fw-light bg-info text-white">
                  <?php echo $words[$i]; ?>
                </span>
              <?php }
            }
            ?>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>
  </div>
  <? endif; ?>


  <!--Load Cloudflare jquery.min.js online-->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <!--Load index.js from the resource folder-->
  <script src="js/index.js"></script>

</body>

</html>