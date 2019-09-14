<?php
  use \app\models\Desk;

  $desk = new Desk($db->getConnection());
  
  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h2>List Desk</h2>
      <a class='btn btn-info mb-3' href='./?show=admin&pages=desk-add'>Create Desk</a>
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
              <th>Status</th>
              <th>Type</th>
              <th colspan='2'>Action</th>
          </tr>
      <?php
          $result = $desk->selectAll();
          foreach($result as $key => $row) {
            if($row['status_desk']) {
              $status = "N/A";
            } else {
              $status = "AVAILABLE";
            }
      ?>
          <tr>
              <td><?=$i;?></td>
              <td><?=$row['name_desk'];?></td>
              <td><?=$status;?></td>
              <td><?=$row['type_name'];?></td>
              <td><a href="./?show=admin&pages=desk-edit&id=<?=$row['id'];?>" class='btn btn-info'><span data-feather="edit"></span></a></td>
              <td><a href="./?show=admin&pages=desk-edit&id=<?=$row['id'];?>" class='btn btn-danger' onclick='return confirm("Apakah kamu yakin ingin menghapusnya?")'><span data-feather="trash-2"></span></a></td>
          </tr>
      <?php 
          $i = $i + 1;
          } 
      ?>
      </table>
    </main>
  </div>
</div>