<?php
   session_start();
   require("db_adapter.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {

      find_user($_POST['username'], $_POST['password']);
      header("Location: ../home.php");

   }
?>
