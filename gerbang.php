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
$d = mysqli_query($conn, "select * from akses where id_soal = '$id_soal' AND id_user = '$id_user'"); 
$e = mysqli_fetch_object($d);

if(isset($e)){ //Mengecek sudah bayar atau belum
	$kok = $e->status;
	if($kok==1){
	include'gerbang-mohonsabar.php';		
	}
	else if($kok==2 || $kok==3 || $kok==0){
	include'gerbang-sudahbayar.php';		
	}
}
else{
	include'gerbang-belumbayar.php';
}
?>

	
	
	<br><br><br><br>
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
  <script>
      $('#jurusan2').hide();
      $('#jurusan > option').clone().appendTo('#jurusan2');

      $('#jurusan > option').remove();
      $('#jurusan2 > option[value^='+$('#ptn').val()+']').clone().appendTo('#jurusan');

      $("#ptn").change(function() {
      /*if ($(this).data('options') == undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1
        $(this).data('options', $('#select2 option').clone());
      }*/
      $('#jurusan > option').remove();
      $('#jurusan2 > option[value^='+$(this).val()+']').clone().appendTo('#jurusan');
    });

  </script>
  <script>
      $('#jurusani2').hide();
      $('#jurusani > option').clone().appendTo('#jurusani2');

      $('#jurusani > option').remove();
      $('#jurusani2 > option[value^='+$('#ptn').val()+']').clone().appendTo('#jurusani');

      $("#ptni").change(function() {
      /*if ($(this).data('options') == undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1
        $(this).data('options', $('#select2 option').clone());
      }*/
      $('#jurusani > option').remove();
      $('#jurusani2 > option[value^='+$(this).val()+']').clone().appendTo('#jurusani');
    });

  </script>
  <script>
      $('#jurusano2').hide();
      $('#jurusano > option').clone().appendTo('#jurusano2');

      $('#jurusano > option').remove();
      $('#jurusano2 > option[value^='+$('#ptno').val()+']').clone().appendTo('#jurusano');

      $("#ptno").change(function() {
      /*if ($(this).data('options') == undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1
        $(this).data('options', $('#select2 option').clone());
      }*/
      $('#jurusano > option').remove();
      $('#jurusano2 > option[value^='+$(this).val()+']').clone().appendTo('#jurusano');
    });

  </script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>