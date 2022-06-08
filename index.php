<?php
    ob_start();
    require_once "./libs/helpers/app_autoload.php";
    require_once "./vendor/autoload.php";
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '.env');
    $dotenv->load();

    require_once "./config/app.php";
    require_once "./libs/view.php";
    require_once "./libs/route.php";
    require_once "./routers/app.php";
?>