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
                <li class="nav-item active2">
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
        <form action="pembimbing.php">
            <!--cari nama-->
            <div style="display: inline-block;padding-right: 10px;padding-bottom: 10px;">
                <label>Cari Wali Kelas : </label><br>
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
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">Tambah</button>
        </div>

        <?php  
            if (isset($_GET['caribut'])) {
                $filter = $_GET['cari'];
                $filteridkel = $_GET['filter'];

                if ($filteridkel == "") {
                    ?>
                        <font size="2" style="color: ">Hasil dari Nama/NIP : <b><?php echo "$filter"; ?></b></font>
                    <?php
                }else if ($filteridkel != "") {
                    $querynamkel = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas = '$filteridkel'");

                    while ($datakel = mysqli_fetch_array($querynamkel)) {
                            $filterkel = $datakel['nama_kelas'];

                        if ($filter != "" && $filterkel != "") {
                            ?>
                                <font size="2" style="color: ">Hasil dari Nama/NIP : <b><?php echo "$filter"; ?></b></font>
                                <font size="2" style="color: ">Dan Kelas : <b><?php echo "$filterkel"; ?></b></font>
                            <?php
                        }else if ($filter != "" && $filterkel == ""){
                            ?>
                                <font size="2" style="color: ">Hasil dari Nama/NIP : <b><?php echo "$filter"; ?></b></font>
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
                    <th scope="col">NIP</th>
                    <th scope="col">Kelas</th>
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
                    $kelas = $_GET['filter'];

                    if ($nama != "" && $kelas != "") {
                        //Query select pembimbing
                        $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.*, pemkel.id_kelas FROM ((pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE user.id_role = 2 AND (user.nama LIKE '$nama%' OR pembimbing.nip LIKE '$nama%') AND pemkel.id_kelas = $kelas"); 
                    }else if ($nama != "" && $kelas == ""){
                        $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_role = 2 AND (user.nama LIKE '$nama%' OR pembimbing.nip LIKE '$nama%')");
                    }else if ($nama == "" && $kelas != ""){
                        $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.*, pemkel.id_kelas FROM ((pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user)INNER JOIN pemkel ON pembimbing.id_pembimbing = pemkel.id_pembimbing) WHERE user.id_role = 2 AND pemkel.id_kelas = $kelas");
                    }else{
                        $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_role = 2");
                    }

                }else if(isset($_GET['clearbut'])) {
                    //Query select pembimbing
                    $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_role = 2");
                }else{
                    //Query select pembimbing
                    $querypemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_role = 2");       
                }
            ?>  

            <?php while($key = mysqli_fetch_array($querypemb)) {?>

            <?php
                //Query select kelas
                $idpem = $key['id_pembimbing'];
                $querykel = mysqli_query($conn, "SELECT kelas.*, pembimbing.* , pemkel.*, MAX(pemkel.id_kelas) FROM ((pembimbing INNER JOIN pemkel ON pemkel.id_pembimbing = pembimbing.id_pembimbing) INNER JOIN kelas ON kelas.id_kelas = pemkel.id_kelas)  WHERE pembimbing.id_pembimbing = $idpem ORDER BY kelas.id_kelas ASC");

                $querylistkel = mysqli_query($conn, "SELECT * FROM pemkel WHERE id_pembimbing = $idpem");
                $jumlistkel = mysqli_num_rows($querylistkel);
                $jumkurlistkel = $jumlistkel - 1;
            ?>    

            <?php while($keykel = mysqli_fetch_array($querykel)) {?>

            <tr>
                <td><?php echo $key['nama']; ?></td>
                <td><?php echo $key['nip']; ?></td>
                <?php
                    if ($jumlistkel > 1) {
                        ?>
                            <td><a href="detailkelas_wk.php?idpemb=<?=$key['id_pembimbing']?>&&namapemb=<?=$key['nama']?>" type="button"><?php echo $keykel['nama_kelas']; ?> dan +<?php echo $jumkurlistkel; ?> </a></td>
                        <?php 
                    }else if ($jumlistkel == 1) {
                        ?>
                            <td><a href="detailkelas_wk.php?idpemb=<?=$key['id_pembimbing']?>&&namapemb=<?=$key['nama']?>" type="button"><?php echo $keykel['nama_kelas']; ?></a></td>
                        <?php
                    }else if ($jumlistkel < 1) {
                        ?>
                            <td>Kosong</td>
                        <?php
                    }
                ?>
                <td><?php echo $key['jk']; ?></td>
                <td><?php echo $key['alamat']; ?></td>
                <td><?php echo $key['nohp']; ?></td>
                <td>
                    <a href="#" type="button"  data-toggle="modal" data-target="#myModal<?php echo $key['id_user']; ?>">Ubah</a>
                    <!--Hapus User-->
                    <a href='hapus_pemb.php?id=<?=$key['id_user']?>&&idpemb=<?=$key['id_pembimbing']?>' class='btn btn-danger btn-sm' onclick="return confirm('Jika data Wali Kelas yang membimbing suatu kelas dihapus maka kelas yang dibimbing nya akan ikut terhapus . Apakah Anda yakin ingin menghapusnya ?')">Hapus</a>
                </td>    

<!--Ubah User (pop-up)-->
<div class="modal fade" id="myModal<?php echo $key['id_user']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Wali Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_pemb.php" method="get">
                        
                        <?php
                            $id = $key['id_user']; 
                            $query_editpemb = mysqli_query($conn, "SELECT user.*, pembimbing.* FROM pembimbing INNER JOIN user ON pembimbing.id_user = user.id_user WHERE user.id_user = $id");

                            while($keyedit = mysqli_fetch_array($query_editpemb)) {   
                        ?>

                        <!--Form Pembimbing-->
                        <input type="hidden" name="id_user" value="<?php echo $keyedit['id_user'];?>">   
                        <input type="hidden" name="id_pemb" value="<?php echo $keyedit['id_pembimbing'];?>">  

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
        <?php } ?>
    </tbody>
</table>

<!--Simpan--> 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Wali Kelas</h5><br>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="simpan_pemb.php" method="POST" enctype="multipart/form-data">
                        <!--Form Kelas-->
                        <div class="form-group">
                            <label>NIP</label>
                            <input class="form-control" name="nip" required onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
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