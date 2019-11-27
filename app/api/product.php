<?php

use \app\models\Product;

$product = new Product($db->getConnection());

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = htmlspecialchars(strip_tags($_POST['id']));
    $result = $product->show($id);
    echo json_encode($result);
} else {
    header("Location: index.php");
}
