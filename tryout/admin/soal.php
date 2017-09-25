<?php include '_inc/header.php'; ?>
<?php
  $result = $connect->query('SELECT s.*, COUNT(a.id_user) AS jumlah_pendaftar FROM soal s LEFT OUTER JOIN akses a ON s.id_soal = a.id_soal GROUP BY s.id_soal');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Soal</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li class="active">Soal</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Soal</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama Soal</th>
                <th>Harga</th>
                <th>Waktu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
              while($data = $result->fetch_object()) {
            ?>
              <tr data-id-soal="<?php echo $data->id_soal; ?>">
                <td><?php echo $data->nama_soal; ?></td>
                <td align="right"><?php echo $data->harga; ?></td>
                <td><?php echo date_create($data->waktu_buka)->format('d/m/Y H:i').' - '.date_create($data->waktu_tutup)->format('d/m/Y H:i'); ?></td>
                <td>
                  <button class="btn btn-sm btn-primary" onclick="edit(this);">Edit</button>
                  <button class="btn btn-sm btn-info" onclick="sesi(this);">Sesi</button>
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

<div class="modal fade" id="edit" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Soal</h4>
                </div>
                <div class="modal-body">
                      <input type="hidden" id="id_soal">
                      <div class="form-group">
                        <label for="waktu">Nama Soal :</label><br />
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="nama_soal">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="waktu">Harga:</label><br />
                        <div class="input-group">
                          <div class="input-group-addon">
                            <small>Rp</small>
                          </div>
                          <input type="text" class="form-control pull-right" id="harga">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="waktu">Waktu:</label><br />
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="waktu" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="waktu_pengumuman">Pengumuman:</label><br />
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="waktu_pengumuman" autocomplete="off">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="waktu">Petunjuk Pembayaran:</label><br />
                          <textarea class="form-control" id="petunjuk_pembayaran"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="waktu">Petunjuk Pengerjaan:</label><br />
                          <textarea class="form-control" id="petunjuk_pengerjaan"></textarea>
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

<div class="modal fade" id="sesi" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Sesi</h4>
                </div>
                <div class="modal-body">
                      <table class="table" id="tabel-sesi">
                      <tr>
                        <th></th>
                        <th>Jumlah Pertanyaan</th>
                        <th>Durasi (menit)</th>
                        <th>Aksi</th>
                      </tr>
                      <tr>
                        <td></td>
                        <td><input type="number" id="jumlah_pertanyaan" value="0" autocomplete="off"></td>
                        <td><input type="text" id="durasi" value="0" autocomplete="off"></td>
                        <td><button class="btn btn-sm btn-success" onclick="tambah();" >Tambah</button></td>
                      </tr>
                      <tr>
                        <th>No.</th>
                        <th>Jumlah Pertanyaan</th>
                        <th>Durasi (menit)</th>
                        <th>Aksi</th>
                      </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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

  var tr, id_soal;

  function edit(pointer) {
    tr = $(pointer).parent().parent();
    id_soal = tr.attr('data-id-soal');
    var obj;
    $.getJSON('_comm/soal.php', {'id_soal': id_soal}, function (data) {
      $('#edit').modal('show');
      $('#nama_soal').val(data['nama_soal']);
      $('#id_soal').val(data['id_soal']);
      $('#harga').val(data['harga']);
      $('#waktu').val(data['waktu_buka']+' - '+data['waktu_tutup']);
      $('#waktu_pengumuman').val(data['hasil_buka']+' - '+data['hasil_tutup']);
      $('#petunjuk_pembayaran').val(data['petunjuk_pembayaran']);
      $('#petunjuk_pengerjaan').val(data['petunjuk_pengerjaan']);
      $('#waktu').daterangepicker({
          "timePicker": true,
          "timePicker24Hour": true,
          "locale": {
              "format": "DD/MM/YYYY HH:mm",
              "separator": " - ",
              "applyLabel": "OK",
              "cancelLabel": "Batal",
              "fromLabel": "Dari",
              "toLabel": "Sampai",
              "customRangeLabel": "Custom",
              "weekLabel": "M",
              "daysOfWeek": [
                  "Min",
                  "Sen",
                  "Sel",
                  "Rab",
                  "Kam",
                  "Jum",
                  "Sab"
              ],
              "monthNames": [
                  "Januari",
                  "Februari",
                  "Maret",
                  "April",
                  "Mei",
                  "Juni",
                  "Juli",
                  "Agustus",
                  "September",
                  "Oktober",
                  "November",
                  "Decsember"
              ],
              "firstDay": 0
          },
          autoUpdateInput: true
      });
      $('#waktu_pengumuman').daterangepicker({
          "timePicker": true,
          "timePicker24Hour": true,
          "locale": {
              "format": "DD/MM/YYYY HH:mm",
              "separator": " - ",
              "applyLabel": "OK",
              "cancelLabel": "Batal",
              "fromLabel": "Dari",
              "toLabel": "Sampai",
              "customRangeLabel": "Custom",
              "weekLabel": "M",
              "daysOfWeek": [
                  "Min",
                  "Sen",
                  "Sel",
                  "Rab",
                  "Kam",
                  "Jum",
                  "Sab"
              ],
              "monthNames": [
                  "Januari",
                  "Februari",
                  "Maret",
                  "April",
                  "Mei",
                  "Juni",
                  "Juli",
                  "Agustus",
                  "September",
                  "Oktober",
                  "November",
                  "Decsember"
              ],
              "firstDay": 0
          },
          autoUpdateInput: true
      });
      /*$('#waktu').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY HH:mm'));
      });*/
    });
  }

  function simpan() {
    var data = {'id_soal' : id_soal, 'nama_soal' : $('#nama_soal').val(), 'harga' : $('#harga').val(), 'waktu_pengumuman' : $('#waktu_pengumuman').val(), 'waktu' : $('#waktu').val(), 'petunjuk_pembayaran' : $('#petunjuk_pembayaran').val(), 'petunjuk_pengerjaan' : $('#petunjuk_pengerjaan').val()};
    $.ajax({
        'data': data,
        url: "_comm/edit_soal.php",
        success: function(){
          alert('berhasil');
          location.reload();
        },
        error: function(){
          alert('gagal');
        }
      });
  }

  function sesi(pointer) {
    tr = $(pointer).parent().parent();
    id_soal = tr.attr('data-id-soal');
    var obj;
    $.getJSON('_comm/sesi.php', {'id_soal': id_soal}, function (data) {
      $('#sesi').modal('show');
      $('#id_soal').val(data['id_soal']);
       for(var i in data['sesi']) {
        $('#tabel-sesi').append('<tr><td>'+data['sesi'][i]['nomor_sesi']+'</td><td><input type="number" class="jumlah_pertanyaan" value="'+data['sesi'][i]['jumlah_pertanyaan']+'" /></td><td><input type="text" class="durasi" value="'+data['sesi'][i]['durasi']+'" /></td><td><button class="btn btn-sm btn-primary" onclick="ubah(this);">Ubah</button>');
       }
       $('#tabel-sesi tr:last td:last').append(' <button class="btn btn-sm btn-danger" onclick="hapus();" >Hapus</button></td></tr>');
    });
    $('#sesi').on('hidden.bs.modal', function () {
      $('#tabel-sesi tr').slice(3).remove();
    });
  }

  function tambah() {
    var jumlah_pertanyaan = $('#jumlah_pertanyaan').val();
    var durasi = $('#durasi').val();
    var data = {'id_soal': id_soal, 'jumlah_pertanyaan': jumlah_pertanyaan, 'durasi': durasi};
     $.ajax({
        'data': data,
        url: "_comm/tambah_sesi.php",
        success: function(){
          alert('berhasil');
          data['nomor_sesi'] = Number($('#tabel-sesi tr:last td:first').text());
          $('#tabel-sesi tr:last td:last button:last').remove();
          $('#tabel-sesi').append('<tr><td>'+(data['nomor_sesi']+1)+'</td><td><input type="number" class="jumlah_pertanyaan" value="'+data['jumlah_pertanyaan']+'" /></td><td><input type="text" class="durasi" value="'+data['durasi']+'" /></td><td><button class="btn btn-sm btn-primary" onclick="ubah(this);">Ubah</button> <button class="btn btn-sm btn-danger" onclick="hapus();" >Hapus</button></td></tr>');
        },
        error: function(){
          alert('gagal');
        }
      });
  }

  function ubah(pointer) {
    var tr = $(pointer).parent().parent();
    var nomor_sesi = tr.children().eq(0).text();
    var jumlah_pertanyaan = $('.jumlah_pertanyaan', tr).val();
    var durasi = $('.durasi', tr).clone().val();

    $.ajax({
        data: {'id_soal': id_soal, 'nomor_sesi' : nomor_sesi, 'jumlah_pertanyaan': jumlah_pertanyaan, 'durasi': durasi},
        url: "_comm/edit_sesi.php",
        success: function(){
          alert('berhasil');
        },
        error: function(){
          alert('gagal');
        }
      });
  }

  function hapus() {
    var tr = $('#tabel-sesi tr:last');
    var nomor_sesi = tr.children(':first').text();
    if(confirm('Semua pertanyaan sesi ini akan dihapus. Anda yakin?')) {
      $.ajax({
        data: {'id_soal': id_soal, 'nomor_sesi' : nomor_sesi},
        url: "_comm/hapus_sesi.php",
        success: function(){
          alert('berhasil');
          tr.remove();
          $('#tabel-sesi tr:last td:last').append(' <button class="btn btn-sm btn-danger" onclick="hapus();" >Hapus</button></td></tr>');
        },
        error: function(){
          alert('gagal');
        }
      });
    }

  }
</script>

<?php include '_inc/footer.php'; ?>