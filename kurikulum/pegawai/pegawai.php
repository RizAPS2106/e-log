<?php
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Pegawai</title>
    
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
?>

<div class="wrapper">
    
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <center>
                <a href="../dashboard_kurikulum.php?id=<?=$id?>">
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
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../bimbingan_konseling/bimbingankonseling.php?id=<?=$id?>">Bimbingan Konseling</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../kelas/kelas.php?id=<?=$id?>">Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;background-color: #2c3e50;border-radius: 5px;">
                <a href="../pegawai/pegawai.php?id=<?=$id?>">Pegawai</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../../admin/logout.php">Keluar</a>
            </li>
        </ul>
    </nav>


<!--Content-->

<script type="text/javascript">
    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
</script>

<div id="content">
    <div class="container-fluid">
        
        <!--Filter-->
        <div style="display: inline-block;">
        <form action="pegawai.php">
            <!--cari nama-->
            <div style="display: inline-block;padding-right: 10px;padding-bottom: 10px;">
                <label>Cari Pegawai : </label><br>
                <input type="text" name="cari">
            </div>

            <!--button-->
            <div style="display: inline-block;padding: 10px;">
                <button type="submit" class="btn btn-dark" name="caribut">Cari</button>
            </div>
            <div style="display: inline-block;">
                <button type="submit" class="btn btn-dark" name="clearbut">Tampilkan Semua</button>
            </div>
        </form>
        </div>

        <!--button tambah-->
        <div style="display: inline-block;margin-right: 30px;padding-left: 43%">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Tambah</button>
        </div>

        <?php  
            if (isset($_GET['caribut'])) {
                $filter = $_GET['cari'];
                ?>
                    <font size="2" style="color: ">Hasil dari Nama/NIP : <b><?php echo "$filter"; ?></b></font>
                <?php
            }
        ?>

        <!--tabel-->
        <div class="divtable">
            <table class="table">
            <thead class="thead-light">
            <br>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Bidang</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No.HP</th>
                    <th scope="col">Ubah/Hapus</th>
                </tr>
            </thead>
            <tbody>

            <!--Isi Tabel-->
            <?php
                if(isset($_GET['caribut'])){
                    $nama = $_GET['cari'];

                    if ($nama != "") {
                        //Query select pegawai
                        $querypeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE (user.nama LIKE '$nama%' OR pegawai.nip LIKE '$nama%') AND (user.id_role = 3 OR user.id_role = 4)"); 
                    }else{
                        $querypeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.id_role = 3 OR user.id_role = 4");
                    }

                }else if(isset($_GET['clearbut'])) {
                    //Query select pegawai
                    $querypeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.id_role = 3 OR user.id_role = 4");
                }else{
                    //Query select pegawai
                    $querypeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.id_role = 3 OR user.id_role = 4");       
                }
            ?>  

            <?php while($key = mysqli_fetch_array($querypeg)) {?>

            <tr>
                <td><?php echo $key['nama']; ?></td>
                <td><?php echo $key['nip']; ?></td>
                <td><?php echo $key['bidang']; ?></td>
                <td><?php echo $key['jk']; ?></td>
                <td><?php echo $key['alamat']; ?></td>
                <td><?php echo $key['nohp']; ?></td>

                <?php
                    if ($key['id_role'] == 3) {
                        ?>
                        <td><b>Tidak Dapat</b></td>
                        <?php
                    }else{
                        ?>
                        <td>
                            <a href="#" type="button"  data-toggle="modal" data-target="#myModal<?php echo $key['id_user']; ?>">Ubah</a>
                            <!--Hapus User-->
                            <a href='hapus_pegawai.php?id=<?=$key['id_user']?>&&idpeg=<?=$key['id_pegawai']?>' class='btn btn-danger btn-sm' onclick="return confirm('Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
                        </td> 
                        <?php
                    }
                ?>   

<!--Ubah User (pop-up)-->
<div class="modal fade" id="myModal<?php echo $key['id_user']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_pegawai.php" method="get">
                        
                        <?php
                            $id = $key['id_user']; 
                            $query_editpeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.id_user = $id AND (user.id_role = 3 OR user.id_role = 4)");

                            while($keyedit = mysqli_fetch_array($query_editpeg)) {   
                        ?>

                        <!--Form Pembimbing-->
                        <input type="hidden" name="id_user" value="<?php echo $keyedit['id_user'];?>">   
                        <input type="hidden" name="id_peg" value="<?php echo $keyedit['id_pegawai'];?>">  

                        <div class="form-group">
                            <label>NIP</label>
                            <input class="form-control" name="nip" value="<?php echo $keyedit['nip'];?>" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $keyedit['nama'];?>">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $keyedit['username'];?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" value="<?php echo $keyedit['password'];?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?php echo $keyedit['alamat'];?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis" class="form-control">
                                
                                <?php
                                    if($keyedit['jk'] == "laki-laki") {
                                        ?>
                                            <option value="laki-laki" selected>Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        <?php    
                                    }else if ($keyedit['jk'] == "perempuan") {
                                        ?>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan" selected>Perempuan</option>
                                        <?php 
                                    }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohp" value="<?php echo $keyedit['nohp'];?>" onkeypress="return isNumberKey(event)">
                        </div>

                        <div class="modal-footer">  
                            <button type="submit" class="btn btn-success">Ubah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                        
                        <?php } ?>
                    </form>
                </div>
        </div>
    </div>
</div>
<!--akhir ubah-->

        </tr>
        <?php } ?>
    </tbody>
</table>

<!--Simpan--> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kesiswaan</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="simpan_pegawai.php" method="POST" enctype="multipart/form-data">
                        <!--Form Kelas-->
                        <div class="form-group">
                            <label>NIP</label>
                            <input class="form-control" name="nip" required onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama Pembimbing</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div> 
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis" class="form-control">
                                <option value="laki-laki" selected>Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohp" required onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Tambah" name="submit">
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
<!--akhir simpan-->

<!--alert-->

<?php
    if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];

        if ($pesan == "") {
        //do nothing
        }else{
        ?>
            <script type="text/javascript">alert("<?php echo $pesan?>")</script>
        <?php
        }
    }else{
        //do nothing
    } 
?>

<!--akhir alert-->

    </div>
</div>


</div>
</div>
</body>
</html>