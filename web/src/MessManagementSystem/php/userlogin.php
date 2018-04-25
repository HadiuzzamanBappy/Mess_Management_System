<?php
session_start();

require "connection.php";

if(isset($_POST['Submit']))
{
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$password=$_POST['password'];

	$mess_person_name="SELECT *
						from person
						where password like '$password' and person_id like (SELECT person_id 
																			from email_id
																				where email_id like '$email')";
	$result=mysqli_query($conn,$mess_person_name);
		if($row=$result->fetch_assoc())
		{
			setcookie ("email",$email,time()+ (30 * 365 * 24 * 60 * 60));  
    		setcookie ("password",$password,time()+ (30 * 365 * 24 * 60 * 60));
			$_SESSION["person_email"] = $email;
			$_SESSION["person_id"] = $row['person_id'];
			$person_id=$row['person_id'];
			$mess_member="SELECT * from mess_person where person_id like '$person_id' and active_status like 1";
			$admin_member="SELECT * from mess_admin where person_id like '$person_id'";
			$result2=mysqli_query($conn,$mess_member);
			$result3=mysqli_query($conn,$admin_member);
			if($row2=$result2->fetch_assoc()){
				if($row3=$result3->fetch_assoc()){
					$_SESSION["person_type"] = 'admin';
					$_SESSION["person_mess_id"] = $row3['mess_id'];
				}
				else{
					if($row2['active_status']=1){
						$_SESSION["person_type"] = 'member';
						$_SESSION["person_mess_id"] = $row2['mess_id'];
					}
					else
					{
						$_SESSION["person_type"] = 'normal';
						unset($_SESSION["person_mess_id"]);
					}
				}
			}
			else{
				$_SESSION["person_type"] = 'normal';
				unset($_SESSION["person_mess_id"]);
			}
			header("location:Home.php");
		}  
		else  
		{  
			$message = "Invalid Login";  
		} 
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Database project</title>
	<link rel="stylesheet" href="../css/userlogin.css">
</head>
<body>
	<div class="headertitle over templete">
		<div class="headertitle_icon over">
			<a href="Home.php">
				<img src="../picture/mess_logo.png" alt="logo" height="80" width="200"">
			</a>	
		</div>
		<div class="Home over">
			<a class="homepage" href="Home.php"><u>Go To Home</u></a>
		</div>
	</div>
	<div class="login_form templete over">
		<form method="post" action="">
			<div class="image over">
				<img src="../picture/people.png" alt="logo" height="250" width="250" title="i am anonymous"">
			</div>
			<div class="maincontainer over">
		  		<div class="container">
		    		<label for="email"><b>E-mail</b></label>
		    			<input type="email" name="email" placeholder="Enter Email" required>

		    		<label for="password"><b>Password</b></label>  
     				<input type="password" name="password" placeholder="Enter Password" required> 
		        
		    		<input type="submit" name="Submit" value="Login">  
				     <div class="text-danger">
				     	<?php
				     		if(isset($message)) {
				     		    echo $message; 
				     		} 
						?>
					</div> 
		  		</div>

		  		<div class="container">
		    		<span class="psw">Forgot <a href="#">password?</a></span>
		    		<span class="need-account"><a href="signup.php">Don't have any account?</a></span>
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