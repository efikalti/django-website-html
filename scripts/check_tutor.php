<?PHP
session_start();

if ($_SESSION['role'] != 'tutor') {
    header('Location: ../home.php');
}
?>
