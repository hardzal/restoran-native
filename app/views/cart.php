<?php

use app\config\Utilities;
use \app\models\Product;
use \app\models\Order;
use \app\models\OrderProduct;

$order = new Order($db->getConnection());
$orderProduct = new OrderProduct($db->getConnection());
$util = new Utilities();
$cart = array();

if (isset($_SESSION['cart'])) {
    $carts = $_SESSION['cart'];
}
$products = new Product($db->getConnection());
$total = 0;
$i = 0;
foreach ($carts as $cart) {
    $carts[$i]['product_detail'] = $products->show($cart['product_id']);
    $i++;
}
?>

<main role='main'>
    <div class='container mt-5 mb-5'>
        <h2 style='margin-top:90px !important;'>List Order</h2>
        <hr />
        <div class="row">
            <?php foreach ($carts as $cart) :
                $total += $cart['quantity'] * $cart['product_detail']['price']; ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= BASEFILE . './public/assets/images/' . $cart['product_detail']['img_product']; ?>" class="card-img-top" alt="<?= $cart['product_detail']['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $cart['product_detail']['name']; ?></h5>
                            <p class="card-text"><?= $cart['product_detail']['description']; ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Price : Rp @<?= $util->setNumberFormat($cart['product_detail']['price']); ?></li>
                            <li class="list-group-item">Quantity : <?= $cart['quantity']; ?></li>
                            <li class="list-group-item">Total : Rp<?= $util->setNumberFormat($cart['quantity'] * $cart['product_detail']['price']); ?></li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link"><button class="btn btn-danger" type="button" style="cursor:pointer;">Delete</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class='row mt-5'>
            <div class='col-12'>
                <div class="card">
                    <div class="card-header">
                        Total Pemesanan : <strong>Rp <?= $util->setNumberFormat($total); ?></strong>
                    </div>
                    <div class="card-body">
                        <p>Silahkan bayar melalui kasir atau melalui dompet digital</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>