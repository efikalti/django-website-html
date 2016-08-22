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
    <?php  session_start(); ?>

    <div id="main">
              <div class="login">
                <form action="scripts/login.php" method="post">
                    <div class="imgcontainer">
                        <img src="style/img_avatar2.png" alt="Avatar" class="avatar">
                    </div>

                    <div class="container">
                        <?php if ($_SESSION['errLogin'])
                              {
                                echo "<div class='error'> *{$_SESSION['errLogin']} <br><br></div>";
                                unset($_SESSION['errLogin']);
                              }
                        ?>
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>

                        <button type="submit">Login</button>
                    </div>
                </form>
                <p>Not a member? <a href="sign_up.php">Create account</a></p>
        </div>
    </div>
</body>

</html>
