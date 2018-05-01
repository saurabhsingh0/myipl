<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
	echo "1";
header("Location: index.php"); // Redirecting To Home Page
}
?>