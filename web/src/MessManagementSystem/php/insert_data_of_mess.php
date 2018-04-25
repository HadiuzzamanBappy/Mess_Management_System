<?php
	require "connection.php";
	if(isset($_POST['enter_the_meal']))
	{
	$date=mysqli_real_escape_string($conn,$_POST['date']);
	 list($year,$month,$day)=explode("-", $date);
	$meal=mysqli_real_escape_string($conn,$_POST['count']);
	$person=$_POST['person'];
	$moy_id="";
	$moy_id_query="SELECT * from month_of_year where month like $month and year like $year";
	$result=mysqli_query($conn,$moy_id_query);
	if($row=$result->fetch_assoc())
	{
		$moy_id=$row['moy_id'];
	}
	else
	{
		$moy_id_query="INSERT into month_of_year(month,year) values
								($month,$year)";
		if(mysqli_query($conn,$moy_id_query))
		{
			$moy_id_query="SELECT moy_id from month_of_year where month like $month and year like $year";
			if($row=mysqli_query($conn,$moy_id_query)->fetch_assoc())
			{
				$moy_id=$row['moy_id'];
			}
		}
	}
	$mess_id=mysqli_real_escape_string($conn,$_SESSION["person_mess_id"]);
	$meal_enter="INSERT into mess_meal(person_id,mess_id,date_of_month,moy_id,meal) values
											('$person','$mess_id','$day','$moy_id','$meal')";
	if(mysqli_query($conn,$meal_enter))
		{
			$message="Thank You Sir!!!!";
		}
	}
	if(isset($_POST['enter_the_cost']))
	{
		$date=mysqli_real_escape_string($conn,$_POST['date']);
		 list($year,$month,$day)=explode("-", $date);
		$cost=mysqli_real_escape_string($conn,$_POST['cost']);
		$details=mysqli_real_escape_string($conn,$_POST['details']);
		$moy_id="";
		$moy_id_query="SELECT * from month_of_year where month like $month and year like $year";
		$result=mysqli_query($conn,$moy_id_query);
		if($row=$result->fetch_assoc())
		{
			$moy_id=$row['moy_id'];
		}
		else
		{
			$moy_id_query="INSERT into month_of_year(month,year) values
									($month,$year)";
			if(mysqli_query($conn,$moy_id_query))
			{
				$moy_id_query="SELECT moy_id from month_of_year where month like $month and year like $year";
				if($row=mysqli_query($conn,$moy_id_query)->fetch_assoc())
				{
					$moy_id=$row['moy_id'];
				}
			}
		}
		$mess_id=mysqli_real_escape_string($conn,$_SESSION["person_mess_id"]);
		$person_id=mysqli_real_escape_string($conn,$_SESSION["person_id"]);
		$market_enter="INSERT into meal_market(person_id,mess_id,moy_id,date_of_month,total_cost,details)values('$person_id','$mess_id','$moy_id','$day','$cost','$details')";
		if(mysqli_query($conn,$market_enter))
			{
				$message="Thank You Sir!!!!";
			}
	}
?>
<div class="bodyinsert template over">
	<div id="navigationinner" class="navigationinner over">
			<a href="#mealinput" class="links" id="link_1">Meal Input</a>
			<a href="#marketinput" class="links" id="link_2">Market Input</a>
	</div>
	<div id="id_of_mealinput" class="divs over">
		<div class="meal_header template over">
			<h3>Meal Input</h3>
		</div>
	<form class="post_a_market_meal over" method="post" action="#">
		    		<label for="date"><b>Enter Meal Date</b></label><br>
		    		<input type="date" name="date" required><br>

		    		<label for="count"><b>Enter Meal Count</b></label><br>
     				<input type="number" name="count" placeholder="Meal Count s.a. 1,2,3.." min="0" required> <br>

     				<label for="details"><b>Select Person Name</b></label><br>
     				<select name="person" class="person_dropdown">
						<option value="select">Selct Person</option>;
	     				<?php
	     				$mess_id=mysqli_real_escape_string($conn,$_SESSION["person_mess_id"]);
	     				$person_details="SELECT * from person where person_id in (SELECT person_id from mess_person where mess_id like '$mess_id' and active_status like 1)";
						$result2=mysqli_query($conn,$person_details); 
						while($row2=$result2->fetch_assoc())
						{
							echo '<option value="'.$row2["person_id"].'">'.$row2["name"].'</option>';
						}
	     				?>
     				</select><br>

		    		<input type="submit" name="enter_the_meal" value="POST"><br>
				     <div class="text-danger">
				     	<?php
				     		if(isset($message)) {
				     		    echo $message; 
				     		} 
						?>
					</div> 
		</form> 
	</div>
	<div id="id_of_marketinput" class="divs over">
		<div class="market_header template over">
			<h3>Market Input</h3>
		</div>
		<form class="post_a_market_meal over" method="post" action="#">
		    		<label for="date"><b>Enter Your Market Date</b></label><br>
		    		<input type="date" name="date" required><br>

		    		<label for="cost"><b>Enter your Market Cost</b></label><br>
     				<input type="number" name="cost" placeholder="Market Cost" min="0" required> <br>

     				<label for="details"><b>Enter Market Details</b></label><br>
     				<textarea id="text" name="details" rows="10" cols="45" class="required"></textarea><br>
		        
		    		<input type="submit" name="enter_the_cost" value="POST"><br>
				     <div class="text-danger">
				     	<?php
				     		if(isset($message)) {
				     		    echo $message; 
				     		} 
						?>
					</div> 
		</form>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script>
 	$('a.links').click(function (e){
   		e.preventDefault();
   		var div_id = $('a.links').index($(this));
   		$('.divs').hide().eq(div_id).show();
});
</script>
