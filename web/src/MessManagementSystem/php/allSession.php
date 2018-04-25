<?php
$_SESSION['requested_mess_id']=$mess_id;
$_SESSION["person_email"] = $email;
$_SESSION["person_id"] = $row['person_id'];
$_SESSION["person_type"] = 'admin';
$_SESSION["person_type"] = 'normal';
$_SESSION["person_type"] = 'member';
$_SESSION["person_mess_id"] = $row2['mess_id'];
?>