<?php
   session_start();
   require("db_adapter.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {

      create_user($_POST['username'], $_POST['password'],  $_POST['name'],  $_POST['surname'],  $_POST['role']);
      header("Location: ../home.php");

   }
?>
