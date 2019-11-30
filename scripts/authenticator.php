<?php
    $method = $_POST;
    if($method === $_POST) {
        $form_method = "post";
    } elseif($method === $_GET) {
        $form_method = "get";
    }

    $sql_query_read = "SELECT * from `users`";
    $read_result = mysqli_query($db_connection, $sql_query_read);
        $users = [''];
    while($row = mysqli_fetch_assoc($read_result)) {
        $users[] = $row;
    }

    AuthValidation($users, $method["login"], $method["password"]);

?>