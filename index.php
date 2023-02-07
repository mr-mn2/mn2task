<?php
include "bootstrap/init.php";
use Hekmatinasser\Verta\Verta;
$verta = new Verta();
if (isset($_GET['delete-folder']) && is_numeric($_GET['delete-folder'])) {
    $deletedCount = deleteFolder($_GET['delete-folder']);
}
if (isset($_GET['delete-task']) && is_numeric($_GET['delete-task'])) {
    $deletedCount = deleteTask($_GET['delete-task']);
    echo $deletedCount ."deleted";
}

$folders = GetFolders();
$tasks = GetTasks();

$time =  $verta-> format('Y/m/d  H:i:s');
include "views/view-index.php";
?>