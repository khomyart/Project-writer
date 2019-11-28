<?php
    $err_code=-1;
    //err_code=1 when registration is not ok, err_code=2 when authorization is not ok

    function LoginExistence($reading_query_result, $login) {
        while($row = mysqli_fetch_assoc($reading_query_result)) {
            if($row['user_login'] === $login) {
                return true;
            }
        }
    }

    function AuthValidation($users, $login, $password) {
    global $err_code;
       foreach($users as $user) {
            if(($user["user_login"] === $login) 
            && (password_verify($password, $user["user_pwd"]))) {
                $_SESSION["auth"]["login"] = $user['user_login'];
                $_SESSION["auth"]["display_name"] = $user['user_dname'];
                $_SESSION["auth"]["user_id"] = $user['user_id'];
                header("Location: http://files.khomyart.com/catalog.php");
                exit();
            } elseif(isset($login)) {
                $err_code = 2;
            }
        }
    }

    /**
     * Function check for err_code,  
     */
    
    function ErrorClassFeedback() {
        global $err_code;
        if ($err_code === 1 || 
            $err_code === 2 || 
            $err_code === 3 ||
            $err_code === 4 ||
            $err_code === 5) {
            return 'bad-value';
        } else {
            return '';
        }
    }

    function ErrorMessageFeedback() {
        global $err_code;
        if ($err_code === 0) {
            return "<div class='text_success'>Success!</div>";
        } elseif ($err_code === 1) {
            return "<div class='text_error'>Account or display name already exists</div>";
        } elseif ($err_code === 2) {
            return "<div class='text_error'>Login or password is incorrect</div>";
        } elseif ($err_code === 3) {
            return "<div class='text_error'>Account does not exist</div>";
        } elseif ($err_code === 4) {
             return "<div class='text_error'>Display name already exists</div>";
        } elseif ($_SESSION["auth"]["err_code"] === 5) {
            return "<div class='text_error'>File already exists</div>";
       }
    }

?>