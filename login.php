<?php

$con=  mysqli_connect("localhost", "root", "", "user");
session_start();

if(empty($_POST["login"]))
{
	 
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	$sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);

	if($count == 1)
	{
		$row = mysqli_fetch_array($run_query);
		$_SESSION["user_id"] = $row["user_id"];
		header("location:countryflag.html");
		echo "savita";
	}
	else
	{
		echo "<script>  alert('Hello! I am an alert box!') </script>";
		header("location:login.php");
	}
	
}
?>