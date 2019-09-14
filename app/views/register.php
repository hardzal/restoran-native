<?php
  use \app\config\Authentication;
  use \app\models\User;

  $auth = new Authentication($db->getConnection());
  $user = new User($db->getConnection());
?>
<main role='main'>
<div class='container jumbotron'>
<h2 class='mb-3'>Register Form</h2>
<?php
if(isset($_POST['submit'])) {
  if($auth->register()) {
    echo "<div class='alert alert-success'>Berhasil mendaftar!</div>";
  } else {
    echo "<div class='alert alert-danger'>Gagal mendaftar :( </div>";
  }
}
?>
<form method="POST" action=""> 
  <div class="form-group">
    <label for="email">Email address</label>
    <input name='email' type="email" class="form-control" id="email" placeholder="Enter email" autocomplete="off"/>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input name='username' type="text" class="form-control" id="username" placeholder="Enter username" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input name='password' type="password" class="form-control" id="password" placeholder="Password" autocomplete="off">
  </div>
  <div class="form-group">
    <label for="password_confirm">Confirm Password</label>
    <input name='password_confirm' type="password" class="form-control" id="password_confirm" placeholder='Confirm Password' autocomplete="off"/>
  </div>
  <button name='submit' type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</main>