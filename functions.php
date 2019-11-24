<?php

    //err_code=1 when registration is not ok, err_code=2 when authorization is not ok

    /**
     * User submits login through some method
     * and function does check if submited login alredy exists in $usersmassive,
     * then check if submited password through method does match current user's login
     * 
     * @param array $usersmassive
     * @param array $method
     * @param int $user_id
     * 
     * @return true if auth is succesfull
     */

    function AuthValidationChecker($users_massive, $method, &$user_id) {
        for($i=0; $i <= count($users_massive); $i++) {
            if($method["login"] === $users_massive[$i]["login"]) {
                if ($method["password"] === $users_massive[$i]["password"]) {
                    $user_id = $i;
                    return true;
                }
            }
        }
    }

    function ElementExistenceChecker($method, $users_massive, $key_of_element){
        for($i=0; $i <= count($users_massive); $i++){
            if($method[$key_of_element] === $users_massive[$i][$key_of_element]){
                return true;
            }
        }
    }

    /**
     * Function check for err_code,  
     */
    
    function ErrorClassFeedback () {
        global $err_code;
        if ($err_code === 1 || 
            $err_code === 2 || 
            $err_code === 3 ||
            $err_code === 4) {
            return 'bad-value';
        } else {
            return '';
        }
    }

    function ErrorMessageFeedback () {
        global $err_code;
        if ($err_code === 0) {
            return "<div class='text_success'>Success!</div>";
        } elseif ($err_code === 1) {
            return "<div class='text_error'>Account already exists</div>";
        } elseif ($err_code === 2) {
            return "<div class='text_error'>Login or password is incorrect</div>";
        } elseif ($err_code === 3) {
            return "<div class='text_error'>Account does not exist</div>";
        } elseif ($err_code === 4) {
             return "<div class='text_error'>Display name already exists</div>";
        }
    }

?>