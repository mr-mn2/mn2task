<?php

use LDAP\Result;

include "bootstrap/init.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = isset($_GET['action']) ? $_GET['action']: '';
    if ($action == "register"){
        $parametr = $_POST;
        $registerValidation =registerValidation($parametr);
        if($registerValidation){
            $result = register($parametr);
        }
        
    }else
    if ($action == "login"){
        $result = login($_POST['email'], $_POST['password']);
        if($result){
            header('Location: '.siteUrl("index.php"));
           
        } 
        d( "an error in login"); 
    }

}
include "views/view-auth.php";
?>