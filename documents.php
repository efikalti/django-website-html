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
          <li><a href="communication.php">Contact</a></li>
          <li class="current"><a href="#">Documents</a></li>
          <li><a href="homework.php">Projects</a></li>
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
            if ( $_SESSION['role'] === 'tutor' )
            {
              echo "<br><br><a href='sign_up.php'>Create an account</a></p>";
            }
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
        <h1>Documents</h1>

        <?php
          if ( $_SESSION['role'] === 'tutor' ){
            if (isset($_GET['create']) && $_GET['create'] === 'true')
            {
              echo "<div class='announcement'>";
              echo "<div class='form_settings'>";
              echo "<form action='scripts/modify.php' method='post' enctype='multipart/form-data'>";
              echo "<h2><strong>Description:</strong></h2>";
              echo "<input type='text' placeholder='Type a description for the file' name='description'><br>";
              echo "<br><label><b>File</b></label><br>";
              if ($_SESSION['errFile'])
              {
                echo "<div class='error'> *{$_SESSION['errFile']} <br><br></div>";
                unset($_SESSION['errFile']);
              }
              echo "<input type='file' name='file' id='file'>";
              echo "<input type='hidden' value='create' name='action'>";
              echo "<input type='hidden' value='file' name='category'>";
              echo "<br>";
              echo "<button class='okbtn' type='submit'>Ok</button>       ";
              echo "<button class='cancelbtn' type='submit' name='cancel' value='cancel'>Cancel</button>";
              echo "</form>";
              echo "</div>";
              echo "</div>";
            }
            else {
              echo "<a href='documents.php?create=true'>Add file</a><br><br>";
            }
          }

          $data = get_files();
          $result = $data->fetchAll();
          foreach ($result as &$file) {
              echo "<div class='announcement'>";
              echo "<h3>File {$file['id']}";
              if ( $_SESSION['role'] === 'tutor' ){
                echo "<font size='5'>
                     [<a href=scripts/modify.php?delete=true&category=file&filename={$file['filename']}&file_id={$file['id']}>Delete</a>]
                     </font>";
              }
              echo "</h3>";
              echo "<h2><strong>Description:</strong> {$file['description']}</h2>";
              echo "<h5><strong>File: {$file['filename']} </strong></h5>";
              echo "<a href={$file['filename']} download>Download</a>";
              echo "</div>";
          }
        ?>

        <a href="#top">Hop to top</a>

      </div>
    </div>
    <div id="footer">
      <p>
        <a href="home.php">Home</a> |
        <a href="announcement.php">Announcements</a> |
        <a href="communication.php">Contact</a> |
        <a class="active" href="#">Documents</a> |
        <a href="homework.php">Projects</a>
      </p>
    </div>
  </div>
</body>
</html>
