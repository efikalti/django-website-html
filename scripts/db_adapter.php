<?php
   $servername = 'webpagesdb.it.auth.gr';
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

   function check_connection()
   {
     global $conn;
     if ( $conn === '')
     {
       connect();
     }
   }

  function find_user($username, $password)
  {
    global $conn;
    check_connection();

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
    check_connection();

    try {
      $statement = $conn->prepare("select username from User where username = :username");
      $statement->execute(array(':username' => $username));
      $count = $statement->rowCount();
      if ( $count === 0 )
      {
        $sql = "INSERT INTO User (username, name, surname, password, role)
        VALUES ('$username', '$name', '$surname', '$password', '$role')";
        $conn->exec($sql);
      }
      else {
        $_SESSION['errSignUp'] = 'User with that email already exists.';
      }

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function modify_user($username, $password, $name, $surname, $role, $id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "UPDATE User SET username='$username', password='$password', name='$name', surname='$surname', role='$role' WHERE id='$id'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function delete_user($id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "DELETE FROM User WHERE id='$id'";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function get_users()
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from User", array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
      $statement->execute();
      return $statement;

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function get_tutors()
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from User where role = 'tutor'", array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
      $statement->execute();
      return $statement;

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function get_announcements()
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from Announcement", array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
      $statement->execute();
      return $statement;

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function get_announcement($id)
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from Announcement where id = :id");
      $statement->execute(array(':id' => $id));
      return $statement;
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function modify_announcement($subject, $text, $id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "UPDATE Announcement SET subject='$subject', text='$text', date=now() WHERE id='$id'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function create_announcement($subject, $text)
  {
    global $conn;
    check_connection();

    try {
      $sql = "INSERT INTO Announcement (subject, text, date) VALUES ('$subject', '$text', now())";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function delete_announcement($id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "DELETE FROM Announcement WHERE id='$id'";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }


  function get_assignments()
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from Assignment", array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
      $statement->execute();
      return $statement;

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }
  function create_assignment($description, $goals, $deadline, $files)
  {
    global $conn;
    check_connection();

    try {
      $sql = "INSERT INTO Assignment (description, goals, deadline, files) VALUES ('$description', '$goals', '$deadline', '$files')";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function delete_assignment($id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "DELETE FROM Assignment WHERE id='$id'";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function modify_assignment($description, $goals, $deadline, $files, $id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "UPDATE Assignment SET description='$description', goals='$goals', deadline='$deadline', files='$files' WHERE id='$id'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }


  function get_files()
  {
    global $conn;
    check_connection();

    try {
      $statement = $conn->prepare("select * from File", array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
      $statement->execute();
      return $statement;

    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }
  function create_file($description, $filename)
  {
    global $conn;
    check_connection();

    try {
      $sql = "INSERT INTO File (description, filename) VALUES ('$description', '$filename')";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function delete_file($id, $filename)
  {
    global $conn;
    check_connection();

    try {
      $sql = "DELETE FROM File WHERE id='$id'";
      $conn->exec($sql);
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

  function modify_file($description, $filename, $id)
  {
    global $conn;
    check_connection();

    try {
      $sql = "UPDATE File SET description='$description', filename='$filename' WHERE id='$id'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
    }
    catch(Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
  }

?>
