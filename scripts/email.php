<?php
require("db_adapter.php");

$headers = "From: {$_POST['email']}" . "\r\n";

$tutors = get_tutors();
$result = $tutors->fetchAll();
foreach ($result as &$tutor) {
  mail($tutor['username'], $_POST['subject'], $_POST['message'], $headers);
}
header("Location: ../communication.php");
?>
