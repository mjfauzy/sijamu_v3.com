<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];
$eselon = $_SESSION['eselon'];

?>

<div class="container">
  <h2>Usulan Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Buat Usulan</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE nama_org='$nama_org'");
  if($result_org) {
    $row_org = $result_org->fetch_object();
    $kode_org = $row_org->kode_org;
  }

  $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi WHERE kode_org='$kode_org' AND file NOT IN ('')");

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row_dokumen = $result_dokumen->fetch_object()) {
          $no++;
          $load_dokumen = mysqli_query($connect,"SELECT no_dokumen,judul_dokumen FROM tbl_dokumen WHERE id='$row_dokumen->id_dokumen' AND status='Telah Didistribusi'");
          if($load_dokumen) {
            if($load_dokumen->num_rows > 0) {
              while($row_load = $load_dokumen->fetch_object()) {
?>

                <tr>
                  <td><?php echo "$no."; ?></td>
                  <td><?php echo $row_load->no_dokumen; ?></td>
                  <td><?php echo $row_load->judul_dokumen; ?></td>
                  <td class="text-center">
                    <a href="#" class="open_modal_amandemen btn btn-primary" id="<?php echo $row_dokumen->id_dokumen; ?>">Amandemen</a> 
                    <a href="#" class="open_modal_pemusnahan btn btn-danger" id="<?php echo $row_dokumen->id_dokumen; ?>">Pemusnahan</a>
                  </td>
                </tr>
<?php
              }
            } 
          }          
      }
    } else {
      $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_rek_file_distribusi WHERE kode_org='SBM.5' AND file NOT IN ('')");
      if($result_dokumen) {
        if($result_dokumen->num_rows > 0) {
          while ($row_dokumen = $result_dokumen->fetch_object()) {
              $no++;
              $load_dokumen = mysqli_query($connect,"SELECT no_dokumen,judul_dokumen FROM tbl_dokumen WHERE id='$row_dokumen->id_dokumen' AND status='Telah Didistribusi'");
              if($load_dokumen) {
                if($load_dokumen->num_rows > 0) {
                  while($row_load = $load_dokumen->fetch_object()) {
    ?>

                    <tr>
                      <td><?php echo "$no."; ?></td>
                      <td><?php echo $row_load->no_dokumen; ?></td>
                      <td><?php echo $row_load->judul_dokumen; ?></td>
                      <td class="text-center">
                        <a href="#" class="open_modal_amandemen btn btn-primary" id="<?php echo $row_dokumen->id_dokumen; ?>">Amandemen</a> 
                        <a href="#" class="open_modal_pemusnahan btn btn-danger" id="<?php echo $row_dokumen->id_dokumen; ?>">Pemusnahan</a>
                      </td>
                    </tr>
    <?php
                  }
                } 
              }          
          }
        } 
      }
    }
  }
?>
  </tbody>
</table>
</div>

<!-- Modal Popup untuk Amandemen--> 
<div id="ModalAmandemen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Pemusnahan--> 
<div id="ModalPemusnahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Amandemen--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_amandemen").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_amandemen_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalAmandemen").html(ajaxData);
               $("#ModalAmandemen").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Pemushanan--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_pemusnahan").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_pemusnahan_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalPemusnahan").html(ajaxData);
               $("#ModalPemusnahan").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<?php

$connect->close();
require '_footer.php';

?>