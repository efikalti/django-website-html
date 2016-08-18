<?PHP
session_start();

if ( $_SESSION["logged"] !== "true" )
{
  header ("Location: login.html");
}
else
{
  header ("Location: home.php");
}

?>
