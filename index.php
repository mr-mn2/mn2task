<?php
include "bootstrap/init.php";
use Hekmatinasser\Verta\Verta;
$verta = new Verta();
$folders = GetFolders();

$time =  $verta-> format('Y/m/d  H:i:s');
include "views/view-index.php";
?>