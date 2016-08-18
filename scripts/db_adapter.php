<?php
   $servername = 'localhost';
   $username = 'django-web';
   $password = 'django-web';
   $dbname = 'django-web';
   $conn = '';

   function connect()
   {
       global $servername, $username, $password, $dbname, $conn;
       // Create connection
       $conn = new mysqli($servername, $username, $password, $dbname);
       // Check connection
       if ($conn->connect_error) {
           die('Connection failed: '.$conn->connect_error);
       }
   }

  function find_user($username, $password)
  {
    global $conn;
    if ( $conn === '')
    {
      connect();
    }

    $query = sprintf("SELECT * FROM User
    WHERE username='%s' AND password='%s'",
    $username, $password);
    $result = $conn->query($query);
    $record = mysql_fetch_array($result);
    $count = $result->num_rows;

    if($count == 1) {
       $_SESSION['username'] = $username;
       $_SESSION['name'] = $record["name"];
       $_SESSION['surname'] = $record["surname"];
       $_SESSION['role'] = $record["role"];
       header("Location: ../home.php");
    }else {
       $error = "Your Username or Password is invalid";
       return $error;
    }
  }
