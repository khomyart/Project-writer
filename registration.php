<?php
    ini_set('display_errors', 1);
    session_start();
    include "/var/www/files.khomyart.com/public_html/scripts/db_connector.php";
    include "/var/www/files.khomyart.com/public_html/functions.php";
    include "/var/www/files.khomyart.com/public_html/scripts/registrator.php"; 
    include "/var/www/files.khomyart.com/public_html/header.php";   
    if (isset($_SESSION['auth']["login"])) {
        header("Location: ../catalog.php");
        exit();
    } else {
?>
    <div class='container p-0' style='height: 100vh;'>
        <div class='d-flex flex-column justify-content-center align-items-center w-100 h-100'>
            <form 
                method='post'
                action='registration.php' 
                class='d-flex flex-column justify-content-center align-items-center col-9 col-md-6 col-xl-3'>
                <input 
                    class='form-control <?=ErrorClassFeedback();?>' 
                    type='text' 
                    placeholder='Login' 
                    name='login' 
                    value=''>
                <input 
                    class='form-control <?=ErrorClassFeedback();?>' 
                    type='text' style='margin-top:15px;' 
                    placeholder='Password' 
                    name='password' 
                    value=''>
                <input 
                    class='form-control <?=ErrorClassFeedback();?>' 
                    type='text' 
                    style='margin-top:15px;' 
                    placeholder='Dsiplay name' 
                    name='display_name' 
                    value=''>
                <?=ErrorMessageFeedback();?>
                <div class='d-flex justify-content-center'>
                    <a href='http://files.khomyart.com/index.php'>
                        <button 
                            type='button' 
                            style='margin-top:15px; border-radius: 8px 0 0 8px;' 
                            class='btn btn-primary' 
                            name='signup_button' 
                            value='signup'>
                            Back
                        </button>
                    </a>
                    <button 
                        type='submit' 
                        style='margin-top:15px; border-radius: 0 8px 8px 0;' 
                        class='btn btn-primary' 
                        name='signup_button' 
                        value='signup'>
                        Registration
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php 
       include "/var/www/files.khomyart.com/public_html/footer.php";
    }
?>