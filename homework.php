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
          <li><a href="index.php">Home</a></li>
          <li><a href="announcement.php">Announcements</a></li>
          <li><a href="communication.html">Contact</a></li>
          <li><a href="documents.php">Documents</a></li>
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
      <h1>Assignments</h1>

        <?php
          if ( $_SESSION['role'] === 'tutor' ){
            if ($_GET['create'] === 'true')
            {
              echo "<div class='announcement'>";
              echo "<form action='scripts/modify.php' method='post'>";
              echo "<h2><strong>Goals:</strong></h2>";
              echo "<input type='textarea' placeholder='Type the goals of the assignment separated by commas' name='goals'><br>";
              echo "<br><label><b>Description</b></label><br>";
              echo "<input type='textarea' placeholder='Type the description of the assignment' name='description'><br>";
              echo "<br><label><b>Files</b></label><br>";
              echo "<input type='textarea' placeholder='List the deriverables files for the assignment separated by commas' name='files'><br>";
              echo "<br><label><b>Deadline</b></label><br>";
              if ($_SESSION['errDate'])
              {
                echo "<div class='error'> *{$_SESSION['errDate']} <br><br></div>";
                unset($_SESSION['errDate']);
              }
              echo "<p>";
              echo "Hour:  <select name='hour' size=1>";
              $days = "";
              for ($i = 1; $i <= 24; $i++) {
                  if ( $i < 10 ){
                    $i = "0" . $i;
                  }
                  $part = "<option value='$i'>$i</option>";
                  $days .= $part;
              }
              echo "$days";
              echo "</select>";
              echo "   Day:  <select name='day' size=1>";
              $days = "";
              for ($i = 1; $i <= 31; $i++) {
                  if ( $i < 10 ){
                    $i = "0" . $i;
                  }
                  $part = "<option value='$i'>$i</option>";
                  $days .= $part;
              }
              echo "$days";
              echo "</select>";
              echo "   Month:  <select name='month' size=1>";
              $months = "";
              for ($i = 1; $i <= 12; $i++) {
                  if ( $i < 10 ){
                    $i = "0" . $i;
                  }
                  $part = "<option value='$i'>$i</option>";
                  $months .= $part;
              }
              echo "$months";
              echo "</select>";
              echo "  Year:  <select name='year' size=1>";
              echo "<option value='2016'>2016</option>";
              echo "<option value='2017'>2017</option>";
              echo "</select>";
              echo "</p>";
              echo "<input type='hidden' value='create' name='action'>";
              echo "<input type='hidden' value='assignment' name='category'>";
              echo "<button class='okbtn' type='submit'>Ok</button>    ";
              echo "<button class='cancelbtn' type='submit' name='cancel' value='cancel'>Cancel</button>";
              echo "</form>";
              echo "</div>";
            }
            else {
              echo "<a href='homework.php?create=true'>Add project</a><br><br>";
            }
          }

          $data = get_assignments();
          $result = $data->fetchAll();
          foreach ($result as &$assignment) {

            if ($_GET['assignment_id'] === $assignment['id'])
            {
              echo "<div class='announcement'>";
              echo "<a name='{$assignment['id']}'></a>";
              echo "<form action='scripts/modify.php' method='post'>";
              echo "<h3>Assignment {$assignment['id']} </h3><br>";
              echo "<h2><strong>Goals:</strong></h2>";
              echo "<input type='textarea' value='{$assignment['goals']}' name='goals'><br>";
              echo "<br><label><b>Description</b></label><br>";
              echo "<input type='textarea' value='{$assignment['description']}' name='description'><br>";
              echo "<h2><strong>Files:</strong></h2>";
              echo "<input type='textarea' value='{$assignment['files']}' name='files'><br>";
              echo "<h2><strong>Deadline:</strong></h2>";
              echo "<input type='date' value='{$assignment['deadline']}' name='deadline'><br>";
              echo "<input type='hidden' value='{$assignment['id']}' name='id'>";
              echo "<input type='hidden' value='update' name='action'>";
              echo "<input type='hidden' value='assignment' name='category'>";
              echo "<button class='okbtn' type='submit'>Ok</button>      ";
              echo "<button class='cancelbtn' type='submit' name='cancel' value='cancel'>Cancel</button>";
              echo "</form>";
              echo "</div>";
            }
            else {
              echo "<div class='announcement'>";
              $goals = explode(",", $assignment['goals']);
              echo "<h3>Assignment {$assignment['id']}";
              if ( $_SESSION['role'] === 'tutor' ){
                echo "<font size='5'>
                     [<a href=homework.php?assignment_id={$assignment['id']}#{$assignment['id']}>Modify</a>]
                     [<a href=scripts/modify.php?delete=true&category=assignment&assignment_id={$assignment['id']}>Delete</a>]
                     </font>";
              }
              echo "</h3>";
              echo "<h2><strong>Goals:</strong></h2>";
              echo "  <ol type='1'>";
              foreach ($goals as &$goal){
                echo "<li>$goal</li>";
              }
              echo "</ol>";
              echo "<p><b>Description</b><br>{$assignment['description']}</p>";
              echo "<h2>Files</h2>";
              $files = explode(",", $assignment['files']);
              echo "  <ol type='1'>";
              foreach ($files as &$file){
                echo "<li>$file</li>";
              }
              echo "</ol>";
              echo "<br><label><b>Files</b></label><br>";

              echo "<h5><strong>Deadline:</strong> {$assignment['deadline']}</h5>";
              echo "</div>";
            }
          }
        ?>

        <a href="#top">Hop to top</a>


      </div>
    </div>
    <div id="footer">
      <p>
        <a href="index.html">Home</a> |
        <a href="announcement.html">Announcements</a> |
        <a href="communication.html">Contact</a> |
        <a href="documents.php">Documents</a> |
        <a class="active" href="#">Projects</a>
      </p>
    </div>
  </div>
</body>
</html>
