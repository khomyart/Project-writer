<?php 
    include "header.php";
    $acc_file = "dat_files/accounts.dat";
    $login_file = "dat_files/login.dat";
    $pass_file = "dat_files/pass.dat";
?>


<div class="container p-0" style="height: 100vh;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form method="get" action="index.php" class="d-flex flex-column justify-content-center align-items-center" >
            <input class="form-control" type="text" placeholder="Login" name="login" value="">
            <input class="form-control" type="text" style="margin-top:15px;" placeholder="Password" name=password value="">
            <button type="submit" style="margin-top:20px;" class="btn btn-primary" name="signin_button" value="signin">Sign in</button>
            <button type="submit" style="margin-top:20px;" class="btn btn-primary" name="signup_button" value="signup">Sign up</button>
        </form>
    </div>
</div>

<?php 
    if ($_GET["signup_button"]==="signup") {
        $logins = file_get_contents($login_file);
        $logins = json_decode ($logins, true);
        $passwords = file_get_contents($pass_file);
        $passwords = json_decode ($passwords, true);
        foreach ($logins as $key) {
            if ($_GET["login"]===$key) {
                $err_code = 1;
                break;
            } else {
                $logins[]=$_GET["login"];
                $passwords[]=$_GET["password"];
                $encoded_logins = json_encode($logins);
                file_put_contents ($login_file, $encoded_logins);
                $encoded_pass = json_encode($passwords);
                file_put_contents ($pass_file, $encoded_pass);
            }
        } 
    }
    echo ($err_code);
?>

<?php 
    include "footer.php";
?>