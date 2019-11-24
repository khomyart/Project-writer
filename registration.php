<?php
    include "header.php";
    include "functions.php";
    $login_file = "dat_files/login.dat";
    $pass_file = "dat_files/pass.dat";
    $dname_file = "dat_files/dname.dat";
    define ("err_code", 0); //err_code=1 when registration is not ok, err_code=2 when authorization is not ok
?>

<?php 
    //USER REGISTRATION
if ($_POST["signup_button"]==="signup") {
    $logins = file_get_contents($login_file);
    $logins = json_decode ($logins, true);
    $passwords = file_get_contents($pass_file);
    $passwords = json_decode ($passwords, true);
    $dnames = file_get_contents($dname_file);
    $dnames = json_decode ($dnames, true);
    if (RepeatChecker($logins, "login")) {
        $err_code = 1;
    } elseif (RepeatChecker($dnames, "dname")) {
            $err_code = 4;
        } else {
            $logins[]=$_POST["login"];
            $passwords[]=$_POST["password"];
            $dnames[] = $_POST["dname"];
            $encoded_logins = json_encode($logins);
            file_put_contents ($login_file, $encoded_logins);
            $encoded_pass = json_encode($passwords);
            file_put_contents ($pass_file, $encoded_pass);
            $encoded_dnames = json_encode($dnames);
            file_put_contents ($dname_file, $encoded_dnames);
            $err_code = 0;
        }
    }
    //USER REGISTRATION   
?>

<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form method="post" action="registration.php" class="d-flex flex-column justify-content-center align-items-center col-9 col-md-6 col-xl-3" >
            <input class="form-control <?= ErrClassFeedback(); ?>" type="text" placeholder="Login" name="login" value="">
            <input class="form-control <?= ErrClassFeedback(); ?>" type="text" style="margin-top:15px;" placeholder="Password" name="password" value="">
            <input class="form-control <?= ErrClassFeedback(); ?>" type="text" style="margin-top:15px;" placeholder="Dsiplay name" name="dname" value="">
            <?php
                if($err_code===0) {
                    echo (ErrMessageFeedback ());
                } else {
                    echo (ErrMessageFeedback ());
                }
            ?>
            <div class="d-flex justify-content-center">
                <a href="http://files.khomyart.com/index.php">
                    <button type="button" style="margin-top:15px; border-radius: 8px 0 0 8px;" class="btn btn-primary" name="signup_button" value="signup">Back</button>
                </a>
                <button type="submit" style="margin-top:15px; border-radius: 0 8px 8px 0;" class="btn btn-primary" name="signup_button" value="signup">Registration</button>
            </div>
        </form>
    </div>
</div>

<?php 
    include "footer.php";
?>