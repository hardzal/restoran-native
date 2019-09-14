<?php
  use \app\models\User as User;

  $user = new User($db->getConnection());
  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <h2>List Users</h2>
    <a class='btn btn-info mb-3' href='./?show=admin&pages=user-add'>Create User</a>
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
            <th>Username</th>
            <th>Email</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    <?php
        $result = $user->selectAll();
        foreach($result as $key => $row) {
    ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$row['username'];?></td>
            <td><?=$row['email'];?></td>
            <td><?php echo isset($row['full_name']) ? $row['full_name'] : "-";?></td>
            <td><?php echo isset($row['gender']) ? $row['gender'] : "-";?></td>
            <td><?=$row['roles'];?></td>
            <td><a href='./?show=admin&pages=user-show&id=<?=$row["id"];?>' class='btn btn-success mr-2'><span data-feather='eye'></span></a><a href='./?show=admin&pages=user-edit&id=<?=$row["id"];?>' class='btn btn-info ml-1 mr-2'><span data-feather='edit'></span></a>
            <a href='./?show=admin&pages=user-delete&id=<?=$row["id"];?>' class='btn btn-danger' onclick='return confirm("Apakah kamu yakin ingin menghapus ini?")'><span data-feather='trash-2'></span></a></td>
        </tr> 
    <?php 
        $i = $i + 1;
        } 
    ?>
    </table>
    </main>
  </div>
</div>
