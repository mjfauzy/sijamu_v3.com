<?php

require '_header.php';

?>

<div class="container">
  <h2>Data Formulir</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />
  <p>
    <a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAdd' data-toggle='modal' title='Tambah Formulir Baru'></a>
  </p>
  <hr />

<table id="dataFormulir" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Kode Formulir</th>
        <th>Nama Formulir</th>
        <th>Status File</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_formulir = mysqli_query($connect,"SELECT * FROM tbl_formulir");

  if($result_formulir) {
    if($result_formulir->num_rows > 0) {
      while ($row_formulir = $result_formulir->fetch_object()) {
          $no++;
?>
          <tr>
            <td class="text-center"><?php echo "$no."; ?></td>
            <td><?php echo $row_formulir->kode_formulir; ?></td>
            <td><?php echo $row_formulir->nama_formulir; ?></td>
            <td class="text-center">
              <?php 
                $file = $row_formulir->file;
                if($file == '') {
                  echo "File Tidak Tersedia";
                } else {
                  echo "<a href='../files/uploads/formulir/$file' class='btn btn-primary'>File Tersedia</a>";
                }
              ?>
            </td>
            <td class="text-center">
              <a href="#" class="open_modal_edit_formulir btn btn-success glyphicon glyphicon-pencil" title="Edit Data Formulir" id="<?php echo $row_formulir->id; ?>"></a>
              <a href='#' onclick="confirm_delete('proses_delete_formulir.php?&id=<?php echo $row_formulir->id; ?>');" class='btn btn-danger glyphicon glyphicon-trash' title='Delete Data Formulir'></a>
            </td>
          </tr>

<?php
      }
    }
  }
?>

  </tbody>
</table>
</div>


<!-- Modal Popup untuk Add--> 
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Formulir Baru</h4>
        </div>

        <div class="modal-body">
          <form action="proses_save_formulir.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Formulir">Kode Formulir</label>
                  <input type="text" name="kode_formulir"  class="form-control" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama Formulir">Nama Formulir</label>
                  <input type="text" name="nama_formulir"  class="form-control" required />
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="File">File</label>
                  <input type="file" name="file_upload" required />
                </div>

              <div class="modal-footer">
                <button class="btn btn-success" type="submit" title="Simpan Dokumen">Simpan</button>                
                <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Tutup</button>
              </div>
              </form>

            </div>
        </div>
    </div>
</div>

<!-- Modal Popup untuk Edit Formulir--> 
<div id="ModalEditFormulir" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="ModalDelete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Dokumen Ini?</h4>
      </div>
                
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-primary" id="delete_link">Ya</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#dataFormulir").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Edit Data Formulir --> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_edit_formulir").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_edit_formulir.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalEditFormulir").html(ajaxData);
               $("#ModalEditFormulir").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_delete(delete_url)
    {
      $('#ModalDelete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<?php

$connect->close();
require '_footer.php';

?>