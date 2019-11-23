<?php

    //err_code=1 when registration is not ok, err_code=2 when authorization is not ok

    function loginRepeatChecker($loginmassive) {
        for ($i=0; $i <= count($loginmassive); $i++) {
            if ($_GET["login"]===$loginmassive[$i]) {
               return true;
            }
        }
    }
    
    function loginErrClassFeedback () {
        global $err_code;
        if ($err_code === 1 || $err_code === 2) {
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
        }
    }

?>