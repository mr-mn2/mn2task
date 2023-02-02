<?php
defined("BASE_PATH") or die("peremetion denied");

function GetCurrentUserId()
{
    return 1;
}
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
    //file_put_contents("dsklfjdlksf.txt", $query);
    $stmt = $pdo -> prepare($query);
    $stmt -> execute([':folderName'=>$folderName , ':user_id'=>$currentUserId]);
    return $pdo ->lastInsertId();
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