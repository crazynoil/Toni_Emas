<?php
	header("Content-Type: text/html; charset=ISO-8859-1");
	require'connect.php';
    session_start();

  /*
    cek login, kalau belum redirect ke tryout
    kalau sudah, cek soal:
		kalau belum buka atau belum tutup redirect ke gerbang
		kalau sudah buka dan belum tutup, cek akses:
	      kalau belum bayar, belum lunas, atau sudah pernah mengerjakan, redirect ke gerbang
	      kalau sudah lunas dan belum mengerjakan, cek timer:
	        kalau ngga ada buat timer (nomor_sesi = 1)
	        kalau ada cek deadline_sesi:
	          kalau belum terlewat atau deadline_sesi = 0, tampilin sesi tersebut
	          kalau sudah terlewat, cek jumlah_sesi:
	            kalau nomor_sesi == jumlah sesi, update akses set status = 3, hapus timer, redirect ke gerbang
	            kalau nomor_sesi < jumlah sesi, cek durasi sesi sampai akhir + istirahatnya
	              kalau kurang dari deadline_soal - sekarang, tampilin istirahat
	              kalau ngga, update timer set nomor_sesi += 1, deadline_sesi = 0, tampilin sesi berikutnya
  */

	function redirect_user() {
		header('Location: user.php');
		exit();
   }

   function redirect_gerbang($code, $sl) {
		if(!is_null($code)) $_SESSION['kacau'] = $code;
		header('Location: gerbang.php?sl='.$sl);
		exit();
   }

  	//cek login
	if(isset($_SESSION['id'])){
    	$id_user = (int) $_SESSION['id'];
    	$id_soal = (int) $_GET['sl'];
    } else {
    	header('Location: tryout.php');
    	exit();
    }

    date_default_timezone_set('Asia/Jakarta');
    $sekarang = date("Y-m-d H:i:s");

    //cek soal
    $query = "SELECT * FROM soal WHERE id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) redirect_user();
    $soal = mysqli_fetch_object($result);
    if($soal->waktu_buka > $sekarang) redirect_gerbang(0, $id_soal);
    else if($soal->waktu_tutup < $sekarang) redirect_gerbang(1, $id_soal);

    //cek akses
    $query = "SELECT status FROM akses WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) redirect_gerbang(0,$id_soal);
    $status = mysqli_fetch_object($result)->status;
    if($status < 2) redirect_gerbang(2,$id_soal);
    else if($status == 3) redirect_gerbang(5,$id_soal);

    //cek timer
    $query = "SELECT * FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1) { //ngga ada timer
    	 $query = "INSERT INTO timer(id_user, id_soal, nomor_sesi) VALUES ($id_user, $id_soal, 1)";
    	 mysqli_query($conn, $query);
    	 if(mysqli_affected_rows($conn) < 1) redirect_gerbang(NULL,$id_soal);
    	 $query = "SELECT * FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
    	 $result = mysqli_query($conn, $query);
    }

    //cek deadline_sesi
    $timer = mysqli_fetch_object($result);
    $deadline_sesi = $timer->deadline_sesi;
    $deadline_soal = $timer->deadline_soal;
    if($deadline_sesi == '0000-00-00 00:00:00' || $deadline_sesi > $sekarang) { $sesi = $timer->nomor_sesi; }

    else {
    	//cek jumlah_sesi
	    $query = "SELECT COUNT(*) AS jumlah_sesi FROM sesi WHERE id_soal = $id_soal";
	    $result = mysqli_query($conn, $query);
	    $jumlah_sesi = mysqli_fetch_object($result)->jumlah_sesi;
	    if($timer->nomor_sesi >= $jumlah_sesi) { //ngga ada sesi lagi
	    	$query = "UPDATE akses SET status = 3 WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	$query = "DELETE FROM timer WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	redirect_gerbang(6,$id_soal);
	    }
	    
	    //cek durasi
	    $query = "SELECT durasi FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = 2";
	    $result = mysqli_query($conn, $query);
	    $durasi = mysqli_fetch_object($result)->durasi;
	    $dur = new DateInterval('PT'.$durasi.'M');
	    $d_so = new DateTime($deadline_soal);
	    $sekarang = new DateTime('now');
	    $mulai_sesi = clone $d_so;
	    $mulai_sesi->sub($dur);

	    if($sekarang < $mulai_sesi) $istirahat = TRUE;
	    else {
	    	$deadline_sesi = $d_so->format('Y-m-d H:i:s');
	    	$query = "UPDATE timer SET nomor_sesi = nomor_sesi + 1, deadline_sesi = '$deadline_sesi' WHERE id_user = $id_user AND id_soal = $id_soal";
	    	mysqli_query($conn, $query);
	    	$sesi = (($timer->nomor_sesi)+1);	
	    }
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

<section class="mbr-section mbr-section-hero mbr-section-full mbr-after-navbar" id="header2-0">
<br><br><br><br><br>
<?php
	if(isset($sesi)) {
?>
	<h2 align="center"> Tryout <?php echo $soal->nama_soal; ?> Online</h2>
	<div class="col-md-8 col-md-offset-2" >
		<div class="well" style="padding: 10px 10px 0px 10px; margin: 10px 0px 20px 0px">
		
					<div>
						<div class="col-md-2 col-md-offset-5">
							<h5 style="" align="center">Sesi  <?php echo $sesi; ?></h5>
						</div>
						
						<div class="col-md-3 col-md-offset-2">
							
						</div>
					</div>
			
				<div class="form-group">
						<br>
						<hr/>
						<!--[ Menampilkan soal ke-1 sampai 10 dari 100 soal tersedia ]<br /-->				
						<div id="countdown"></div>						
							
					<!--SOAL-->
						<form accept-charset="UTF-8" role="form" action="sesi-proses.php" method="POST" class="form-inline" id="formcache">
						<input type="hidden" name="sl" value="<?php echo $id_soal; ?>">
<?php
		$query = "SELECT * FROM sesi WHERE id_soal = $id_soal AND nomor_sesi = $sesi";
		$result = mysqli_query($conn, $query);
		$limit = mysqli_fetch_object($result)->jumlah_pertanyaan;
		$query = "SELECT p.* FROM pertanyaan p, sesi s WHERE id_soal = $id_soal AND nomor_sesi = $sesi AND p.id_sesi = s.id_sesi LIMIT $limit";
		$result = mysqli_query($conn, $query);
		$i = 1;
		while($pertanyaan = mysqli_fetch_object($result)) {
?>
							<div class="well container" style="padding: 10px 10px 10px 10px; margin: 10px 0px 10px 0px">
<?php
			echo $i++.'.&emsp;'.$pertanyaan->isi_pertanyaan;
?><br>
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" value="A" name="<?php echo $pertanyaan->id_pertanyaan;?>"> A&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="B" name="<?php echo $pertanyaan->id_pertanyaan;?>"> B&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="C" name="<?php echo $pertanyaan->id_pertanyaan;?>"> C&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="D" name="<?php echo $pertanyaan->id_pertanyaan;?>"> D&emsp;&emsp;
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="E" name="<?php echo $pertanyaan->id_pertanyaan;?>"> E&emsp;&emsp;
									</label>
								</div>
							</div>
						</div>
<?php
		}
?>	
								<!--SOAL SELESAI-->
							<div class="row">
								<div class="col-md-6">
									  <button type="submit" class="btn btn-primary"  onclick="return confirm('Yakin dengan jawaban anda?');">Kirim</button>
								</div>
							</div>
						</form>
				</div>			
		</div>
	</div>
<?php
	} else {
?>
<h2 align="center"> Tryout <?php echo $soal->nama_soal; ?> Online</h2>
	<div class="col-md-8 col-md-offset-2" >
		<div class="well" style="padding: 10px 10px 0px 10px; margin: 10px 0px 20px 0px">
		
					<div>
						<div class="col-md-2 col-md-offset-5">
							<h5 style="" align="center">ISTIRAHAT</h5>
						</div>
						
						<div class="col-md-3 col-md-offset-2">
							
						</div>
					</div>
			
				<div class="form-group">
						<form accept-charset="UTF-8" role="form" action="sesi-proses.php" method="POST" class="form-inline" id="formcache">
							<input type="hidden" name="sl" value="<?php echo $id_soal; ?>">
						</form>
						<br>
						<hr/>
						<!--[ Menampilkan soal ke-1 sampai 10 dari 100 soal tersedia ]<br /-->				
						<div id="countdown"></div>
				</div>
		</div>
	</div>
<?php } ?>
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
  <script src="assets/formcache/dist/formcache.min.js"></script>
  <script src="assets/jquery.countdown/jquery.countdown.min.js"></script>
  <script>
  	function sqlToJsDate(sqlDate){
	    //sqlDate in SQL DATETIME format ("yyyy-mm-dd hh:mm:ss.ms")
	    var sqlDateArr1 = sqlDate.split("-");
	    //format of sqlDateArr1[] = ['yyyy','mm','dd hh:mm:ms']
	    var sYear = sqlDateArr1[0];
	    var sMonth = (Number(sqlDateArr1[1]) - 1).toString();
	    var sqlDateArr2 = sqlDateArr1[2].split(" ");
	    //format of sqlDateArr2[] = ['dd', 'hh:mm:ss.ms']
	    var sDay = sqlDateArr2[0];
	    var sqlDateArr3 = sqlDateArr2[1].split(":");
	    //format of sqlDateArr3[] = ['hh','mm','ss.ms']
	    var sHour = sqlDateArr3[0];
	    var sMinute = sqlDateArr3[1];
	    var sqlDateArr4 = sqlDateArr3[2].split(".");
	    //format of sqlDateArr4[] = ['ss','ms']
	    var sSecond = sqlDateArr4[0];
	    var sMillisecond = sqlDateArr4[1];
	    
	    return new Date(sYear,sMonth,sDay,sHour,sMinute,sSecond,sMillisecond);
	}
  	$.ajaxSetup({
      type:"post",
      cache:false,
      dataType: "json"
    });
  	$('#formcache').formcache({local: false, maxAge: <?php if(isset($durasi)) echo $durasi*60; else echo 60; ?>});
    var deadline;	
    $.ajax({
        data: {sl: <?php echo $id_soal; ?>},
        url: "timer.php",
        async: false,
        success: function(data){
          console.log(new Date(data['deadline']));
          deadline = new Date(data['deadline']);
        },
        error: function(){
          document.location.reload();
        }
      });
  	$('div#countdown').countdown(deadline).on('update.countdown', function(event) {
	  var format = 'Sisa waktu: %H jam %M menit %S detik';
	  $(this).html(event.strftime(format));
	}).on('finish.countdown', function() {
	  alert('<?php if(isset($sesi)) echo 'Waktu pengerjaan habis.'; else echo 'Waktu istirahat habis. Sesi berikutnya SUDAH dimulai.'; ?>');
	  $(this).html('Sisa waktu: 00 jam 00 menit 00 detik');
	  $('#formcache').submit();
	});
  </script>
  
  
  <input name="animation" type="hidden">
  </body>
</html>