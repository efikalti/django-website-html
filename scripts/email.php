<?php
require("db_adapter.php");

$headers = "From: {$_POST['email']}" . "\r\n";

$tutors = get_tutors();
foreach ($tutors as &$tutor) {
  mail($tutor['username'], $_POST['subject'], $_POST['message'], $headers);
}
header("Location: ../communication.php");
?>
