<?php 
    $db_location = 'localhost';
    $username = 'root';
    $password = 'i29y39u68xxx';
    $db_name = 'files_khomyart';

    $db_connection = mysqli_connect($db_location, $username, $password, $db_name);

    if(!$db_connection) {
        exit ();
    } 
?>