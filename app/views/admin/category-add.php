<?php
    use \app\models\Category;
    use \app\models\Product;
  
  $category = new Category($db->getConnection());
  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Create New Category</h2>
        <?php
        if(isset($_POST['submit'])) {
            if($category->create()) {
                header("Location: ./?show=admin&pages=category-all&action=saved");
            } else {
                header("Location: ./?show=admin&pages=category-all&action=failed");
            }
        }
      ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" style='height:100px;'></textarea>
            </div>
            <input name='submit' type="submit" class="btn btn-primary"/>
        </form>
    </main>
  </div>
</div>
