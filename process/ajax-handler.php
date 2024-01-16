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
    case 'addTask':
        $TaskName = $_POST['TaskName'];

        $folderId = $_POST['FolderID'];

        if (is_null($folderId) or empty($folderId)) {
            echo json_encode(["status"=> "203"]);
            die();
        }
        

        if (!isset($TaskName) or empty($TaskName)) {
            echo json_encode(["status"=> "202"]);
            die();
        }
       
        if (strlen($TaskName) < 3 or strlen($TaskName) > 100) {
            echo json_encode(["status"=> "201"]);
            die();
        }

       
        $AddFolderID = AddTask($TaskName,$folderId);
        if (!$AddFolderID) {
            echo json_encode(["status"=> "404"]);
            die();
        }
        echo json_encode(["status"=> "200"]);
        break;

    case 'doneSwitching':
        $TaskId = $_POST['taskid'];
        if (!isset($TaskId) or !is_numeric($TaskId)) {
            echo json_encode(["status"=> "202"]);
            die();
        }
        $AddTaskId = Doneswitch($TaskId);
        if (!$AddTaskId) {
            echo json_encode(["status"=> "404"]);
            die();
        }
        echo json_encode(["status"=> "200"]);
        break;
    
}