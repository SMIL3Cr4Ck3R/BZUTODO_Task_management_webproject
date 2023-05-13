<?php

require_once "../controllers/session.controller.php";

if (isset($_SESSION['userId'])) {

    require_once "../database/queries.php";

    $userId = $_SESSION['userId'];
    $loggedUser = getUserInfoByID($userId);

    echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Task</title>
            <link rel='stylesheet' type='text/css' href='../../assets/css/indexStyle.css'>
            <link rel='stylesheet' type='text/css' href='../../assets/css/dashboardStyles.css'>
        </head>
        <body>
        
            <header class="page-header">
                <nav class="page-top-nav">
                    <section class="header-ico">
                        <img src="../../assets/imgs/c99.png" width="180" height="50" alt="some">
                    </section>

                    <section class="header-links-section">
                        <ul>
                            <li class="links-head"><a href="app/auth/signup.php">About Us</a></li>
                            <li class="links-head"><a href="app/auth/signup.php">Contact Us</a></li>
                            <li><div id="splitter">&#8205;</div></li>
                            <li ><a  href="#"><img class="profile-img" src="../uploads/images/{$loggedUser['member_photoRef']}" alt="profileImg"></a></li>
                            <li class="links-head"><a  href="../controllers/logout.controller.php">logout</a></li>
                        </ul>
                    </section>
                </nav>
            </header>
            <aside id="left-aside">
                        <nav class="left-navbar">
                            <ul>
                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/icons8-dashboard-layout-96 (2).png" alt="dashboard">
                                    <a href="./index.php?success=verified&id={$loggedUser['memeber_token']}">Dashboard</a>
                                </li>

                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/add.png" alt="add task">
                                    <a href="./add.php">add task</a>
                                </li>

                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/icons8-search-208 (1).png" alt="search Task">
                                    <a href="./search.php">search task</a>
                                </li>

                                    <div class="splitter-btm">&#8205;</div>
                                    <br>
                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/icons8-task-completed-90.png" alt="active">
                                    <a href="./active.php">active tasks</a>
                                </li>

                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/deadline (1).png" alt="overdue task">
                                    <a href="./overdue.php">overdue tasks</a>
                                </li>

                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/wall-clock (1).png" alt="pending task">
                                    <a href="./pending.php">pending tasks</a>
                                </li>

                                <div class="splitter-btm">&#8205;</div>
                                <br>
                                <li>
                                    <img  class="img-ico profile-img" src="../../assets/imgs/user.png" alt="profile">
                                    <a href="./profile.php">profile</a>
                                </li>
                                
                                <li>
                                    <img  class="img-ico" width="100"src="../../assets/imgs/group-chat (1).png" alt="Team members">
                                    <a href="./members.php">team members</a>
                                </li>

                                <li>
                                    <img  class="img-ico" src="../../assets/imgs/setting.png" alt="settings">
                                    <a href="#">settings</a>
                                </li>
                            </ul>
                        </nav>
            </aside>
            <main class="main-section">

                <h1>Task Information</h1>
                
                <section class="task-info-sec">
        HTML;

    $getTaskInfo  = getTasksInfo($_GET['taskId']);

    echo <<<HTML
                <div class="info">
                    <h2>Task ID : {$getTaskInfo['task_Id']}</h2>
                </div>
                <div class="info">
                    <h2>Task Title : {$getTaskInfo['task_title']}</h2>
                </div>
                <div class="info">
                    <h2>Description</h2>
                    <textarea cols="70" rows="10">{$getTaskInfo['task_description']}</textarea>
                </div>
                <div class="info">
                    <h2>Start Date : {$getTaskInfo['task_startDate']}</h2>
                </div>
                <div class="info">
                    <h2>Due Date: {$getTaskInfo['task_endDate']}</h2>
                </div>
                <div class="info">
                    <h2>status : {$getTaskInfo['task_status']}</h2>
                </div>
                <div class="info">
                    <h2>Priority: {$getTaskInfo['task_priority']}</h2>
                </div>
                <div class="info">
                    <h2>Assigned To : {$getTaskInfo['task_assignedUserId']}</h2>
                </div>
                <div class="info">
                    <h2>Assigned By : {$getTaskInfo['task_ByUserId']}</h2>
                </div>

HTML;

    echo <<<HTML
                </section>

            </main>
                
            <footer id="footer-section">
                <section class="socialMedia">
                    <a href="https://www.facebook.com/ezpzok" target="_blank"><img src="../../assets/imgs/facebook.png" width="26" alt="facebook" /></a>
                    <a href="https://www.instagram.com" target="_blank"><img src="../../assets/imgs/instagram (2).png" width="26" alt="instagram" /></a>
                    <a href="https://www.linkedin.com/in/mohammed-tahaynah/" target="_blank"><img src="../../assets/imgs/linkedin.png" width="26" alt="linkedin" /></a>
                    <a href="https://github.com/SMIL3Cr4Ck3R" target="_blank"><img src="../../assets/imgs/github.png" width="26" alt="github" /></a>
                </section>
                <p>&copy; mohammed tahaynah</p>
            </footer>
        </body>
        </html>
        HTML;
} else {

    echo "invalid login token please try again later";
}
