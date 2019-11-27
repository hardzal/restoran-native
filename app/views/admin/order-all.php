<?php

use \app\models\Order as Order;

$order = new Order($db->getConnection());

$i = 1;
?>

<div class="container-fluid">
  <div class="row">

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h2>List Orders</h2>
      <a class='btn btn-info mb-3' href='./?show=admin&pages=product-add'>Create Order</a>
      <?php
      $result = $order->selectAll();
      if (sizeof($result) > 0) :
        ?>
        <table class='table table-hover table-responsive table-bordered'>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Desk Name</th>
            <th>Description</th>
            <th>Status Order</th>
            <th colspan='2'>Action</th>
          </tr>
          <?php
            foreach ($result as $key => $row) {
              $status = $row['status_order'] == 1 ? 'DONE' : 'NOT YET';
              $description = $row['description'] == '' ? '-' : $row['description'];
              ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $row['name']; ?></td>
              <td><?= $row['name_desk']; ?></td>
              <td><?= $description; ?></td>
              <td><?= $status; ?></td>
              <td><a href='./?show=admin&pages=order-show&id=<?= $row['id']; ?>' class='btn btn-info'><span data-feather='eye'></span></a></td>
              <td><a href='./?show=admin&pages=order-delete&id=<?= $row['id']; ?>' class='btn btn-danger' onclick='return confirm("Apakah kamu yakin ingin menghapus ini?")'><span data-feather='trash-2'></span></a></td>
            </tr>
          <?php
              $i = $i + 1;
            }
            ?>
        </table>
      <?php
      else :
        echo "<p>Belum ada order.</p>";
      endif; ?>
    </main>
  </div>
</div>