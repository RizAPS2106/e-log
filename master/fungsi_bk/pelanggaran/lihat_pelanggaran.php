<?php
include '../../../connection.php';
// $id = $_GET['id'];
?>

<?php
$sql = "SELECT * FROM kategori";
$query1 = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/logosmk2cimahi.png">
    <title>e-log | Tata Tertib</title>
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../datatables/media/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="../../../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_master.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];
    // echo $id;
    // die;
    ?>


    
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../dashboard_master.php?id=<?= $id;?>" style="color:white; text-decoration:none;">
        <div class="sidebar-brand-icon">
          <img class="img-profile rounded-circle" src="../../images/logosmk2cimahi.png" width="47px" height="47px">
        </div>
        <div class="sidebar-brand-text mx-3">E-LOG</div>
      </a>
        </div>

        <ul class="list-unstyled components">
        <!-- <p>The Providers</p> -->
        <hr class="sidebar-divider my-0">

            <button class="dropdown-btn">Data
                <i class="fa fa-caret-down"><img src="../../images/white-down-arrow-png-2.png" width="15" height="15"></i>
            </button>
            <div class="dropdown-container">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/siswa/siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Data Siswa</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/ortu/ortu.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Data Wali Siswa</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/pembimbing/pembimbing.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Data Wali Kelas</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/bimbingankonseling/bimbingankonseling.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Data Bimbingan Konseling</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/kelas/kelas.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                        <span>Data Kelas</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a href="../../fungsi_kurikulum/pegawai/pegawai.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Data Pegawai</span></a>
                </li>
            </div>

            <script type="text/javascript">
                var dropdown = document.getElementsByClassName("dropdown-btn");
                var i;

                for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                    } else {
                    dropdownContent.style.display = "block";
                    }
                });
                } 
            </script>            

            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="../../fungsi_bk/pelanggaran/lihat_pelanggaran.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Tata tertib</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../../fungsi_bk/kelas/kelas.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Kelas</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../../fungsi_bk/pelanggaran/pelanggaran_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pelanggaran</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../../fungsi_bk/wali/wali_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Wali Siswa</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../../../admin/logout.php" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Keluar</span></a>
            </li>
        </ul>
    </nav>


<div id="content">

    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pelanggaran Siswa</h1>
<p class="mb-4">Seluruh siswa/i yang masih berstatus pelajar di SMKN 2 CIMAHI harus mengikuti semua peraturan yang berlaku</p>

<!-- DataTales Example -->
<button type="button" class="btn btn-dark btn btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah</button><br><br>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-black">Daftar Tata Tertib SMKN 2 CIMAHI</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
            <tr>
                <th scope="col">No</th> 
                <!-- <th scope="col">ID Pelanggaran</th> -->
                <th scope="col">Nama Pelanggaran</th>
                <th scope="col">Kategori</th>
                <th scope="col">Point</th>
                <th scope="col">Edit/Delete</th>
            </tr>
            </thead>
        <tbody>
        <?php 
$query = mysqli_query($conn, "SELECT pelanggaran.*, kategori.* FROM pelanggaran, kategori WHERE pelanggaran.id_kategori=kategori.id_kategori");
$no = 1;
while ($data = mysqli_fetch_assoc($query)) 
{
  ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <!-- <td><?php echo $data['id_pelanggaran']; ?></td> -->
      <td><?php echo $data['nama_pelanggaran']; ?></td>
      <td><?php echo $data['nama_kategori']; ?></td>
      <td><?php echo $data['point']; ?></td>
      <td>
        <!-- Button untuk modal -->
      <a href="#" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data['id_pelanggaran']; ?>">Edit</a>
      <a href='delete_pelanggaran.php?idd=<?php echo $data['id_pelanggaran']; ?>&&id=<?=$id;?>' class='btn btn-danger btn-sm' onclick="return confirm('Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
      </td>
    </tr>


<!-- Modal Edit -->
<div class="modal fade" id="myModal<?php echo $data['id_pelanggaran']; ?>" role="dialog">
  <div class="modal-dialog">

<!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Update Data Siswa</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
  <div class="modal-body">
    <form role="form" action="update_pelanggaran.php" method="get">

      <?php
      $idpel = $data['id_pelanggaran']; 
      $query_edit = mysqli_query($conn, "SELECT pelanggaran.*, kategori.* FROM pelanggaran INNER JOIN kategori ON kategori.id_kategori=pelanggaran.id_kategori WHERE id_pelanggaran='$idpel'");
      //$result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($query_edit)) {  
      ?>

        <input type="hidden" name="id_pelanggaran" value="<?php echo $row['id_pelanggaran']; ?>">

  <div class="form-group">
    <label>Nama Pelanggaran</label>
      <input type="text" name="nama_pelanggaran" class="form-control" value="<?php echo $row['nama_pelanggaran']; ?>">      
  </div>

  <div class="form-group">
    <label>Kategori</label>
      <select name="id_kategori" class="form-control">
        <?php foreach ($query1 as $key) : ?>
					<option value="<?=$key['id_kategori'];?>">
						<?=$key['nama_kategori'];?></option>
					    <?php endforeach ?>
			</select>    
  </div>

<div class="form-group">
  <label>Point</label>
    <input type="text" name="point" class="form-control" value="<?php echo $row['point']; ?>">      
</div>

<div class="modal-footer">  
  <button type="submit" class="btn btn-success">Update</button>
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<?php 
}
//mysqli_close($host);
?>        
</form>
  </div>
    </div>

    </div>
      </div>
        <?php               
          } 
          ?>
            <!-- tambah data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan_pelanggaran.php?id=<?=$id;?>" method="POST" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                        <label>Id Pelanggaran</label>
                        <input type="text" class="form-control" name="idpel" >
                    </div> -->
                    <div class="form-group">
                        <label>Nama Pelanggaran</label>
                        <input type="text" class="form-control" name="namapel" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                        <select name="jenis" class="form-control">
                        <?php foreach ($query1 as $key) : ?>
					            	<option value="<?=$key['id_kategori'];?>">
						            <?=$key['nama_kategori'];?></option>
					              <?php endforeach ?>
					              </select>
                    </div>
                    <div class="form-group">
                        <label>Point Pelanggaran</label>
                        <input type="text" class="form-control" name="point" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Tambah" name="submit">
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
</div>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


</div>
</div>

<script type="text/javascript" src="../../datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../../datatables/media/js/dataTables-demo.js"></script>

</body>
</html>