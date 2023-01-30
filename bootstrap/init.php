<?php
date_default_timezone_set("Asia/Tehran");
include "constants.php";
include "config.php";
include "vendor/autoload.php";
include "libs/helpers.php";
try {
    $pdo = new PDO("mysql:host={$databaseConfig->host};dbname={$databaseConfig->name};charset=utf8mb4", $databaseConfig->username, $databaseConfig->password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) 
    {
        diePage("connection faild error : ". $e->getMessage());
    }
    

include "libs/lib-auth.php";
include "libs/lib-tasks.php";



