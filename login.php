<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password and databasename as a parameter
$conn = mysqli_connect("localhost", "root", "", "myipl");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);

//echo $username ."    "  .$password;
// SQL query to fetch information of registerd users and finds user match.
//include 'connection.php';
$sql="select * from `users` where `password`='$password' AND `userID`='$username'";
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_assoc($result);
print_r($rows);
$rowsofresult = mysqli_num_rows($result);
if ($rowsofresult == 1) {
	echo "In if statement";
$_SESSION['login_user']=$username; // Initializing Session
header("location: home.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($conn); // Closing Connection
}
}
?>
