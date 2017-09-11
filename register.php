<?php

$con=  mysqli_connect("localhost", "root", "", "user");

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];
$contact=$_POST['contact'];
$address=$_POST['address'];
$name = "/^[A-Z][a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number = "/^[0-9]+$/";


if(empty($name) || empty($email) || empty($password)|| empty($repassword)|| empty($contact)|| empty($address) )
{
		echo "<div class='alert alert-danger'>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><i>Please Fill all fields..!</i></b>
			  </div>";
		exit();
}
 else 
 {
		if(!preg_match($name,$name))
		{
			echo 
				"<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>name <i>$name</i> is not valid..!</b>
				</div>";
			exit();
		}
	
	
		if(!preg_match($emailValidation,$email))
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>This Email <i>$email</i> is not valid..!</b>
				</div>";
			exit();
		}
		
		if(strlen($password) < 9 )
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Password is weak</b>
				</div>";
			exit();
		}
	
		if(strlen($repassword) < 9 )
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Password is weak</b>
				</div>";
			exit();
		}
	
		if($password != $repassword)
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b><i>Password not matches</i></b>
				</div>";
		}
	
		if(!preg_match($number,$contact))
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Mobile number <i>$mobile</i> is not valid</b>
				</div>";
			exit();
		}
		
		if(!(strlen($contact) == 10))
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Mobile number must be greater than 10 digit</b>
				</div>";
			exit();
		}
	
		$sql = "SELECT user_id FROM user WHERE email = '$email' LIMIT 1" ;
		$check_query = mysqli_query($con,$sql);
		$count_email = mysqli_num_rows($check_query);
	
		if($count_email > 0)
		{
			echo "
				<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Email Address is already available Try Another email address</b>
				</div>";
				exit();
		}
		else 
		{
			$password = md5($password);
			$sql = "INSERT INTO `user` 
					(`user_id`, `name`, `email`, 
					`password`,`repassword`, `contact`, `address`) 
					VALUES (NULL, '$name', '$email', 
					'$password',`$repassword` '$contact', '$address')";
		
			$run_query = mysqli_query($con,$sql);
			if($run_query)
			{
				echo "<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>You Have Registered Successfully...</b>
					</div>";
			}
		}
	}
?>