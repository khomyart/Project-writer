<?php

    function loginRepeatChecker($loginmassive) {
        for ($i=0; $i <= count($loginmassive); $i++) {
            if ($_GET["login"]===$loginmassive[$i]) {
               return true;
            }
        }
    }

?>