<?php
  require('connect.php');
  session_start();
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

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar"><li class="nav-item"><a class="nav-link link" href="EMASprivate.html">EMAS Private</a></li><li class="nav-item"><a class="nav-link link" href="EMASprivate.html#msg-box7-0">About Us<br></a></li><li class="nav-item"><a class="nav-link link" href="EMASprivate.html#features7-0">Services<br></a></li><li class="nav-item"><a class="nav-link link" href="EMASprivate.html#gallery2-0">Our Gallery<br></a></li><li class="nav-item"><a class="nav-link link" href="EMASprivate.html#contacts1-0">Contacts<br></a></li></ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>

<!-- Modal Pop-up End -->
		
<section class="mbr-cards mbr-section mbr-section-nopadding" id="features7-0" style="background-color: rgb(239, 239, 239);">
<br>
<br>
<br>
<br>
<br>
<h3 class="mbr-section-title display-2" style="color:#000000" ><center>Daftarkan Diri Anda</center></h3>

    <div class="row container">
    	<div class="col-md-6 col-md-offset-3">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<!--<h3 class="panel-title" align="center"><strong>Login Administrator Intiqolam Press</strong></h3>-->
			 	</div>
			  	<div class="panel-body">
<?php
  $errors = array('Formulir ada yang kosong. Silakan isi ulang.',
          'Format nomor HP salah. Contoh: 081234567890 (10-13 digit).',
          'Format email salah.',
          'Pendaftaran gagal.',
          );
  if(isset($_SESSION['error'])) { echo $errors[$_SESSION['error']].'<br/>'.PHP_EOL; unset($_SESSION['error']); };
?>
			    	<form accept-charset="UTF-8" class="form-horizontal" role="form" action="daftar-proses.php" method="POST">
						<fieldset>
							<div class="form-group">
                                                                <span class="col-md-3">Nama Lengkap</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" type="text"  maxlength="32" required>
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">Nomor HP</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Nomor HP" name="nomor_hp" type="text" maxlength="13" required>
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">Email</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Email" name="email" type="email" maxlength="32" required>
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">Asal Sekolah</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Asal Sekolah" name="asal_sekolah" type="text" maxlength="32" required>
								</div>
							</div>
                            <div class="form-group">
                                                                        <span class="col-md-3">Asal Provinsi</span>
									<div class="col-md-9">
									<select class="form-control" name="provinsi" id="provinsi" required>
									<?php
									  $query = 'SELECT * FROM wilayah_provinsi';
									  $result = mysqli_query($conn, $query);
									  while($data = mysqli_fetch_object($result)) {
									?>
									  <option value="<?php echo $data->id; ?>"><?php echo $data->nama; ?></option>
									<?php
									  }
									?>
									</select>
								</div>
                            </div>
                            <div class="form-group">
                                                                <span class="col-md-3">Asal Kota</span>
								<div class="col-md-9">
									<select class="form-control" name="kota" id="kota" required>
									<?php
									  $query = 'SELECT * FROM wilayah_kota';
									  $result = mysqli_query($conn, $query);
									  while($data = mysqli_fetch_object($result)) {
									?>
									  <option value="<?php echo $data->id; ?>"><?php echo $data->nama; ?></option>
									<?php
									  }
									?>
									</select>
                                                                       <select id="kota2"></select>
								</div>
                            </div>
							<div class="form-group">
                                                                <span class="col-md-3">ID Line</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="ID Line" name="id_line" type="text" maxlength="32">
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">ID Instagram</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="ID Instagram" name="id_instagram" type="text" maxlength="32">
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">Username</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Username" name="username" type="text" maxlength="16" required>
								</div>
							</div>
							<div class="form-group">
                                                                <span class="col-md-3">Password</span>
								<div class="col-md-9">
									<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
								</div>
							</div>
                                                        
							<div align="center">
<br><br>
							     <input class="btn btn-lg btn-success" align="center" type="submit" value="Daftar">
                                                        </div>
							<br>
						</fieldset>
			      	</form>
                      
			    </div>
			</div>
		</div>
	</div>
		
</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-0" style="background-color: rgb(46, 46, 46); padding-top: 30px; padding-bottom: 90px;">
    
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
					Email : contacts@emasenterprise.com<br>Phone : +62-857-0477-4649
					<br> line : @fse2710q
					<br> Instagram : @EMASprivate</p>
            </div>
           
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
      $('#kota2').hide();
      $('#kota > option').clone().appendTo('#kota2');

      $('#kota > option').remove();
      $('#kota2 > option[value^='+$('#provinsi').val()+']').clone().appendTo('#kota');

      $("#provinsi").change(function() {
      /*if ($(this).data('options') == undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1
        $(this).data('options', $('#select2 option').clone());
      }*/
      $('#kota > option').remove();
      $('#kota2 > option[value^='+$(this).val()+']').clone().appendTo('#kota');
    });

  </script>
  
  <input name="animation" type="hidden">
  </body>
</html>