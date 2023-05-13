<?php

    require_once "./session.controller.php";

if (isset($_POST['SignInBtn'])) {

    require_once '../database/connectDB.php';
    $dbInstance = getDBConnectionInstance();

    
    validateUserAuth ($dbInstance);

}else{
    echo 'error submit';
    exit();
}

function validateUserAuth ($dbInstance) {


    if (empty($_POST['username']) || empty($_POST['password'])) {

        header('Location: ../auth/login.php?error=signup');
        exit(-1);

    }else { 
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql_query = "SELECT * from login_auth WHERE login_username= ? AND login_password= ?";
        $stmt = $dbInstance->prepare($sql_query);
        $stmt->execute([$username,$password]);
        echo $stmt->rowCount();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $_SESSION['userId'] =$row['login_UserID'] ;
            header("Location: ../dashboard/index.php?success=verified");
            exit();
        }else {
            header('Location: ../auth/login.php?error=invaliduser');
            exit(-1);
        }
    }
}

?>