<?php
   session_start();
   require("db_adapter.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     if ($_POST['category'] === 'announcement') {
      if (isset($_POST['cancel'])) {
        header("Location: ../announcement.php");
      }
      else {
        if ( $_POST['action'] === 'update' ) {
          modify_announcement($_POST['subject'], $_POST['text'], $_POST['id']);
        }
        elseif ($_POST['action'] === 'create') {
          create_announcement($_POST['subject'], $_POST['text']);
        }
      }
      header("Location: ../announcement.php");
    }
   }
   elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
     if ($_GET['category'] === 'announcement') {
       if (isset($_GET['delete']) && isset($_GET['announcement_id'])) {
         delete_announcement($_GET['announcement_id']);
         header("Location: ../announcement.php");
       }
     }
   }


?>
