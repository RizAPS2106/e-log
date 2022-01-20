<?php
include '../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Orang Tua</title>
    
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
            <li style="padding-top: 10px;padding-bottom: 10px;background-color: #2c3e50;border-radius: 5px;">
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
        <form action="ortu.php">
            <!--cari nama-->
            <div style="display: inline-block;padding-right: 10px;padding-bottom: 10px;">
                <label style="padding-right: 10px;">Cari Nama Orang Tua/Siswa atau NIS siswa</label> 
                <br>
                <input type="text" name="cari" style="width: 100%;">
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
        <div style="display: inline-block;margin-right: 30px;padding-left: 29%">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Tambah</button>
        </div>

        <br>

        <?php  
            if (isset($_GET['caribut'])) {
                $filter = $_GET['cari'];
                ?>
                    <font size="2" style="color: ">Hasil dari Nama/NIS : <b><?php echo "$filter"; ?></b></font>
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
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No.HP</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Ubah/Hapus</th>
                </tr>
            </thead>
            <tbody>

            <!--Isi Tabel-->
            <?php
                if(isset($_GET['caribut'])){
                    $nama = $_GET['cari'];

                    if ($nama != "") {
                        //Query select ortu
                        $queryort = mysqli_query($conn, "SELECT user.*, ortu.*, ortu.id_user as idort, siswa.*, siswa.id_user as idsis FROM ((user INNER JOIN ortu ON ortu.id_user = user.id_user)INNER JOIN siswa ON siswa.id_siswa = ortu.id_ortu) WHERE user.id_role = 6 AND (ortu.nama_ortu like '$nama%' OR siswa.nama_siswa like '$nama%' OR siswa.nis like '$nama%')");
                    }else{
                        $queryort = mysqli_query($conn, "SELECT user.*, ortu.*, ortu.id_user as idort, siswa.*, siswa.id_user as idsis FROM ((user INNER JOIN ortu ON ortu.id_user = user.id_user)INNER JOIN siswa ON siswa.id_siswa = ortu.id_ortu) WHERE user.id_role = 6");
                    }

                }else if(isset($_GET['clearbut'])) {
                    //Query select ortu
                    $queryort = mysqli_query($conn, "SELECT user.*, ortu.*, ortu.id_user as idort, siswa.*, siswa.id_user as idsis FROM ((user INNER JOIN ortu ON ortu.id_user = user.id_user)INNER JOIN siswa ON siswa.id_siswa = ortu.id_ortu) WHERE user.id_role = 6");
                }else{
                    //Query select ortu
                    $queryort = mysqli_query($conn, "SELECT user.*, ortu.*, ortu.id_user as idort, siswa.*, siswa.id_user as idsis FROM ((user INNER JOIN ortu ON ortu.id_user = user.id_user)INNER JOIN siswa ON siswa.id_siswa = ortu.id_ortu) WHERE user.id_role = 6");       
                }
            ?>
            
            <?php while($key = mysqli_fetch_array($queryort)) {?>
            
            <?php
                //Query select siswa
                $idsiswa = $key['id_siswa'];
                $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.*, siswa.id_user as idsis FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND siswa.id_siswa = $idsiswa");
            ?>

            <?php while($keysis = mysqli_fetch_array($querysis)) {?>  

            <tr>
                <td><?php echo $key['nama_ortu']; ?></td>
                <td><?php echo $key['jk']; ?></td>
                <td><?php echo $key['alamat']; ?></td>
                <td><?php echo $key['nohp']; ?></td>
                <td><?php echo $keysis['nama_siswa']; ?></td>
                <td>
                    <a href="#" type="button"  data-toggle="modal" data-target="#myModal<?php echo $key['idort']; ?><?php echo $keysis['idsis']; ?>">Ubah</a>
                    <!--Hapus User-->
                    <a href='hapus_ortu.php?id=<?=$key['idort']?>&&idsis=<?=$keysis['idsis']?>' class='btn btn-danger btn-sm' onclick="return confirm('Menghapus data orang tua berarti menghapus data siswa juga . Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
                </td>    

<!--Ubah User (pop-up)-->
<div class="modal fade" id="myModal<?php echo $key['idort']; ?><?php echo $keysis['idsis']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Orang Tua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_ortu.php" method="get">
                        
                        <?php
                            $idusort = $key['idort'];
                            $idussis = $keysis['idsis']; 

                            $queryeditort = mysqli_query($conn, "SELECT user.*, ortu.* FROM user INNER JOIN ortu ON ortu.id_user = user.id_user WHERE user.id_role = 6 AND ortu.id_user = $idusort");
                            $queryeditsis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.*, siswa.id_siswa as idsis FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND siswa.id_user = $idussis");

                            while($keyedit = mysqli_fetch_array($queryeditort)){
                            while($keyeditsis = mysqli_fetch_array($queryeditsis)){
                        ?>

                        <input type="hidden" name="id_user" value="<?php echo $key['idort'];?>">    
                        <input type="hidden" name="id_usersis" value="<?php echo $keysis['idsis'];?>">

                        <!--Form Orang Tua-->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo $keyedit['nama'];?>"> </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="<?php echo $keyedit['alamat'];?>">
                        </div>
                        <div class="form-group">
                            <label>Orang Tua</label>
                            <select name="jenis" class="form-control">
                                
                                <?php
                                    if($keyedit['jk'] == "laki-laki") {
                                        ?>
                                            <option value="laki-laki" selected>Ayah</option>
                                            <option value="perempuan">Ibu</option>
                                        <?php    
                                    }else if ($keyedit['jk'] == "perempuan") {
                                        ?>
                                            <option value="laki-laki">Ayah</option>
                                            <option value="perempuan" selected>Ibu</option>s
                                        <?php 
                                    }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohp" value="<?php echo $keyedit['nohp'];?>" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $keyedit['username'];?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pass" value="<?php echo $keyedit['password'];?>">
                        </div>
                        
                        <!--Form Siswa-->
                        <div class="form-group">
                            <label>NIS</label>
                            <input class="form-control" name="nis" value="<?php echo $keyeditsis['nis'];?>" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" name="namasis" value="<?php echo $keyeditsis['nama'];?>">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="usernamesis" value="<?php echo $keyeditsis['username'];?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passsis" value="<?php echo $keyeditsis['password'];?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamatsis" value="<?php echo $keyeditsis['alamat'];?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenissis" class="form-control">
                                
                                <?php
                                    if($keyeditsis['jk'] == "laki-laki") {
                                        ?>
                                            <option value="laki-laki" selected>Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        <?php    
                                    }else if ($keyeditsis['jk'] == "perempuan") {
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
                            <input class="form-control" name="nohpsis" value="<?php echo $keyeditsis['nohp'];?>" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                                
                                <!--Pertamakan kelas yang sesuai database-->
                                <option value="<?=$keyeditsis['id_kelas'];?>"><?=$keyeditsis['nama_kelas'];?></option>
                                
                                <!--Sisa nya-->
                                <?php
                                    $idkel = $keyeditsis['id_kelas'];
                                    $querykel = mysqli_query($conn, "SELECT * FROM kelas WHERE NOT id_kelas = $idkel");
                                    foreach ($querykel as $akey) : 
                                ?>
                                    <option value="<?=$akey['id_kelas'];?>"><?=$akey['nama_kelas'];?></option>
                                <?php 
                                    endforeach 
                                ?>

                            </select>
                        </div>

                        <div class="modal-footer">  
                            <button type="submit" class="btn btn-success">Ubah</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>

                        <?php 
                            }
                        ?>
                        <?php 
                            }
                        ?>

                    </form>
                </div>
        </div>
    </div>
</div>
<!--akhir ubah-->

        </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
</table>

<!--Tambah User (pop-up)-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Orang Tua-Siswa</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="simpan_ortu.php" method="POST" enctype="multipart/form-data">
                        <!--Form Ortu-->
                        <div class="form-group">
                            <label>Nama Orang Tua</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Username Orang Tua</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password Orang Tua</label>
                            <input type="password" class="form-control" name="pass" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Orang Tua</label>
                            <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>Orang Tua</label>
                            <select name="jenis" class="form-control">
                                <option value="laki-laki">Ayah</option>
                                <option value="perempuan">Ibu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp Orang Tua</label>
                            <input class="form-control" name="nohp" required onkeypress="return isNumberKey(event)">
                        </div>
                        <!--Form Siswa-->
                        <div class="form-group">
                            <label>NIS</label>
                            <input class="form-control" name="nis" required onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" name="namasis" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="usernamesis" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passsis" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamatsis" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenissis" class="form-control">
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohpsis" required onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                            <?php 
                                $querykel = mysqli_query($conn, "SELECT * FROM kelas");
                            ?>
                            <?php foreach ($querykel as $akey) : ?>
                                <option value="<?=$akey['id_kelas'];?>"><?=$akey['nama_kelas'];?></option>
                            <?php endforeach ?>
                        </select>
                        </div>
                        <div class="form-group">
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