<?php
    use \app\models\User;
    
    $user = new User($db->getConnection());

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if($user->delete($id)) {
            header('Location: ./?show=admin&pages=user-all&action=deleted');
        } else {
            header('Location: ./?show=admin&pages=user-all&action=failed');
        }
    } else {
        header('Location:user-all.php');
    }
?>