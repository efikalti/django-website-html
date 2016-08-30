<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Django_101</title>
    <link rel="icon" href="style/dj.png">
    <meta name="description" content="website description" />
    <meta name="keywords" content="website keywords, website keywords" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine&amp;v1" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" />
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>

  <?php require 'scripts/check_login.php';
        require 'scripts/check_tutor.php'; ?>

    <div id="main">
              <div class="login">
                <form action="scripts/sign_up.php" method="post">

                    <div class="container">
                        <?php if ($_SESSION['errSignUp'])
                              {
                                echo "<div class='error'> *{$_SESSION['errSignUp']} <br><br></div>";
                                unset($_SESSION['errSignUp']);
                              }
                        ?>
                        <label><b>Username</b></label>
                        <input type="email" placeholder="Type the user's email.This will be their username." name="username" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Choose a password for the account." name="password" required>

                        <label><b>Name</b></label>
                        <input type="sign_text" placeholder="Type the name." name="name" required>

                        <label><b>Surname</b></label>
                        <input type="sign_text" placeholder="Type the surname." name="surname" required>

                        <label><b>Role</b></label>
                        <br>
                        <input type="radio" name="role" value="student" checked> Strudent<br>
                        <input type="radio" name="role" value="tutor"> Tutor<br>

                        <button type="submit">Sign up</button>
                    </div>
                </form>
        </div>
    </div>
</body>

</html>
