<?php 
session_start();
include "header.php";

if (isset($_SESSION["auth"])){
?>
    
<div class="container p-0 d-flex flex-column" style="height: 100vh; background-color: #f3f3f3;">
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
                <?= $_SESSION["auth"]["display_name"] ?>
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
    <div class="row d-flex justify-content-center">
        <!-- Button trigger modal -->
        <button 
            type="button" 
            class="btn btn-primary col-4 col-xl-2" 
            style="margin-top:15px;"
            data-toggle="modal" 
            data-target="#exampleModalCenter">
            Create file
        </button>

    <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="get" action="catalog.php">
                            <input class="form-control" type="text" placeholder="File name">
                            <select class="form-control">
                                <option>Default select</option>
                            </select>
                            <input class="form-control" type="text" placeholder="Description">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Create file</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    } else {
        header("Location: http://files.khomyart.com/index.php");
    }
    include "footer.php";
?>