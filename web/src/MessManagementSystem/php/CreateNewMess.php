<?php
session_start();

require "connection.php";

if(isset($_POST['Submit']))
{
	$mess_name=mysqli_real_escape_string($conn,$_POST['mess_name']);
	$mess_street=mysqli_real_escape_string($conn,$_POST['mess_street']);
	$mess_town=mysqli_real_escape_string($conn,$_POST['mess_town']);
	$mess_person_value=mysqli_real_escape_string($conn,$_POST['mess_person_value']);
	$mess_helpline=mysqli_real_escape_string($conn,$_POST['mess_helpline']);
	$mess_code=mysqli_real_escape_string($conn,$_POST['mess_code']);
	$mess_code_again=mysqli_real_escape_string($conn,$_POST['mess_code_again']);
	if($mess_code<>$mess_code_again)
		$message="Password didn't Match.";
	else
	{
		$mess_name_search="SELECT * from mess_information where mess_name like '$mess_name'";
		$result=mysqli_query($conn,$mess_name_search);
		if($row=$result->fetch_assoc())
		{
			$message="Mess Name Found.Give another Name.";
		}
		else
		{
			$person_id=mysqli_real_escape_string($conn,$_SESSION['person_id']);
			$admin_point="SELECT * from mess_admin where person_id like '$person_id'";
			$result2=mysqli_query($conn,$admin_point);
			if($row2=$result2->fetch_assoc())
			{
				$message="Sorry Sir,You have already created a Mess as Admin.";
			}
			else
			{
				$mess_add="INSERT into mess_information (mess_name,total_person,street,town,helpline,mess_code) values
				   ('$mess_name','$mess_person_value','$mess_street','$mess_town','$mess_helpline','$mess_code')";
				if(mysqli_query($conn,$mess_add))
				{
					$mess_name2="SELECT * from mess_information where mess_name like '$mess_name'";
					$result3=mysqli_query($conn,$mess_name2);
					if($row3=$result3->fetch_assoc())
					{
						$person_id=mysqli_real_escape_string($conn,$_SESSION['person_id']);
						$mess_id=$row3['mess_id'];
						$mess_admin_add="INSERT into mess_admin(person_id,mess_id) values
														('$person_id','$mess_id')";
						if($result=mysqli_query($conn,$mess_admin_add))
						{
							$message="Successfully Created!!";
						}
						else
						{
							$message="There is a problem to add Admin.";
							$mess_delete="DELETE from mess_information where mess_name like '$mess_name'";
							mysqli_query($conn,$mess_delete);
						}
					}
					else
					{
						$message="There is a problem to to get Mess id.";
						$mess_delete="DELETE from mess_information where mess_name like '$mess_name'";
							mysqli_query($conn,$mess_delete);
					}
				}
				else
				{
					$message="There is a problem to add Mess.Try Again.";
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Database project</title>
	<link rel="stylesheet" href="../css/CreateNewMess.css">
</head>
<body>
	<div class="headertitle over templete">
		<div class="headertitle_icon over">
			<a href="http://localhost/MessManagementSystem/Home.html">
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
				<p style="align-content: center;text-align: center; font-size: 16px;"><b>**Please Fill Up All Necessary Information**</b></p>
			</div>
			<div class="maincontainer over">
		  		<div class="container">
		  			<form method="post" action="">
			    		<input type="text" name="mess_name" maxlength="20" style="text-transform:uppercase" placeholder="Enter Your Mess Name.." required> 
	     				<input type="text" name="mess_street" placeholder="Full Address.." required>
	     				<input type="text" name="mess_town" placeholder="Town.." required>
	     				<input type="number" name="mess_person_value" placeholder="Enter Mess Member Value.." required>
	     				<input type="tel" name="mess_helpline" placeholder="Enter a helpline number.." required>

	     				<input type="password" name="mess_code" placeholder="Enter a Secret Code.." class="password" required>
	     				<label for="mess_code" style="font-size: 12px;margin: 13px;margin-top:4px; line-height: 12px;"><i>**this is very important because when anyone wanted to be in your mess then they should proide it</i></label>
	     				<input type="password" name="mess_code_again" placeholder="Enter Secret Code Again" required>
			        
			    		<input type="submit" name="Submit" value="Create My Mess">  

					     <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div> 
				     </form>
				 </div>
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