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
      <div class='col-md-4 mb-4'>
      <form method='GET' action=''>
        <p>Show by Category</p>
        <select name='categories'>
          <option value=''>All</option>
          <?php
            $result = $category->selectAll();
            foreach($result as $key => $value) {
              if(isset($_GET['categories'])) {
                if($_GET['categories'] == $value['id']) {
                  $selected = "selected";
                } else {
                  $selected = "";
                }
              }
              echo "<option value='".$value['id']."' {$selected}>".$value['name']."</option>";
            }
          ?>
        </select>
        <input type='submit' name='submit_categories'/>
      </form>
      </div>
    </div>
   
    <div class="row">
      <?php
        if(isset($_GET['submit_categories']) && !empty($_GET['categories'])) {
          $id = filter_input(INPUT_GET, 'categories', FILTER_SANITIZE_NUMBER_INT);
          $result = $product->showByCategory($id);
        } else if(isset($_GET['search'])) {
          $query = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
          $result = $product->search($query);
        } else {
          $result = $product->selectAll();
        }
        foreach($result as $key => $row) {
        ?>
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <?php echo "<img src='./public/assets/images/". $row['img_product']. "' alt='".$row['name']."' title='".$row['name']."' style='width:100%;'/>";?>
              <div class="card-body">
                <h3><a href='#'><?=$row['name'];?></a></h3>
                <p class="card-text"><?php echo strlen($row['description']) > 40 ? substr($row['description'], 0, 40).".." : $row['description'];?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="./?show=product&id=<?=$row['id'];?>" class="btn btn-sm btn-outline-secondary" style='cursor:pointer;'>View</a>
                    <form method="POST" action="">
                      <input type='hidden' name='product_id' value="<?=$row['id'];?>"/>
                      <button type="button" name='buy_button' class="btn btn-sm btn-outline-secondary" style='cursor:pointer;'>Buy</button>
                    </form>
                  </div>
                  <small class="text-success">Rp <?php echo number_format($row['price'], 0, ',', '.');?></small>
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

    <!-- START THE FEATURETTES -->

    <!-- <hr class="featurette-divider"> -->

    <!-- <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div> -->

    <!-- <hr class="featurette-divider"> -->

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

<?php
    require_once __DIR__. '/layouts/footer.php';
?>
