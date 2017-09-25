<?php include '_inc/header.php'; ?>
<?php
    $id_soal = (int) $_GET['id'];
    $nama_soal = $connect->query("SELECT nama_soal FROM soal WHERE id_soal = $id_soal")->fetch_object()->nama_soal;
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Hasil Tryout</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li>Hasil</li>
        <li class="active"><?php echo $nama_soal; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $nama_soal; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="dataTable" style="white-space: nowrap;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
        				<th>Jumlah Pertanyaan</th>
                <th>Dikerjakan</th>
        				<th>Benar</th>
        				<th>Salah</th>
        				<th>Kosong</th>
                <th>Nilai Total</th>
                <th>Kelulusan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
      			$result = $connect->query("SELECT *, jumlah_pertanyaan - (jumlah_benar + jumlah_salah) AS jumlah_kosong, (jumlah_benar + jumlah_salah) AS jumlah_dikerjakan, (jumlah_benar*4 - jumlah_salah*1) AS nilai_total FROM hasil WHERE id_soal = $id_soal");
      			$nomor = 1;
            while($data = $result->fetch_object()) {
            ?>
              <tr data-id-user="<?php echo $data->id_user; ?>" data-id-soal="<?php echo $data->id_soal; ?>" data-jenis-soal="<?php echo $data->jenis_soal; ?>">
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data->nama_lengkap; ?></td>
        				<td><?php echo $data->jumlah_pertanyaan; ?></td>
                <td><?php echo $data->jumlah_dikerjakan; ?></td>
        				<td><?php echo $data->jumlah_benar; ?></td>
        				<td><?php echo $data->jumlah_salah; ?></td>
        				<td><?php echo $data->jumlah_kosong; ?></td>
                <td><?php echo $data->nilai_total; ?></td>
                <td><?php echo $data->kelulusan; ?></td>
                <td>
                  <button class="btn btn-sm btn-primary edit" onclick="edit(this);">Edit</button>
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
  
<div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Kelulusan</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" id="id_soal">
                  <input type="hidden" id="id_user">
									<div class="form-group" id="kelulusan">
									  
									</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" onclick="simpan();">Simpan</button>
                </div>
              </div>
              
            </div>
          </div>
</div>

<script>
  $.ajaxSetup({
      type:"post",
      cache:false,
    });

    var myTable = $('#dataTable').DataTable({
      "columnDefs": [
        {
           "searchable": false,
           "orderable": false,
           "targets": [0,-1]
        }],
      "order": [[ 1, 'asc' ]],
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
    myTable.on( 'order.dt search.dt', function () {
        myTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

  var tr, id_user, id_soal;

  function edit(pointer) {
    tr = $(pointer).parent().parent();
    $('#edit').modal('show');
    id_user = tr.attr('data-id-user');
    id_soal = tr.attr('data-id-soal');
    jenis_soal = tr.attr('data-jenis-soal');
    var obj;
    $.getJSON('_comm/kelulusan.php', {'id_user': id_user, 'id_soal': id_soal}, function (data) {
      $('#edit').modal('show');
      if(jenis_soal == 1) {
        $('#kelulusan').append('<label>Hasil Tryout:</label><br><select name="kelulusan"></select>');
        $('#kelulusan > select').append('<option value="0">Tidak Lolos</option>');
        for(var i in data['hasil']['pilihan']) {
           $('#kelulusan > select').append('<option value="'+i+'">'+data['hasil']['pilihan'][i]+'</option>');
        }
        if(data['hasil']['kelulusan'] != null) $('#kelulusan > select').val(data['hasil']['kelulusan']).change();
      }
      else if(jenis_soal == 2)
        $('#kelulusan').append('<label>Nilai Akhir:</label><br><input type="number" name="kelulusan" value="'+ data['hasil']['kelulusan'] +'">');
      else {
        $('#kelulusan').append('<label>Hasil Tryout:</label><br><select name="kelulusan"></select>');
        $('#kelulusan > select').append('<option value="0">Tidak Lolos</option>');
        $('#kelulusan > select').append('<option value="1">Lolos</option>');
        if(data['hasil']['kelulusan'] != null) $('#kelulusan > select').val(data['hasil']['kelulusan']).change();
      }
    });
    $('#edit').on('hidden.bs.modal', function () {
      $('#kelulusan').html('');
    });
  }

  function simpan() {
    var kelulusan = $('[name=kelulusan]').val();
    var data = {'id_user': id_user, 'id_soal': id_soal, 'kelulusan': kelulusan};
    $.ajax({
        'data': data,
        url: "_comm/edit_kelulusan.php",
        success: function(){
          alert('berhasil');
          $(':nth-child(9)', tr).html(kelulusan);
          $('#edit').modal('hide');
        },
        error: function(){
          alert('gagal');
        }
      });
  }
</script>
<?php include '_inc/footer.php'; ?>