<?php 
  use \app\models\Product;
  use \app\models\Category;

  $product = new Product($db->getConnection());
  $category = new Category($db->getConnection());

  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <h2>Create New Product</h2>
        <?php
        if(isset($_POST['submit'])) {
            $product->create();
            print_r($_POST);
            // header("Location: ./?show=admin&pages=product-all&action=saved");
        }
      ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Title"/>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price"/>
            </div>
            <div class='form-group'>
                <label for='category'>Category</label>
                <select name='category_id' id='category' class='form-control'> 
                    <?php
                        $result = $category->selectAll();
                        foreach($result as $key => $value) {
                            echo "<option value='".$value['id']."'>{$value['name']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock"/>
            </div>
            <div class='form-group'>
                <label for='status_product'>Status Product</label>
                <select name='status_product' class='form-control' id='status_product'>
                    <option value='1'>DONE</option>
                    <option value='0'>NOT YET</option>
                </select>
            </div>
            <div class="form-group">
                <label for="img">Preview Image</label>
                <input type="file" class="form-control-file" id="img" name="img"/>
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
