<?php
  use \app\models\Desk;
  $desk = new Desk($db->getConnection());

  if(!isset($_GET['id']) && empty($_GET['id'])) {
      header('Location: ./?show=admin&pages=desk-all');
  }
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Update Category</h2>
        <?php
        if(isset($_POST['submit'])) {
            if($desk->update($id)) {
                header("Location: ./?show=admin&pages=desk-all&action=updated");
            } else {
                header("Location: ./?show=admin&pages=desk-all&action=failed");
            }
        }

        $value = $desk->show($id);
      ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=$value['name_desk'];?>"/>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" style='height:100px;'><?=$value['description'];?></textarea>
            </div>
            <input name='submit' type="submit" class="btn btn-primary"/>
        </form>
    </main>
  </div>
</div>
