<?php
   session_start();
   $servername = 'localhost';
   $username = 'django-web';
   $password = 'django-web';
   $dbname = 'django-web';
   $conn = '';

   function connect()
   {
      global $servername, $username, $password, $dbname, $conn;
      try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e)
      {
            echo "Connection failed: " . $e->getMessage();
      }
   }

  function find_user($username, $password)
  {
    global $conn;
    if ( $conn === '')
    {
      connect();
    }

    try {
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $statement = $conn->prepare("select * from User where username = :username and password = :password");
      $statement->execute(array(':username' => $username, ':password' => $password));
      $count = $statement->rowCount();
      if ( $count === 1 )
        {
          $row = $statement->fetch();
          $_SESSION['username'] = $row['username'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['surname'] = $row['surname'];
          $_SESSION['role'] = $row['role'];
          $_SESSION['id'] = $row['id'];
          $_SESSION['logged'] = 'true';
        }
      else {
        echo "No user with that username or password.";
      }
    }
    catch(Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
  }
?>
