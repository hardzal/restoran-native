<?php

use \app\models\Order;
use \app\models\OrderProduct;

$order = new Order($db->getConnection());
$orderProduct = new OrderProduct($db->getConnection());
?>

<main role='main'>
    <div class='container mt-5 mb-5'>
        <h2 style='margin-top:90px !important;'>List Order</h2>
        <?php foreach ($orders as $list) : ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= BASEFILE; ?>public/assets/images" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>