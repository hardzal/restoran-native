<?php
ob_start();
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use \app\config\Database as Database;

$db = new Database();

require_once __DIR__. '/public/index.php';

ob_end_flush();