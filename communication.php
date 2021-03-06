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
        include 'scripts/db_adapter.php'; ?>

  <div id="main">
    <div id="header">
      <div id="logo">
        <!-- TITLE -->
        <h1>Django<a href="https://www.djangoproject.com/download/" target="_blank">_1.10</a></h1>
        <div class="slogan">The web framework for perfectionists with deadlines.</div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="home.php">Home</a></li>
          <li><a href="announcement.php">Announcements</a></li>
          <li class="current"><a href="#">Contact</a></li>
          <li><a href="documents.php">Documents</a></li>
          <li><a href="homework.php">Projects</a></li>
          <?php
            if ( $_SESSION['role'] === 'tutor' )
            {
              echo "<li><a href='users.php'>Users</a></li>";
            }
          ?>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div id="sidebar_container">
        <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>User information</h3>
          <div class="imgcontainer">
              <img src="style/img_avatar2.png" alt="Avatar" class="avatar">
          </div>
          <?php
            echo "<h4>Username:</h4> {$_SESSION['username']}";
            echo "<h4>Role:</h4> {$_SESSION['role']}";
          ?>
          <br>
          <form action="scripts/logout.php">
            <button type="submit" class="cancelbtn">Log out</button>
          </form>
        </div>
        <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
        <div class="sidebar">
        <!-- insert your sidebar items here -->
        <h3>Latest News</h3>
        <h4>Registration for Django: Under the Hood 2016 is now open!</h4>
        <h5>25 July 2016 </h5>
        <p>DUTH is an annual Django conference that takes place in Amsterdam, the Netherlands.
           On 3rd - 6th November this year, we're going to see 9 deep dive talks into topics of Django channels,
           testing, Open Source funding, mental health, JavaScript, Django forms validation, debugging and many
           more.<br/>
           <a href="https://www.djangoproject.com/weblog/2016/jul/25/registration-django-under-hood-2016-now-open/"  target="_blank">Read more</a></p>
        </div>
        <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Development</h3>
          <p>See what's currently being worked on.
          <br /><a href="https://dashboard.djangoproject.com/"  target="_blank">Development dashboard</a></p>

        </div>
        <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
        <div class="sidebar">
          <h3>Latest Blog</h3>
          <h4>How to Deploy Django Applications on Heroku</h4>
          <h5>9 August 2016</h5>
          <p><a href="https://simpleisbetterthancomplex.com/tutorial/2016/08/09/how-to-deploy-django-applications-on-heroku.html"  target="_blank">Read blog</a></p>
        </div>
      </div>
      <div id="content">

        <!-- insert the page content here -->
        <h1>Contact an expert</h1>

        <h2>1. Complete a form</h2>

        <p>You can submit your question/request, with your email, directly into the following form.<br>
           The <i>tutor(s) will send the response to this email address.</i></p>
        <form action="scripts/email.php" method="post">
          <div class="form_settings">
            <p><span>Email Address</span><input type="text" name="email" placeholder="Type your email address" /></p>
            <p><span>Subject</span><input type="text" name="subject" placeholder="Type the subject of your mail" /></p>
            <p><span>Message</span><textarea rows="8" cols="50" name="message" placeholder="Type your message"></textarea></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="submit" /></p>
          </div>
        </form>

        <h2>2. Send an email.</h2>
        <p>
          Click on the following email address to open your default email client and compose your message:
          <a href="mailto:professor@django-lesson.com?Subject=Django%20Lesson%202016" target="_top">professor@django-lesson.com</a>
        </p>

      </div>
    </div>

    <div id="footer">
      <p>
        <a href="home.php">Home</a> |
        <a href="announcement.php">Announcements</a> |
        <a class="active" href="#">Contact</a> |
        <a href="documents.php">Documents</a> |
        <a href="homework.php">Projects</a>
        <?php
          if ( $_SESSION['role'] === 'tutor' )
          {
            echo " | <a href='users.php'>Users</a>";
          }
        ?>
      </p>
    </div>
  </div>
</body>
</html>
