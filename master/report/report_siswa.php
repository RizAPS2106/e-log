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
$pdf->Cell(190,7,'DAFTAR SISWA SMK NEGERI 2 CIMAHI',0,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,15,$tanggalind,0,1);
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,0,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(21,6,'NIS',1,0);
$pdf->Cell(29,6,'NAMA SISWA',1,0);
$pdf->Cell(20,6,'KELAS',1,0);
$pdf->Cell(20,6,'JK',1,0);
$pdf->Cell(25,6,'ALAMAT',1,0);
$pdf->Cell(30,6,'NO. HP',1,0);
$pdf->Cell(15,6,'POINT',1,0);
$pdf->Cell(29,6,'NAMA ORTU',1,1);
 
$pdf->SetFont('Arial','',10);
 
include '../../connection.php';
?>

<?php
	$querysis = mysqli_query($conn, "SELECT user.*, kelas.*, siswa.* FROM ((siswa INNER JOIN user ON siswa.id_user = user.id_user) INNER JOIN kelas ON kelas.id_kelas = siswa.id_kelas) WHERE user.id_role = 5 ORDER BY kelas.id_kelas ASC");
?>

<?php while($key = mysqli_fetch_array($querysis)) {?>
            
<?php
    //Query select ortu
    $idsiswa = $key['id_siswa'];
    $queryort = mysqli_query($conn, "SELECT user.*, siswa.*, ortu.* FROM ((ortu INNER JOIN user ON ortu.id_user = user.id_user) INNER JOIN siswa ON ortu.id_siswa = siswa.id_siswa) WHERE ortu.id_siswa = $idsiswa");
?>

<?php while($keyort = mysqli_fetch_array($queryort)) {?>

<?php
    $pdf->Cell(21,6,$key['nis'],1,0);
    $pdf->Cell(29,6,$key['nama'],1,0);
    $pdf->Cell(20,6,$key['nama_kelas'],1,0);
    $pdf->Cell(20,6,$key['jk'],1,0);
    $pdf->Cell(25,6,$key['alamat'],1,0);
    $pdf->Cell(30,6,$key['nohp'],1,0); 
    $pdf->Cell(15,6,$key['sisa_point'],1,0);
    $pdf->Cell(29,6,$keyort['nama'],1,1);
?>

<?php } ?>
<?php } ?>

<?php 
$pdf->Output();
?>