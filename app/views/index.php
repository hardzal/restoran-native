<?php

use \app\models\Product as Product;
use \app\models\Category as Category;

$product = new Product($db->getConnection());
$category = new Category($db->getConnection());
?>
<main role="main">
  <div class="container marketing mt-5">

    <!-- Three columns of text below the carousel -->
    <div class="album py-5 bg-light">
      <div class="container">
        <div class='row'>
          <div class='col-lg-12 mb-4'>
            <form method='GET' action=''>
              <div class="form-group row">
                <label class="col-form-label col-sm-2">Show by Category</label>

                <select name='categories' class="form-control col-sm-7 mr-3">
                  <option value=''>All</option>
                  <?php
                  $result = $category->selectAll();
                  $selected = "";
                  foreach ($result as $key => $value) {
                    if (isset($_GET['categories'])) {
                      if ($_GET['categories'] == $value['id']) {
                        $selected = "selected";
                      } else {
                        $selected = "";
                      }
                    }
                    echo "<option value='" . $value['id'] . "' {$selected}>" . $value['name'] . "</option>";
                  }
                  ?>
                </select>

                <input class="col-sm-2 btn btn-primary" type='submit' value="Tampilkan" style="cursor:pointer;" />
              </div>
            </form>
          </div>
        </div>

        <div class="row">
          <?php
          if (!empty($_GET['categories'])) {
            $id = filter_input(INPUT_GET, 'categories', FILTER_SANITIZE_NUMBER_INT);
            $result = $product->showByCategory($id);
          } else if (isset($_GET['q'])) {
            $query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
            $result = $product->search($query);
          } else {
            $result = $product->selectAll();
          }
          // var_dump($result);
          if ($result) :
            foreach ($result as $key => $row) :
              $img_product = empty($row['img_product']) ? 'food_default.png' : $row['img_product'];
              ?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm product-card">
                  <?php echo "<img src='./public/assets/images/" . $img_product . "' alt='" . $row['name'] . "' title='" . $row['name'] . "' style='width:100%;'/>"; ?>
                  <div class="card-body">
                    <h3><a href='#'><?= $row['name']; ?></a></h3>
                    <p class="card-text"><?php echo strlen($row['description']) > 40 ? substr($row['description'], 0, 40) . ".." : $row['description']; ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a data-id="<?= $row['id']; ?>" data-link="<?= BASEFILE; ?>" data-toggle="modal" data-target="#buyModal" name='buy_button' class="btn btn-lg btn-primary buy-product" style='cursor:pointer;color: white;'>View</a>
                      </div>
                      <small class="text-success">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></small>
                    </div>
                  </div>
                </div>
              </div>
          <?php
            endforeach;
          else :
            echo "<p>Tidak ada data makanan!</p>";
          endif;
          ?>
        </div>
      </div>
    </div>

  </div><!-- /.container -->

  <!-- Modal -->
  <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buyModalLabel">Order Food <span class='food-name'></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?= BASEFILE; ?>?show=api&pages=order&action=add">
          <div class="modal-body">
            <div class="card mb-3" style="width: 100%;">
              <div class="row no-gutters">
                <div class="col-md-4 modal-img">
                  <img src="#" class="card-img food-img" alt="#" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title food-title">Card title</h5>
                    <p class="card-text food-desc">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <ul class="list-group">
                      <li class="list-group-item food-price"></li>
                      <li class="list-group-item food-category"></li>
                      <li class="list-group-item food-status"></li>
                    </ul>
                    <div class="form-group">
                      <label for="food-num" class="col-form-label">Order</label>
                      <input type="number" name="food-num" id="food-num" min=0 class="form-control" />
                      <label for="food-price-total" class="col-form-label">Total Price</label>
                      <input type='number' name='food-price-total' class='form-control food-price-total' min=0 readonly />
                      <label for="food-description" class="col-form-label">Notes</label>
                      <textarea name='food-description' class='form-control food-description'></textarea>
                      <input type='hidden' name='status' value=0 class='food-status-stock' />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <?php if (isset($_SESSION['user_id'])) : ?>
              <input type="hidden" name="food-id" value="" class="food-id" />
              <button name="addCart" type="submit" class="btn btn-primary addCart" style="cursor:pointer;">Add to cart</button>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor:pointer;">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  require_once __DIR__ . '/layouts/footer.php';
  ?>