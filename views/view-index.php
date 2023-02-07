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
                    src="https://static.vecteezy.com/system/resources/thumbnails/001/503/756/small/boy-face-avatar-cartoon-free-vector.jpg" width="40" height="40" /></div>
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
                        <a href="<?= siteUrl()?>" style="text-decoration: none;">
                        <li class=<?= (isset($_GET['select-folder'])) ? '' : "active" ?>>
                            <?= (isset($_GET['select-folder'])) ? '<i class="fa fa-folder"></i>' : '<i class="fa fa-folder-open"></i>' ?>
                            All
                        </li>
                        </a>
                        <?php foreach ($folders as $folder):?>
                        <li
                            class="<?= (isset($_GET['select-folder']) and $_GET['select-folder'] == $folder->id) ? 'active' : '' ?>">
                            <a style="text-decoration: none;color: #000;" href="?select-folder=<?= $folder->id ?>">
                                <?= (isset($_GET['select-folder']) and $_GET['select-folder'] == $folder->id) ? '<i class="fa fa-folder-open"></i>' : '<i class="fa fa-folder"></i>' ?><?=$folder->name?>
                            </a>
                            <a style="text-decoration: none; float: right; color: red !important;"
                                href="index.php?delete-folder=<?= $folder->id ?>">
                                X
                            </a>
                        </li>
                        <?php endforeach?>
                    </ul>

                    <input id="folderName" type="text" style="width: 70%;">
                    <button id="addFolder" class="create-folder-button ">+</button>
                </div>
            </div>
            <div class="view">
                <div class="viewHeader">
                    <div class="title"><input id="taskName" type="text"><button id="addFolder"
                            class="create-task-button ">+</button></div>

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
                            <?php foreach($tasks as $task):?>
                            <li data-TaskId="<?= $task->id ?>" class="link isDone  <?= $task -> is_done ? 'checked' : ''?>">
                                <?= $task -> is_done ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-square-o"></i>'?>

                                <span><?= $task->title ?></span>
                                <div class="info">
                                    <span class="created-at">created at <?= $task -> created_at?></span>
                                    <a style="text-decoration: none; float: right; color: red; margin-right: 10px;"
                                        href="index.php?delete-task=<?= $task->id ?>"
                                        onclick="return confirm('are you sure??');">X</a>
                                </div>
                            </li>

                            <?php endforeach;?>
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
        $('#addFolder').click(function() {
            var input = $('#folderName');
            $.ajax({
                url: "process/ajax-handler.php",
                method: "post",
                data: {
                    action: "addFolder",
                    folderName: input.val()
                },
                success: function(response) {
                    const json = JSON.parse(response);

                    if (json.status == "200") {
                        $('<li> <a style="text-decoration: none;color: #000;" href="?add-folderfolder_id=' +
                            json.folderId + '"> <i class="fa fa-folder"></i>' + json
                            .folderName +
                            '</a> <a style="text-decoration: none; float: right; color: red;" href="index.php?delete-folder=' +
                            json.folderId + '"> X </a> </li>').appendTo(
                            ".list-of-folders");

                    } else
                    if (json.status == "202") {
                        alert("folder name does not exist or you filled something wrong");
                    } else
                    if (json.status == "404") {
                        alert("something wrong happened. try again");
                    } else
                    if (json.status == "201") {
                        alert(
                            "lenth of characters shoud be more than 3 characters and less than 100 characters"
                        );
                    } else {
                        alert("please enter a name less than 100 characters");
                    }
                }
            });
        });

    });
    
    $('#taskName').on('keypress', function(e) {
        if (e.which == 13) {
            var TaskName = $('#taskName');
            $.ajax({
                url: "process/ajax-handler.php",
                method: "post",
                data: {
                    action: "addTask",
                    TaskName: TaskName.val(),
                    FolderID : <?= isset($_GET['select-folder']) ? $_GET['select-folder'] : "''" ?>,
                
                },
                success: function(response) {
                    const json = JSON.parse(response);
                    
                    if (json.status == "200") {
                        location.reload();
                    } else
                    if (json.status == "202") {
                        alert("task name does not exist or you filled something wrong");
                    } else
                    if (json.status == "404") {
                        alert("something wrong happened. try again");
                    } else
                    if (json.status == "201") {
                        alert("lenth of characters shoud be more than 3 characters and less than 100 characters");
                    } else
                    if (json.status == "203") {
                        alert( "please select one of the folders then try again");
                    } else {
                        alert("please enter a name less than 100 characters");
                    }
                }
            });
                
        }
    });
    $('.isDone').click(function(e) {
        var tid = $(this).attr('data-taskid');
        $.ajax({
                url: "process/ajax-handler.php",
                method: "post",
                data: {
                    action: "doneSwitching",
                    taskid: tid
                },
                success: function(response) {
                    const json = JSON.parse(response);
                    if (json.status == "200") {
                        location.reload();
                    } else
                    if (json.status == "202") {
                        alert("task id in not valid, please try again");
                    } else
                    if (json.status == "404") {
                        alert("something wrong happened.please try again");
                    } 
                    
                }
            });
    });

    $('#taskName').focus();

    </script>

</body>

</html>