<?php
	require '../_inc/connect.php';

	$id_user = !empty($_POST['id_user']) ? (int) $_POST['id_user'] : NULL;
	$password_baru = !empty($_POST['password_baru']) ? md5($_POST['password_baru']) : NULL;

	$connect->query("UPDATE user SET password = '$password_baru' WHERE id_user = $id_user");
	if($connect->affected_rows < 1) {header('HTTP/1.0 403 Forbidden'); die('error');}
	else echo 'success';
?>