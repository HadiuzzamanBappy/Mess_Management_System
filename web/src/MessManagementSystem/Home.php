<?php
session_start();
require 'connection.php';
if (isset($_POST['request'])) {
	if (isset($_SESSION['person_id'])) {
		$mess_id = mysqli_real_escape_string($conn, $_POST['request']);
		$_SESSION['requested_mess_id'] = $mess_id;
		header("location:mess_entrance_request.php");
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Database project</title>
	<link rel="stylesheet" href="css/homestyle.css">
</head>

<body>
	<div class="header templete over">
		<div class="headertitle templete over">
			<div class="headertitle_icon">
				<a href="Home.php">
					<img src="picture/mess_logo.png" alt="logo" height="80" width="200"">
			</a>
		</div>
		<div class=" headertitle_login over ">
			<?php
			if (isset($_SESSION['person_type'])) {
				echo '<div class="login_signup">
						<a class="login" href="logout.php">LOG OUT</a>
					</div>
					';
				$person_type = mysqli_real_escape_string($conn, $_SESSION['person_type']);
				if ($person_type == "normal") {
					echo '<a href="CreateNewMess.php">Create Your Own Mess</a>';
				}
			} else {
				echo '<div class="login_signup">
						<a class="login" href="userlogin.php">LOGIN</a>
						<a  class="signup" href="signup.php">SIGN UP</a>
					</div>';
			}
			?>
		</div>
	</div>
	<form action=" Home.php" method="POST">
					<div class="navigation templete over">
						<a class="active" href="Home.php">Home</a>
						<a href="#Rules">Rules</a>
						<a href="#Services">Services</a>
						<a href="#Contact">Contact Us</a>
						<a href="#About">About</a>
						<?php
						if (isset($_SESSION['person_type'])) {
							$person_type = mysqli_real_escape_string($conn, $_SESSION['person_type']);
							if ($person_type <> "normal") {
								echo '<a href="mymess.php">My Mess</a>';
							}
						}
						?>
						<button type="submit">Submit</button>
						<input type="text" name="search" placeholder="Search Mess..">
					</div>
					</form>
					<div class="slideshow-container">
						<div class="mySlides fade">
							<div class="numbertext">1 / 3</div>
							<img src="picture/demo_pic1.jpg" style="width:100%">
						</div>

						<div class="mySlides fade">
							<div class="numbertext">2 / 3</div>
							<img src="picture/demo_pic2.jpg" style="width:100%">
						</div>

						<div class="mySlides fade">
							<div class="numbertext">3 / 3</div>
							<img src="picture/demo_pic3.jpg" style="width:100%">
						</div>

						<div style="text-align:center">
							<span class="dot" onclick="currentSlide(1)"></span>
							<span class="dot" onclick="currentSlide(2)"></span>
							<span class="dot" onclick="currentSlide(3)"></span>
						</div>
					</div>

					<div class="containsection templete over">
						<div class="maincontent templete">
							<?php
							require "connection.php";
							if (isset($_POST['search'])) {
								$name = $_POST['search'];
								if ($name == "") {
									$mess_name = "SELECT * from mess_information";
								} else {
									$mess_name = "SELECT * FROM mess_information WHERE LOWER(mess_information.Mess_Name) LIKE LOWER('%$name%')";
								}
							} else {
								$mess_name = "SELECT * from mess_information";
							}
							$result = mysqli_query($conn, $mess_name);
							while ($row = $result->fetch_assoc()) {
								echo '
							<div class="mess-container over">
								<div class="mess-image over">
									<img src="picture/mess_pic.png" width="126px">
								</div>
								<div class="mess-information over">
									<div class="mess-name-street over">
										<h2 style="width: fill-content">' . $row["mess_name"] . '</h2>
										<p align:right;>' . "Place : " . $row["street"] . ',' . $row["town"] . '</p>
									</div>
									<div class="total-person over">
										' . "Total Person : " . $row["total_person"] . '
									</div>
									<div class="help-line over">
										' . 'Help Line : ' . $row["helpline"] . '
									</div>
								</div>
								<div class="submit-request over">
									<form action="" method="post">
										<button type="submit" name="request" class="requestbuttont" value="' . $row["mess_id"] . '">Request To Enter!</button>
									</form>
								</div>
							</div>
							';
							}
							?>
						</div>
						<div class="sidesection templete">
							<div class="sideheadings">
								<p>Latest News</p>
							</div>
							<div class="sidesectionwrite">
								<p>here go some text.here go some text.here go some text.here go some text.here go some text.here go some text.here go some text.</p>
							</div>
						</div>
					</div>
					<div class="footer templete over">
						<div class="reserved">
							<p><i>All Rights Reserved &copy2018 www.messmanagement.com</i></p>
						</div>
						<div class="credit">
							<p><i>Developed by Bappy,Arju And Rakib<br>Course Co-ordinator : Prof. Dr. Md. Anisur Rahman</i></p>
						</div>
					</div>
			</div>

			<script>
				var slideIndex = 0;
				showSlides();

				function showSlides() {
					var i;
					var slides = document.getElementsByClassName("mySlides");
					var dots = document.getElementsByClassName("dot");
					for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";
					}
					for (i = 0; i < dots.length; i++) {
						dots[i].className = dots[i].className.replace(" active", "");
					}
					slideIndex++;
					if (slideIndex > slides.length) {
						slideIndex = 1
					}
					slides[slideIndex - 1].style.display = "block";
					dots[slideIndex - 1].className += " active";
					setTimeout(showSlides, 4000); // Change image every 2 seconds
				}
			</script>
</body>

</html>