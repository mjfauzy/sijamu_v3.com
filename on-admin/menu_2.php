<?php

require '_header.php';

?>

<div class="container">
  <h2>Kendali Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Status Pengendalian</th>
        <th>Tracking Dokumen</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus')");

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row_dokumen = $result_dokumen->fetch_object()) {
          $no++;
?>
          <tr>
            <td><?php echo "$no."; ?></td>
            <td><?php echo $row_dokumen->no_dokumen; ?></td>
            <td><?php echo $row_dokumen->judul_dokumen; ?></td>
            <td class="text-center">
              <?php 
                $status = $row_dokumen->status;
                if($status == 'Draf') {
                  echo "Belum Diperiksa Oleh yang Berwenang";
                } elseif($status == 'Telah Diperiksa') {
                  echo "Belum Disahkan Oleh yang Berwenang";
                } elseif($status == 'Telah Disahkan') {
                  echo "<a href='#' class='open_modal_distribusi btn btn-success' id='$row_dokumen->id'>Distribusi Dokumen</a>";
                } elseif($status == 'Telah Didistribusi') {
                  echo "Telah Didistribusi";
                  echo " | <a href='#' class='open_modal_distribusi btn btn-success' id='$row_dokumen->id'>Distribusi Dokumen</a>";
                } elseif($status == 'Terkendali') {
                  echo "Telah Terkendali";
                  echo " | <a href='files/uploads/terkendali/$row_dokumen->file' class='btn btn-success' target='_blank'>Lihat Dokumen</a>";
                }
              ?>
            </td>
            <td class="text-center">
              <a href="#" class="open_modal_details btn btn-success glyphicon glyphicon-option-horizontal" title="Document Details" id="<?php echo $row_dokumen->id; ?>"></a>
              <a href="#" class="open_modal_tracking btn btn-primary" id="<?php echo $row_dokumen->id; ?>">Show Tracking</a>
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

<!-- Modal Popup untuk Detail--> 
<div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Tracking--> 
<div id="ModalTracking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Distribusi--> 
<div id="ModalDistribusi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Search--> 
<div id="ModalSearch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Javascript untuk datatables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Details--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_details").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_detail_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalDetail").html(ajaxData);
               $("#ModalDetail").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Tracking--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_tracking").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_tracking.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalTracking").html(ajaxData);
               $("#ModalTracking").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Distribusi--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_distribusi").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_distribusi.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalDistribusi").html(ajaxData);
               $("#ModalDistribusi").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<?php

$connect->close();
require '_footer.php';

?>