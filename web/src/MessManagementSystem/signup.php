<?php
session_start();

require "connection.php";

if (isset($_POST['Submit'])) {
	$name = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$district = mysqli_real_escape_string($conn, $_POST['district']);
	$versity = mysqli_real_escape_string($conn, $_POST['versity']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
	if ($password == $password2) {
		$mess_person_name = "INSERT into person(name,address,district,versity,password) values
								('$name','$address','$district','$versity','$password')";
		$result = mysqli_query($conn, $mess_person_name);
		$tuple = (mysqli_query($conn, "SELECT person_id from person where name like '$name' and versity like '$versity' and address like '$address'"));
		$row = $tuple->fetch_assoc();
		$id = $row['person_id'];

		mysqli_query($conn, "INSERT into email_id (email_id,person_id) values ('$email','$id')");

		mysqli_query($conn, "INSERT into phone_no (person_id,phone_no) values ('$id','$phone')");

		$_SESSION['message'] = "You are Signed Up";
		$_SESSION['username'] = $name;
		$_SESSION["person_type"] = 'normal';
		header("location: userlogin.php");
	} else {
		$_SESSION['message'] = "the two password didn't match";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Database project</title>
	<link rel="stylesheet" href="css/signup.css">
</head>

<body>
	<div class="headertitle over templete">
		<div class="headertitle_icon over">
			<a href="Home.php">
				<img src="picture/mess_logo.png" alt="logo" height="80" width="200"">
			</a>	
		</div>
		<div class=" Home over">
				<a class="homepage" href="Home.php"><u>Go To Home</u></a>
		</div>
	</div>
	<div class="login_form templete over">
		<form method="post" action="">
			<div class="image over">
				<img src="picture/people.png" alt="logo" height="250" width="250" title="i am anonymous"">
			</div>
			<div class=" maincontainer over">
				<div class="container">
					<input type="text" name="username" placeholder="Enter Full Name" required><br>
					<input type="email" name="email" placeholder="Enter Email" required><br>
					<input type="phone" name="phone" placeholder="Enter Mobile Number" required><br>
					<input type="text" name="address" placeholder="Enter Address" required><br>
					<input type="text" name="district" placeholder="Enter District" required><br>
					<input type="text" name="versity" placeholder="Enter Your University Name" required><br>
					<input type="password" name="password" placeholder="Enter Password" required> <br>
					<input type="password" name="password2" placeholder="Confirm Password" required> <br>
					<input type="submit" name="Submit" value="Sign Up">
					<div class="text-danger">
						<?php
						if (isset($message)) {
							echo $message;
						}
						?>
					</div>
				</div>

				<div class="container">
					<span class="need-account"><a href="userlogin.php">Already have an account?</a></span>
				</div>
		</form>
	</div>
	<div class="footer templete over">
		<div class="reserved">
			<p><i>All Rights Reserved 2018 www.messmanagement.com</i></p>
		</div>
		<div class="credit">
			<p><i>Developed by Bappy,Arju And Rakib<br>Course Co-ordinator : Prof. Dr. Md. Anisur Rahman</i></p>
		</div>
	</div>
</body>

</html>