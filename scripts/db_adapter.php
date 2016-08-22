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
            return $e;
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
          $_SESSION['errLogin'] = "Incorrect username or password.";
      }
    }
    catch(Exception $e) {
        return $e;
    }
    $conn = null;
  }

  function create_user($username, $password, $name, $surname, $role)
  {
    global $conn;
    if ( $conn === '')
    {
      connect();
    }
    try {
      $statement = $conn->prepare("select username from User where username = :username");
      $statement->execute(array(':username' => $username));
      if ( $count === 0 )
      {
        $sql = "INSERT INTO User (username, password, name, surname, role) VALUES ($username, $password, $name, $surname, $role)";
        $conn->exec($sql);
        find_user($username, $password);
      }
      else {
        $_SESSION['errSignUp'] = 'User with that email already exists.'
      }

    }
    catch(Exception $e) {
        return $e;
    }
    $conn = null;
  }

?>