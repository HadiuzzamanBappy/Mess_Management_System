<?php
session_start();

require "connection.php";

if (isset($_POST['submitcode'])) {
	$requested_mess_id = mysqli_real_escape_string($conn, $_SESSION['requested_mess_id']);
	$person_id = mysqli_real_escape_string($conn, $_SESSION['person_id']);

	$mess_name = "SELECT mess_code from mess_information where mess_id like '$requested_mess_id'";
	$result = mysqli_query($conn, $mess_name);
	if ($row = $result->fetch_assoc()) {
		$mess_admin = "SELECT * from mess_admin where mess_id like '$requested_mess_id' and person_id like '$person_id'";
		$result2 = mysqli_query($conn, $mess_admin);
		if ($row2 = $result2->fetch_assoc()) {
			$message = "Sir!! You are the Admin.";
		} else {
			$mess_person = "SELECT * from mess_person where mess_id like '$requested_mess_id'";
			$result3 = mysqli_query($conn, $mess_person);
			if ($row3 = $result3->fetch_assoc()) {
				if ($row3['active_status'] == 1) {
					$message = "Sorry,You are already a member!!";
				} else {
					$message = "Sorry,You have already Requested!!";
				}
			} else {
				$insert_person = "INSERT into mess_person(mess_id,person_id) values
														('$requested_mess_id','$person_id')";
				if (mysqli_query($conn, $insert_person))
					$message = "Thank you.Your Request Has Been Sent To Admin!!";
			}
		}
	} else {
		$message = "Invalid Password";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Database project</title>
	<link rel="stylesheet" href="css/mess_entrance_request.css">
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
			<div class="profile over">
				<?php
				$requested_mess_id = mysqli_real_escape_string($conn, $_SESSION['requested_mess_id']);
				$person_id = mysqli_real_escape_string($conn, $_SESSION['person_id']);
				$mess_person_name = "SELECT * from person where person_id like '$person_id'";
				$result = mysqli_query($conn, $mess_person_name);
				if ($row = $result->fetch_assoc()) {
					echo '<div>
						<p><b>' . "Name : " . '</b>' . $row["name"] . '</p>
					</div>
					<div>
						<p><b>' . "Address : " . '</b>' . $row["address"] . "," . $row["district"] . '</p>
					</div>
					<div>
						<p><b>' . "Institution : " . '</b>' . $row["versity"] . '</p>
					</div>';
					$mess_name = "SELECT * from mess_information where mess_id like '$requested_mess_id'";
					$result2 = mysqli_query($conn, $mess_name);
					if ($row2 = $result2->fetch_assoc()) {
						echo '<div>
					</div>
					<div>
						<p><b>' . "Your are requesting for : " . '</b></p>
					</div>
					<div>
						<p>' . $row2["mess_name"] . '</p>
					</div>';
					}
				}
				?>
			</div>
			<div class="maincontainer over">
				<div class="container">
					<div class="text-danger">
						<?php
						if (isset($message)) {
							echo $message;
						}
						?>
					</div>
					<label for="psw"><b>Mess Key Password</b></label>
					<input type="password" placeholder="Enter Mess Key Password" name="psw" required>

					<input type="submit" name="submitcode" value="Request to Admin">
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