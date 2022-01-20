<?php
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Pembimbing</title>
    
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

    $idpemb = $_GET['idpemb'];
    $namapemb = $_GET['namapemb'];
?>

<div class="wrapper">
    
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center>
                <a href="../dashboard_kurikulum.php">
                    <img src="../images/logosmk2cimahi.png" style="width: 100px;height: 100px;">
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
            <li style="padding-top: 10px;padding-bottom: 10px;background-color: #2c3e50;border-radius: 5px;">
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