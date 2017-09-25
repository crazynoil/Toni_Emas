<div class="col-md-12" >
		<div class="col-md-4 col-md-offset-2">
				<div class="well" style="background-color: blue; padding-top: 10px; padding-bottom: 10px; padding-left: 10px; padding-right: 10px; margin: 0px 0px 10px 0px;">
					<h5 style="color:" align="center">Petunjuk Pengerjaan Tryout</h5><hr />
					<p style="color:" align="justify">
					<?php echo $b['petunjuk_pengerjaan']; ?>
<?php
	$k = mysqli_query($conn, "select * from akses where id_soal = '$id_soal' AND id_user = '$id_user'");
	$l = mysqli_fetch_object($k);
	
	if(($l->id_soal == 1 || $l->id_soal == 2 || $l->id_soal == 6 || $l->id_soal == 7 || $l->id_soal == 8) && $l->data1==NULL){?>
		4. Isi form pilihan jurusan yang dipilih<br>
<?php	}
?>
					</p>
<?php
	if(($l->id_soal == 1 || $l->id_soal == 2) && $l->data1==NULL){?>
					<form action="univ-proses.php?sl=<?php echo $id_soal?>" method="POST" charset="UTF-8" class="form-horizontal">
						<fieldset>
							<div class="form-group" align="center">
								<label class="col-md-12 control-label">Pilihan Pertama</label>
								<div class="col-md-5">
									<select name="ptn" class="form-control" id="ptn" required>
<?php
  $query = 'SELECT * FROM ptn';
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_ptn; ?>"><?php echo $data->nama_ptn; ?></option>
<?php
  }
?>
									</select>
								</div>
								<div class="col-md-5">
									<select name="jurusan" class="form-control" id="jurusan" required>
<?php
  $query = "SELECT * FROM jurusan where substr(id_jurusan,-1)=$id_soal";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
                                    <select id="jurusan2"></select>
								</div>
								<label class="col-md-12 control-label">Pilihan Kedua</label>
								<div class="col-md-5">
									<select name="ptno" class="form-control" id="ptno" required>
<?php
  $query = 'SELECT * FROM ptn';
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_ptn; ?>"><?php echo $data->nama_ptn; ?></option>
<?php
  }
?>
									</select>
								</div>
								<div class="col-md-5">
									<select name="jurusano" class="form-control" id="jurusano" required>
<?php
  $query = "SELECT * FROM jurusan where substr(id_jurusan,-1)=$id_soal";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
                                    <select id="jurusano2"></select>
								</div>
								<label class="col-md-12 control-label">Pilihan Ketiga</label>
								<div class="col-md-5">
									<select name="ptni" class="form-control" id="ptni" required>
<?php
  $query = 'SELECT * FROM ptn';
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_ptn; ?>"><?php echo $data->nama_ptn; ?></option>
<?php
  }
?>
									</select>
								</div>
								<div class="col-md-5">
									<select name="jurusani" class="form-control" id="jurusani" required>
<?php
  $query = "SELECT * FROM jurusan where substr(id_jurusan,-1)=$id_soal";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
                                    <select id="jurusani2"></select>
								</div>
								
								<div class="col-md-5 form-group" align="center"><br>
									<input type="submit" value="Kirim" class="btn btn-primary btn-lg">
								</div>
							</div>
						</fieldset>
					</form>
<?php		
	}     //Selesai pilihan untuk SBMPTN
?>

<?php    //Mulai pilihan untuk UTM IPB, dll
	if(($l->id_soal == 6 || $l->id_soal == 7 || $l->id_soal == 8) && $l->data1==NULL){?>
					<form action="univ-proses.php?sl=<?php echo $id_soal?>" method="POST" charset="UTF-8" class="form-horizontal">
						<fieldset>
							 <div class="form-group" align="center">
								<label class="col-md-12 control-label">Pilihan Pertama</label>
								<div class="col-md-12">
									<select name="jurusan" class="form-control" id="" required>
<?php
if($l->id_soal==6){
	$koi = 47;
}
if($l->id_soal==7){
	$koi = 31;
}
else{
	$koi = 33;
}

  $query = "SELECT * FROM jurusan where substr(id_jurusan,1,2)='$koi'";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
								</div>				
								<label class="col-md-12 control-label">Pilihan Kedua</label>
								<div class="col-md-12">
									<select name="jurusano" class="form-control" id="" required>
<?php
  $query = "SELECT * FROM jurusan where substr(id_jurusan,1,2)='$koi'";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
								</div>
								<label class="col-md-12 control-label">Pilihan Ketiga</label>
								<div class="col-md-12">
									<select name="jurusani" class="form-control" id="" required>
<?php
  $query = "SELECT * FROM jurusan where substr(id_jurusan,1,2)='$koi'";
  $result = mysqli_query($conn, $query);
  while($data = mysqli_fetch_object($result)) {
?>
  <option value="<?php echo $data->id_jurusan; ?>"><?php echo $data->nama_jurusan; ?></option>
<?php
  }
?>
									</select>
								</div>
								
								<div class="col-md-5 form-group" align="center"><br>
									<input type="submit" value="Kirim" class="btn btn-primary btn-lg">
								</div>
							</div>
						</fieldset>
					</form>
<?php		
	}
?>											
				</div>
		</div>
		<div class="col-md-4">
				<div class="well" style="background-color: blue; padding-top: 10px; padding-bottom: 0px; padding-left: 10px; padding-right: 10px; margin: 0px 0px 20px 0px;">
					<h5 style="color:" align="center">Pelaksanaan Tryout</h5><hr />
<?php
$buka = $b['waktu_buka'];
$tutup = $b['waktu_tutup'];
$pengumuman_buka = $b['hasil_buka'];
$pengumuman_tutup = $b['hasil_tutup'];

function indonesian_date ($timestamp, $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}
//Mengatur Durasi Waktu
$query_durasi = mysqli_query($conn, "select * from sesi where id_soal = $id_soal");
$jumlah_durasi=0;
while($data = mysqli_fetch_object($query_durasi)){
	$ubah = $data->durasi;
	$jumlah_durasi = $jumlah_durasi + $ubah;
}
$jumlah_sesi = mysqli_num_rows($query_durasi);
$jumlah_durasi = $jumlah_durasi + ($jumlah_sesi - 1)*10; 
?>
					<p style="color:" align="justify">
					Tryout <?php echo $b['nama_soal'];?> Online Emas Private Institute insyaAllah akan :
						<ul>
							<li>Dibuka  : <?php echo indonesian_date($buka);?></li>
							<li>Ditutup : <?php echo indonesian_date($tutup);?></li>
							<li>Durasi pengerjaan : <?php echo $jumlah_durasi?> menit</li>
						</ul>
					</p>
					<p style="color:" align="justify">
					Pengumuman hasil Tryout <?php echo $b['nama_soal'];?> insyaAllah akan :
						<ul>
							<li>Dibuka  : <?php echo indonesian_date($pengumuman_buka);?></li>
							<li>Ditutup : <?php echo indonesian_date($pengumuman_tutup);?></li>
						</ul>
					</p>
											
					<div class="form-group" align="center">
						<?php if($kok != 3) { ?><a href="sesi.php?sl=<?php echo $id_soal; ?>" onclick="return confirm('Timer akan dimulai begitu anda masuk. Pastikan koneksi internet lancar. Anda yakin?');" class="btn btn-primary btn-lg">Mulai</a><?php } ?>
						<a href="cekhasil.php?sl=<?php echo $id_soal; ?>" class="btn btn-success btn-lg">Cek Hasil</a>
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
</div>