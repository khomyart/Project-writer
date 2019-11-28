<?php
    session_start();
    if(isset($_SESSION["auth"])) {
        header("Location: catalog.php");
        exit();
    } else {
        include "functions.php";
        include "header.php";
        include "scripts/authenticator.php"; 
?>

<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form 
            method="<?=$form_method?>"
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