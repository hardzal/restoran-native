<?php

use \app\models\Product as Product;
use \app\models\Category as Category;

$product = new Product($db->getConnection());
$category = new Category($db->getConnection());
?>
<main role="main">
  <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption text-left">
            <h1>Example headline.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption text-right">
            <h1>One more for good measure.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div> -->


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

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
          } else if (isset($_GET['search'])) {
            $query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
            $result = $product->search($query);
          } else {
            $result = $product->selectAll();
          }
          foreach ($result as $key => $row) {
            ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm product-card">
                <?php echo "<img src='./public/assets/images/" . $row['img_product'] . "' alt='" . $row['name'] . "' title='" . $row['name'] . "' style='width:100%;'/>"; ?>
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
          }
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
        <form method="POST" action="<?= BASEFILE ?>?show=cart&pages=add">
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
                      <input type="number" name="food-nnum" id="food-num" min=0 class="form-control" />
                      <label for="food-price-total" class="col-form-label">Total Price</label>
                      <input type='number' name='food-price-total' class='form-control food-price-total' min=0 readonly />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor:pointer;">Close</button>
            <button type="button" class="btn btn-primary" style="cursor:pointer;">Add to cart</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  require_once __DIR__ . '/layouts/footer.php';
  ?>