<?php
	include'connect.php';
    session_start();
	if(isset($_SESSION['id'])){
		
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
<div class="row">
	<div class="row col-md-4" style="margin: 0px 0px 0px 30px;"><br><br><br>
					<div class="mbr-cards-col col-md-4" style="padding-top: 100px; padding-bottom: 0px;">

						<div class="card container">
							<form class="form-horizontal">
	<?php
		$id = $_SESSION['id'];
		$query = "select * from user where id_user = '$id'";
		$ha  = mysqli_query($conn, $query);
		$hasil = mysqli_fetch_array($ha);
		
		$kota = $hasil['asal_kota'];
		$prov = $hasil['asal_provinsi'];
		
		$query2 = "select * from wilayah_kota where id = '$kota'";
		$ha2  = mysqli_query($conn, $query2);
		$hasil2 = mysqli_fetch_array($ha2);
		
		$query3 = "select * from wilayah_provinsi where id = '$prov'";
		$ha3  = mysqli_query($conn, $query3);
		$hasil3 = mysqli_fetch_array($ha3);
	?>

								<h5 align="center">Data Diri</h5>
								<div class="form-group">
									<label class="col-md-6">Nama Lengkap</label>
									<div class="form-control col-md-6">
										<h6> <?php echo $hasil['nama_lengkap'];?> </h6>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-6">Asal Sekolah</label>
									<div class="form-control col-md-6">
										<h6><?php echo $hasil['asal_sekolah'];?> </h6>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-6">Asal Provinsi</label>
									<div class="form-control col-md-6">
										<h6><?php echo $hasil3['nama'];?> </h6>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-6">Asal Kota</label>
									<div class="form-control col-md-6">
										<h6><?php echo $hasil2['nama'];?> </h6>
									</div>
								</div>
								<div  align="center">
									<a href="edit-datadiri.php" class="btn btn-success btn-lg">Edit</a>
								</div>
							</form>
						</div>
					</div>
	<?php
	  $errors = array('Maaf, waktu pelaksanan tryout belum dimulai.',
		  'Maaf, waktu pelaksanan tryout telah selesai.',
		  'Maaf, anda belum melakukan pembayaran untuk tryout yang anda pilih.',
		  'Maaf, anda belum mengerjakan tryout.',
		  'Maaf, status kelulusan anda belum sedang kami proses. Mohon bersabar.',
		  'Tryout sudah dikerjakan. ',
		  'Tryout berhasil dikerjakan. Terimakasih telah mengikuti Tryout ini.',
		  'Maaf, tunggu sampai waktu pengumuman tiba.',
		  'Maaf, waktu pengumuman sudah berakhir.');
	  if(isset($_SESSION['kacau'])) { 
	  echo '<p style="color:red">'. $errors[$_SESSION['kacau']].'</p>'.'<br/>'.PHP_EOL; unset($_SESSION['kacau']); 
	  };
	?>
	</div>
	<div class="row col-md-7">
		<br><br><br><br>
		<div align="center" style="padding-right:0px">
			<h3 class="mbr-section-title display-2" style="color:#000000" >Tryout Online</h3>
		</div>
		<div class="col-md-offset-1" style="margin:0px 0px 0px 0px;">
<?php
	$z = "select * from soal";
	$x = mysqli_query($conn, $z);
	$jumlah = mysqli_num_rows($x);
	for($o = 0; $o<$jumlah; $o++){
	$y = mysqli_fetch_array($x);
	?>
		<div class="well col-md-3" style="padding: 10px 10px 10px 10px; margin:0px 10px 10px 0px;" align="center">
			<div class="card-img"><a href="#" ><img src="assets/images/logo-tipe-soal/<?php echo $y['logo']?>.png"></a></div><br>
			<h6 class="card-title"><?php echo $y['nama_soal']?></h6>
			<a href="gerbang.php?sl=<?php echo $y['id_soal']?>" class="btn btn-primary btn-lg">Masuk</a>
		</div>		
	<?php
	}
?>		
		</div>
	</div>
</div>
<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-0" style="background-color: rgb(46, 46, 46); padding-top: 30px; padding-bottom: 0px;">
    
    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><img src="assets/images/logo3-128x128-80.png"></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><br><br><strong>Address</strong>
<br>Jl. Babakan Raya 6
<br>Dramaga, Bogor
<br>16680</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
			<p><br><br><strong>Contacts</strong>
			<br> Email : contacts@emasenterprise.com
			<br> Phone : +62-822-6066-7358
			<br> LINE : @emasprivate
			<br> Instagram : @emasprivate_ipb
			</p>
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