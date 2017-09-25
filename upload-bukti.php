<?php
		include 'connect.php';
		session_start();
			$id = $_SESSION['id'];
			$soal = $_GET['sl'];
			$foto_size = $_FILES["bukti"]["size"];
			$imageFileType = $_FILES["bukti"]["type"];
			$foto_loc = $_FILES["bukti"]["tmp_name"];
			$nama_baru = 'bukti'.$id;
			date_default_timezone_set("Asia/Bangkok");
			$waktu = date("Y-m-d H:i:s");
			$folder = "assets/images/bukti-pembayaran/";
			$alamat_bukti = $folder.basename($_FILES["bukti"]["name"]);			
			$query = "insert into akses values('$id', '$soal', '1', '$alamat_bukti', '$waktu', NULL, NULL, NULL, NULL, NULL)";
			$uploadOk = 1;
			$tipe_gambar = pathinfo($alamat_bukti, PATHINFO_EXTENSION);
			
		if($tipe_gambar){
			if ($foto_size > 3000000) {
					?>
					<script language="javascript">alert("Maaf, ukuran file terlalu besar. Ukuran maksumal 3 Mb.");</script>
					<script>document.location.href='gerbang.php?sl=<?php echo $soal;?>';</script>
					<?php
			}
			if($tipe_gambar != "jpg" && $tipe_gambar != "png" && $tipe_gambar != "jpeg") { echo $tipe_gambar;
					?>
					<script language="javascript">alert("Hanya gambar berformat JPG, JPEG, dan PNG yang dapat diupload.");</script>
					<script>document.location.href='gerbang.php?sl=<?php echo $soal;?>';</script>
					<?php

			// Jika semuanya ok, langsung lakukan upload file
			}
			else {
				if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $alamat_bukti)) {
					mysqli_query($conn, $query);
					echo "Proses upload bukti pembayaran anda berhasil";
					$_SESSION['terupload'] = TRUE;
					?>
					<script>document.location.href='gerbang.php?sl=<?php echo $soal;?>';</script>
					<?php
				} else {
					echo mysqli_error($conn);
					$_SESSION['terupload'] = FALSE;
					?>
					<script language="javascript">alert("Maaf terjadi error ketika melakukan upload.");</script>
					<script>document.location.href='gerbang.php?sl=<?php echo $soal;?>';</script>
					<?php
				}
			}			
		}
		else{
			$_SESSION['terupload'] = FAlSE;
			echo 'maaf terjadi error ketika melakukan upload'.mysqli_error($conn);?>
			
					<script>document.location.href='gerbang.php?sl=<?php echo $soal;?>';</script>
					<?php
		}
?>