<?php
include '../../../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Data Siswa</title>
    
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css">
    
    <script type="text/javascript" src="../../../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../../../js/bootstrap.js"></script>
</head>
<body>
<?php
    session_start();
    if($_SESSION['status']!="login"){
        header("location:dashboard_master.php?pesan=belum_login");
    }
    $id = $_SESSION['id'];
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
                <li class="nav-item active2">
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
                <li class="nav-item">
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
        <form action="siswa.php">
            <!--cari nama-->
            <div style="display: inline-block;padding-right: 10px;padding-bottom: 10px;">
                <label>Cari Siswa : </label><br>
                <input type="text" name="cari">
            </div>

            <!--filter kelas-->
            <div style="display: inline-block;padding-right: 10px;">
                <label>Kelas :</label><br>
                <select name="filter" style="height: 31px;">
                
                    <option value=""></option>                
                    <?php
                    $querykel = mysqli_query($conn, "SELECT * FROM kelas");
                        foreach ($querykel as $akey) : 
                    ?>
                        <option value="<?=$akey['id_kelas'];?>"><?=$akey['nama_kelas'];?></option>
                    <?php 
                        endforeach 
                    ?>

                </select>
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
        <div style="display: inline-block;margin-right: 30px;padding-left: 33%">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal ">Tambah</button>
        </div>

        <br>

        <?php  
            if (isset($_GET['caribut'])) {
                $filter = $_GET['cari'];
                $filteridkel = $_GET['filter'];

                if ($filteridkel == "") {
                    ?>
                        <font size="2" style="color: ">Hasil dari Nama/NIS : <b><?php echo "$filter"; ?></b></font>
                    <?php
                }else if ($filteridkel != "") {
                    $querynamkel = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$filteridkel'");

                    while ($datakel = mysqli_fetch_array($querynamkel)) {
                            $filterkel = $datakel['nama_kelas'];

                        if ($filter != "" && $filterkel != "") {
                            ?>
                                <font size="2" style="color: ">Hasil dari Nama/NIS : <b><?php echo "$filter"; ?></b></font>
                                <font size="2" style="color: ">Dan Kelas : <b><?php echo "$filterkel"; ?></b></font>
                            <?php
                        }else if ($filter != "" && $filterkel == ""){
                            ?>
                                <font size="2" style="color: ">Hasil dari Nama/NIS : <b><?php echo "$filter"; ?></b></font>
                            <?php
                        }else if ($filter == "" && $filterkel != ""){
                            ?>
                                <font size="2" style="color: ">Hasil dari filter Kelas : <b><?php echo "$filterkel"; ?></b></font>
                            <?php
                        }else{
                            //do nothing
                        }
                    }
                }
            }
        ?>

        <!--tabel-->
        <div class="divtable">
            <table class="table">
            <thead class="thead-light">
            <br>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No.HP</th>
                    <th scope="col">Point</th>
                    <th scope="col">Nama Orang Tua</th>
                    <th scope="col">Ubah/Hapus</th>
                </tr>
            </thead>
            <tbody>

            <!--Isi Tabel-->
            <?php
                if(isset($_GET['caribut'])){
                    $nama = $_GET['cari'];
                    $kelas = $_GET['filter'];

                    if ($nama != "" && $kelas != "") {
                        //Query select siswa
                        $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND (user.nama LIKE '$nama%' OR siswa.nis LIKE '$nama%') AND siswa.id_kelas = $kelas ORDER BY kelas.id_kelas ASC"); 
                    }else if ($nama != "" && $kelas == "") {
                        $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND (user.nama LIKE '$nama%' OR siswa.nis LIKE '$nama%') ORDER BY kelas.id_kelas ASC"); 
                    }else if ($nama == "" && $kelas != "") {
                        $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND siswa.id_kelas = $kelas ORDER BY kelas.id_kelas ASC");
                    }else{
                        $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 ORDER BY kelas.id_kelas ASC");
                    }

                }else if(isset($_GET['clearbut'])) {
                    //Query select siswa
                    $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 ORDER BY kelas.id_kelas ASC");
                }else{
                    //Query select siswa
                    $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 ORDER BY kelas.id_kelas ASC");       
                }
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
                <td><a href="detailkelas_sis.php?idkel=<?=$key['id_kelas']?>&&namasis=<?=$key['nama']?>" type="button"><?php echo $key['nama_kelas']; ?></a></td>
                <td><?php echo $key['nis']; ?></td>
                <td><?php echo $key['jk']; ?></td>
                <td><?php echo $key['alamat']; ?></td>
                <td><?php echo $key['nohp']; ?></td>
                <td><?php echo $key['sisa_point']; ?></td>
                <td><?php echo $keyort['nama']; ?></td>
                <td>
                    <a href="#" type="button"  data-toggle="modal" data-target="#myModal<?php echo $key['id_user']; ?><?php echo $keyort['id_user']; ?> ">Ubah</a>
                    <!--Hapus User-->
                    <a href='hapus_siswa.php?id=<?=$key['id_user']?>&&idort=<?=$keyort['id_user']?>' class='btn btn-danger btn-sm' onclick="return confirm('Menghapus data siswa berarti menghapus data orang tua nya juga . Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
                </td>    

<!--Ubah User (pop-up)-->
<div class="modal fade" id="myModal<?php echo $key['id_user']; ?><?php echo $keyort['id_user']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_siswa.php" method="get">
                        
                        <?php
                            $id = $key['id_user']; 
                            $idort = $keyort['id_user'];
                            $query_edit = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas)WHERE user.id_user = $id");
                            $query_editort = mysqli_query($conn, "SELECT user.*, siswa.*, ortu.* FROM ((ortu INNER JOIN user ON ortu.id_user = user.id_user) INNER JOIN siswa ON ortu.id_siswa = siswa.id_siswa) WHERE user.id_user = $idort");
                            while ($keyedit = mysqli_fetch_array($query_edit)){ 
                            while ($keyortedit = mysqli_fetch_array($query_editort)){    
                        ?>

                        <!--Form Siswa-->
                        <input type="hidden" name="id_user" value="<?php echo $keyedit['id_user'];?>">    

                        <div class="form-group">
                            <label>NIS</label>
                            <input class="form-control" name="nis" value="<?php echo $keyedit['nis'];?>" onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" name="namasis" value="<?php echo $keyedit['nama'];?>">
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
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="kelas" class="form-control">
                                
                                <!--Pertamakan kelas yang sesuai database-->
                                <option value="<?=$keyedit['id_kelas'];?>"><?=$key['nama_kelas'];?></option>
                                
                                <!--Sisa nya-->
                                <?php
                                    $idkel = $keyedit['id_kelas'];
                                    $querykel = mysqli_query($conn, "SELECT * FROM kelas WHERE NOT id_kelas = $idkel");
                                    foreach ($querykel as $akey) : 
                                ?>
                                    <option value="<?=$akey['id_kelas'];?>"><?=$akey['nama_kelas'];?></option>
                                <?php 
                                    endforeach 
                                ?>

                            </select>
                        </div>

                        <!--Form Ortu-->
                        <input type="hidden" name="id_userort" value="<?php echo $keyortedit['id_user'];?>">

                        <div class="form-group">
                            <label>Nama Ortu</label>
                            <input type="text" class="form-control" name="namaort" value="<?php echo $keyortedit['nama'];?>">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="usernameort" value="<?php echo $keyortedit['username'];?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passort" value="<?php echo $keyortedit['password'];?>">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamatort" value="<?php echo $keyortedit['alamat'];?>">
                        </div>
                        <div class="form-group">
                            <label>Orang Tua</label>
                            <select name="jenisort" class="form-control">
                                
                                <?php
                                    if($keyortedit['jk'] == "laki-laki") {
                                        ?>
                                            <option value="laki-laki" selected>Ayah</option>
                                            <option value="perempuan">Ibu</option>
                                        <?php    
                                    }else if ($keyortedit['jk'] == "perempuan") {
                                        ?>
                                            <option value="laki-laki">Ayah</option>
                                            <option value="perempuan" selected>Ibu</option>
                                        <?php 
                                    }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohport" value="<?php echo $keyortedit['nohp'];?>" onkeypress="return isNumberKey(event)">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa-Orang tua</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="simpan_siswa.php" method="POST" enctype="multipart/form-data">
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
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp</label>
                            <input class="form-control" name="nohp" required onkeypress="return isNumberKey(event)">
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

                        <!--Form Ortu-->
                        <div class="form-group">
                            <label>Nama Orang Tua</label>
                            <input type="text" class="form-control" name="namaort" required>
                        </div>
                        <div class="form-group">
                            <label>Username Orang Tua</label>
                            <input type="text" class="form-control" name="usernameort" required>
                        </div>
                        <div class="form-group">
                            <label>Password Orang Tua</label>
                            <input type="password" class="form-control" name="passort" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Orang Tua</label>
                            <input type="text" class="form-control" name="alamatort" required>
                        </div>
                        <div class="form-group">
                            <label>Orang Tua</label>
                            <select name="jenisort" class="form-control">
                                <option value="laki-laki">Ayah</option>
                                <option value="perempuan">Ibu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.Hp Orang Tua</label>
                            <input class="form-control" name="nohport" required onkeypress="return isNumberKey(event)">
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