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
                    <li class="current"><a href="#">Home</a></li>
                    <li><a href="announcement.html">Announcements</a></li>
                    <li><a href="communication.html">Contact</a></li>
                    <li><a href="documents.html">Documents</a></li>
                    <li><a href="homework.html">Projects</a></li>
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
                <div class="sidebar">
                    <h3>Latest News</h3>
                    <h4>Registration for Django: Under the Hood 2016 is now open!</h4>
                    <h5>25 July 2016 </h5>
                    <p>DUTH is an annual Django conference that takes place in Amsterdam, the Netherlands. On 3rd - 6th November this year, we're going to see 9 deep dive talks into topics of Django channels, testing, Open Source funding, mental health,
                        JavaScript, Django forms validation, debugging and many more.
                        <br/>
                        <a href="https://www.djangoproject.com/weblog/2016/jul/25/registration-django-under-hood-2016-now-open/" target="_blank">Read more</a></p>
                </div>
                <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
                <div class="sidebar">
                    <h3>Development</h3>
                    <p>See what's currently being worked on.
                        <br /><a href="https://dashboard.djangoproject.com/" target="_blank">Development dashboard</a></p>

                </div>
                <img class="paperclip" src="style/paperclip.png" alt="paperclip" />
                <div class="sidebar">
                    <h3>Latest Blog</h3>
                    <h4>How to Deploy Django Applications on Heroku</h4>
                    <h5>9 August 2016</h5>
                    <p><a href="https://simpleisbetterthancomplex.com/tutorial/2016/08/09/how-to-deploy-django-applications-on-heroku.html" target="_blank">Read blog</a></p>
                </div>
            </div>
            <div id="content">

                    <!-- insert the page content here -->
                    <h1>Welcome to Django 101</h1>
                    <p>Django is a high-level <strong>Python Web framework</strong> that encourages rapid development and clean, pragmatic design. Built by experienced developers, it takes care of much of the hassle of Web development, so you can focus on
                        writing your app without needing to reinvent the wheel.It is <i>free</i> and <i>open source</i>. </p>

                    <p>In this lesson we will learn to install and use to in order to create <i>better</i> websites, <i>easier</i> than ever.</p>

                    <p>Prerequisites</p>
                    <ul>
                        <li>Basic knowledge of <strong>Python</strong> programming language.</li>
                        <li>Good understanding of <strong>SQL</strong> database queries and schemas.</li>
                        <li><strong>HTML</strong> knowledge on a novice level.</li>
                    </ul>

                    <p>
                        Let's explore, briefly, the contents of each page.
                    </p>
                    <dl>
                        <dt><a href="announcement.html">Announcements</a></dt>
                        <dd>In this page you can view the latest news about the lesson, project deadlines and exam dates, such horrific stuff.</dd>
                        <dt><a href="communication.html">Contact</a></dt>
                        <dd>Instructions for morse code and smoke signals...No just kidding, the email of the professor, who teaches the lesson, in case you have questions and special requests.</dd>
                        <dt><a href="documents.html">Documents</a></dt>
                        <dd>Download links to useful pdfs about each lesson and django tutorials.</dd>
                        <dt><a href="homework.html">Projects</a></dt>
                        <dd>The description and specifications of each announced project.</dd>
                    </dl>
                    <br>

                    <img id="logo-image" src="style/django-logo.png" alt="Django logo">
            </div>
        </div>
        <div id="footer">
            <p>
                <a class="active" href="#">Home</a> |
                <a href="announcement.html">Announcements</a> |
                <a href="communication.html">Contact</a> |
                <a href="documents.html">Documents</a> |
                <a href="homework.html">Projects</a>
            </p>
        </div>
    </div>
</body>

</html>
