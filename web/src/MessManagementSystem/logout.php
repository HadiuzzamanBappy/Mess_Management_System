<?php
session_start();
unset($_SESSION["person_email"]);
unset($_SESSION["person_id"]);
unset($_SESSION["person_type"]);
header("location:Home.php");
?>