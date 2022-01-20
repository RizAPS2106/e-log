<?php 
include '../connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap2.min.css">

    <script type="text/javascript" src="../js/Chart.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
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
                  <img src="images/logosmk2cimahi.png" style="width: 100px;height: 100px;border: 2px solid white;border-radius: 100%;-webkit-box-shadow: 0 0 3px #FFF, 0 0 5px #FFF, 0 0 10px #FFF; box-shadow: 0 0 3px #FFF, 0 0 5px #FFF, 0 0 10px #FFF">
                </a>
            </center>
        </div>

        <ul class="list-unstyled components">
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="siswa/siswa.php?id=<?=$id?>">Siswa</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="ortu/ortu.php?id=<?=$id?>">Orang Tua</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="pembimbing/pembimbing.php?id=<?=$id?>">Wali Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="bimbingan_konseling/bimbingankonseling.php?id=<?=$id?>">Bimbingan Konseling</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="kelas/kelas.php?id=<?=$id?>">Kelas</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="pegawai/pegawai.php?id=<?=$id?>">Pegawai</a>
            </li>
            <li style="padding-top: 10px;padding-bottom: 10px;">
                <a href="../admin/logout.php">Keluar</a>
            </li>
        </ul>
    </nav>

<div id="content">

<!--Ubah Profil-->
<?php  
  $queryprofil = mysqli_query($conn, "SELECT user.*, user.nama as name, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_pegawai WHERE user.id_user = $id");
  while ($keyprof = mysqli_fetch_array($queryprofil)) {
?>
      <div style="background-color: white;-webkit-box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.20);box-shadow: 5px 5px 15px 5px rgba(0,0,0,0.20);border-radius: 5px;margin-left: 20px;margin-right: 20px;margin-bottom: 30px;margin-top: 1px;"> 
        <div style="padding-top: 10px;padding-bottom: 10px;">

          <div style="display: inline-block;vertical-align: top;padding: 25px;">
              
            <div style="background-color: #004DE6;border-radius: 10px 90px 0px 10px;">
              <font size="6" style="width: 960px;display: inline-block;vertical-align: top;padding-top: 15px;padding-left: 30px;padding-bottom: 15px;color: white"><?php echo $keyprof['name'];?></font>
            </div>

            <br>
            
            <font size="4" style="display: inline-block;vertical-align: top;padding-left: 33px;color: #1966FF;"><b>NIP : <?php echo $keyprof['nip']; ?></b></font>
             
            <br>

            <font size="4" style="display: inline-block;vertical-align: top;padding-left: 33px;padding-bottom: 25px;color: #1966FF"><b>Bidang : <?php echo $keyprof['bidang']; ?></b></font> 

            <br> 

            <a href="#" data-toggle="modal" data-target="#myModal<?php echo $keyprof['id_user']; ?>"><font size="2" style="display: inline-block;vertical-align: top;padding-left: 33px;color: #0080FF">Ubah Profil</font></a>

          </div>
        </div>
      </div>

<!--Ubah Profil (pop-up)-->
<div class="modal fade" id="myModal<?php echo $keyprof['id_user']; ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form role="form" action="ubah_profil.php" method="get">
                        
                        <?php
                            $id = $keyprof['id_user']; 
                            $query_editpeg = mysqli_query($conn, "SELECT user.*, pegawai.* FROM user INNER JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.id_user = $id");

                            while($keyedit = mysqli_fetch_array($query_editpeg)) {   
                        ?>

                        <!--Form Pembimbing-->
                        <input type="hidden" name="id_user" value="<?php echo $keyedit['id_user'];?>">   
                        <input type="hidden" name="id_peg" value="<?php echo $keyedit['id_pegawai'];?>">  

                        <script type="text/javascript">
                          function isNumberKey(evt){
                          var charCode = (evt.which) ? evt.which : evt.keyCode
                          if (charCode > 31 && (charCode < 48 || charCode > 57))
                              return false;
                              return true;
                          }
                        </script>

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

<?php    
  }
?>

<!-- Begin Page Content -->
<div class="container-fluid">  

<!-- Content Row -->
<div class="row">

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <a href="report/report_siswa.php" style="text-decoration: none;">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Siswa</div>
            <?php 
            $siswa = mysqli_query($conn,  "SELECT * FROM siswa");
            $jumlah_siswa = mysqli_num_rows($siswa);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_siswa; ?></div>
            </a>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <a href="report/report_wk.php" style="text-decoration: none;">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Wali Kelas</div>
            <?php 
            $pembimbing = mysqli_query($conn,  "SELECT * FROM pembimbing WHERE bidang = 'Wali Kelas'");
            $jumlah_pembimbing = mysqli_num_rows($pembimbing);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pembimbing; ?></div>
            </a>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <a href="report/report_ortu.php" style="text-decoration: none;">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Wali Murid</div>
            <?php 
            $ortu = mysqli_query($conn, "SELECT * FROM ortu");
            $jumlah_ortu = mysqli_num_rows($ortu);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_ortu; ?></div>
            </a>
            </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <a href="report/report_bk.php" style="text-decoration: none;">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">BK</div>
            <?php 
            $beka = mysqli_query($conn,  "SELECT * FROM pembimbing WHERE bidang = 'BK'");
            $jumlah_beka = mysqli_num_rows($beka);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_beka; ?></div>
            </a>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <a href="report/report_kelas.php" style="text-decoration: none;">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total Kelas</div>
            <?php 
            $kelas = mysqli_query($conn, "SELECT * FROM kelas");
            $jumlah_kelas = mysqli_num_rows($kelas);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kelas; ?></div>
            </a>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

  </div>
</div>

</div>
</div>
</body>
</html>