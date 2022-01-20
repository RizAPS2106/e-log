<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string
$tanggal1 = date('l');
$tanggal2 = date(', d M Y');
if ($tanggal1 == "Monday") {
    $hari = "Senin";
}else if ($tanggal1 == "Tuesday") {
    $hari = "Selasa";
}else if ($tanggal1 == "Wednesday") {
    $hari = "Rabu";
}else if ($tanggal1 == "Thursday") {
    $hari = "Kamis";
}else if ($tanggal1 == "Friday") {
    $hari = "Jumat";
}else if ($tanggal1 == "Saturday") {
    $hari = "Sabtu";
}else if ($tanggal1 == "Sunday") {
    $hari = "Minggu";
}
$tanggalind = "$hari $tanggal2";
$pdf-> Image('kopsuratsmk.jpg' ,20,15,170,25);
$pdf-> Ln(40);
$pdf->Cell(190,7,'DAFTAR ORANG TUA SMK NEGERI 2 CIMAHI',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,15,$tanggalind,0,1);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,0,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,6,'NAMA ORANG TUA',1,0);
$pdf->Cell(33,6,'JENIS KELAMIN',1,0);
$pdf->Cell(40,6,'ALAMAT',1,0);
$pdf->Cell(32,6,'NO. HP',1,0);
$pdf->Cell(39,6,'NAMA SISWA',1,1);
 
$pdf->SetFont('Arial','',10);
 
include '../../connection.php';
?>

<?php
	$queryort = mysqli_query($conn, "SELECT user.*, ortu.*, ortu.id_user as idort, siswa.*, siswa.id_user as idsis FROM ((user INNER JOIN ortu ON ortu.id_user = user.id_user)INNER JOIN siswa ON siswa.id_siswa = ortu.id_ortu) WHERE user.id_role = 6");
?>

<?php while($key = mysqli_fetch_array($queryort)) {?>
            
<?php
    //Query select siswa
    $idsiswa = $key['id_siswa'];
    $querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.*, siswa.id_user as idsis FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 AND siswa.id_siswa = $idsiswa");
?>

<?php while($keysis = mysqli_fetch_array($querysis)) {?>

<?php
    $pdf->Cell(45,6,$key['nama'],1,0);
    $pdf->Cell(33,6,$key['jk'],1,0);
    $pdf->Cell(40,6,$key['alamat'],1,0);
    $pdf->Cell(32,6,$key['nohp'],1,0);
    $pdf->Cell(39,6,$keysis['nama'],1,1);
?>

<?php } ?>
<?php } ?>

<?php 
$pdf->Output();
?>