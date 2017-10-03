<?php

require '_header.php';
$id_user = $_SESSION['id'];
$nama_org = $_SESSION['nama_org'];
$eselon = $_SESSION['eselon'];

?>

<div class="container">
  <h2>Dokumen Masuk</h2>
  <p><b>User Log :</b> <?php echo $_SESSION['nama']." (".$_SESSION['jabatan'].")" ?></p>
  <hr />

<table id="tabelDokumen" class="table table-bordered">
    <thead>
      <tr>
        <th>No. Dokumen</th>
        <th>Judul</th>
        <th>Aksi</th>
        <th>Status Dokumen</th>
      </tr>
    </thead>
    <tbody>
<?php 
  //menampilkan data mysqli
  include "../koneksi.php";
  $result_org = mysqli_query($connect,"SELECT * FROM tbl_organisasi WHERE nama_org='$nama_org'");
  if($result_org) {
    $row_org = $result_org->fetch_object();
    $kode_org = $row_org->kode_org;
  }

  if($eselon == "Eselon II") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND status NOT IN ('Draf') AND kode_jenis='SOP.02'");
  } elseif($nama_org == "Bagian Tata Usaha" && $eselon == "Eselon III") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org IN ('SBM.1.1','SBM.1.2','SBM.1.3','SBM.5')");
  } elseif(($nama_org == "Sub Bag. PKDI" || $nama_org == "Sub Bag. Keuangan" || $nama_org == "Sub Bag. Perlengkapan") && $eselon = "Eselon IV") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org='$kode_org' AND kode_jenis='SOP.03'");
  } elseif(($nama_org == "Bidang Teknologi Berkas Neutron" || $nama_org == "Bidang Sains Bahan Maju") && $eselon == "Eselon III") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org='$kode_org' AND kode_jenis='SOP.03'");
  } elseif($nama_org == "Bidang Keselamatan Kerja dan Keteknikan" && $eselon == "Eselon III") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org IN ('SBM.4.1','SBM.4.2') AND kode_jenis='SOP.03'");
  } elseif(($nama_org == "Sub Bid. KKPR" || $nama_org == "Sub Bid. Keteknikan") && $eselon = "Eselon IV") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org='$kode_org' AND kode_jenis='SOP.03'");
  } elseif($jabatan == "Penanggungjawab Alat $nama_org") {
    $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE status NOT IN ('Tidak Berlaku','Telah Dihapus') AND kode_org='$kode_org' AND kode_jenis='SOP.03'");
  } 

  if($result_dokumen) {
    if($result_dokumen->num_rows > 0) {
      while ($row_dokumen = $result_dokumen->fetch_object()) {
          $status = $row_dokumen->status;
          if($row_dokumen->kode_org == 'SBM.5') {
            $result_user = mysqli_query($connect,"SELECT * FROM tbl_user WHERE kode_org='$row_dokumen->kode_org'");
            if($result_user) {
              if($result_user->num_rows > 0) {
                while($row_user = $result_user->fetch_object()) {
                  if($row_user->id == $row_dokumen->id_user) {
                    if($row_user->eselon == "Eselon IV") {
                      echo "<tr>";
                        echo "<td>$row_dokumen->no_dokumen</td>";
                        echo "<td>$row_dokumen->judul_dokumen</td>";
                        echo "<td class='text-center'>";
                          echo "<a href='#' class='open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal' title='View Details' id='".$row_dokumen->id."'></a> ";
                            if($status == "Draf" || $status == "Telah Diperiksa") {
                              echo "<a href='../files/uploads/draf/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                            } elseif($status == "Telah Disahkan") {
                              echo "<a href='../files/uploads/disahkan/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                            }
                        echo "</td>";
                        echo "<td class='text-center'>"; 
                          if($status == 'Draf') {
                            echo "Belum Diperiksa | ";
                            if($eselon == 'Eselon III' && $row_dokumen->kode_jenis == 'SOP.02') {
                              echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a> ";
                            } elseif($jabatan == "Penanggungjawab Alat $nama_org") {
                              echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a>";
                            }
                          } elseif($status == 'Telah Diperiksa') {
                            echo "Selesai Diperiksa | ";
                            if($eselon == 'Eselon II') {
                              echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                            } elseif($eselon == "Eselon III" && $row_dokumen->kode_jenis == "SOP.03") {
                              echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                            }
                          } elseif($status == 'Telah Disahkan' || $status == 'Telah Dipublikasi') {
                            echo "$status | ";
                          }
                          echo "<a href='#' class='open_modal_tracking btn btn-primary' title='Show Tracking' id='".$row_dokumen->id."'>Tracking</a>";
                        echo "</td>";
                      echo "</tr>";
                    }
                  }
                }
              }
            }
          } else {
?>
          <tr>
            <td><?php echo $row_dokumen->no_dokumen; ?></td>
            <td><?php echo $row_dokumen->judul_dokumen; ?></td>
            <td class="text-center">
              <a href="#" class="open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal" title="View Details" id="<?php echo $row_dokumen->id; ?>"></a> 
              <?php
                if($status == "Draf" || $status == "Telah Diperiksa") {
                  echo "<a href='../files/uploads/draf/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                } elseif($status == "Telah Disahkan") {
                  echo "<a href='../files/uploads/disahkan/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                }
              ?>
            </td>
            <td class="text-center">
              <?php 
                if($status == 'Draf') {
                  echo "Belum Diperiksa | ";
                  if($eselon == 'Eselon III' && $row_dokumen->kode_jenis == 'SOP.02') {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a> ";
                  } elseif($eselon == 'Eselon IV' && $row_dokumen->kode_jenis == 'SOP.03') {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a> ";
                  } elseif($jabatan == "Penanggungjawab Alat $nama_org") {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a>";
                  }
                } elseif($status == 'Telah Diperiksa') {
                  echo "Selesai Diperiksa | ";
                  if($eselon == 'Eselon II') {
                    echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                  } elseif($eselon == "Eselon III" && $row_dokumen->kode_jenis == "SOP.03") {
                    echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                  }
                } elseif($status == 'Telah Disahkan' || $status == 'Telah Dipublikasi') {
                  echo "$status | ";
                }
              ?>
              <a href="#" class="open_modal_tracking btn btn-primary" title="Show Tracking" id="<?php echo $row_dokumen->id; ?>">Tracking</a>
            </td>
          </tr>
<?php
        }
      }
    }
  }

  $result_autentikasi = mysqli_query($connect,"SELECT * FROM tbl_rek_autentikasi_dokumen WHERE diperiksa_oleh='$jabatan' OR diperiksa_oleh_2='$jabatan'");
  if($result_autentikasi) {
    if($result_autentikasi->num_rows > 0) {
      while($row_autentikasi = $result_autentikasi->fetch_object()) {
        $result_dokumen = mysqli_query($connect,"SELECT * FROM tbl_dokumen WHERE no_dokumen='$row_autentikasi->no_dokumen' AND status NOT IN ('Tidak Berlaku','Telah Dihapus')");
        if($result_dokumen) {
          if($result_dokumen->num_rows > 0) {
            $row_dokumen = $result_dokumen->fetch_object();
?>
          <tr>
            <td><?php echo $row_dokumen->no_dokumen; ?></td>
            <td><?php echo $row_dokumen->judul_dokumen; ?></td>
            <td class="text-center">
              <a href="#" class="open_modal_detail btn btn-success glyphicon glyphicon-option-horizontal" title="View Details" id="<?php echo $row_dokumen->id; ?>"></a> 
              <?php
                if($status == "Draf" || $status == "Telah Diperiksa") {
                  echo "<a href='../files/uploads/draf/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                } elseif($status == "Telah Disahkan") {
                  echo "<a href='../files/uploads/disahkan/".$row_dokumen->file."' class='btn btn-success glyphicon glyphicon-file' title='Open File'></a>";
                }
              ?>
            </td>
            <td class="text-center">
              <?php 
                if($status == 'Draf') {
                  echo "Belum Diperiksa | ";
                  if($eselon == 'Eselon III' && $row_dokumen->kode_jenis == 'SOP.02') {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a> ";
                  } elseif($eselon == 'Eselon IV' && $row_dokumen->kode_jenis == 'SOP.03') {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a> ";
                  } elseif($jabatan == "Penanggungjawab Alat $nama_org") {
                    echo "<a href='#' class='open_modal_checked btn btn-success' id='$row_dokumen->id' title='Document Checked'>Checked</a>";
                  }
                } elseif($status == 'Telah Diperiksa') {
                  echo "Selesai Diperiksa | ";
                  if($eselon == 'Eselon II') {
                    echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                  } elseif($eselon == "Eselon III" && $row_dokumen->kode_jenis == "SOP.03") {
                    echo "<a href='#' class='open_modal_approved btn btn-success' id='$row_dokumen->id' title='Document Approved'>Approved</a> ";
                  }
                } elseif($status == 'Telah Disahkan' || $status == 'Telah Dipublikasi') {
                  echo "$status | ";
                }
              ?>
              <a href="#" class="open_modal_tracking btn btn-primary" title="Show Tracking" id="<?php echo $row_dokumen->id; ?>">Tracking</a>
            </td>
          </tr>
<?php
          }
        }
      }
    }
  }

?>
  </tbody>
</table>
</div>

<!-- Modal Popup untuk Details--> 
<div id="ModalDetail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Checked--> 
<div id="ModalChecked" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Approved--> 
<div id="ModalApproved" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk Tracking--> 
<div id="ModalTracking" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>


<!-- Javascript untuk dataTables -->
<script type="text/javascript">
  $(function() {
    $("#tabelDokumen").dataTable();
  });
</script>

<!-- Javascript untuk popup modal Details--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_detail").click(function(e) {
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

<!-- Javascript untuk popup modal Checked--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_checked").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_checked_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalChecked").html(ajaxData);
               $("#ModalChecked").modal('show',{backdrop: 'true'});
             }
           });
        });
      });
</script>

<!-- Javascript untuk popup modal Approved--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal_approved").click(function(e) {
      var m = $(this).attr("id");
       $.ajax({
             url: "modal_approved_dokumen.php",
             type: "GET",
             data : {id: m,},
             success: function (ajaxData){
               $("#ModalApproved").html(ajaxData);
               $("#ModalApproved").modal('show',{backdrop: 'true'});
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

<?php

$connect->close();
require '_footer.php';

?>