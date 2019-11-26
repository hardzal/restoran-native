<?php

use \app\models\User as User;
use \app\config\Authentication as Authentication;

$user = new User($db->getConnection());
$auth = new Authentication($db->getConnection());

if ($auth->checkSesi()) {
  $auth->redirected();
}
?>
<main role='main'>
  <div class='container mt-5 mb-5'>
    <h2 style='margin-top:90px !important;'>Login Form</h2>
    <?php
    if (isset($_POST['submit'])) {
      if ($auth->login()) {
        if (!$auth->checkRole($_SESSION['roles_id'])) {
          echo "<div class='alert alert-warning'>Anda tidak memiliki user role yang terdaftar!</div>";
        }
      } else {
        echo "<div class='alert alert-danger'>Gagal Login!</div>";
      }
    }
    ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" />
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>