<?php
include '../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Siswa</title>
    
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    
    <script type="text/javascript" src="../../js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_kurikulum.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];

    $idkelas = $_GET['idkel'];
    $namakel = $_GET['namakel'];
?>

<div class="wrapper">
    
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center>
                <a href="dashboard_kurikulum.php">
                    <img src="images/logosmk2cimahi.png" style="width: 100px;height: 100px;">
                </a>
            </center>
        </div>

        <ul class="list-unstyled components">
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../siswa/siswa.php?id=<?=$id?>">Siswa</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../ortu/ortu.php?id=<?=$id?>">Orang Tua</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../pembimbing/pembimbing.php?id=<?=$id?>">Wali Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../bimbingan_konseling/bimbingankonseling.php?id=<?=$id?>">Bimbingan Konseling</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../kelas/kelas.php?id=<?=$id?>">Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../pegawai/pegawai.php?id=<?=$id?>">Pegawai</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../../admin/logout.php">Keluar</a>
            </li>
            </li>
        </ul>
    </nav>


<!--Content-->
<div id="content">
    <div class="container-fluid">

<h5>Siswa-siswa dari Kelas <b><?php echo $namakel; ?></b></h5>

<!--Detail-->
<div class="divtable">
    <table class="table">
    <thead class="thead-light">
    <br>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">NIS</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Nama Orang Tua</th>
            <th scope="col">Alamat</th>
            <th scope="col">No.HP</th>
            <th scope="col">Point</th>
        </tr>
    </thead>
    <tbody>

    <!--Isi Tabel-->    
    <?php
        $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND kelas.id_kelas = $idkelas ORDER BY kelas.id_kelas ASC");
    ?>

    <?php while($key = mysqli_fetch_array($querysis)) {?> 

    <?php
        //Query select ortu
        $idsiswa = $key['id_siswa'];
        $queryort = mysqli_query($conn, "SELECT user.*, siswa.*, ortu.* FROM ((ortu INNER JOIN user ON ortu.id_user = user.id_user) INNER JOIN siswa ON ortu.id_siswa = siswa.id_siswa) WHERE ortu.id_siswa = $idsiswa");
    ?>

    <?php while($keyort = mysqli_fetch_array($queryort)) {?>

    <tr>
        <td><?php echo $key['nama']; ?></td>
        <td><?php echo $key['nama_kelas']; ?></td>
        <td><?php echo $key['nis']; ?></td>
        <td><?php echo $key['jk']; ?></td>
        <td><?php echo $keyort['nama']; ?></td>
        <td><?php echo $key['alamat']; ?></td>
        <td><?php echo $key['nohp']; ?></td>
        <td><?php echo $key['sisa_point']; ?></td>
        <td>
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