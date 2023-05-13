<?php 

    require_once "./session.controller.php";


    unset($_SESSION['session_variable_name']);
    session_destroy();
    header("Location: ../auth/login.php");
?>