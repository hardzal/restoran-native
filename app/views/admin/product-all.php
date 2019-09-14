<?php
  use \app\models\Product;

  $product = new Product($db->getConnection());

  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <h2>List Product</h2>
    <a class='btn btn-info mb-3' href='./?show=admin&pages=product-add'>Create Product</a>
    <?php
      if(isset($_GET['action']) && !empty($_GET['action'])) {
        if($_GET['action'] == 'saved') {
          echo "<div class='alert alert-success'>Berhasil menyimpan data</div>";        
        } else if($_GET['action'] == 'deleted') {
          echo "<div class='alert alert-danger'>Berhasil menghapus data</div>";
        } else if($_GET['action'] == 'updated') {
          echo "<div class='alert alert-info'>Berhasil memperbaharui data</div>";
        } else if($_GET['action'] == 'failed') {
          echo "<div class='alert alert-warning'>Gagal memproses.</div>";
        }
      }
    ?>
    <table class='table table-hover table-bordered'>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status Produk</th>
            <th>Category</th>
            <th>Image</th>
            <th colspan='2'>Action</th>
        </tr>
    <?php
        $result = $product->selectAll();
        foreach($result as $key => $row) {
        $status = $row['status_product'] == 1 ? 'DONE' : 'NOT YET';
        $img = $row['img_product'] == NULL ? "food_default.png" : $row['img_product'];
    ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$row['name'];?></td>
            <td><?=$row['price'];?></td>
            <td><?=$row['stock'];?></td>
            <td><?=$status;?></td>
            <td><?=$row['category_name'];?></td>
            <td><img src='./public/assets/images/<?=$img;?>' alt='<?=$row['name'];?>' title='<?=$row['name'];?>' style='width:100px'/></td>
            <td><a href='./?show=admin&pages=product-show&id=<?=$row["id"];?>' class='btn btn-success mr-2'><span data-feather='eye'></span></a><a href='?show=admin&pages=product-edit&id=<?=$row["id"];?>' class='btn btn-info ml-1 mr-2'><span data-feather='edit'></span></a> 
            <a href='?show=admin&pages=product-delete&id=<?=$row["id"];?>' class='btn btn-danger' onclick='return confirm("Apakah kamu yakin ingin menghapus ini?")'><span data-feather='trash-2'></span></a></td>
        </tr> 
    <?php 
        $i = $i + 1;
        } 
    ?>
    </table>
    </main>
  </div>
</div>

