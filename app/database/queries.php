<?php

require_once "../database/connectDB.php";
$con =   getDBConnectionInstance();

function getUserInfoByID($userID)
{

    global $con;

    $sql_query = "SELECT * from members where memeber_token = ?";
    $prepare = $con->prepare($sql_query);
    $prepare->execute([$userID]);

    if ($prepare->rowCount() > 0) {
        return $prepare->fetch();
    }
    return null;
}

function getDailyTasks()
{
    $offset = -8640; // 1 day offset
    $date = date("Y-m-d", time() + $offset);
    global $con;

    $sql_query1 = "SELECT tasks.*, members.member_PhotoRef from tasks , members 
                    where tasks.task_assignedUserId = members.memeber_token AND tasks.task_startDate = ?";

    $prepare1 = $con->prepare($sql_query1);
    $prepare1->execute(array($date));

    $dataArray = $prepare1->fetchAll();
    $sql_query2 = "SELECT members.member_PhotoRef from tasks , members
    where tasks.task_ByUserID = members.memeber_token";

    $prepare2 = $con->prepare($sql_query2);
    $prepare2->execute();
    $photoBy = $prepare2->fetchAll();

    $arrPhotos = array();

    foreach ($photoBy as $value) {
        $arrPhotos[] = $value['member_PhotoRef'];
    }

    $i = 0;
    foreach ($dataArray as $key => $value) {
        $dataArray[$key]['byPhoto'] = $arrPhotos[$i];
        $i++;
    }


    if ($prepare1->rowCount() > 0) {
        return $dataArray;
    }
    return null;
}


function getUserNames()
{

    global $con;

    $sql_query = "SELECT members.memeber_token,members.member_name from members";
    $prepare = $con->prepare($sql_query);
    $prepare->execute();
    if ($prepare->rowCount() > 0) {
        return $prepare->fetchAll();
    }
    return null;
}

function insertTask($taskInfo)
{

    global $con;

    $sql_query = "INSERT INTO `tasks` (`task_title`, `task_description`, 
    `task_startDate`, `task_endDate`, `task_priority`, `task_assignedUserId`, `task_ByUserId`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $prepare = $con->prepare($sql_query);

    $prepare->execute(array(
        $taskInfo['taskTitle'],
        $taskInfo['taskDesc'],
        $taskInfo['startingDate'],
        $taskInfo['dueDate'],
        $taskInfo['priority'],
        $taskInfo['assignedTo'],
        $taskInfo['assignedBy']
    ));

    if ($prepare->rowCount() > 0) {
        return $prepare->rowCount();
    } else
        return null;
}


function getTasksByStatus($status)
{

    global $con;


    $sql_query1 = "SELECT tasks.* , members.member_PhotoRef FROM tasks, members where tasks.task_status = ?
     AND tasks.task_assignedUserId = members.memeber_token";
    $prepare1 = $con->prepare($sql_query1);
    $prepare1->execute(array($status));

    $dataArray = $prepare1->fetchAll();


    $sql_query2 = "SELECT members.member_PhotoRef from tasks , members 
    where  tasks.task_status = ? AND tasks.task_ByUserID = members.memeber_token";

    $prepare2 = $con->prepare($sql_query2);
    $prepare2->execute(array($status));
    $photoBy = $prepare2->fetchAll();

    $arrPhotos = array();

    foreach ($photoBy as $value) {
        $arrPhotos[] = $value['member_PhotoRef'];
    }

    $i = 0;
    foreach ($dataArray as $key => $value) {
        $dataArray[$key]['byPhoto'] = $arrPhotos[$i];
        $i++;
    }


    if ($prepare1->rowCount() > 0) {
        return $dataArray;
    }
    return null;
}

function getSearchResults($searchArray)
{

    foreach ($searchArray as $key => $value) {
        if ($searchArray[$key] === "") {
            $searchArray[$key] = null;
        } 
    }


    global $con;

    $sql_query = "SELECT tasks.* , members.member_photoRef FROM tasks , members 
                  WHERE  tasks.task_endDate = ? OR tasks.task_priority = ? 
                  OR  tasks.task_status = ? OR members.member_name = ? ";

    $dataSet = $con->prepare($sql_query);
    $dataSet->execute(array(

        $searchArray['byDate'],
        $searchArray['priority'],
        $searchArray['status'],
        $searchArray['byName']
    ));

    if ($dataSet->rowCount() > 0) {
            return $dataSet->fetchAll();
    } else
        return null;
}



function getTasksInfo($task_id) {

    global $con;

    $sql_query = "SELECT * from tasks WHERE task_id= ?";
    $prepare = $con->prepare($sql_query);
    $prepare->execute(array($task_id));

    if ($prepare->rowCount() > 0) {
        return $prepare->fetch();
    }
    return null;

}