<?php
   session_start();
   require("db_adapter.php");
   $months_30 = [
       "04" , "06", "09", "11"
   ];

   if($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['category'] === 'announcement') {
        if (isset($_POST['cancel'])) {
          header("Location: ../announcement.php");
        }
        else{
          if ( $_POST['action'] === 'update' ) {
            modify_announcement($_POST['subject'], $_POST['text'], $_POST['id']);
          }
          elseif ($_POST['action'] === 'create') {
            create_announcement($_POST['subject'], $_POST['text']);
          }
        header("Location: ../announcement.php");
      }
    }
    elseif ($_POST['category'] === 'assignment') {
      if (isset($_POST['cancel'])) {
        header("Location: ../homework.php");
      }
      else {
        $day =  (int) $_POST['day'];
        $month = $_POST['month'];
        if ( $_POST['action'] === 'update' ) {
          if ( $day <= 28){
            $date = $_POST['year'] . "-" .  $month . "-" .  $day . " " . $_POST['hour'] . ":00:00" ;
            modify_assignment($_POST['description'], $_POST['goals'], $date, $_POST['files'], $_POST['id']);
            header("Location: ../homework.php");
          }
          elseif ( $day > 28 && $month == "02"){
            $_SESSION['errDate'] = 'Selected date is wrong.';
            header("Location: ../homework.php?assignment_id={$_POST['id']}#{$_POST['id']}");
          }
          elseif ( $day > 30){
            if (in_array($month, $months_30)) {
              $_SESSION['errDate'] = 'Selected date is wrong.';
              header("Location: ../homework.php?assignment_id={$_POST['id']}#{$_POST['id']}");

            }
            else {
              $date = $_POST['year'] . "-" .  $month . "-" .  $day . " " . $_POST['hour'] . ":00:00" ;
              modify_assignment($_POST['description'], $_POST['goals'], $date, $_POST['files'], $_POST['id']);
              header("Location: ../homework.php");
            }
          }
        }
        elseif ($_POST['action'] === 'create') {
          if ( $day <= 28){
            $date = $_POST['year'] . "-" .  $month . "-" .  $day . " " . $_POST['hour'] . ":00:00" ;
            create_assignment($_POST['description'], $_POST['goals'], $date, $_POST['files']);
            header("Location: ../homework.php");
          }
          elseif ( $day > 28 && $month == "02"){
            $_SESSION['errDate'] = 'Selected date is wrong.';
            header("Location: ../homework.php?create=true");
          }
          elseif ( $day > 30){
            if (in_array($month, $months_30)) {
              $_SESSION['errDate'] = 'Selected date is wrong.';
              header("Location: ../homework.php?create=true");

            }
            else {
              $date = $_POST['year'] . "-" .  $month . "-" .  $day . " " . $_POST['hour'] . ":00:00" ;
              create_assignment($_POST['description'], $_POST['goals'], $date, $_POST['files']);
              header("Location: ../homework.php");
            }
          }
        }
      }
    }
    elseif ($_POST['category'] === 'file') {
      if (isset($_POST['cancel'])) {
        header("Location: ../documents.php");
      }
      else {
        if ( $_POST['action'] === 'update' ) {
          modify_file($_POST['description'], $_POST['filepath'], $_POST['id']);
        }
        elseif ($_POST['action'] === 'create') {
          $target_dir = "../docs/";
          $target_file = $target_dir . basename($_FILES["file"]["name"]);
          if (file_exists($target_file)) {
            $_SESSION['errFile'] = "File already exists.";
            header("Location: ../documents.php?create=true");
          }
          elseif ($_FILES["file"]["size"] > 500000) {
              $_SESSION['errFile'] = "File size is too large.";
              header("Location: ../documents.php?create=true");
          }
          else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                create_file($_POST['description'], $_FILES["file"]["name"]);
                header("Location: ../documents.php");
            } else {
                $_SESSION['errFile'] = "Error while trying to upload the file.Please try again.";
                header("Location: ../documents.php?create=true");
            }
          }
        }
      }
    }
    elseif ($_POST['category'] === 'user') {
      if (isset($_POST['cancel'])) {
        header("Location: ../users.php");
      }
      else {
        if ( $_POST['action'] === 'update' ) {
          modify_user($_POST['username'], $_POST['password'],  $_POST['name'],  $_POST['surname'],  $_POST['role'], $_POST['id']);
        }
        elseif ($_POST['action'] === 'create') {
          create_user($_POST['username'], $_POST['password'],  $_POST['name'],  $_POST['surname'],  $_POST['role']);
          header("Location: ../users.php");
        }
      }
    }
   }
   elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
     if ($_GET['category'] === 'announcement') {
       if (isset($_GET['delete']) && isset($_GET['announcement_id'])) {
         delete_announcement($_GET['announcement_id']);
         header("Location: ../announcement.php");
       }
     }
     elseif ($_GET['category'] === 'assignment') {
       if (isset($_GET['delete']) && isset($_GET['assignment_id'])) {
         delete_assignment($_GET['assignment_id']);
         header("Location: ../homework.php");
       }
     }
     elseif ($_GET['category'] === 'file') {
       if (isset($_GET['delete']) && isset($_GET['file_id'])) {
         $name = "../docs/" . $_GET['filename'];
         if (file_exists($name)) {
           unlink($name);
         }
         delete_file($_GET['file_id']);
         header("Location: ../documents.php");
       }
     }
     elseif ($_GET['category'] === 'user') {
       if (isset($_GET['delete']) && isset($_GET['user_id'])) {
         delete_user($_GET['user_id']);
         header("Location: ../users.php");
       }
     }
   }


?>
