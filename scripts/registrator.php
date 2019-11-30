<?php
    $login = mysqli_real_escape_string($db_connection,$_POST["login"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $password=mysqli_real_escape_string($db_connection,$password);
    $display_name = mysqli_real_escape_string($db_connection,$_POST["display_name"]);

    if(isset($_POST["signup_button"])) {
        if (strlen($_POST["login"])<3 || strlen($_POST["password"])<3) {
            $err_code = 6;
        }
        if (strlen($_POST["login"])>16 || strlen($_POST["password"])>16) {
            $err_code = 7;
        }
        $sql_query_read = "SELECT user_login FROM users;";
        $read_result = mysqli_query($db_connection, $sql_query_read);
        if(!$read_result) {
            echo "DB read error";
            exit();
        } 
        elseif(LoginExistence($read_result, $_POST["login"])) {
            $err_code=1;
        } 
        $sql_query_read = "SELECT user_dname FROM users;";
        $read_result = mysqli_query($db_connection, $sql_query_read);
        if(!$read_result) {
            echo "DB read error";
            exit();
        } 
        if(DnameExistence($read_result, $_POST["display_name"])) {
            $err_code=4;
        } 
        if(!isset($err_code)){
            $sql_query_write = "INSERT INTO users(user_login,user_pwd,user_dname) VALUES (?, ?, ?);";
            $stmt = mysqli_stmt_init($db_connection);
            if(!mysqli_stmt_prepare($stmt,$sql_query_write)) {
                echo "SQL error";
                exit();
            } elseif(!mysqli_stmt_bind_param($stmt, "sss", $login, $password, $display_name)) {
                echo "bind param error";
                exit();
            } elseif (!mysqli_stmt_execute($stmt)) {
                echo "nonono u got an stmt eroo"; 
            } else {
                $user_dir = 'users/'.$_POST['login']."/files/";
                mkdir($user_dir, 0777, true); 
                $err_code=0;
                $_SESSION["auth"]["user_folder"] = $user_dir;
                header("Refresh: 2; url=../index.php");
            }  
                       
        }
    }

?>

