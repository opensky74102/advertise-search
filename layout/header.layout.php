<div class="header">
  <nav class="navbar navbar-expand-lg fixed-top" aria-label="Main navigation">
    <div class="container-fluid d-flex">
      <div class=" navbar-collapse justify-content-end">
        <form class="d-flex" action="/search.php" role="search" method="get">
          <input class="form-control me-2 shadow-none" name="q" type="search" placeholder="Search" aria-label="Search">
          <!-- <button class="btn btn-success rounded-0" type="submit">Search</button> -->
        </form>
        <ul class="navbar-nav mb-2 mb-lg-0 mr-0 ">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">How It Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/mypost">My Posts</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">New Post</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/pages/post/add.php?p=free">Free</a></li>
              <li><a class="dropdown-item" href="/pages/post/add.php?p=paid">Paid</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout.php">LogOut</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
</div>
</div>