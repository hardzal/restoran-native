<?php
  use \app\config\Authentication; 
  use \app\models\UserRole;

  $database = new Database();

  $auth = new Authentication($database->getConnection());
  $userRole = new UserRole($database->getConnection());

  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Create New User</h2>
        <?php
        if(isset($_POST['submit'])) {
            // $auth->register();
            if($auth->register()) {
                header("Location: ./show=admin&pages=user-all&action=saved");
            } else {
                header("Location: ./show=admin&pages=user-all&action=failed");
            }
        }
      ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"/>
            </div>
            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' class='form-control' id='password' name='password'/>  
            </div>
            <div class='form-group'>
                <label for='password_confirm'>Confirm Password</label>
                <input type='password' class='form-control' id='password_confirm' name='password_confirm'/>  
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name='roles' id='roles' class='form-control'>
                    <?php
                        $row = $userRole->selectAll();
                        foreach($row as $key => $value) {
                            echo "<option value=\"{$value['id']}\">{$value['roles']}</option>";
                        }
                    ?>
                </select>
            </div>
            <input name='submit' type="submit" class="btn btn-primary"/>
        </form>
    </main>
  </div>
</div>