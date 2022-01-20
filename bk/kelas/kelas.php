<?php
include '../../connection.php';
// $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../image/logosmk2cimahi.png">
    <title>e-log | Kelas</title>
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
    </nav>

    <div id="content">

    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kelas </h1><br>
<!-- <p class="mb-4">Seluruh siswa/i yang masih berstatus pelajar di SMKN 2 CIMAHI harus mengikuti semua peraturan yang berlaku</p> -->

<!-- DataTales Example -->

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-black">Daftar Kelas</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th align="center">No</th> 
                <!-- <th scope="col">ID Kelas</th> -->
                <th scope="col">Kelas</th>
                <th scope="col">Wali Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // $querypel = mysqli_query($conn, "SELECT kelas.*, pembimbing.* FROM ((pemkel INNER JOIN kelas ON pemkel.id_kelas=kelas.id_kelas) INNER JOIN pembimbing ON pemkel.id_pembimbing=pembimbing.id_pembimbing) WHERE pembimbing.bidang='Wali Kelas' AND pemkel.id_kelas=1");
                // $querypel = mysqli_query($conn, "SELECT kelas.*, pembimbing.*, pemkel.* FROM ((pemkel INNER JOIN kelas ON pemkel.id_kelas=kelas.id_kelas) INNER JOIN pembimbing ON pemkel.id_pembimbing=pembimbing.id_pembimbing) WHERE pembimbing.id_pembimbing=$id");
                // foreach ($querypel as $pem) :
                //     $kelas = $pem['id_kelas'];
                    // $querypel = mysqli_query($conn, "SELECT kelas.*, pembimbing.*, pemkel.* FROM ((pemkel INNER JOIN kelas ON pemkel.id_kelas=kelas.id_kelas) INNER JOIN pembimbing ON pemkel.id_pembimbing=pembimbing.id_pembimbing) WHERE pemkel.id_kelas=$kelas AND pembimbing.bidang='Wali Kelas'");
                    // SELECT kelas.*, pembimbing.*, pemkel.* FROM ((pemkel INNER JOIN kelas ON pemkel.id_pembimbing=kelas.id_pembimbing) INNER JOIN pembimbing ON pembimbing.id_pembimbing=pemkel.id_pembimbing)
                $querypel = mysqli_query($conn, "SELECT kelas.*, pembimbing.*, pemkel.* FROM ((kelas INNER JOIN pembimbing ON kelas.id_pembimbing=pembimbing.id_pembimbing) INNER JOIN pemkel ON kelas.id_kelas=pemkel.id_kelas) WHERE pemkel.id_pembimbing='$id'");
                $no=1;
                   ?> 
                   <?php foreach ($querypel as $key):?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <!-- <td><?php echo $key['id_kelas']; ?></td> -->
                    <td><a href="detail_kelas.php?idd=<?php echo $key['id_kelas'] ?>&&id=<?=$id?>"><?php echo $key['nama_kelas']; ?></a></td>
                    <td><?php echo $key['nama']; ?></td>
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
