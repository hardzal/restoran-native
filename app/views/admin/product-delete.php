<?php
    use \app\models\Product;

    $product = new Product($db->getConnection());

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($product->delete($id)) {
            header('Location: ./?show=admin&pages=product-all&action=deleted');
        } else {
            header('Location: ./?show=admin&pages=product-all&action=failed');
        }
    } else {
        header('Location:product-all.php');
    }
?>