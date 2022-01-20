<?php
include '../../connection.php';
$idd = $_GET['idd'];
// $id = $_GET['id'];
$querypel = mysqli_query($conn, "SELECT siswa.*, kelas.* FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE kelas.id_kelas='$idd'");
$no=1;
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
        <!-- <p>The Providers</p> -->
            
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
        
            <!-- DataTales Example -->

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <?php foreach($querypel as $m ) :?>
            <!-- <h6 align="left" class="m-0 font-weight-bold text-black">Kelas = <?= $m['nama_kelas'] ?></h6> -->
          <?php endforeach; ?>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
            <tr>
                <th scope="col">No</th> 
                <th scope="col">NIS</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Sisa Point</th>
            </tr>
        </thead>
        <tbody>
                   <?php foreach ($querypel as $key):?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $key['nis']; ?></td>
                    <td><a href="detail_siswa.php?idd=<?php echo $key['nama_siswa']; ?>&&id=<?=$id?>"><?php echo $key['nama_siswa']; ?></a></td>
                    <td><?=$key['sisa_point']; ?></td>
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