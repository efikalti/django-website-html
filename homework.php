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

  <?php require 'scripts/check_login.php'; ?>

  <div id="main">
    <div id="header">
      <div id="logo">
        <!-- TITLE -->
        <h1>Django<a href="https://www.djangoproject.com/download/" target="_blank">_1.10</a></h1>
        <div class="slogan">The web framework for perfectionists with deadlines.</div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="announcement.php">Announcements</a></li>
          <li><a href="communication.html">Contact</a></li>
          <li><a href="documents.html">Documents</a></li>
          <li class="current"><a href="#">Projects</a></li>
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

        <?php
          if ( $_SESSION['role'] === 'tutor' ){
            if ($_GET['create'] === 'true')
            {
              echo "<div class='announcement'>";
              echo "<form action='scripts/modify.php' method='post'>";
              echo "<h2><strong>Subject:</strong></h2>";
              echo "<input type='text' placeholder='Type the subject of the announcement' name='subject'><br>";
              echo "<br><label><b>Text</b></label><br>";
              echo "<input type='text' placeholder='Type the text of the announcement' name='text'><br>";
              echo "<input type='hidden' value='create' name='action'>";
              echo "<button class='okbtn' type='submit'>Ok</button>       ";
              echo "<button class='cancelbtn' type='submit' name='cancel' value='cancel'>Cancel</button>";
              echo "</form>";
              echo "</div>";
            }
            else {
              echo "<a href='homework.php?create=true'>Add project</a><br><br>";
            }
          }

          $data = get_announcements();
          $result = $data->fetchAll();
          foreach ($result as &$announcement) {

            if ($_GET['announcement_id'] === $announcement['id'])
            {
              echo "<div class='announcement'>";
              echo "<a name='{$announcement['id']}'></a>";
              echo "<form action='scripts/modify.php' method='post'>";
              echo "<h3>Announcement {$announcement['id']} </h3><br>";
              echo "<h2><strong>Subject:</strong></h2>";
              echo "<input type='text' value='{$announcement['subject']}' name='subject'><br>";
              echo "<br><label><b>Text</b></label><br>";
              echo "<input type='text' value='{$announcement['text']}' name='text'><br>";
              echo "<input type='hidden' value='{$announcement['id']}' name='id'>";
              echo "<input type='hidden' value='update' name='action'>";
              echo "<button class='okbtn' type='submit'>Ok</button>       ";
              echo "<button class='cancelbtn' value='cancel'>Cancel</button>";
              echo "</form>";
              echo "</div>";
            }
            else {
              echo "<div class='announcement'>";
              echo "<h3>Announcement {$announcement['id']}";
              if ( $_SESSION['role'] === 'tutor' ){
                echo "<font size='5'>
                     [<a href=announcement.php?announcement_id={$announcement['id']}#{$announcement['id']}>Modify</a>]
                     [<a href=scripts/modify.php?delete=true&announcement_id={$announcement['id']}>Delete</a>]
                     </font>";
              }
              echo "</h3>";
              echo "<h2><strong>Subject:</strong> {$announcement['subject']}</h2>";
              echo "<h5><strong>Date:</strong> {$announcement['date']}</h5>";
              echo "<p>{$announcement['text']}</p>";
              echo "</div>";
            }
          }
        ?>

        <div class="announcement">
        <h2>First optional assignment</h2>
        <h3>Getting started with Django</h3>
        <h5>15 August 2016</h5>
        <p>For the first optional assignment of this lesson you are asked to download and install the Django Web Framework on your computer.<br>
           You can do so by following the instructions from the Django webpage, <a href="https://docs.djangoproject.com/en/1.10/intro/install/" target="_blank">here</a> .</p>
           <br>The version we will be using is <em>1.10</em> .
        </div>

        <a href="#top">Hop to top</a>


      </div>
    </div>
    <div id="footer">
      <p>
        <a href="index.html">Home</a> |
        <a href="announcement.html">Announcements</a> |
        <a href="communication.html">Contact</a> |
        <a href="documents.html">Documents</a> |
        <a class="active" href="#">Projects</a>
      </p>
    </div>
  </div>
</body>
</html>
