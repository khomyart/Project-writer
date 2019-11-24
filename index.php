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
        }elseif($method === $_GET) {
            $form_method = "get";
        }

        #User authorization
        $users = file_get_contents($users_file);
        $users = json_decode($users, TRUE);
        if(isset($method["signin_button"])) {
            if(AuthValidationChecker($users, $method, $user_id)){
                $_SESSION["auth"]["login"] = $users[$user_id]["login"];
                $_SESSION["auth"]["display_name"] = $users[$user_id]["display_name"]; 
                $_SESSION["auth"]["user_id"] = $user_id;
                header("Location: http://files.khomyart.com/catalog.php");
                exit();
            } else {
                $err_code=2;
            }
        }
        #User authorization end
?>

<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form 
            method=<?=$form_method?>
            action="index.php" 
            class="d-flex flex-column justify-content-center align-items-center col-9 col-md-6 col-xl-3">
            <input 
                class="form-control <?=ErrorClassFeedback();?>" 
                type="text" 
                placeholder="Login" 
                name="login" value="">
            <input 
                class="form-control <?=ErrorClassFeedback();?>" 
                type="password" 
                id="exampleInputPassword1" 
                style="margin-top:15px;" 
                placeholder="Password"
                name="password" 
                value="">
                <?=ErrorMessageFeedback();?>
            <div class="d-flex justify-content-center">
                <button 
                    type="submit" 
                    style="margin-top:15px; border-radius: 8px 0 0 8px;" 
                    class="btn btn-primary" 
                    name="signin_button" 
                    value="signin">
                    Log In
                </button>
                <a href="http://files.khomyart.com/registration.php">
                    <button 
                        type="button" 
                        style="margin-top:15px; border-radius: 0 8px 8px 0;" 
                        class="btn btn-primary">
                        Registration
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>

<?php 
        include "footer.php";
    }
?>