<?php
include '../../connection.php';
$nama=$_GET['idreport'];
$sql = "SELECT siswa.*, kasus.*, pelanggaran.*, kelas.* FROM (((siswa INNER JOIN kasus ON kasus.id_siswa=siswa.id_siswa) INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas) WHERE siswa.nama_siswa='$nama'";
$queryrep = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($queryrep);

$sqlkasus = "SELECT DISTINCT pelanggaran.nama_pelanggaran FROM ((kasus INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) INNER JOIN siswa ON siswa.id_siswa=kasus.id_siswa) WHERE siswa.nama_siswa='$nama'";
$querykasus = mysqli_query($conn, $sqlkasus);
// $kasus = mysqli_fetch_array($querykasus);

// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf = new FPDF('P','mm','a4');

    $pdf-> AddPage();
    $pdf-> Image('kopsuratsmk.jpg' ,20,10,170,35);
	$pdf-> Ln(40);
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','',13);
// mencetak string 
$pdf->Cell(190,7,'SURAT TEGURAN TERTULIS',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1,'C');
 
$pdf->SetFont('Arial','','11');
$pdf->Cell(8,5,'Hal',0,0,'R');
$pdf->Cell(53,5,': Surat Teguran Tertulis',0,1,'R');
$pdf->Cell(190,5,'Lampiran  : -',0,1,'J');


$pdf-> Ln(15);

$pdf->SetFont('Arial','','11');
$pdf->Cell(190,5,'Kepada Yth,',0,1,'J');
$pdf->Cell(190,5,'Bpk/Ibu Orang Tua Wali',0,1,'J');
$pdf->Cell(190,5,'Di tempat',0,1,'J');

$pdf-> Ln(8);

$pdf->SetFont('Arial','','11');
$pdf->Cell(190,5,'Dengan Hormat,',0,1,'J');
$pdf-> Ln(3);
$pdf->Cell(118,5,'Dengan ini kami sampaikan kepada Bapak/Ibu Wali dari :',0,1,'R');
// $pdf-> Ln(3);
$pdf->Cell(30,6,'Nama',0,0,'R');
$pdf->Cell(22,6,':'.$data['nama_siswa'],0,1,'L');
$pdf->Cell(29.5,6,'Kelas',0,0,'R');
$pdf->Cell(30,6,':'.$data['nama_kelas'],0,1,'L');
$pdf->Cell(145,6,'Bahwa siswa/i tersebut telah melakukan pelanggaran tata tertib berupa : ',0,1,'L');
$pdf-> Ln(3);
while ($kasus = mysqli_fetch_array($querykasus)) {
    $pdf->SetFont('Arial','B','11');
    $pdf->Cell(10,4,''.$kasus['nama_pelanggaran'],0,1,'L');
}





$pdf-> Ln(6);
$pdf->SetFont('Arial','','11');
// $pdf->setmargins(40,0,0);
$pdf->MultiCell(0,5,'       Oleh karena itu kami memberikan surat teguran tertulis. Dengan ini diharapkan agar kiranya Bapak/Ibu Wali lebih mengawasi kegiatan siwa, baik dari segi sikap individu, sosial, dan spiritual. Agar dikemudian hari siswa tidak mengulangi kesalahan yang sama dan atau kesalahan lainnya, sehingga tercipta perilaku siswa yang lebih baik.
Demikian surat ini kami sampaikan, atas kejasamanya kami ucapkan terma kasih.');

$pdf-> SetFont('Arial','',10);
date_default_timezone_set("Asia/Jakarta");
$pdf->SetY(99);
$pdf-> cell(190,120,'',0,1,'R');
$pdf-> cell(190,5,'Cimahi ,      '. date('d M Y'),0,1,'R');
$pdf-> cell(200,5,'Mengetahui,                             ',0,1,'R');
// $pdf-> Ln(20);
$pdf-> cell(200,5,'Waka Kesiswaan                     ',0,1,'R');
$pdf-> Ln(25);
$pdf->Line(160,$pdf->GetY(),200,$pdf->GetY());
$pdf->Cell(159.5,5,'NIP.',0,1,'R');
$pdf-> Output();
?>
