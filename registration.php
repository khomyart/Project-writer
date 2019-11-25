<?php
session_start();
if(isset($_SESSION["auth"])) {
    header("Location: http://files.khomyart.com/catalog.php");
    exit();
} else {
    include "header.php";
    include "functions.php";
    $users_file = "dat_files/accounts.dat";
    $user_id = 0; #can be used to get id of user who pass through auth process
    $method = $_POST;
    if($method === $_POST) {
        $form_method = "post";
    } elseif($method === $_GET) {
        $form_method = "get";
    }

    #User registration 
    if($_POST["signup_button"]==="signup") {
         $users = file_get_contents($users_file);
         $users = json_decode($users, TRUE);
        if(ElementExistenceChecker($method, $users, "login")) {
            $err_code = 1;
        } elseif(ElementExistenceChecker($method, $users, "display_name")) {
            $err_code = 4;
        } else {
            $i = count($users);
            $users[$i]["login"] = $method["login"];
            $users[$i]["password"] = $method["password"];
            $users[$i]["display_name"] = $method["display_name"];
            $encoded_users = json_encode($users);
            file_put_contents($users_file, $encoded_users);
            $user_home_directory = 'users/'.$users[$i]["login"].'/files';
            mkdir($user_home_directory, 0777, true);
            $err_code = 0;
        }
    }
    #User registration end
?>

<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form 
            method=<?=$form_method?>
            action="registration.php" 
            class="d-flex flex-column justify-content-center align-items-center col-9 col-md-6 col-xl-3">
            <input 
                class="form-control <?=ErrorClassFeedback();?>" 
                type="text" 
                placeholder="Login" 
                name="login" 
                value="">
            <input 
                class="form-control <?=ErrorClassFeedback();?>" 
                type="text" style="margin-top:15px;" 
                placeholder="Password" 
                name="password" 
                value="">
            <input 
                class="form-control <?=ErrorClassFeedback();?>" 
                type="text" 
                style="margin-top:15px;" 
                placeholder="Dsiplay name" 
                name="display_name" 
                value="">
            <?=ErrorMessageFeedback();?>
            <div class="d-flex justify-content-center">
                <a href="http://files.khomyart.com/index.php">
                    <button 
                        type="button" 
                        style="margin-top:15px; border-radius: 8px 0 0 8px;" 
                        class="btn btn-primary" 
                        name="signup_button" 
                        value="signup">
                        Back
                    </button>
                </a>
                <button 
                    type="submit" 
                    style="margin-top:15px; border-radius: 0 8px 8px 0;" 
                    class="btn btn-primary" 
                    name="signup_button" 
                    value="signup">
                    Registration
                </button>
            </div>
        </form>
    </div>
</div>

<?php 
        include "footer.php";
    }
    if($err_code===0){
        header('Refresh: 1; URL=http://files.khomyart.com/index.php');
        exit();
    }
?>