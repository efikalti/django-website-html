<?PHP

session_start();

if ($_SESSION['user'] !== 'user') {
    header('Location: login.html');
}
