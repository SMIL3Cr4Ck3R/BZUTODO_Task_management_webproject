<?php 

    require_once "./session.controller.php";

    if (isset($_POST['search-submit'])) {

        require_once "../database/queries.php";
        $userId = $_SESSION['userId'];

        

    }else {
        header("Location: ../dashboard/search.php?search=invalid");
        exit(-1);
    }
?>