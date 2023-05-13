<?php 


    if (isset($_POST['addSubmit'])) {

        require_once "./session.controller.php";
        require_once "../database/queries.php";
        $userId = $_SESSION['userId'];

        $taskInput = array (

            'taskTitle' => $_POST['taskTitle'],
            'startingDate' => $_POST['startingDate'],
            'dueDate' => $_POST['DueDate'],
            'priority' => $_POST['priority'],
            'taskDesc' => $_POST['taskDesc'],
            'assignedTo' => $_POST['assignedTo'],
            'assignedBy' => $userId,
        );

        $added = insertTask ($taskInput);

        if ($added != null) {
            header("Location: ../dashboard/index.php?newTask=Added");
        }else
            header("Location: ../dashboard/add.php?newTask=error");
        


    }else
        echo "error occured try again";

?>