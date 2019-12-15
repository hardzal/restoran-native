<?php
ob_start();
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/phpqrcode/qrlib.php';

use \app\config\Database as Database;

define('BASEFILE', 'http://localhost/projects/restoran-native/');

$db = new Database();

require_once __DIR__ . '/public/index.php';

ob_end_flush();
