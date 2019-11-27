<?php

use \app\models\Order;
use \app\models\OrderProduct;

$order = new Order($db->getConnection());
$orderProduct = new OrderProduct($db->getConnection());
?>

<main role='main'>
    <div class='container mt-5 mb-5'>
        <h2 style='margin-top:90px !important;'>List Order</h2>
            
    </div>
</main>