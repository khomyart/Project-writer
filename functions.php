<?php

    //err_code=1 when registration is not ok, err_code=2 when authorization is not ok

    /**
     * Registration validator. User submits login through some method
     * and function does check if submited login alredy exists in $loginmassive
     * 
     * @param array $loginmassive
     * @param string $key_in_method
     * 
     * @return true if sumbited login exists
     */

    function RepeatChecker($loginmassive, $key_in_method) {
        for ($i=0; $i <= count($loginmassive); $i++) {
            if ($_POST[$key_in_method]===$loginmassive[$i]) {
               return true;
            }
        }
    }

    /**
     * Function check for err_code,  
     */
    
    function ErrClassFeedback () {
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

    function ErrMessageFeedback () {
        global $err_code;
        if ($err_code === 0) {
            return "<div class='text_success'>Success!</div>";
        } elseif ($err_code === 1) {
            return "<div class='text_error'>This account already exists</div>";
        } elseif ($err_code === 2) {
            return "<div class='text_error'>Login or password is incorrect</div>";
        } elseif ($err_code === 3) {
            return "<div class='text_error'>Account does not exist</div>";
        } elseif ($err_code === 4) {
             return "<div class='text_error'>Display name already exists</div>";
        }
    }

?>