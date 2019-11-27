<?php
$show = isset($_GET['show']) ? $_GET['show'] : "index";

if (!empty($show)) {
    if ($show == 'api') {
        $pages  = htmlspecialchars(strip_tags($_GET['pages']));
        require_once __DIR__ . "//api/" . $pages . ".php";
        exit;
    }

    if (isset($_GET['pages']) && !empty($_GET['pages'])) {

        if (!isset($_SESSION['user_id']) && empty($_SESSION['user_id'])) header('Location: ./?show=index');

        require_once __DIR__ . '/views/layouts/dashboard/head.php';
        require_once __DIR__ . '/views/layouts/dashboard/nav.php';
        require_once __DIR__ . '/../app/views/' . htmlspecialchars(strip_tags($show)) . '/' . htmlspecialchars(strip_tags($_GET['pages'])) . '.php';
        require_once __DIR__ . '/views/layouts/dashboard/sidebar.php';
        require_once __DIR__ . '/views/layouts/dashboard/footer.php';
    } else if ($show != 'admin') {
        require_once __DIR__ . '/views/layouts/head.php';
        require_once __DIR__ . '/views/layouts/header.php';
        require_once __DIR__ . '/../app/views/' . htmlspecialchars(strip_tags($show)) . '.php';
        require_once __DIR__ . '/views/layouts/footer.php';
    } else {
        header('Location:./?show=index');
    }
} else {
    header('Location: ./404.php');
}
