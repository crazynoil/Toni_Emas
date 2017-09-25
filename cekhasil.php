<?php
	include'connect.php';
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
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Site made with Mobirise Website Builder v3.5.1, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v3.5.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/logo2-128x128-52.png" type="image/x-icon">
  <meta name="description" content="">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic&amp;subset=latin">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900">
  <link rel="stylesheet" href="assets/et-line-font-plugin/style.css">
  <link rel="stylesheet" href="assets/bootstrap-material-design-font/css/material.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/socicon/css/socicon.min.css">
  <link rel="stylesheet" href="assets/animate.css/animate.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise-gallery/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

  
 <title> EMAS Private Institute </title> 
  
</head>
<body>
<section id="ext_menu-0">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="index.html" class="navbar-logo"><img src="assets/images/logo2-128x128-80.png" alt="Mobirise"></a>
                        <a class="navbar-caption" href="index.html">EMAS Private Institute</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
						<li class="nav-item"><a class="nav-link link" href="EMASprivate.html">EMAS Private</a></li>
						<li class="nav-item"><a class="nav-link link" href="EMASprivate.html#msg-box7-0">About Us<br></a></li>
						<li class="nav-item"><a class="nav-link link" href="EMASprivate.html#features7-0">Services<br></a></li>
						<li class="nav-item"><a class="nav-link link" href="EMASprivate.html#gallery2-0">Our Gallery<br></a></li>
						<li class="nav-item"><a class="nav-link link" href="EMASprivate.html#contacts1-0">Contacts<br></a></li>
						<li class="nav-item"><a class="nav-link link" href="exit.php">Logout<br></a></li>
					</ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<?php
 $a = mysqli_query($conn, "select * from soal where id_soal = '$id_soal'");
 $b = mysqli_fetch_array($a);
?>	

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-after-navbar" id="header2-0">
	<br><br><br><br><br>

	<h2 align="center"> Tryout <?php echo $b['nama_soal']; ?> Online</h2>

<?php
$doi = mysqli_query($conn, "select * from akses where id_soal = '$id_soal' AND id_user = '$id_user'");
$eoi = mysqli_fetch_object($doi);
$foi = $eoi->id_soal;
$hasil_tryout = $eoi->kelulusan;
$status = $eoi->status;
$kelulusan= $eoi->kelulusan;

	function error($code) {
		$_SESSION['kacau'] = $code;
		header('Location: user.php');
		exit();
	}
	
	function error2($code, $gg) {
		$_SESSION['kacau'] = $code; 
		header("Location: gerbang.php?sl=".$gg);
		exit();
	}

			$goi = $eoi->status;
			$goi = $eoi->kelulusan;
$ambil_waktu = mysqli_query($conn, "select * from soal where id_soal = '$id_soal'");
$y = mysqli_fetch_object($ambil_waktu);

		date_default_timezone_set('Asia/Jakarta');
		$hariini = date("Y-m-d H:i:s");
		$buka = $y->hasil_buka;
		$tutup = $y->hasil_tutup;

			if($hariini < $buka){
				error2(7, $foi);			
			}
			else if($hariini > $tutup){
				error2(8, $foi);			
			}
			else{
                             if(!isset($kelulusan)){
				error2(4, $foi);
                             }
                              else{}
                        }
		
		
$d = mysqli_query($conn, "select * from user where id_user = '$id_user'");
$e = mysqli_fetch_object($d);

$kota = $e->asal_kota;
$prov = $e->asal_provinsi;

$query2 = "select * from wilayah_kota where id = '$kota'";
$ha2  = mysqli_query($conn, $query2);
$hasil2 = mysqli_fetch_object($ha2);

$query3 = "select * from wilayah_provinsi where id = '$prov'";
$ha3  = mysqli_query($conn, $query3);
$hasil3 = mysqli_fetch_object($ha3);
?>

	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3">
				<div class="well" style="background-color: blue; padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; margin: 0px 0px 10px 0px;">
					<h5 style="color:" align="center">Pengumuman</h5><hr />
					<p>
						Nama &emsp;&emsp;&emsp;&emsp;: <?php echo $e->nama_lengkap?><br>
						Asal Sekolah&nbsp;&nbsp;&nbsp; : <?php echo $e->asal_sekolah?><br>
						Asal Provinsi &emsp;: <?php echo $hasil3->nama?> <br>
						Asal Kota&emsp;&emsp;&nbsp;&nbsp; : <?php echo $hasil2->nama?> <br>
					</p><br>		
					<p align="center" style="font-size:15px">
		<?php
			$query = mysqli_query($conn, "select * from soal where id_soal='$id_soal'");
			$fetch = mysqli_fetch_object($query);
			$rumpun = $fetch->jenis_soal;
	
			$query2 = mysqli_query($conn, "select * from akses where id_user = '$id_user' and id_soal = '$id_soal'");
			$fetch2 = mysqli_fetch_object($query2);
			$kelulusan = $fetch2->kelulusan;
			
			if($rumpun == 2){
				echo '<font size="10" color="limegreen"><strong>SELAMAT</strong></font><br>
				<font size="4"><strong>Nilai akhir anda '. $eoi->kelulusan.' </strong></font><br>';
			}
			elseif($rumpun == 1){				
				if($kelulusan != NULL){
				
				$query3 = mysqli_query($conn, "select * from jurusan where id_jurusan = '$kelulusan'");
				$fetch3 = mysqli_fetch_object($query3);
				$nama_jurusan = $fetch3->nama_jurusan;
				
				$query4 = mysqli_query($conn, "select * from ptn where id_ptn = substr('$kelulusan',1,2)");
				$fetch4 = mysqli_fetch_object($query4);
				$nama_ptn = $fetch4->nama_ptn;
				
				echo '<font size="10" color="limegreen"><strong>SELAMAT</strong></font><br>
				<font size="4"><strong>Anda dinyatakan lulus program studi</br>'.$nama_jurusan.' - '.$nama_ptn.'</strong></font><br>';
				}
				else{
					echo '<font size="10" color="red"><strong>MAAF</strong></font><br>
					<font size="4"><strong>Anda dinyatakan tidak lulus</strong></font><br>';
				}
				
			}
			else{
				if($kelulusan != NULL || $kelulusan ==1){
					echo '<font size="10" color="limegreen"><strong>SELAMAT</strong></font><br>
					<font size="4"><strong>Anda dinyatakan lulus</strong></font><br>';
				}
				else{
					echo '<font size="10" color="red"><strong>MAAF</strong></font><br>
					<font size="4"><strong>Anda dinyatakan tidak lulus</strong></font><br>';
				}
			}
		?>
						Pada Tryout <?php echo $b['nama_soal']; ?>  Online Nasional 2017<br>
						EMAS Private Institute<br>
						<em>Tingkatkan Prestasi Anda Menjadi yang Terdepan</em>
					</p>
										
				</div>
		</div>
	</div>
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-0" style="background-color: rgb(46, 46, 46); padding-top: 30px; padding-bottom: 0px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><img src="assets/images/logo2-128x128-80.png"></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Address</strong><br>Dramaga Cantik Regency<br>Blok M-17<br>Dramaga, Bogor<br>16680</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>Contacts</strong><br>
					Email : emas.private@gmail.com<br>Phone : +62-857-0477-4649
					<br> Line : @fse2710q
					<br> Instagram : @EMASprivate</p>
            </div>
        </div>
		<div>
			<p align="right">Developed by AHA Labs IPB</p>
		</div>
    </div>
</section>


  <script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smooth-scroll/SmoothScroll.js"></script>
  <script src="assets/viewportChecker/jquery.viewportchecker.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touchSwipe/jquery.touchSwipe.min.js"></script>
  <script src="assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/jarallax/jarallax.js"></script>
  <script src="assets/masonry/masonry.pkgd.min.js"></script>
  <script src="assets/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/mobirise-gallery/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>