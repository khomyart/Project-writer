<?php

    //err_code=1 when registration is not ok, err_code=2 when authorization is not ok

    /**
     * Registration validator. User submits login through some method
     * and function does check if submited login alredy exists in $loginmassive
     * 
     * @param array $loginmassive
     * 
     * @return true if sumbited login exists
     */

    function loginRepeatChecker($loginmassive) {
        for ($i=0; $i <= count($loginmassive); $i++) {
            if ($_POST["login"]===$loginmassive[$i]) {
               return true;
            }
        }
    }

    /**
     * Function check for err_code,  
     */
    
    function loginErrClassFeedback () {
        global $err_code;
        if ($err_code === 1 || 
            $err_code === 2 || 
            $err_code === 3) {
            return 'bad-value';
        } else {
            return '';
        }
    }

    function loginErrMessageFeedback () {
        global $err_code;
        if ($err_code === 0) {
            return 'Success!';
        } elseif ($err_code === 1) {
            return 'This account already exists';
        } elseif ($err_code === 2) {
            return 'Login or password is incorrect';
        } elseif ($err_code === 3) {
            return 'Account does not exist';
        }
    }

?>