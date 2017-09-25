<?php
    include 'connect.php';
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

<section class="mbr-section mbr-section-hero mbr-section-full mbr-parallax-background mbr-after-navbar" id="header2-0" style="background-image:url(assets/images/to.jpg);">

    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(0, 0, 0);">
    </div>

    <div class="mbr-table mbr-table-full">
        <div class="mbr-table-cell">

            <div class="container">
                <div class="mbr-section row">
                    <div class="mbr-table-md-up">
                        
                        <div class="mbr-table-cell mbr-right-padding-md-up mbr-valign-top col-md-7">
                            <div class="mbr-figure"><img src="assets/images/to.png"></div>
                        </div>
                        <div class="mbr-table-cell col-md-5 text-xs-center text-md-left">

                            <h3 class="mbr-section-title display-2" style="color:white">TRY OUT</h3>

                            <div class="mbr-section-text lead" style="color:white;text-align:justify">
                                

                           &nbsp; &nbsp;EMAS Private Institute menyediakan latihan soal berupa Try Out yang tidak hanya tertutup untuk siswa EMAS saja, 
						   tetapi juga bagi khalayak umum agar dapat ikut berlatih menghadapi Ujian dengan mantap. Program ini sangat diminati baik 
						   oleh siswa EMAS dan non-EMAS, karena berbeda dengan Try Out yang lain. Try Out EMAS tidak hanya sekedar mengerjakan soal, 
						   namun juga ada penilaian serta pembahasan dan seringkali akan disertai dengan seminar - seminar oleh pembicara dari orang 
						   - orang inspiratif yang telah sukses di bidangnya. So, don't miss it! Let's Join US!
						   
						   </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mbr-arrow mbr-arrow-floating hidden-sm-down" aria-hidden="true"><a href="#msg-box2-0"><i class="mbr-arrow-icon"></i></a></div>

</section>

<section class="mbr-info mbr-section mbr-section-md-padding" id="msg-box2-0" style="background-color: rgb(46, 46, 46); padding-top: 90px; padding-bottom: 90px;">

    
    <div class="container">
        <div class="row">
			<div class="col-md-4">
	<?php
if(isset($_SESSION['error'])) {
    unset($_SESSION['error']);
    echo '<p style="color:red"><small>Maaf akun anda belum aktif. Silakan coba lagi setelah 7 Februari 2016.</small></p>';
}
if(isset($_SESSION['success'])) {
    unset($_SESSION['success']);
    echo '<p style="color:white"><small>Pendaftaran berhasil. Silakan login.</small><br/></p>';
}
?>			
							<h6 style="color:white" align="center">Masukkan Username dan Password Anda</h6>
			  	<div class="panel-body">

			    	<form accept-charset="UTF-8" role="form" action="login-proses.php" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" maxlength="16" required >
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" required="">
							</div>

							<input class="btn btn-lg btn-success btn-block" type="submit" value="Masuk">
						</fieldset>
			      	</form>
                    <p style="color:white"><small>Lupa password? Silakan hubungi contacts@emasenterprise.com</small></p>
			    </div>			
			</div>
			<div class="col-md-8">
				<div class="mbr-table-md-up">
				  <div class="mbr-table-cell mbr-right-padding-md-up col-md-8 text-xs-center text-md-left">
					  <h3 class="mbr-info-title mbr-section-title display-2"  style="color:#ffffff">DAFTAR TRY OUT ONLINE</h3>
					  <h2 class="mbr-info-subtitle mbr-section-subtitle" style="color:#ffffff">Daftarkan dirimu sekarang juga!</h2>
					  <br/>
<br><br>
					  <div class="row">
					  <a class="btn btn-warning" href="daftar.php">Daftar</a>
					 
					  </div>
				  </div>
				</div>
			</div>

            

        </div>
    </div>
</section>

<br><br>

<section class="mbr-section" id="form1-0" style="background-color: rgb(255, 255, 255); padding-top: 0px; padding-bottom: 50px;">
    
    <div class="mbr-section mbr-section__container mbr-section__container--middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-xs-center">
                    <h3 class="mbr-section-title display-2">CONTACT US</h3>
                    <small class="mbr-section-subtitle">if you have some questions about our services, or something else, please kindly send us message.</small>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-section mbr-section-nopadding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">


                    <div data-form-alert="true">
                        <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">
						Thanks for contacting us!
						Don't forget to follow our 
						Instagram : @EMASprivate
						line  : @fse2710q
						phone : +6285704774649</div>
                    </div>


                    <form action="https://mobirise.com/" method="post" data-form-title="CONTACT US">

                        <input type="hidden" value="E7b/kzuyu0sVmdmORPpgj88dK6ZwlphAag1JpgF5KiTXfYcD8TT7lAUpMNtECFawCO48uBmVp+WNC61C4rWJ4+NRof4CraHBonZ3J/0DPo/rliEZmvxS/q/+Yjr1eFb4" data-form-email="true">

                        <div class="row row-sm-offset">

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-0-name">Name<span class="form-asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" required="" data-form-field="Name" id="form1-0-name">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-0-email">Email<span class="form-asterisk">*</span></label>
                                    <input type="email" class="form-control" name="email" required="" data-form-field="Email" id="form1-0-email">
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="form1-0-phone">Phone</label>
                                    <input type="tel" class="form-control" name="phone" data-form-field="Phone" id="form1-0-phone">
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="form1-0-message">Message</label>
                            <textarea class="form-control" name="message" rows="7" data-form-field="Message" id="form1-0-message"></textarea>
                        </div>

                        <div><button type="submit" class="btn btn-warning">CONTACT US</button></div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


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