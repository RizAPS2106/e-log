<?php
include '../../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Pembimbing</title>
    
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
    
    <script type="text/javascript" src="../../../js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="../../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_kurikulum.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];

    $idpemb = $_GET['idpemb'];
    $namapemb = $_GET['namapemb'];
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

            <button class="dropdown-btn active">Data
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
                <li class="nav-item active">
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
            <li class="nav-item">
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


<!--Content-->
<div id="content">
    <div class="container-fluid">

<h5>Kelas yang dibimbing oleh <b><?php echo $namapemb; ?></b></h5>

<!--Detail-->
<div class="divtable">
    <table class="table">
    <thead class="thead-light">
    <br>
        <tr>
            <th scope="col">Kelas</th> 
            <th scope="col">Bimbingan Konseling</th>
            <th scope="col">Wali Kelas</th>
            <th scope="col">Jumlah Siswa</th>
        </tr>
    </thead>
    <tbody>

    <!--Isi Tabel-->    
    <?php
        $querykel = mysqli_query($conn, "SELECT user.*, user.nama as name, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE kelas.id_kelas != 0 AND user.id_role = 1 AND pemkel.id_pembimbing = $idpemb ORDER BY kelas.id_kelas ASC");
    ?>

    <?php while($key = mysqli_fetch_array($querykel)) {?> 

    <?php 
        $idkel = $key['id_kelas'];

        $querykeldua = mysqli_query($conn, "SELECT user.*, user.nama as name, pembimbing.*, kelas.*, pemkel.* FROM ((( pembimbing INNER JOIN user ON  pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing)INNER JOIN kelas ON pemkel.id_kelas = kelas.id_kelas) WHERE kelas.id_kelas = $idkel AND user.id_role = 2 ORDER BY kelas.id_kelas ASC");

        $queryjumsis = mysqli_query($conn, "SELECT * FROM siswa WHERE id_kelas = $idkel");
        $jumsis = mysqli_num_rows($queryjumsis);
    ?> 

    <?php while($keydua = mysqli_fetch_array($querykeldua)) {?>

    <tr>
        <td><?php echo $key['nama_kelas']; ?></td>
        <td><?php echo $key['name']?></td>
        <td><?php echo $keydua['name']?></td>
        <?php
        if ($jumsis > 0) {
            ?>
            <td><a href="../siswakelas.php?idkel=<?=$key['id_kelas']?>&&namakel=<?=$key['nama_kelas']?>" type="button"><?php echo $jumsis?></a></td>
            <?php  
        }else{
            ?>
            <td><?php echo $jumsis?></td>
            <?php
        }
        ?>
    </tr>
                    
    <?php } ?>
    <?php } ?>
                    
    </tbody>
    </table>
</div>

<div style="display: inline-block;margin-left: 90%;margin-top: 10px;">
    <button type="button" class="btn btn-dark" onclick="history.go(-1);">Kembali</button>
</div>

</div>
</div>
</body>
</html>