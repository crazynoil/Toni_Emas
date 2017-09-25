<?php include '_inc/header.php'; ?>
<?php
    $result = $connect->query('SELECT u.*, p.nama AS nama_provinsi, k.nama AS nama_kota FROM user u, wilayah_provinsi p, wilayah_kota k WHERE asal_provinsi = p.id AND asal_kota = k.id');
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pengguna</h1>
      <ol class="breadcrumb">
        <li><a href="../tryout.php"><i class="fa fa-dashboard"></i> Try Out</a></li>
        <li><a href="index.php">Admin</a></li>
        <li class="active">Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Daftar Pengguna</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="dataTable" style="white-space: nowrap;">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Asal Sekolah</th>
                <th>Asal Provinsi</th>
                <th>Asal Kota</th>
                <th>ID Line</th>
                <th>ID Instagram</th>
                <th>Username</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            while($data = $result->fetch_object()) {
            ?>
              <tr data-id-user="<?php echo $data->id_user; ?>" data-id-provinsi="<?php echo $data->asal_provinsi; ?>" data-id-kota="<?php echo $data->asal_kota; ?>">
                <td></td>
                <td><?php echo $data->nama_lengkap; ?></td>
                <td><?php echo $data->nomor_hp; ?></td>
                <td><?php echo $data->email; ?></td>
                <td><?php echo $data->asal_sekolah; ?></td>
                <td><?php echo $data->nama_provinsi; ?></td>
                <td><?php echo $data->nama_kota; ?></td>
                <td><?php echo $data->id_line; ?></td>
                <td><?php echo $data->id_instagram; ?></td>
                <td><?php echo $data->username; ?></td>
                <td>
                  <button class="btn btn-sm btn-primary edit" onclick="edit(this);">Edit Data</button>
                  <button class="btn btn-sm btn-success simpan" onclick="simpan();">Simpan</button>
                  <button class="btn btn-sm btn-danger batal" onclick="batal();">Batal</button>
                  <button class="btn btn-sm btn-warning password" onclick="password(this)">Password</button>
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

<div class="modal fade" id="modal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Ganti Password</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_user" value="" />
                    <label for="password_baru">Password Baru:</label><br />
                    <input type="password" id="password_baru" value=""/>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" onclick="ganti();">Ganti</button>
                </div>
              </div>
              
            </div>
          </div>
</div>

<select id="provinsi">
  <?php
    $result =$connect->query('SELECT * FROM wilayah_provinsi');
    while ($data = $result->fetch_object()) {
  ?>
  <option value="<?php echo $data->id ?>"><?php echo $data->nama ?></option>
  <?php } ?>
</select>

<select id="kota">
  <?php
    $result =$connect->query('SELECT * FROM wilayah_kota');
    while ($data = $result->fetch_object()) {
  ?>
  <option value="<?php echo $data->id ?>"><?php echo $data->nama ?></option>
  <?php } ?>
</select>

<select id="kota2"></select>

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

  var tr, id_user, row, inputs;
  function td(n) { return tr.children(':nth-child('+(n+1)+')'); }
  function inputText(id, value, maxlength) {return '<input type="text" id="'+id+'" value="'+value+'" maxlength="'+ maxlength +'" />';}
  $('.simpan, .batal').hide();

  $('#kota2, #provinsi, #kota').hide();

  function edit(pointer){
    tr = $(pointer).parent().parent();
    id_user = tr.attr('data-id-user'); 
    row = $('td', tr).map(function(index, td) {
        return $(td).text();
    });
    td(1).html(inputText('nama_lengkap', row[1], 64));
    td(2).html(inputText('nomor_hp', row[2], 13));
    td(3).html(inputText('email', row[3], 128));
    td(4).html(inputText('asal_sekolah', row[4], 32));
    td(5).html($('#provinsi').clone().show().prop('id', 'asal_provinsi').prop('outerHTML'));
    td(6).html($('#kota').clone().show().prop('id', 'asal_kota').prop('outerHTML'));

      $('#asal_kota > option').clone().appendTo('#kota2');

      $('#asal_kota > option').remove();
      $('#asal_provinsi').val(tr.attr('data-id-provinsi')).change();
      $('#kota2 > option[value^='+$('#asal_provinsi').val()+']').clone().appendTo('#asal_kota');
      $('#asal_kota').val(tr.attr('data-id-kota')).change();

      $("#asal_provinsi").change(function() {
        $('#asal_kota > option').remove();
        $('#kota2 > option[value^='+$(this).val()+']').clone().appendTo('#asal_kota');
      });

    td(7).html(inputText('id_line', row[7], 32));
    td(8).html(inputText('id_instagram', row[8], 32));
    td(9).html(inputText('username', row[9], 16));
    $('.edit, .password').hide();
    $('.simpan, .batal', tr).show();
  }
  
  function batal(){
    for(i=1; i<=9; i++) td(i).html(row[i]);
    $('.edit, .password').show();
    $('.simpan, .batal', tr).hide();
  }

  function simpan() {
    inputs = $("input, select", tr);
    var obj = {}
    inputs.each(function(){
      var key= $(this).attr('id');
      var value= $(this).val();
      obj[key] = value;
    });

    obj['id_user'] = id_user;
    
    //console.log(obj);
    
    $.ajax({
        data: obj,
        url: "_comm/edit_pengguna.php",
        success: function(){
          alert('berhasil');
          for(i=1; i<=9; i++) td(i).html((i==5 || i==6) ? $('option:selected', inputs.eq(i-1)).text() : inputs.eq(i-1).val());
          $('.edit, .password').show();
          $('.simpan, .batal', tr).hide();
          tr.attr('data-id-provinsi',inputs.eq(4).val());
          tr.attr('data-id-kota',inputs.eq(5).val());
          myTable.row(tr).invalidate();
        },
        error: function(){
          alert('gagal');
          batal();
        }
      });
  }

  function password(pointer) {
    $('#modal').modal('show');
    $('#password_baru').val('');
    $('#password_baru').hideShowPassword(false, true);
    $('#id_user').val($(pointer).parent().parent().attr('data-id-user'));
  }

  function ganti() {
    $.ajax({
        data: {id_user: $('#id_user').val(), password_baru: $('#password_baru').val()},
        url: "_comm/edit_password.php",
        success: function(){
          alert('berhasil');
          $('#modal').modal('hide');
        },
        error: function() {
          alert('gagal');
        }
      });
  }
</script>
<?php include '_inc/footer.php'; ?>