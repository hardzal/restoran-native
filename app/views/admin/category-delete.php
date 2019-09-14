<?php
    use \app\models\Category;
    
    $category = new Category($db->getConnection());

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($category->delete($id)) {
            header('Location: ./?show=admin&pages=category-all&action=deleted');
        } else {
            header('Location: ./?show=admin&pages=category-all&action=failed');
        }
    } else {
        header('Location:./?show=admin&pages=category-all');
    }
?>