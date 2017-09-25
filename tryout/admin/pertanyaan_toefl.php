<?php include '_inc/header.php'; ?>
<?php
  $result = $connect->query('SELECT p.*,s.nomor_sesi FROM pertanyaan p, sesi s WHERE s.id_soal = 3 AND s.id_sesi = p.id_sesi');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>SBMPTN Sainstek</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li>Pertanyaan</li>
        <li class="active">SBMPTN Sainstek</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Pertanyaan</h3>
          &emsp;<button class="btn btn-sm btn-success" onclick="tambah();">Tambah</button>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered" id="dataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Pertanyaan</th>
                <th class="hidden">Isi Pertanyaan</th>
                <th>Kunci Jawaban</th>
                <th>Sesi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while($data = $result->fetch_object()) {
            ?>
              <tr>
                <td><?php echo $data->id_pertanyaan; ?></td>
                <td><?php echo $data->nama_pertanyaan; ?></td>
                <td class="hidden"><textarea><?php echo $data->isi_pertanyaan; ?></textarea></td>
                <td><?php echo $data->kunci_jawaban; ?></td>
                <td data-id-sesi="<?php echo $data->id_sesi; ?>"><?php echo $data->nomor_sesi; ?></td>
                <td>
                  <button class="btn btn-sm btn-primary" onclick="edit(this);">Edit</button>
                  <button class="btn btn-sm btn-danger" onclick="hapus(this);">Hapus</button>
                </td>
              </tr>
            <?php
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="pertanyaan" role="dialog">
            <div class="modal-dialog" style="width:90%">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Soal</h4>
                </div>
                <div class="modal-body">
                      <input type="hidden" id="id_pertanyaan">
                      <div class="form-group col-md-8">
                        <label for="nama_pertanyaan">Nama Pertanyaan:</label><br />
                          <input type="text" class="form-control" id="nama_pertanyaan" autocomplete="off" maxlength="64">
                      </div>
                      <div class="form-group col-md-2">
                        <label for="id_sesi">Sesi:</label><br />
                        <div class="input-group col-md-8">
                          <div class="input-group-addon">
                            <i class="fa fa-hourglass-2"></i>
                          </div>
                          <select class="form-control pull-right" id="id_sesi" autocomplete="off" required>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="kunci_jawaban">Kunci Jawaban:</label><br />
                        <div class="input-group col-md-8">
                          <div class="input-group-addon">
                            <i class="fa fa-key"></i>
                          </div>
                          <select class="form-control pull-right" id="kunci_jawaban" autocomplete="off">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="isi_pertanyaan">Isi Pertanyaan (+Opsi):</label><br />
                          <textarea class="form-control" id="isi_pertanyaan" autocomplete="off"></textarea>
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

  var tr, id_pertanyaan, sesi;

  $.getJSON('_comm/sesi.php', {'id_soal': 3}, function (data) {
    for(var i in data['sesi']) {
      $('#id_sesi').append('<option value="'+data['sesi'][i]['id_sesi']+'">'+data['sesi'][i]['nomor_sesi']+'</option>');
    }
  });

  $('#dataTable').DataTable({
      "columnDefs": [
        {
           "searchable": false,
           "orderable": false,
           "targets": -1
        }],
      "order": [[ 4, 'asc' ],[0, 'asc']],
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

  function sendFile(file) {
            data = new FormData();
            data.append('id_pertanyaan',id_pertanyaan);
            data.append('file', file);
            $.ajax({
                data: data,
                type: "POST",
                url: "_comm/upload.php",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = $('<img>').attr('src', url);
                    $('#isi_pertanyaan').summernote("insertNode", image[0]).attr('class', 'responsive');
                },
                error: function(data) {
                  alert(error);
                  console.log(data);
                }
            });
  }

  function edit(pointer) {
    tr = $(pointer).parent().parent();
    id_pertanyaan = Number($('td:first', tr).text());
    $('#id_pertanyaan').val(id_pertanyaan);
    $('#nama_pertanyaan').val(tr.children().eq(1).text());
    $('#kunci_jawaban').val(tr.children().eq(3).text()).change();
    $('#id_sesi').val(tr.children().eq(4).attr('data-id-sesi')).change();
    $('#isi_pertanyaan').summernote({
            height: 200,
            callbacks: {
              onImageUpload: function(files) {
                sendFile(files[0]);
              }
            }
        });
    $('#isi_pertanyaan').summernote('code', tr.children().eq(2).text());
    $('#pertanyaan').modal('show');
    $("button.close-summernote-modal").click(function(){
      $('.summernote-modal').modal('hide');
    });
  }

  function simpan() {
    if($('#id_pertanyaan').val()) {
      var data = {
        id_pertanyaan: id_pertanyaan,
        id_sesi:  $('#id_sesi').val(),
        kunci_jawaban:  $('#kunci_jawaban').val(),
        nama_pertanyaan:  $('#nama_pertanyaan').val(),
        isi_pertanyaan:  $('#isi_pertanyaan').val()
      };
      $.ajax({
          data: data,
          url: "_comm/edit_pertanyaan.php",
          success: function(){
            alert('berhasil');
            location.reload();
          },
          error: function(){
            alert('error');
          }
        });
      id_pertanyaan = null;
    }
    else {
      var data = {
        id_sesi:  $('#id_sesi').val(),
        kunci_jawaban:  $('#kunci_jawaban').val(),
        nama_pertanyaan:  $('#nama_pertanyaan').val(),
        isi_pertanyaan:  $('#isi_pertanyaan').val()
      };
      $.ajax({
          data: data,
          url: "_comm/tambah_pertanyaan.php",
          success: function(){
            alert('berhasil');
            location.reload();
          },
          error: function(){
            alert('gagal');
          }
        });
    }
  }

  function tambah() {
    $('#id_pertanyaan').val('');
    $('#nama_pertanyaan').val('');
    $('#kunci_jawaban').val('A').change();
    $('#id_sesi').val($('#id_sesi option:first').val()).change();
    $('#isi_pertanyaan').summernote('code','');
    $('#pertanyaan').modal('show');
    $("button.close-summernote-modal").click(function(){
      $('.summernote-modal').modal('hide');
    });
  }

  function hapus(pointer) {
    tr = $(pointer).parent().parent();
    id_pertanyaan = Number($('td:first', tr).text());
    if(confirm('Anda yakin?')) {
      $.ajax({
          data: {id_pertanyaan: id_pertanyaan},
          url: "_comm/hapus_pertanyaan.php",
          success: function(){
            alert('berhasil');
            location.reload();
          },
          error: function(){
            alert('gagal');
          }
      });
    }
  }

</script>

<?php include '_inc/footer.php'; ?>