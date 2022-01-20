<?php
include '../../connection.php';
$idd=$_GET['idd'];
// $id=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../image/logosmk2cimahi.png">
    <title>e-log | Detail Siswa</title>
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
        <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../pelanggaran/lihat_pelanggaran.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Tata tertib</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a href="kelas.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Kelas</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../pelanggaran/pelanggaran_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pelanggaran</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../wali/wali_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
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
   
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <div class="container-fluid">
        </div>
        
        
            <!-- DataTales Example -->
            <!-- Begin Page Content -->
<!-- <div class="container-fluid"> -->

<!-- Content Row -->
<div class="row">

  <div class="col-xl-2">
    <div class="card shadow">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="h6 text font-weight-bold text-primary text-uppercase"> Sisa Point</div>
            <?php 
            // $kelas = mysqli_query($conn, "SELECT * FROM kelas");
            $sisa = mysqli_query($conn, "SELECT siswa.* FROM siswa WHERE nama_siswa='$idd'");
            ?>

            <?php foreach ($sisa as $key => $value): ?>

            <div class="h6 mb-0 font-weight-bold"><?= $value['sisa_point']; ?></div>
            <?php endforeach;?>

          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-10">
<div class="card shadow mb-9">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-black"><?= $idd;?>
        <a href="../../report/reportsiswa.php?id=<?= $idd;?>" style="float:right; color:white;" class="btn btn-secondary btn-sm">Cetak PDF</a>
    </h6>
    </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">No</th> 
                <th scope="col">Aturan yang Dilanggar</th>
                <th scope="col">Total Point</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $querypel = mysqli_query($conn, "SELECT siswa.*, pelanggaran.*, kasus.* FROM ((kasus INNER JOIN siswa ON siswa.id_siswa=kasus.id_siswa) INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) WHERE siswa.nama_siswa='$idd'");
                $no=1;
                   ?> 
                   <?php foreach ($querypel as $key):?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $key['nama_pelanggaran']; ?></td>
                      <td><?php echo $key['point']; ?></td>
                   </tr>
              <?php endforeach?>
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