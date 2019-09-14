<?php

use \app\models\Product;
use \app\models\Category;

$product = new Product($db->getConnection());
$category = new Category($db->getConnection());

if(isset($_GET['id']) && !empty($_GET['id'])) {
?>

<?php
} else {
    header('Location: ./?show=index');
}
