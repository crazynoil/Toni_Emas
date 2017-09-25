<?php
	header("Content-Type: text/html; charset=ISO-8859-1");
	require'connect.php';
    session_start();
	if(isset($_SESSION['id'])){
		$id_user = $_SESSION['id'];
		$id_soal = $_GET['sl'];
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
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
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
						<li class="nav-item"><a class="nav-link link" href="exit.php">Exit<br></a></li>
					</ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-after-navbar" id="header2-0">
<br><br><br><br><br>
<?php
$d = mysqli_query($conn, "select * from akses where id_soal = '$id_soal' AND id_user = '$id_user'");
$e = mysqli_fetch_object($d);
$f = $e->id_soal;

$x = mysqli_query($conn, "select * from soal where id_soal = '$f'");
$y = mysqli_fetch_object($x);

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

if(isset($e)){
		date_default_timezone_set('Asia/Jakarta');
		$hariini = date("Y-m-d H:i:s");
		$buka = $y->waktu_buka;
		$tutup = $y->waktu_tutup;
		if($hariini < $buka){
			error2(0, $f);			
		}
		if($hariini > $tutup){
			error2(1, $f);			
		}
		else{}
}
else{
	error(2);
	
}

$a = mysqli_query($conn, "select * from user where id_user = '$id_user'");
$b = mysqli_fetch_object($a);

?>
	<h2 align="center"> Tryout <?php echo $y->nama_soal; ?> Online</h2>
	<div class="col-md-8 col-md-offset-2" >
		<div class="well" style="padding: 10px 10px 0px 10px; margin: 10px 0px 20px 0px">
		
					<div>
						<div class="col-md-2 col-md-offset-5">
							<h5 style="" align="center">Sesi 1</h5>
						</div>
						
						<div class="col-md-3 col-md-offset-2">
							
						</div>
					</div>
			
				<div class="form-group">
						<br>
						<hr/>
						[ Menampilkan soal ke-1 sampai 10 dari 100 soal tersedia ]
						<p align="left">							
							<script language="JavaScript">
								TargetDate = "2/24/2017 5:00 AM";
								BackColor = "";
								ForeColor = "";
								CountActive = true;
								CountStepper = -1;
								LeadingZero = true;
								DisplayFormat = "%%D%% Hari, %%H%% Jam, %%M%% Menit, %%S%% Detik.";
								FinishMessage = "It is finally here!";
							</script>
							Sisa Waktu : <script src="assets/bootstrap/js/countdown.js"></script>							
							</p>
							
					<!--SOAL-->
<?php
$tut = mysqli_query($conn, "select * from sesi where id_soal = $id_soal and nomor_sesi=1");
$tet = mysqli_fetch_object($tut);
$tat = $tet->id_sesi;
$jumlah_pertanyaan = $tet->jumlah_pertanyaan;
$batas = 50;
$yee = mysqli_query($conn, "select * from pertanyaan where id_sesi = $tat ORDER BY RAND() limit 0,$jumlah_pertanyaan");
$yoo = mysqli_num_rows($yee);
$ya = 1;
?>
						<form accept-charset="UTF-8" role="form" action="#" method="POST" class="form-inline">
<?php
while($yaa = mysqli_fetch_object($yee)){?>
						<div class="well container" style="padding: 10px 10px 10px 10px; margin: 10px 0px 10px 0px">
<?php
echo $ya++.'. '.$yaa->isi_pertanyaan;
?><br>
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" value="A" name="<?php echo $yaa->id_pertanyaan;?>"> A&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="B" name="<?php echo $yaa->id_pertanyaan;?>"> B&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="C" name="<?php echo $yaa->id_pertanyaan;?>"> C&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="D" name="<?php echo $yaa->id_pertanyaan;?>"> D&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="E" name="<?php echo $yaa->id_pertanyaan;?>"> E&emsp;&emsp;
									</label>
								</div>
							</div>
						</div>
<?php
}
?>	
						</form>					
					<!--SOAL SELESAI-->
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<ul class="pager">
							  <li class="previous disabled"><a href="#">&larr; Sebelumnya</a></li>
							  <li class="next"><a href="#">Selanjutnya &rarr;</a></li>
							</ul>
						</div>
					</div>
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
					Email : EMAS.private@gmail.com<br>Phone : +62-857-0477-4649
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
  <script src="assets/bootstrap/js/countdown.js"></script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>