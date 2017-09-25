<?php include '_inc/header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dasbor</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li class="active">Dasbor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div id="clock"></div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
<?php 
$query = mysqli_query($connect, "select * from user");
$fetch = mysqli_fetch_row($query);
$jumlah_pengguna = mysqli_num_rows($query);
?>
              <h3><?php echo $jumlah_pengguna; ?></h3>

              <p>Total Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="pengguna.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->	
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  /*$('div#clock').countdown('2017/02/05 01:00:00', function(event) {
    $(this).html(event.strftime('%D %H:%M:%S'));
  });
  function serverTime() {
    var date = new Date('2017-02-05T01:00:00+07:00');
    console.log(date);
    return date;
  }
  //console.log(date);
  $("div#clock").countdown({
    until: new Date('2017-02-05T01:10:00+07:00'),
    format:"dHMS",
    serverSync: serverTime
  });*/
  </script>
<?php include '_inc/footer.php'; ?>