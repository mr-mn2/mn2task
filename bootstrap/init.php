<?php
session_start();
date_default_timezone_set("Asia/Tehran");
include "constants.php";
include "config.php";
include BASE_PATH."vendor/autoload.php";
include BASE_PATH."libs/helpers.php";
try {
    $pdo = new PDO("mysql:host={$databaseConfig->host};dbname={$databaseConfig->name};charset=utf8mb4", $databaseConfig->username, $databaseConfig->password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) 
    {
        diePage("connection faild error : ". $e->getMessage());
    }
    

include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."libs/lib-tasks.php";



