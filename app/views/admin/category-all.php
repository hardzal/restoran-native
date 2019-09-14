<?php
  use \app\models\Category;

  $category = new Category($db->getConnection());
  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <h2>List Category</h2>
    <a class='btn btn-info mb-3' href='./?show=admin&pages=category-add'>Create Category</a>
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
            <th>Description</th>
            <th colspan='2'>Action</th>
        </tr>
    <?php
        $result = $category->selectAll();
        foreach($result as $key => $row) {
    ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$row['name'];?></td>
            <td><?php echo strlen($row['description']) > 150 ? substr($row['description'], 0, 150). "..." : $row['description']; ?></td>
            <td><a href="./?show=admin&pages=category-edit&id=<?=$row['id'];?>" class='btn btn-info'><span data-feather="edit"></span></a></td>
            <td><a href="./?show=admin&pages=category-delete&id=<?=$row['id'];?>" class='btn btn-danger' onclick='return confirm("Apakah kamu yakin ingin menghapusnya?")'><span data-feather="trash-2"></span></a></td>
        </tr>
    <?php 
        $i = $i + 1;
        } 
    ?>
    </table>
    </main>
  </div>
</div>
