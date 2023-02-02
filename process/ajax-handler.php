<?php
include "../bootstrap/init.php";
$action = $_POST['action'];
switch ($action) {
    case 'addFolder':
        $foldername = $_POST['folderName'];
        if (!isset($foldername) or empty($foldername)) {
            echo json_encode(["status"=> "202"]);
            die();
        }
       
        if (strlen($foldername) < 3 or strlen($foldername) > 100) {
            echo json_encode(["status"=> "201"]);
            die();
        }
        $AddFolderID = AddFolder($foldername);
        if (!$AddFolderID) {
            echo json_encode(["status"=> "404"]);
            die();
        }
        echo json_encode(['folderName' => $foldername,"folderId" => $AddFolderID,"status"=> "200"]);
        break;
    
    default:
        # code...
        break;
}