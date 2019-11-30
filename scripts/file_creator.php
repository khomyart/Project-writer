<?php
  echo $_SESSION["auth"]["err_message"];

  if(isset($_GET["folder"])) {
    $_SESSION["auth"]["user_folder"] = $_SESSION["auth"]["user_folder"].$_GET["folder"];
    chdir($_SESSION["auth"]["user_folder"]);
    
    #clear $_GET to prevent redirection to / folder
    header("Location: http://files.khomyart.com/catalog.php"); 
  } else {
    $_SESSION["auth"]["user_folder"] = $_SESSION["auth"]["user_folder"];
    chdir($_SESSION["auth"]["user_folder"]);
  }

  echo("<br>".getcwd());
  if(isset($_POST["create_folder"])) {
    if(!file_exists($_POST["folder_name"])) {
      $sql_query_write = "INSERT INTO `folders`(`folder_owner`, `folder_path`, `folder_name`, `folder_desc`) VALUES (?,?,?,?);";
      $stmt = mysqli_stmt_init($db_connection);
      mysqli_stmt_prepare($stmt,$sql_query_write);
      $folder_owner = mysqli_real_escape_string($db_connection, $_SESSION["auth"]["login"]);
      $folder_path = mysqli_real_escape_string($db_connection, getcwd());
      $folder_name = mysqli_real_escape_string($db_connection,$_POST["folder_name"]);
      $folder_desc = mysqli_real_escape_string($db_connection,$_POST["folder_description"]);
      mysqli_stmt_bind_param($stmt, "ssss", $folder_owner, $folder_path, $folder_name, $folder_desc);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mkdir($_POST["folder_name"]);
      $_SESSION["auth"]["err_message"] = "folder has been created";
      header('Location: http://files.khomyart.com/catalog.php');
    } else {
      $_SESSION["auth"]["err_message"] = "folder already exists";
      header('Location: http://files.khomyart.com/catalog.php');
    }
  }

  if(isset($_POST["create_file"])) {
    if(!file_exists($_POST["file_name"].$_POST["file_type"])) {
      $sql_query_write = "INSERT INTO `files`(`file_owner`, `file_path`, `file_name`, `file_type`, `file_desc`) VALUES (?,?,?,?,?);";
      $stmt = mysqli_stmt_init($db_connection);
      mysqli_stmt_prepare($stmt,$sql_query_write);
      $file_owner = mysqli_real_escape_string($db_connection, $_SESSION["auth"]["login"]);
      $file_path = mysqli_real_escape_string($db_connection, getcwd());
      $file_name = mysqli_real_escape_string($db_connection,$_POST["file_name"]);
      $file_type = mysqli_real_escape_string($db_connection,$_POST["file_type"]);
      $file_desc = mysqli_real_escape_string($db_connection,$_POST["file_description"]);
      mysqli_stmt_bind_param($stmt, "sssss", $file_owner, $file_path, $file_name, $file_type, $file_desc);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      file_put_contents($_POST["file_name"].$_POST["file_type"],"");
      $_SESSION["auth"]["err_message"] = "file has been created";
      header('Location: http://files.khomyart.com/catalog.php');
      } else {
        $_SESSION["auth"]["err_message"] = "file already exists";
        header('Location: http://files.khomyart.com/catalog.php');
      }
  
  }

  if (isset($_POST["logout"])) {
    mysqli_close($db_connection);
    session_destroy();
    unset($_SESSION);
    header('Location: http://files.khomyart.com/index.php');
    exit();
  } 
?>