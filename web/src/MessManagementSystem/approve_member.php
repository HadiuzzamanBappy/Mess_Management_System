<div class="approvetext over templete">
	<table>
		<?php
		$mess_id = mysqli_real_escape_string($conn, $_SESSION["person_mess_id"]);
		$inactive_query = "SELECT name,address,district,versity from person,mess_person where person.person_id like mess_person.person_id and mess_person.active_status like 0 and mess_person.mess_id like '$mess_id'";
		$result2 = mysqli_query($conn, $inactive_query);
		while ($row2 = $result2->fetch_assoc()) {
			echo '<tr>
						<td>' . $row2["name"] . '</td>
						<td>' . $row2["address"] . '</td>
						<td>' . $row2["district"] . '</td>
						<td>' . $row2["versity"] . '</td>
						<td><input type="submit" class="approve" name="approve" value="Approve"></td>
						<td><input type="submit" class="delete" name="delete" value="Delete"></td>
					</tr>';
		}
		?>
	</table>
</div>