<?php 
    session_start();
    include "header.php";
    include "functions.php";
    if (isset($_SESSION["auth"])){
    $list_of_files = "dat_files/list_of_files.dat";
    $users_file = "dat_files/accounts.dat";
    
    if(isset($_POST["create_file"])) {
        $files = file_get_contents($list_of_files);
        $files = json_decode($files, TRUE);
    
        $i=count($files);
        $default_file_path = 'users/'.$_SESSION["auth"]["login"].'/files'."/";
        $files[$i]["file_owner"] = $_SESSION["auth"]["user_id"];
        $files[$i]["file_path"] = $default_file_path;
        $files[$i]["file_name"] = $_POST["file_name"];
        $files[$i]["file_type"] = $_POST["file_type"];
        $files[$i]["file_description"] = $_POST["file_description"];
        
        if(!file_exists($files[$i]["file_path"].$files[$i]["file_name"].$files[$i]["file_type"])) {
          file_put_contents($files[$i]["file_path"].$files[$i]["file_name"].$files[$i]["file_type"], "");
          $encoded_list_of_files = json_encode($files);
          file_put_contents ($list_of_files,  $encoded_list_of_files);
        } else {
          $error_code = 5;
        }

        header("Location: http://files.khomyart.com/catalog.php");
    }

    if (isset($_POST["logout"])) {
        session_destroy();
        unset($_SESSION);
        header('Location: http://files.khomyart.com/index.php');
        exit();
    } 
?>
<div
  class="container p-0 d-flex flex-column"
  style="height: 100vh; background-color: #f3f3f3;"
>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#"
            >Home <span class="sr-only">(current)</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <?= $_SESSION["auth"]["display_name"] ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <form action="" method="post">
              <button
                type="submit"
                class="dropdown-item"
                name="logout"
                value="logout"
              >
                Log out
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="row d-flex justify-content-center">
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary col-4 col-xl-2 <?=ErrorClassFeedback();?>"
      style="margin-top:15px;"
      data-toggle="modal"
      data-target="#exampleModalCenter"
    >
      Create file
    </button>
    <?=ErrorMessageFeedback();?>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="catalog.php" autocomplete="off">
                <span">
                    Name
                </span">
              <input class="form-control modal_elements_intervar" type="text" placeholder="" name="file_name" autocomplete="off"/>
                 <span">
                    Type
                </span">
              <select class="form-control modal_elements_intervar" name="file_type" autocomplete="off">
                <option value=".txt">*.txt</option>
                <option value=".dat">*.dat</option>
              </select>
                <span">
                    Description
                </span">
              <input
                class="form-control modal_elements_intervar"
                type="text"
                placeholder=""
                name ="file_description"
                autocomplete="off"
              />
            <div class="modal-footer">
                <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                >
                Close
                </button>
                <button type="submit" class="btn btn-primary" name="create_file" value="create_file">Create</button>
            </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
      <!--File list-->
  <div class="list-group" style="margin-top:15px;">
    <?php 
        $files = file_get_contents($list_of_files);
        $files = json_decode($files, TRUE);
        for($file_index=0; $file_index<count($files); $file_index++) {
          if(($files[$file_index]["file_owner"]===$_SESSION["auth"]["user_id"]) 
          && (file_exists($files[$file_index]["file_path"].$files[$file_index]["file_name"].$files[$file_index]["file_type"]))) {
    ?>
      <a href="#" class="list-group-item list-group-item-action ">
        <?=$files[$file_index]["file_name"].$files[$file_index]["file_type"]?>
      </a>
    <?php
          }
        }
    ?>
      <!--File list end-->
    </div>
</div>

<?php
    } else {
        header("Location: http://files.khomyart.com/index.php");
        exit();
    }
    include "footer.php";
?>
