<!DOCTYPE html>
<?php
defined("BASE_PATH") or die("peremetion denied");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= SITE_TITLE?></title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="page">
        <div class="pageHeader">
            <div class="title">Dashboard</div>
            <div class="title"><?=$time?></div>
            <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img
                    src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40" /></div>
        </div>
        <div class="main">
            <div class="nav">
                <div class="searchbox">
                    <div><i class="fa fa-search"></i>
                        <input type="search" placeholder="Search" />
                    </div>
                </div>
                <div class="menu">
                    <div class="title">Navigation</div>
                    <ul class="list-of-folders">
                        <?php foreach ($folders as $folder):?>
                        <li>
                            <a style="text-decoration: none;" href="?add-folderfolder_id=<?= $folder->id ?>">
                                <i class="fa fa-folder"></i><?=$folder->name?>
                            </a>
                            <a style="text-decoration: none; float: right; color: red;" href="index.php?delete-folder=<?= $folder->id ?>">
                               X
                            </a>
                        </li>
                        <?php endforeach?>
                        <li class="active"> <i class="fa fa-tasks"></i>Manage Tasks</li>
                    </ul>
                    
                        <input id="folderName" type="text" style="width: 70%;">
                        <button id="addFolder" class="create-folder-button ">+</button>
                </div>
            </div>
            <div class="view">
                <div class="viewHeader">
                    <div class="title">Manage Tasks</div>
                    <div class="functions">
                        <div class="button active">Add New Task</div>
                        <div class="button">Completed</div>
                        <div class="button inverz"><i class="fa fa-trash-o"></i></div>
                    </div>
                </div>
                <div class="content">
                    <div class="list">
                        <div class="title">Today</div>
                        <ul>
                            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
                                <div class="info">
                                    <div class="button green">In progress</div><span>Complete by 25/04/2014</span>
                                </div>
                            </li>
                            <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
                                <div class="info">
                                    <div class="button">Pending</div><span>Complete by 10/04/2014</span>
                                </div>
                            </li>
                            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
                                <div class="info"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="list">
                        <div class="title">Tomorrow</div>
                        <ul>
                            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
                                <div class="info"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partial -->
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="assets/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $('#addFolder').click(function(){
                var input = $('#folderName');
                $.ajax({
                    url: "process/ajax-handler.php",
                    method: "post",
                    data: {action : "addFolder", folderName: input.val()},
                    success: function (response){
                        const json = JSON.parse(response);

                       if (json.status == "200") {
                        $('<li> <a style="text-decoration: none;" href="?add-folderfolder_id='+json.folderId+'"> <i class="fa fa-folder"></i>'+json.folderName+'</a> <a style="text-decoration: none; float: right; color: red;" href="index.php?delete-folder='+json.folderId+'"> X </a> </li>').appendTo(".list-of-folders");
                      
                       }else
                       if (json.status == "202") {
                        alert ("folder name does not exist or you filled something wrong");
                       }else
                       if (json.status == "404") {
                        alert ("something wrong happened. try again");
                       }else
                       if (json.status == "201") {
                        alert ("lenth of characters shoud be more than 3 characters and less than 100 characters");
                       } else {
                        alert("please enter a name less than 100 characters");
                       }
                    }
                });
            });
           
        });
    </script>

</body>

</html>