<?php

require '_header.php';

?>

<div class="container">
  <h2>Data Formulir</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="dataFormulir" class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Kode Formulir</th>
        <th>Nama Formulir</th>
        <th>File</th>
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
                  echo "<a href='../files/uploads/formulir/$file' class='btn btn-primary'><span class='glyphicon glyphicon-download-alt'></span> Download</a>";
                }
              ?>
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

<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#dataFormulir").dataTable();
  });
</script>

<?php

$connect->close();
require '_footer.php';

?>