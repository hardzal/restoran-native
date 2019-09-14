<?php

use \app\models\Product;
use \app\models\Category;

$product = new Product($db->getConnection());
$category = new Category($db->getConnection());

