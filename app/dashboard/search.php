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
            <title>Dashboard</title>
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
                <h1>Search Tasks</h1>
                <section class="search-section">
                    <form action="{$_SERVER['PHP_SELF']}" method="post">

                    <fieldset>
                    <legend>Search Tasks</legend>

                        <div>
                            <label for="byDate">Date</label>
                            <input type="date" name="byDate" id="byDate">
                        </div>

                        <div>
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority">
                                <option selected   ></option>
                                <option value="1">low</option>
                                <option value="2">medium</option>
                                <option value="3">high</option>
                            </select>
                        </div>
                        <div>
                            <label for="status">status</label>
                            <select name="status" id="status">
                                <option  selected   ></option>
                                <option value="L">late</option>
                                <option value="A">active</option>
                                <option value="P">pending</option>
                                <option value="F">finished</option>
                            </select>
                        </div>

                        <div>
                            <label for="byName">Member Name</label>
                            <input type="text" name="byName" id="byName">
                        </div>

                        <div>
                            <input type="submit" name="search-submit" id="search-submit" value="Search">
                        </div>
                    </fieldset>
                    </form>
                </section>

                <section class="searched-section">
                    <table class="searched-table" border="1" cellspacing="1">

                        <thead>
                            <th>Task Title</th>
                            <th>Assigned to</th>
                            <th>Priority</th>
                            <th>status</th>
                            <th>details</th>
                        </thead>
                        <tbody>
        HTML;

                            if (isset($_POST['search-submit'])) {

                                $searchArray = array(

                                    'byDate'   => $_POST['byDate'],
                                    'priority' => $_POST['priority'],
                                    'status'   => $_POST['status'],
                                    'byName'   => $_POST['byName']
                                );

                                $result = getSearchResults($searchArray);
                                
      
                                if ($result !=null){
                                    $even = 1;
                                    foreach ($result as $key => $value) {

                                        if ($even % 2 == 0) {
                                            echo <<<HTML
                                            <tr class="even-row">
                                                <td><p>{$result[$key]['task_title']}</p></td>
                                                <td><img src="../uploads/images/{$result[$key]['member_photoRef']}" width="50" alt="pfp"></td>
                                        HTML;
                                        }else {
                                            echo <<<HTML
                                            <tr class="odd-row">
                                                <td><p>{$result[$key]['task_title']}</p></td>
                                                <td><img src="../uploads/images/{$result[$key]['member_photoRef']}" width="50" alt="pfp"></td>
                                        HTML;
                                        }
                                            if ($result[$key]['task_status'] == 'P') {
                                                checkStatus ("pending", $key);
                                            }else if ($result[$key]['task_status'] === 'L' ) {
                                                checkStatus ("late", $key);
                                            }else if ($result[$key]['task_status'] === 'A') {
                                                checkStatus ('active', $key);
                                            }
                                            if ($result[$key]['task_assignedUserId'] === $loggedUser['memeber_token'] ) {
                                                echo "<td><a href=\"./viewTask.php?taskId={$result[$key]['task_Id']}\">more info</a><a href=\"#\"><img class=\"updateImg\" src=\"../../assets/imgs/edit (1).png\"  width=\"24\" alt=\"update\" /></a></td>";
                                            }else 
                                                echo "<td><a href=\"./viewTask.php?taskId={$result[$key]['task_Id']}\">more info</a></td>";
                                            $even++;
                                    
                                    }
                                }else
                                    echo "<tr><td colspan=\"6\">NO TASK FOR TODAY'S DATE :D</td></tr>";


                            }

        echo <<<HTML
                        </tbody>

                    </table>
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

function checkStatus ($statusClass,$key) {

    global $result;

    if ($result[$key]['task_priority'] === '1') {
        echo "<td >Low</td>";
        echo "<td class=\"$statusClass\">{$result[$key]['task_status']}</td>";
        
    }else if ($result[$key]['task_priority'] === '2') {
        echo "<td >Medium</td>";
        echo "<td class=\"$statusClass\">{$result[$key]['task_status']}</td>";
        
    }else if ($result[$key]['task_priority'] === '3') {
        echo "<td >High</td>";
        echo "<td class=\"$statusClass\">{$result[$key]['task_status']}</td>";
        
    }

} 

?>