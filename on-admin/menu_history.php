<?php

require '_header.php';

?>

<div class="container">
  <h2>History Dokumen</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelUsulan" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>No. Dokumen</th>
        <th>Judul Dokumen</th>
        <th>Jenis Dokumen</th>
        <th>Tanggal Upload</th>
        <th>Keterangan</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $no = 0;
  $result_history = mysqli_query($connect,"SELECT * FROM tbl_rek_daftar_induk_dokumen");

  if($result_history) {
    if($result_history->num_rows > 0) {
      while ($row_history = $result_history->fetch_object()) {
          $no++;
?>
          <tr>
            <td class="text-center"><?php echo "$no."; ?></td>
            <td><?php echo $row_history->no_dokumen; ?></td>
            <td>
              <?php 
                $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE no_dokumen='$row_history->no_dokumen'");
                if($result_dokumen) {
                  if($result_dokumen->num_rows > 0) {
                    $row_dokumen = $result_dokumen->fetch_object();
                    echo "$row_dokumen->judul_dokumen";
                  }
                }
              ?>
            </td>
            <td class="text-center">
              <?php 
                $result_jenis = mysqli_query($connect,"SELECT * FROM tbl_jenis_dokumen WHERE kode_jenis='$row_history->jenis_dokumen'");
                if($result_jenis) {
                  if($result_jenis->num_rows > 0) {
                    $row_jenis = $result_jenis->fetch_object();
                    echo "$row_jenis->jenis_dokumen";
                  }
                }
              ?>
            </td>
            <td class="text-center"><?php echo "$row_history->tanggal"; ?></td>
            <td><?php echo "$row_history->keterangan"; ?></td>
            <td><?php echo "$row_history->status"; ?></td>
          </tr>

<?php
      }
    }
  }
?>

  </tbody>
</table>
</div>

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelUsulan").dataTable();
  });
</script>

<?php

$connect->close();
$result_dokumen->close();
$result_history->close();
$result_jenis->close();
require '_footer.php';

?>