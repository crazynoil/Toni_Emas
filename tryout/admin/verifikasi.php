<?php include '_inc/header.php'; ?>
<?php
    $result = $connect->query('SELECT a.id_user, a.id_soal, nama_lengkap, nama_soal, harga, waktu_kirim, status, bukti FROM akses a, user u, soal s WHERE a.id_user = u.id_user AND a.id_soal = s.id_soal');
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Verifikasi</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li class="active">Verifikasi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Verifikasi Pembayaran</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>Nama Lengkap</th>
                <th>Tipe Soal</th>
                <th>Harga Soal</th>
                <th>Waktu Kirim</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status = array(
                              '<span class="label label-warning">Belum Lunas</span>',
                              '<span class="label label-info">Menunggu Verifikasi</span>',
                              '<span class="label label-success">Sudah Lunas</span>',
                              '<span class="label label-primary">Sudah mengerjakan</span>'
                          );
            $aksi = array(
                              '<button class="btn btn-sm btn-success sudah" onclick="sudahLunas(this);">Sudah Lunas</button>',
                              '<button class="btn btn-sm btn-success sudah" onclick="sudahLunas(this);">Sudah Lunas</button> <button class="btn btn-sm btn-warning belum" onclick="belumLunas(this);">Belum Lunas</button>',
                              '<button class="btn btn-sm btn-warning belum" onclick="belumLunas(this);">Belum Lunas</button>',''
                          );
            while($data = $result->fetch_object()) {
            ?>
              <tr data-id-user="<?php echo $data->id_user.'" data-id-soal="'.$data->id_soal; ?>">
                <td><?php echo $data->nama_lengkap; ?></td>
                <td><?php echo $data->nama_soal; ?></td>
                <td><?php echo $data->harga; ?></td>
                <td><?php echo $data->waktu_kirim; ?></td>
                <td><?php echo $status[$data->status]; ?></td>
                <td>
                  <?php if(!empty($data->bukti)) echo '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" onclick="lihatBukti(\''.$data->bukti.'\')">Lihat Bukti</button> ';?>
                  <?php echo $aksi[$data->status]; ?>
                  <button class="btn btn-sm btn-danger hapus" onclick="hapus(this);">Hapus</button>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <!--<div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">&raquo;</a></li>
          </ul>
        </div>-->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" style="width: 90%; height: 100%;">
            
              <!-- Modal content-->
              <div class="modal-content" style="height: 90%; border-radius: 0;">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Bukti</h4>
                </div>
                <div class="modal-body" style="height: 75%">
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
              </div>
              
            </div>
          </div>
</div>

<script>
    var myTable = $('#dataTable').DataTable({
      "columnDefs": [
        {
           "searchable": false,
           "orderable": false,
           "targets": -1
        }],
      "order": [[ 3, 'desc' ]],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
       "sProcessing":   "Sedang proses...",
       "sLengthMenu":   "_MENU_ entri per halaman",
       "sZeroRecords":  "Data tidak ditemukan",
       "sInfo":         "Menampilkan _START_&ndash;_END_ dari _TOTAL_ entri",
       "sInfoEmpty":    "Menampilkan 0&ndash;0 dari 0 entri",
       "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
       "sInfoPostFix":  "",
       "sSearch":       "Cari:",
       "sUrl":          "",
       "oPaginate": {
           "sFirst":    "&laquo;",
           "sPrevious": "&lt;",
           "sNext":     "&gt;",
           "sLast":     "&raquo;"
      }
    },
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]]
    });

  var st = [
    '<span class="label label-warning">Belum Lunas</span>',
    '<span class="label label-info">Menunggu Verifikasi</span>',
    '<span class="label label-success">Sudah Lunas</span>'
  ];
  var ak = [
    '<button class="btn btn-sm btn-success sudah" onclick="sudahLunas(this);">Sudah Lunas</button>',
    '<button class="btn btn-sm btn-success sudah" onclick="sudahLunas(this);">Sudah Lunas</button> <button class="btn btn-sm btn-warning belum" onclick="belumLunas(this);">Belum Lunas</button>',
    '<button class="btn btn-sm btn-warning belum" onclick="belumLunas(this);">Belum Lunas</button>'
  ];
  $.ajaxSetup({
      type:"post",
      cache:false,
    });
  function sudahLunas(pointer){
    var tr = $(pointer).parent().parent();
    var id_u = tr.attr('data-id-user');
    var id_s = tr.attr('data-id-soal');
    var button = pointer;
    $.ajax({
        data: {id_user: id_u, id_soal: id_s, status: 2},
        url: "_comm/edit_status.php",
        success: function(){
          alert('berhasil');
          $(button).parent().prev().html(st[2]);
          if($(button).next().next().length) {$(button).remove()}
          else $(button).replaceWith(ak[2]);
        myTable.row(tr).invalidate();
        },
        error: function(){
          alert('gagal');
        }
      });
   }
  function belumLunas(pointer){
    var tr = $(pointer).parent().parent();
    var id_u = tr.attr('data-id-user');
    var id_s = tr.attr('data-id-soal');
    var button = pointer;
    $.ajax({
        data: {id_user: id_u, id_soal: id_s, status: 0},
        url: "_comm/edit_status.php",
        success: function(){
          alert('berhasil');
          $(button).parent().prev().html(st[0]);
          if($(button).prev('.sudah').length) {$(button).remove()}
          else $(button).replaceWith(ak[0]);
          myTable.row(tr).invalidate();
        },
        error: function(){
          alert('gagal');
        }
      });
   }
   function hapus(pointer){
    var tr = $(pointer).parent().parent();
    var id_u = tr.attr('data-id-user');
    var id_s = tr.attr('data-id-soal');
    var button = pointer;
    if(confirm('Anda yakin?')) {
      $.ajax({
          data: {id_user: id_u, id_soal: id_s},
          url: "_comm/hapus_status.php",
          success: function(){
            alert('berhasil');
            myTable.row(tr).remove().draw();
          },
          error: function(){
            alert('gagal');
          }
        });
    }
  }
  function lihatBukti(bukti) {
      $('#myModal .modal-body').html('<img style="width: auto; max-height: 100%; display: block; margin: auto" src="../../'+bukti+'"/>');
  }

</script>
<?php include '_inc/footer.php'; ?>