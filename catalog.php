<?php 
    session_start();
    include "header.php";
?>

<?php 
if (isset($_SESSION["auth"]))
{
?>  
<!--insert some html-->
<div class="container p-0 d-flex flex-column" style="height: 100vh; background-color: #f3f3f3;">
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $_SESSION["auth"]["dname"] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <form action=""  method="get"> 
                        <button type="submit" class="dropdown-item" name="logout" value="logout">Log out</button>
                    </form>
                    <?php 
                        if (isset($_GET["logout"])) {
                            session_destroy ();
                            unset ($_SESSION);
                            header ("Location: http://files.khomyart.com/index.php");
                            exit();
                        } 
                    ?>
                </div>
            </li>
        </ul>
        </div>
    </nav>
    <!--NAVBAR-->
    <h1>Hello, <?php echo($_SESSION["auth"]["dname"]);?></h1>
</div>

<?php
} else {
    echo "you are not authorized, please, go to authorization page and sign in";
}
?>

<?php 
    include "footer.php";
?>