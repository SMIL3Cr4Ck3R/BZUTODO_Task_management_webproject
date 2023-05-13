<?php


    if (isset($_POST['submit-user-cred'])) {

        require_once '../database/connectDB.php';
        $connectDBInstance = getDBConnectionInstance();


        signup_validtion ($connectDBInstance) ;

        $formInputArr = array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'confirm-password' => $_POST['confirm-password'],
            'fullName' => $_POST['fullName'],
            'idNum'    => $_POST['idNum'],
            'DOB'      => $_POST['DOB'],
            'YOE'      => $_POST['YOE'],
            'Nationality'  => $_POST['Nationality'],
            'Address'      => $_POST['Address'],
            'MobileNumber' => $_POST['MobileNumber'],
            'emailAddress' => $_POST['emailAddress']
            
        );
        
        $formInputArr['member_photoRef'] = validateFileUpload('photo') ;
        $formInputArr['cv_fileRef'] = validateFileUpload('cv') ;
        $formInputArr['memeber_token'] = mt_rand(100000,999999);
        
        insert_user($formInputArr,$connectDBInstance);

    }else {

        echo 'submission error';
        header("Location: ../auth/signup.php");
    }

    function signup_validtion ($connectDBInstance) {

        
        if ($_POST['password'] !== $_POST['confirm-password']) { 

            header('Location: ../auth/signup.php?unmatch=unmatchingpasswords');
            exit(-1);
            
        }

        if(checkExists($_POST['username'],$connectDBInstance)){

            header('Location: ../auth/signup.php?error=user_exists');
            exit(-1);
        }
        
        if (!isset($_POST['username'])     || !isset($_POST['password'])    || !isset($_POST['fullName']) ||
            !isset($_POST['idNum'])        || !isset($_POST['Nationality']) || !isset($_POST['Address'])  ||
            !isset($_POST['MobileNumber']) || !isset($_POST['emailAddress'])|| !isset($_POST['DOB'])      ||
            !isset($_POST['YOE'])          || !isset($_FILES['photo'])      || !isset($_FILES['cv'])) {

            header('Location: ../auth/signup.php?error=checkinput');
            exit(-1);

        }   


    }

    function validateFileUpload($fileElementName){

        if (isset($_FILES[$fileElementName])) {

            switch ($fileElementName) {
                
                case 'photo': 
                    move_uploaded_file($_FILES[$fileElementName]['tmp_name'],'../uploads/images/'.$_FILES[$fileElementName]['name']);
                    break;
                case 'cv': 
                    move_uploaded_file($_FILES[$fileElementName]['tmp_name'],'../uploads/cvs/'.$_FILES[$fileElementName]['name']);
                    break;
            }
            echo 'file uploaded';
            
        }else {
            echo 'no file uploaded';
        }
        return $_FILES[$fileElementName]['name'];
    }

    function checkExists($username,$connectDBInstance) {

        $sql_query = "SELECT login_UserID from login_auth where login_username= ? ";
        $stmt = $connectDBInstance->prepare($sql_query);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    function insert_user ($inputArr,$connectDBInstance){

        try {

            $insert_memeber_sql_query = 
            "INSERT INTO `members` (`memeber_token`, `member_Id`,       `member_name`,  `member_nationality`, 
                                    `member_addr`,   `member_phone`,    `member_email`, `member_DOB`, 
                                    `member_YOE`,    `member_photoRef`, `cv_fileRef`) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt_member = $connectDBInstance->prepare($insert_memeber_sql_query);
        
        $stmt_member->execute(array( $inputArr['memeber_token'],  $inputArr['idNum'],   $inputArr['fullName'],
                                $inputArr['Nationality'],    $inputArr['Address'], $inputArr['MobileNumber'], 
                                $inputArr['emailAddress'],   $inputArr['DOB'],     $inputArr['YOE'], 
                                $inputArr['member_photoRef'],$inputArr['cv_fileRef']));

        if ($stmt_member->rowCount() > 0) {

            $insert_member_auth = " INSERT INTO `login_auth` (`login_UserID`, `login_username`, `login_password`) 
                                    VALUES (?,?,?)";

            $stmt_member_auth = $connectDBInstance->prepare($insert_member_auth);
            $stmt_member_auth->execute([$inputArr['memeber_token'], $inputArr['username'], $inputArr['password']]);
            header("Location: ../auth/login.php?registered=success");
            
        }

        }catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
