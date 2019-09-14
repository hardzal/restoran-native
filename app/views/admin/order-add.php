<?php

use \app\models\Order;
use \app\models\OrderProduct;

$order = new Order($db->getConnection());
$orderProduct = new OrderProduct($db->getConnection());

?>

