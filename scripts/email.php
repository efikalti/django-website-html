<?php
// Send
$headers = "From: {$_POST['email']}" . "\r\n";
mail('efikalti@gmail.com', $_POST['subject'], $_POST['message'], $headers);
?>
