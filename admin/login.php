<?php 
include '../connection.php';
$sql = "SELECT * FROM user";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/stylelogin.css">
    <script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</head>
<body>

<?php
if(isset($_GET['pesan'])){
    if($_GET['pesan'] == "gagal"){
        echo "Login gagal!";
    }else if($_GET['pesan'] == "logout"){
        ?>
        <script type='text/javascript'>alert('Logout berhasil');</script>
        <?php
    }else if($_GET['pesan'] == "belum_login"){
        echo "Login terlebih dahulu!";
    }
}
?>

  <section class="form my-4 mx-5">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4">
          <img src="logosmk2cimahi.png" alt="" class="img-fluid">
        </div>
        <div class="col-lg-8 px-5">
          <h4 class="font-weight-bold py-3" align="left">MASUK</h4>
          <form action="logincek.php" method="post">
            <div class="form-row">
              <div class="col-lg-7">
                <input type="text" class="form-control my-3 p-3" name="username" placeholder="Nama Pengguna" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-7">
                <input type="password" class="form-control my-3 p-3" name="password" placeholder="Kata Sandi" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-lg-7">
                <input type="submit" name="submit" class="btn1" value="Masuk">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

</div>
</body>
</html>