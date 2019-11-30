<?php 
    session_start();
    ini_set('display_errors', 1);

    include "/var/www/files.khomyart.com/public_html/header.php"; 

    if (isset($_SESSION["auth"])){
      include "/var/www/files.khomyart.com/public_html/scripts/db_connector.php";
      include "/var/www/files.khomyart.com/public_html/functions.php";
      include "/var/www/files.khomyart.com/public_html/scripts/file_creator.php"; 
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
            <?= $_SESSION["auth"]["display_name"]?>
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
     <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal -->
     <button
     type="button"
     class="btn btn-primary col-4 col-xl-2"
     style="margin-top:15px;"
     data-toggle="modal"
     data-target="#exampleModalCenter1"
   >
     Create folder
   </button>

   <!-- Modal -->
   <div
     class="modal fade"
     id="exampleModalCenter1"
     tabindex="-1"
     role="dialog"
     aria-labelledby="exampleModalCenterTitle1"
     aria-hidden="true">
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
               <span>
                   Name
               </span>
             <input class="form-control modal_elements_intervar" type="text" placeholder="" name="folder_name" autocomplete="off"/>
               <span>
                   Description
               </span>
             <input
               class="form-control modal_elements_intervar"
               type="text"
               placeholder=""
               name ="folder_description"
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
               <button type="submit" class="btn btn-primary" name="create_folder" value="create_folder">Create</button>
           </div>
           </form>
         </div>
       </div>
     </div>
   </div>

      <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal --> <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary col-4 col-xl-2"
      style="margin-top:15px;"
      data-toggle="modal"
      data-target="#exampleModalCenter"
    >
      Create file
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
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
                <span>
                    Name
                </span>
              <input class="form-control modal_elements_intervar" type="text" placeholder="" name="file_name" autocomplete="off"/>
                 <span>
                    Type
                </span>
              <select class="form-control modal_elements_intervar" name="file_type" autocomplete="off">
                <option value=".txt">*.txt</option>
                <option value=".dat">*.dat</option>
              </select>
                <span>
                    Description
                </span>
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
      
  <div class="list-group" style="margin-top:15px;">
      <form action="" method="get">
      <!--File list-->
        <?php
          include "/var/www/files.khomyart.com/public_html/scripts/list_of_files_and_folders.php";
        ?>
      <!--File list end-->
      </form>
    </div>
</div>

<?php
    } else {
        header("Location: http://files.khomyart.com/index.php");
        exit();
    }
    include "/var/www/files.khomyart.com/public_html/footer.php";
?>
