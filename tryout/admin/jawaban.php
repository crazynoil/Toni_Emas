<?php include '_inc/header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Jawaban</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li class="active">Jawaban</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Jawaban Peserta</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tipe Soal</th>
                <th>Jumlah Peserta</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>SBMPTN</td>
                <td>500</td>
                <td>
                  <button class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</button>
                </td>
              </tr>
              <tr>
                <td>SIMAK UI</td>
                <td>200</td>
                <td>
                  <button class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</button>
                </td>
              </tr>
              <tr>
                <td>SIMAK IPB KRS</td>
                <td>10000</td>
                <td>
                  <button class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include '_inc/footer.php'; ?>