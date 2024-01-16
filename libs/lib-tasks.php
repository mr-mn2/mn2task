<?php
defined("BASE_PATH") or die("peremetion denied");


function GetFolders()
{
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $query = 'select * from folders where user_id ='.$currentUserId;
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function AddFolder($folderName)
{
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $query = "insert into folders(name,user_id) values(:folderName,:user_id)";
    
    $stmt = $pdo -> prepare($query);
    $stmt -> execute([':folderName'=>$folderName , ':user_id'=>$currentUserId]);
    return $pdo ->lastInsertId();
}
function AddTask($taskName,$folderId)
{
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $query = "insert into tasks(title,user_id,folder_id) values(:folderName,:user_id,:folder_id)";

    $stmt = $pdo -> prepare($query);
    $stmt -> execute([':folderName'=>$taskName , ':user_id'=>$currentUserId, ':folder_id'=>$folderId]);
    return $pdo ->lastInsertId();
}
function Doneswitch($taskid)
{
    global $pdo;
    $query = "update tasks set is_done = 1 - is_done where id = :task_id";
    $stmt = $pdo -> prepare($query);
    $stmt -> execute(['task_id' => $taskid]);
    return $stmt->rowCount();
}
function deleteFolder($folderId)
{
    global $pdo;
    $query = 'delete from folders where id ='.$folderId;
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    $records = $stmt -> rowCount();
    return $records;
}
function deleteTask($taskId)
{
    global $pdo;
    $query = 'delete from tasks where id ='.$taskId;
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    $records = $stmt -> rowCount();
    return $records;
}

// tasks

function GetTasks()
{ 
    $queryCondition = "";
    if (isset($_GET['select-folder']) and is_numeric($_GET['select-folder'])) {
        $queryCondition = " and folder_id = ".$_GET['select-folder'];
    }
    global $pdo;
    $currentUserId = GetCurrentUserId();
    $query = 'select * from tasks where user_id ='.$currentUserId . $queryCondition;
    $stmt = $pdo -> prepare($query);
    $stmt -> execute();
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records;
}