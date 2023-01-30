<?php
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