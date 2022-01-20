<?php 
include '../connection.php';

if (isset($_POST['daftar'])) {
	$id = $_POST['user'];
	$bidang = $_POST['bidang'];
	$username = $_POST['username'];
    $password = $_POST['password'];
	$jk = $_POST['jk'];
	$alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];

	$sql = "INSERT INTO user VALUES ('$id', '$bidang', '$username', '$password', '$jk', '$alamat', '$nohp')";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		echo "
		<script type='text/javascript'>
			alert('Data Berhasil Disimpan);
		</script>
		";
		header("location:login.php");
	}else{
		echo "gagal";
	}
}
  ?>