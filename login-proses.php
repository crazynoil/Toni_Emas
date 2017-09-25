<?php
        ini_set('session.gc_maxlifetime', 80000);
	include 'connect.php';
		session_start();

	
			$username = stripslashes($_POST['username']);
			$password = stripslashes($_POST['password']);
			$username = mysqli_real_escape_string($conn,$username);
			$password = mysqli_real_escape_string($conn,$password);
                        $md5 = md5($password);
			$query = "SELECT * FROM user WHERE username = '$username'";
				$uspass = mysqli_query($conn,$query);
				$row = mysqli_fetch_array($uspass, MYSQLI_ASSOC); 
				if($row['password']== $md5 && $row['username']== $username) {
					$_SESSION['id'] = $row['id_user'];
					echo "Loading, Please Wait....";
				?>
					<script>document.location.href='user.php';</script>
				<?php
				}
				else {?>
					
					<script language="javascript">alert("Login gagal. Cek kembali username dan password anda.");</script>
					<script>document.location.href='tryout.php';</script>
				<?php 
				}
?>