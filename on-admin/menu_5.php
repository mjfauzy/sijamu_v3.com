<?php

require '_header.php';

?>

<div class="container">
  <h2>Template Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Kode Dokumen</th>
        <th>Template</th>
        <th>Status File</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_template = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen");

  if($result_template) {
    if($result_template->num_rows > 0) {
      while ($row_template = $result_template->fetch_object()) {
          $no++;
?>
          <tr>
            <td class="text-center"><?php echo "$no."; ?></td>
            <td><?php echo $row_template->kode_jenis; ?></td>
            <td><?php echo $row_template->jenis_dokumen; ?></td>
            <td class="text-center">
              <?php 
                $file = $row_template->file;
                if($file == '') {
                  echo "File Tidak Tersedia";
                } else {
                  echo "<a href='../files/uploads/template/$file' class='btn btn-primary'>File Tersedia</a>";
                }
              ?>
            </td>
            <td class="text-center">
              <a href="#" class="open_modal_reupload btn btn-success glyphicon glyphicon-upload" title="Re-Upload Template" id="<?php echo $row_template->kode_jenis; ?>"></a>
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

<!-- Modal Popup untuk Re-upload template--> 
<div id="ModalReupload" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Re-upload template--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_reupload").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_reupload_template.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalReupload").html(ajaxData);
               $("#ModalReupload").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<?php

$connect->close();
require '_footer.php';

?>