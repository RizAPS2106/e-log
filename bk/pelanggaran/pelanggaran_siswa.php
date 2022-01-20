<?php
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../image/logosmk2cimahi.png">
    <title>e-log | Pelanggaran Siswa</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../datatables/media/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
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
            <li class="nav-item active">
                <a href="pelanggaran_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
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

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Pelanggaran Siswa</h1><br>
<!-- <p class="mb-4">Seluruh siswa/i yang masih berstatus pelajar di SMKN 2 CIMAHI harus mengikuti semua peraturan yang berlaku</p> -->

<!-- DataTales Example -->
<button type="button" class="btn btn-dark btn btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah</button><br><br>

<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-black">Daftar nama siswa/i yang melanggar</h6>
</div>
<div class="card-body">
<div class="table-responsive">
  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
  <?php
    $sql = "SELECT siswa.*, kelas.*, pemkel.* FROM ((siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas) INNER JOIN pemkel ON pemkel.id_kelas=kelas.id_kelas) WHERE pemkel.id_pembimbing=$id";
    $query = mysqli_query($conn, $sql);
    
    $sql2 = "SELECT * FROM pelanggaran";
    $query2 = mysqli_query($conn, $sql2);
    
    $sql3 = "SELECT * FROM pegawai";
    $query3 = mysqli_query($conn, $sql3);

?>
            <tr>
                <th>No</th> 
                <th>Nama Siswa/i</th>
                <th>Kelas</th>
                <th>Pelanggaran</th>
                <th>Point</th>
                <th>Tanggal</th>
                <th>Penanganan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $querysis = mysqli_query($conn, "SELECT siswa.*, pelanggaran.*, kasus.*, pembimbing.*, kelas.* FROM ((((kasus INNER JOIN siswa ON siswa.id_siswa=kasus.id_siswa) INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) INNER JOIN pembimbing ON pembimbing.id_pembimbing=kasus.id_pembimbing)INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas) WHERE pembimbing.id_pembimbing='$id' ORDER BY tanggal DESC");
                $no=1;
                while ($key = mysqli_fetch_assoc($querysis))
                    {
                        ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><a href="../kelas/detail_siswa.php?idd=<?php echo $key['nama_siswa']; ?>&&id=<?=$id?>"><?php echo $key['nama_siswa']; ?></a></td>
                    <!-- <td><?php echo $key['nama_siswa']; ?></td> -->
                    <td><?php echo $key['nama_kelas']; ?></td>
                    <td><?php echo $key['nama_pelanggaran']; ?></td>
                    <td align="center"><?php echo $key['point']; ?></td>
                    <td><?php echo $key['tanggal']; ?></td>
                    <td><?php echo $key['penanganan']; ?></td>
                    <td><?php if ($key['sisa_point'] <= 50) {?>
                       <a href="../../report/report.php?idreport=<?= $key['nama_siswa'];?>" class="btn btn-secondary btn-sm">Cetak</a>
                    <?php } ?>
                    <?php } ?>
                    </td>
                    
                   </tr>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pelanggaran Siswa</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="simpan_pelsiswa.php" method="POST" enctype="multipart/form-data">
                    <!-- <div class="form-group">
                        <label>Id Kasus</label>
                        <input type="text" class="form-control" name="idkasus" >
                    </div> -->
                    <div class="form-group">
                        <label>Nama Siswa/i</label>
                        <select name="siswa" class="form-control">
                        <?php foreach ($query as $key) : ?>
						<option value="<?=$key['id_siswa'];?>">
						<?=$key['nama_siswa'];?> - <?=$key['nama_kelas'];?></option>
                        <?php endforeach ?>
					 </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                        <select name="jenis" class="form-control">
                        <?php foreach ($query2 as $pel) : ?>
						<option value="<?=$pel['id_pelanggaran'];?>">
						<?=$pel['nama_pelanggaran'];?></option>
					    <?php endforeach ?>
					 </select>
                    </div>
                    <div class="form-group">
                        <!-- <label>Pegawai</label> -->
                        <input type="hidden" value="1" class="form-control" name="pegawai" readOnly>
                    </div>
                    <div class="form-group">
                        <!-- <label>Pembimbing</label> -->
                        <input type="hidden" value="<?= $id; ?>" class="form-control" name="pembimbing" readOnly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" value="<?= date("d-m-Y")?>" readOnly>
                    </div>
                    <div class="form-group">
                        <label>Penanganan</label>
                        <input type="text" class="form-control" name="penanganan" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Tambah" name="submit">
                    </div>
                </form>
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