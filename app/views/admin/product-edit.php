<?php

use \app\models\Product;
use \app\models\Category;

$product = new Product($db->getConnection());
$category = new Category($db->getConnection());

if (!isset($_GET['id']) && empty($_GET['id'])) {
  header('Location: ./?show=admin&pages=product-all');
}

$id = htmlspecialchars(strip_tags($_GET['id']));
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h2>Update Product</h2>
      <?php
      if (isset($_POST['submit'])) {
        $product->update($id);
        // print_r($_FILES);
        header("Location:./?show=admin&pages=product-all&action=saved");
      }

      $field = $product->show($id);
      ?>
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= $field['name']; ?>" />
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="<?= $field['price']; ?>" />
        </div>
        <div class='form-group'>
          <label for='category'>Category</label>
          <select name='category_id' id='category' class='form-control'>
            <?php
            $result = $category->selectAll();
            foreach ($result as $key => $value) {
              if ($field['category_id'] == $value['id']) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value='" . $value['id'] . "' {$selected}>{$value['name']}</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= $field['stock']; ?>" />
        </div>
        <div class='form-group'>
          <label for='status_product'>Status Product</label>
          <select name='status_product' class='form-control' id='status_product'>
            <option value='1' <?php echo $field['status_product'] == '1' ? " selected" : ""; ?>>DONE</option>
            <option value='0' <?php echo $field['status_product'] == '0' ? " selected" : ""; ?>>NOT YET</option>
          </select>
        </div>
        <div class="form-group">
          <label for="img">Preview Image</label>
          <input type="file" class="form-control-file" id="img" name="img" />
          <input type="hidden" name="img_hidden" value="<?= $field['img_product']; ?>" />
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea name="description" class="form-control" style='height:100px;'><?= $field['description']; ?></textarea>
        </div>
        <input name='submit' type="submit" class="btn btn-primary" />
      </form>
    </main>
  </div>
</div>