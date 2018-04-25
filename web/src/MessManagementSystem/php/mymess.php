<?php
session_start();

require "connection.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Database project</title>
	<link rel="stylesheet" href="../css/mymess.css">
	<link rel="stylesheet" type="text/css" href="../css/insert_data_of_mess.css">
	<link rel="stylesheet" type="text/css" href="../css/approve_member.css">
</head>
<body>
	<div class="headertitle over templete">
		<div class="headertitle_icon over">
			<a href="Home.php">
				<img src="../picture/mess_logo.png" alt="logo" height="80" width="200"">
			</a>	
		</div>
		<div class="Home over">
			<li><a class="homepage" href="Home.php"><u>Go To Home</u></a></li>
		</div>
	</div>
	<div class="navigation templete over">
			<ul class="unorderlist over">
				<li><a class="active" href="mymess.php">Status</a></li>
				<li><a class="" href="mymess.php?page=insert_data_of_mess">Insert</a></li>
				<?php 
				$person_type=mysqli_real_escape_string($conn,$_SESSION["person_type"]);
				if($person_type=="admin")
					echo '<li><a class="" href="mymess.php?page=approve_member">Approve Member</a></li>';
				?>
				<li><a class="" href="mymess.php?page=mymeal">My Meal</a></li>
				<li><a class="" href="mymess.php?page=notice">Notice</a></li>
			</ul>
	</div>	
		<?php
			require "connection.php";
			$p = isset($_GET['page'])?$_GET['page']:"";
			$page = $p.".php";

			if(file_exists($page))
			{
				include $page;
			}
			else if($p=="notice"){
				echo '<div class="noticetext over templete">
				 <p>Here Notice will Published</p>
				 </div>';
			}
			else if($p=="mymeal"){
				echo '<div class="noticetext over templete">
						<div class="meallist over">
							<table class="meallist_table over">
								<tr class="tablerow">
									<th class="tableheader">Date</th>
									<th class="tableheader">Meal</th>
								</tr>';
								$mess_id=mysqli_real_escape_string($conn,$_SESSION["person_mess_id"]);
								$person_id=mysqli_real_escape_string($conn,$_SESSION["person_id"]);
								$meal_list_query="SELECT date_of_month,month,year,meal from mess_meal join month_of_year where mess_meal.moy_id like month_of_year.moy_id and mess_meal.mess_id like '$mess_id' and mess_meal.person_id like '$person_id'";
								$result=mysqli_query($conn,$meal_list_query);
								while($row=mysqli_fetch_assoc($result)){
									echo '<tr class="tablerow">
											<td class="tabledata">'.$row["date_of_month"].'-'.$row["month"].'-'.$row["year"].'</td>
											<td class="tabledata">'.$row["meal"].'</td>
										  </tr>';
								}		
						echo '</table>
						</div>
					</div>';
			}
			else {
				echo '<div class="bodytext over templete">';
				$mess_id=mysqli_real_escape_string($conn,$_SESSION["person_mess_id"]);
				$mess_details="SELECT * from mess_information where mess_id like '$mess_id'";
				$result=mysqli_query($conn,$mess_details);
				if($row=mysqli_fetch_assoc($result))
					echo '<p>Mess Name: '.$row["mess_name"].'<br>Mess Place : '.$row["street"].','.$row["town"].'<br>Total Person : '.$row["total_person"].'<br>Helpline '.$row["helpline"].'<br></p>';
				echo '<table>
						<tr>
							<th>Person Name</th>
							<th>Place</th>
							<th>Organization</th>
						</tr>';
				$person_details="SELECT * from person where person_id in (SELECT person_id from mess_person where mess_id like '$mess_id' and active_status like 1)";
				$result2=mysqli_query($conn,$person_details); 
				while($row2=$result2->fetch_assoc())
				{
					echo '<tr>
							<td>'.$row2["name"].'</td>
							<td>'.$row2["address"].','.$row2["district"].'</td>
							<td>'.$row2["versity"].'</td>
						</tr>';
				}
				echo '</table>
					</div>';
			}
		?>
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