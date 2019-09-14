<?php
  use \app\models\User;
  use \app\models\UserRole;
  
  $user = new User($db->getConnection());
  $userRole = new UserRole($db->getConnection());

  if(!isset($_GET['id']) && empty($_GET['id'])) {
    header('Location: ./?show=admin&pages=user-all');
  }
  
  $id = htmlspecialchars(strip_tags($_GET['id']));
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Update User</h2>
        <?php
        if(isset($_POST['submit'])) {
            if($user->update($id)) {
                header("Location: ./?show=admin&pages=user-all&action=saved");
            } else {
                header("Location: ./?show=admin&pages=user-all&action=failed");
            }
        }

        $field = $user->show($id);
      ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" value="<?=$field['username'];?>" class="form-control" id="username" name="username" placeholder="Username"/>
            </div>
            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' class='form-control' id='password' name='password'/>  
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?=$field['email'];?>" class="form-control" id="email" name="email" placeholder="Email"/>
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name='roles' id='roles' class='form-control'>
                    <?php
                        $row = $userRole->selectAll();
                        foreach($row as $key => $value) {
                            if($field['roles_id'] == $value['id']) {
                                $selected = "selected"; 
                              } else {
                                $selected = "";
                              }
                            echo "<option value=\"{$value['id']}\" {$selected}>{$value['roles']}</option>";
                        }
                    ?>
                </select>
            </div>
            <input name='submit' type="submit" class="btn btn-primary"/>
        </form>
    </main>
  </div>
</div>
