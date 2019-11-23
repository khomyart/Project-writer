<?php
    session_start();
    include "header.php";
    include "functions.php";
    $acc_file = "dat_files/accounts.dat";
    $login_file = "dat_files/login.dat";
    $pass_file = "dat_files/pass.dat";
    define ("err_code", 0); //err_code=1 when registration is not ok, err_code=2 when authorization is not ok
?>

<?php 
    //USER REGISTRATION
    if ($_GET["signup_button"]==="signup") {
        $logins = file_get_contents($login_file);
        $logins = json_decode ($logins, true);
        $passwords = file_get_contents($pass_file);
        $passwords = json_decode ($passwords, true);
        if (loginRepeatChecker($logins)) {
            $err_code = 1;
        } else {
            $logins[]=$_GET["login"];
            $passwords[]=$_GET["password"];
            $encoded_logins = json_encode($logins);
            file_put_contents ($login_file, $encoded_logins);
            $encoded_pass = json_encode($passwords);
            file_put_contents ($pass_file, $encoded_pass);
            $err_code = 0;
        }
    }
    //USER REGISTRATION 

    //USER AUTHORIZATION
    if ($_GET["signin_button"]==="signin") {
        $logins = file_get_contents($login_file);
        $logins = json_decode ($logins, true);
        $passwords = file_get_contents($pass_file);
        $passwords = json_decode ($passwords, true);
        $log_i=0;
        foreach ($logins as $logkey) {
            if ($_GET["login"]===$logkey) {
                $login_key = $log_i;
                break;
            }
            $log_i++;
        }
        $pass_i=0;
        foreach ($passwords as $passkey) {
            if ($pass_i===$log_i) {
                if ($_GET["password"]===$passkey) {
                    $err_code = 0;
                } else {
                    $err_code = 2;
                }
            }
            $pass_i++;
        }
    }
    //USER AUTHORIZATION 
?>

<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form method="get" action="index.php" class="d-flex flex-column justify-content-center align-items-center col-3" >
            <input class="form-control <?= loginErrClassFeedback(); ?>" type="text" placeholder="Login" name="login" value="">
            <input class="form-control <?= loginErrClassFeedback(); ?>" type="text" style="margin-top:15px;" placeholder="Password" name=password value="">
            <div class="login_text_error">
                <?= loginErrMessageFeedback (); ?>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" style="margin-top:25px; border-radius: 8px 0 0 8px;" class="btn btn-primary" name="signin_button" value="signin">Log In</button>
                <button type="submit" style="margin-top:25px; border-radius: 0 8px 8px 0;" class="btn btn-primary" name="signup_button" value="signup">Registration</button>
            </div>
        </form>
    </div>
</div>

<?php 
    include "footer.php";
?>