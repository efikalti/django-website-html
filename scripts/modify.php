<?php
   session_start();
   require("db_adapter.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      if ( $_POST['action'] === 'update' )
      {
        modify_announcement($_POST['subject'], $_POST['text'], $_POST['id']);
        header("Location: ../announcement.php");
      }

   }
?>
