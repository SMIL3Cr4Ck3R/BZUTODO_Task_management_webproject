<?php

        function getDBConnectionInstance(){

            try {
                $db_host = 'localhost';
                $db_name = 'c616_project_managment_system';
                $db_username = 'c616_mtahayna';
                $db_password = 'c616_mtahayna';

                $PDO_Connect_Obj = new PDO("mysql:host=".$db_host.";dbname=".$db_name,$db_username,$db_password);
                $PDO_Connect_Obj->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            }catch (PDOException $e) {

                echo "connection faild";
                echo $e->getMessage();
                exit(-1);
                
            }
            return $PDO_Connect_Obj;
        }
?>