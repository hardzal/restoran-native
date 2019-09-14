<?php
  $i = 1;
?>

<div class="container-fluid">
  <div class="row">
    
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <h2>Reports</h2>
    <a class='btn btn-info mb-3' href='./?show=admin&pages=report-add'>Create Report</a>
    <?php
      if(isset($_GET['action']) && !empty($_GET['action'])) {
        if($_GET['action'] == 'saved') {
          
        } else if($_GET['action'] == 'deleted') {
          echo "<div class='alert alert-danger'>Berhasil menghapus data</div>";
        } else if($_GET['action'] == 'updated') {
          echo "<div class='alert alert-info'>Berhasil memperbaharui data</div>";
        } else if($_GET['action'] == 'failed') {
          echo "<div class='alert alert-warning'>Gagal memproses.</div>";
        }
      }
    ?>
    </main>
  </div>
</div>