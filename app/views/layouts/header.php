<?php

use \app\config\Authentication;

$auth = new Authentication($db->getConnection());
?>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container d-flex justify-content-center">
        <a class="navbar-brand" href="#">Java Restaurant</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
            if (!$auth->checkSesi()) {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="?show=login">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?show=register">Register</a>
              </li>
            <?php
            } else {
              ?>
              <li class="nav-item">
                <?php
                  if ($_SESSION['roles_id'] == 6) {
                    ?>
                  <a class="nav-link" href="?show=user&pages=index">Dashboard</a>
                <?php
                  } else {
                    ?>
                  <a class="nav-link" href="?show=admin&pages=index">Dashboard</a>
                <?php
                  }
                  ?>
              </li>
            <?php
            }
            ?>
            <li class='nav-item'>
              <a class='nav-link' href='?show=cart'>Cart <span class='bg-white' style='color:black; padding: 5px;'>0</span></a>
            </li>
          </ul>
          <form method='GET' action='' class="form-inline mt-2 mt-md-0">
            <input name='q' class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>