<?php 
    include "header.php";
?>


<div class="container vh-100 p-0">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <form method="get" action="index.php" class="d-flex flex-column justify-content-center align-items-center" >
            <input class="form-control" type="text" placeholder="Login" name=login value="">
            <input class="form-control" type="text" style="margin-top:15px;" placeholder="Password" name=password value="">
            <button type="submit" style="margin-top:20px;" class="btn btn-primary">Log in</button>
        </form>
    </div>
</div>


<?php 
    include "footer.php";
?>