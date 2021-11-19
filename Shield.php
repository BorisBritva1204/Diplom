<?php

$shield_user = $_SESSION["username"];
$shield_query_user = "SELECT * FROM admin WHERE username = '$shield_user'";
$shield_result_user = mysqli_query($link, $shield_query_user);

if(mysqli_num_rows($shield_result_user)==0) {
	if ($_SESSION != NULL){
		echo'<body onpageshow="myFunction()">';
		echo'<script>';
		echo'function myFunction() {';
		echo'	alert("Ваш аккаунт удалён");';
		echo'}';
		echo'</script>';
		echo'</body>';
	}
	$_SESSION =session_destroy();
}

$shield_admORuser = $_SESSION["admORuser"];
$shield_admORuser_username = $_SESSION["username"];
$shield_query_admORuser = "SELECT * FROM admin WHERE admORuser = '$shield_admORuser' AND username = '$shield_admORuser_username'" ;
$shield_result_admORuser = mysqli_query($link, $shield_query_admORuser);
$shield_admORuser_row = mysqli_fetch_assoc($shield_result_admORuser);

if ($shield_admORuser != $shield_admORuser_row["admORuser"])
{
	if ($_SESSION != NULL){
		echo'<body onpageshow="myFunction()">';
		echo'<script>';
		echo'function myFunction() {';
		echo'	alert("Вы были кикнуты (Вам изменили статус)");';
		echo'}';
		echo'</script>';
		echo'</body>';
	}
	$_SESSION =session_destroy();
}

?>