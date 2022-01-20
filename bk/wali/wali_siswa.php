<?php
include '../../connection.php';
// $id = $_GET['id'];
?>

<?php
$sql = "SELECT * FROM siswa";
$query1 = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../image/logosmk2cimahi.png">
    <title>e-log | Wali Siswa</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../datatables/media/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="../../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_bk.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];
    // echo $id;
    // die;
    ?>


    
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard_bk.php?id=<?= $id;?>" style="color:white; text-decoration:none;">
        <div class="sidebar-brand-icon">
          <img class="img-profile rounded-circle" src="../../image/logosmk2cimahi.png" width="47px" height="47px">
        </div>
        <div class="sidebar-brand-text mx-3">E-LOG</div>
      </a>
        </div>

        <ul class="list-unstyled components">
        <!-- <p>The Providers</p> -->
        <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../pelanggaran/lihat_pelanggaran.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Tata tertib</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../kelas/kelas.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Kelas</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../pelanggaran/pelanggaran_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pelanggaran</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="wali_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Wali Siswa</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../../admin/logout.php" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Keluar</span></a>
            </li>
        </ul>
    </nav>


<div id="content">

    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Wali Siswa</h1><br>
<!-- <p class="mb-4">Seluruh siswa/i yang masih berstatus pelajar di SMKN 2 CIMAHI harus mengikuti semua peraturan yang berlaku</p> -->

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-black">Daftar Wali Siswa/Ortu</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
            <tr>
                <th scope="col">No</th> 
                <!-- <th scope="col">ID Ortu</th> -->
                <th scope="col">Nama Orang Tua</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No hp</th>
                <!-- <th scope="col">Username</th> -->
                <!-- <th scope="col">Edit/Delete</th> -->
            </tr>
            </thead>
        <tbody>
        <?php 
$query = mysqli_query($conn, "SELECT ortu.*, siswa.*, pembimbing.*, user.* FROM (((pembimbing INNER JOIN ortu ON pembimbing.id_pembimbing=ortu.id_pembimbing) INNER JOIN siswa ON ortu.id_siswa=siswa.id_siswa) INNER JOIN user ON user.id_user=ortu.id_user) WHERE pembimbing.id_pembimbing=$id");
$no = 1;
while ($data = mysqli_fetch_assoc($query)) 
{
  ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <!-- <td><?php echo $data['id_ortu']; ?></td> -->
      <td><?php echo $data['nama_ortu']; ?></td>
      <td><?php echo $data['nama_siswa']; ?></td>
      <td><?php echo $data['jk']; ?></td>
      <td><?php echo $data['alamat']; ?></td>
      <td><?php echo $data['nohp']; ?></td>
      <!-- <td> -->
        <!-- Button untuk modal -->
      <!-- <a href="#" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $data['id_ortu']; ?>">Edit</a>
      <a href='delete_wali_siswa.php?id=<?=$key['id_ortu']?>' class='btn btn-danger btn-sm' onclick="return confirm('Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
      </td> -->
    </tr>


<!-- Modal Edit -->
<div class="modal fade" id="myModal<?php echo $data['id_ortu']; ?>" role="dialog">
  <div class="modal-dialog">

<!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Update Data Wali Siswa</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
  <div class="modal-body">
    <form role="form" action="update_wali_siswa.php" method="get">

      <?php
      $idd = $data['id_ortu']; 
      $query_edit = mysqli_query($conn, "SELECT ortu.*, siswa.* FROM siswa INNER JOIN ortu ON ortu.id_siswa=siswa.id_siswa WHERE id_ortu='$idd'");
      //$result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($query_edit)) {  
      ?>

        <input type="text" name="id_ortu" value="<?php echo $row['id_ortu']; ?>">

  <div class="form-group">
    <label>Nama Wali</label>
      <input type="text" name="nama_ortu" class="form-control" value="<?php echo $row['nama_ortu']; ?>">      
  </div>

  <div class="form-group">
    <label>Nama Siswa</label>
      <select name="nama_siswa" class="form-control">
        <?php foreach ($query1 as $key) : ?>
					<option value="<?=$key['id_siswa'];?>">
						<?=$key['nama_siswa'];?></option>
					    <?php endforeach ?>
			</select>    
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
            

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<script type="text/javascript" src="../../datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../datatables/media/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="../../datatables/media/js/dataTables-demo.js"></script>

</body>
</html>