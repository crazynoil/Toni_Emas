	<div class="col-md-4 col-md-offset-4" >
		<div class="well well-lg" style="background-color: blue; padding-top: 10px; padding-bottom: 0px; padding-left: 10px; padding-right: 10px;">
			
				<div class="form-group">
					<h5 style="color:" align="center">Langkah-langkah Pembayaran</h5><hr />
<?php
$query1 = mysqli_query($conn, "select * from soal where id_soal = $id_soal");
$fetch = mysqli_fetch_object($query1);
$petunjuk_pembayaran = $fetch->petunjuk_pembayaran;
?>					
                                        <p style="color:" align="justify">
<?php echo $petunjuk_pembayaran?>
					</p>

					<form accept-charset="UTF-8" role="form" action="upload-bukti.php?sl=<?php echo $id_soal;?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
								<img id="output" src="#" class="img-thumbnail" alt="Foto bukti pembayaran" width="400" height="170" >
					    <script>
							var loadFile = function(event) {
							var output = document.getElementById('output');
							 output.src = URL.createObjectURL(event.target.files[0]);
							};
						</script>	
							<br>
							<h6 style="color:"	>Upload Bukti Transfer</h6>
							<input type="file" name="bukti" id="bukti" onChange='loadFile(event)'><br>
							<input class="btn btn-success btn-lg" type="submit" value="Kirim">
						</div>
					</form>
				</div>
			
		</div>
	</div>