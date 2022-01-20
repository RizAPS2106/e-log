<?php
include '../connection.php';
// $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logosmk2cimahi.png">
    <title>e-log | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap2.min.css">
    <script type="text/javascript" src="../js/Chart.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_bk.php?id=<?= $id;?>" style="color:white; text-decoration:none;">
        <div class="sidebar-brand-icon">
          <img class="img-profile rounded-circle" src="../image/logosmk2cimahi.png" width="47px" height="47px">
        </div>
        <div class="sidebar-brand-text mx-3">E-LOG</div>
      </a>
        </div>

        <ul class="list-unstyled components">
        <!-- <p>The Providers</p> -->
        <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="pelanggaran/lihat_pelanggaran.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Tata tertib</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="kelas/kelas.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Kelas</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="pelanggaran/pelanggaran_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Pelanggaran</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="wali/wali_siswa.php?id=<?= $id;?>" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Wali Siswa</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a href="../admin/logout.php" class="nav-link"><i class="fas fa-fw fa-clipboard-list"></i>
                <span>Keluar</span></a>
            </li>
        </ul>
    </nav>



<div id="content">
        <div class="container-fluid">
            
        </div>
    </nav>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Content Row -->
<div class="row">

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total Kelas</div>
            <?php 
            $kelas = mysqli_query($conn, "SELECT kelas.*, pemkel.*, pembimbing.* FROM (( pemkel INNER JOIN kelas ON kelas.id_kelas=pemkel.id_kelas) INNER JOIN pembimbing ON pemkel.id_pembimbing=pembimbing.id_pembimbing) WHERE pembimbing.id_pembimbing='$id'");
            $jumlah_kelas = mysqli_num_rows($kelas);

            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kelas; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Wali Kelas</div>
            <?php 
            $pembimbing = mysqli_query($conn,  "SELECT kelas.*, pembimbing.*, pemkel.* FROM ((kelas INNER JOIN pembimbing ON kelas.id_pembimbing=pembimbing.id_pembimbing) INNER JOIN pemkel ON kelas.id_kelas=pemkel.id_kelas) WHERE pemkel.id_pembimbing=$id AND pembimbing.bidang='Wali Kelas'");
            $jumlah_pembimbing = mysqli_num_rows($pembimbing);

            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pembimbing; ?></div>
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
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Wali Murid</div>
            <?php 
            $ortu = mysqli_query($conn, "SELECT ortu.* FROM ortu INNER JOIN pembimbing ON ortu.id_pembimbing=pembimbing.id_pembimbing WHERE pembimbing.id_pembimbing=$id");
            $jumlah_ortu = mysqli_num_rows($ortu);

            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_ortu; ?></div>
              </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pelanggaran</div>
            <?php 
            $pelanggaran = mysqli_query($conn, "SELECT pelanggaran.*, kasus.*, pembimbing.* FROM (( pelanggaran INNER JOIN kasus ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) INNER JOIN pembimbing ON pembimbing.id_pembimbing=kasus.id_pembimbing) WHERE pembimbing.id_pembimbing='$id'");
            $jumlah_pelanggaran = mysqli_num_rows($pelanggaran);

            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pelanggaran; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-xl-9 col-md-6 mb-4">
    <div class="shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
<div class="card-body">
<div class="table-responsive">
<canvas id="myChart" class="chartjs-render-monitor">
    <?php
    //Inisialisasi nilai variabel awal
    $nama_jurusan= "";
    $jumlah_jurusan=null;
    //Query SQL
    $hasil_jurusan = mysqli_query($conn, "SELECT jurusan.nama_jurusan, COUNT(*) as 'total' FROM (((((jurusan INNER JOIN kelas ON kelas.id_jurusan=jurusan.id_jurusan) INNER JOIN siswa ON siswa.id_kelas=kelas.id_kelas) INNER JOIN kasus ON kasus.id_siswa=siswa.id_siswa) INNER JOIN pemkel ON pemkel.id_kelas=kelas.id_kelas) INNER JOIN pembimbing ON pembimbing.id_pembimbing=pemkel.id_pembimbing) WHERE pemkel.id_pembimbing='$id' GROUP BY jurusan.nama_jurusan");

    while ($data_jurusan = mysqli_fetch_array($hasil_jurusan)) {
        //Mengambil nilai nama kelas dari database
        $jurusan=$data_jurusan['nama_jurusan'];
        $nama_jurusan .= "'$jurusan'". ", ";
        //Mengambil nilai total dari database
        $jum_jurusan=$data_jurusan['total'];
        $jumlah_jurusan .= "$jum_jurusan". ", ";

    }
    ?>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_jurusan; ?>],
            datasets: [{
                label:"Data Jurusan", 
                data: [<?php echo $jumlah_jurusan; ?>],
                backgroundColor: [
                  'rgba(78,115,223,0.2)',
                  'rgba(255,99,12,0.2)',
                  'rgba(54,172,235,0.2)',
                  'rgba(255,206,86,0.2)',
                  'rgba(75,192,192,0.2)',
                ],
                borderColor: [
                  'rgba(78,115,223,1)',
                  'rgba(255,99,12,1)',
                  'rgba(54,172,235,1)',
                  'rgba(255,206,86,1)',
                  'rgba(75,192,192,1)',
                ],
                borderWidth: 1
                
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                          beginAtZero: true,
                      }
                }]
            }
        }
    });
    
</script>
</canvas>
</div>
      </div>
    </div>
  </div>
</div>
</div>
</div>



<div class="col-xl-3 col-md-6 mb-4">
    <div class="card shadow">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">

            <table class="table table" id="dataTable">
              <thead>
                <tr>
                  <th>Top 5 Pelanggaran</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
               <?php 
                $pelanggaran2 = mysqli_query($conn, "SELECT pelanggaran.nama_pelanggaran, COUNT(*) as 'jumlah' FROM ( kasus INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) WHERE kasus.id_pembimbing=$id GROUP BY pelanggaran.nama_pelanggaran ORDER BY `jumlah` DESC LIMIT 5");
                $jumlah_pelanggaran2 = mysqli_num_rows($pelanggaran2);

               ?>
              <tbody>
                <?php foreach ($pelanggaran2 as $key):?>
                  <tr>
                    <td class="pel"><?=$key['nama_pelanggaran'];?></td>
                    <td class="pel"><?=$key['jumlah'];?></td>
	                </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
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