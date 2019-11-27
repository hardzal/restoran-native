<?php

if (!isset($_REQUEST) && empty($_REQUEST)) {
    header("Location: ./?show=index");
}

if (isset($_GET['action']) && !empty($_GET['action'])) {

    if ($_GET['action'] == 'add') {

        if (isset($_POST['addCart'])) {
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            // $food_desk = 0; //  hanya untuk sementara 

            $food_id = filter_input(INPUT_POST, 'food-id', FILTER_SANITIZE_STRING);
            $food_num = filter_input(INPUT_POST, 'food-num', FILTER_SANITIZE_NUMBER_INT);
            $food_desc = filter_input(INPUT_POST, 'food-description', FILTER_SANITIZE_STRING);

            $_SESSION['cart'][] = [
                'product_id' => $food_id,
                'quantity' => $food_num,
                'description' => $food_desc
            ];

            echo "<script>alert('Berhasil menambahkan pesanan!');</script>";
            echo "<script>window.location.href='./?show=index'</script>";
        }
    }
}

echo "<script>alert('Tidak memiliki akses!');</script>";
echo "<script>window.location.href='./?show=index'</script>";
