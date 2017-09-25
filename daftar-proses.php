<?php
	require('connect.php');
	session_start();

	if(isset($_SESSION['id'])){
		$id_soal = $_GET['sl'];
		$id_user = $_SESSION['id'];
	}
	else{
		?>
		<script>document.location.href='tryout.php';</script>
		<?php
	}

	function error($code) {
		$_SESSION['error'] = $code;
		header('Location: daftar.php');
		exit();
	}

	$nama_lengkap = !empty($_POST['nama_lengkap']) ? htmlspecialchars($_POST['nama_lengkap']) : NULL;
	$nomor_hp = !empty($_POST['nomor_hp']) ? htmlspecialchars($_POST['nomor_hp']) : NULL;
	$email = !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : NULL;
	$asal_sekolah = !empty($_POST['asal_sekolah']) ? htmlspecialchars($_POST['asal_sekolah']) : NULL;
	$provinsi = !empty($_POST['provinsi']) ? htmlspecialchars($_POST['provinsi']) : NULL;
	$kota = !empty($_POST['kota']) ? htmlspecialchars($_POST['kota']) : NULL;
	$id_line = !empty($_POST['id_line']) ? htmlspecialchars($_POST['id_line']) : NULL;
	$id_instagram = !empty($_POST['id_instagram']) ? htmlspecialchars($_POST['id_instagram']) : NULL;
	$username = !empty($_POST['username']) ? htmlspecialchars($_POST['username']) : NULL;
	$password = !empty($_POST['password']) ? md5($_POST['password']) : NULL;

	if(!$nama_lengkap || !$nomor_hp || !$email || !$asal_sekolah || !$provinsi || !$kota || !$username || !$password) error(0);
	else if(!preg_match('/^08[0-9]{8,11}+$/', $nomor_hp)) error(1);
	else if(filter_var($email, FILTER_VALIDATE_EMAIL)  === FALSE) error(2);
	else {
		$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, 'INSERT INTO user(nama_lengkap, nomor_hp, email, asal_sekolah, asal_provinsi, asal_kota, id_line, id_instagram, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			mysqli_stmt_bind_param($stmt, "ssssssssss", $nama_lengkap, $nomor_hp, $email, $asal_sekolah, $provinsi, $kota, $id_line, $id_instagram, $username, $password);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_affected_rows($stmt) < 1) error(3);
			mysqli_stmt_close($stmt);

			$_SESSION['success'] = TRUE;
			header('Location: tryout.php');
	}
?>