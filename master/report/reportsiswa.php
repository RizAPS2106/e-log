<?php
include '../../connection.php';
$idsis=$_GET['id'];
$sqldata = "SELECT siswa.*, kasus.*, pelanggaran.*, kelas.*, jurusan.* FROM ((((siswa INNER JOIN kasus ON kasus.id_siswa=siswa.id_siswa) INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) INNER JOIN kelas ON kelas.id_kelas=siswa.id_kelas) INNER JOIN jurusan ON jurusan.id_jurusan=kelas.id_jurusan) WHERE siswa.nama_siswa='$idsis'";

$query = mysqli_query($conn, $sqldata);
$data = mysqli_fetch_array($query);

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
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'Daftar Pelanggaran',0,1,'C');

$pdf-> Ln(10);

$pdf->SetFont('Arial','',12);
$pdf->Cell(20,6,'NIS',0,0,'L');
$pdf->Cell(30,6,':'.$data['nis'],0,1,'L');
$pdf->Cell(20,6,'Nama',0,0,'L');
$pdf->Cell(30,6,':'.$data['nama_siswa'],0,1,'L');
$pdf->Cell(20,6,'Kelas',0,0,'L');
$pdf->Cell(30,6,':'.$data['nama_kelas'],0,1,'L');
$pdf->Cell(20,6,'Jurusan',0,0,'L');
$pdf->Cell(30,6,':'.$data['nama_jurusan'],0,1,'L');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf-> Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'NO',1,0,'C');
$pdf->Cell(30,6,'TANGGAL',1,0,'C');
$pdf->Cell(115,6,'PELANGGARAN',1,0,'C');
$pdf->Cell(30,6,'POIN',1,1,'C');


$sqldetail = "SELECT siswa.*, pembimbing.*, kasus.*, pelanggaran.* FROM (((kasus INNER JOIN siswa ON kasus.id_siswa=siswa.id_siswa) INNER JOIN pembimbing ON kasus.id_pembimbing=pembimbing.id_pembimbing) INNER JOIN pelanggaran ON pelanggaran.id_pelanggaran=kasus.id_pelanggaran) WHERE siswa.nama_siswa='$idsis'";
$query2 = mysqli_query($conn, $sqldetail);

$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(255, 0, 0);
$no=1;

while ($row = mysqli_fetch_array($query2)){
    $pdf->Cell(15,6,$no++,1,0,'C');
    $pdf->Cell(30,6,$row['tanggal'],1,0,'C');
	$pdf->Cell(115,6,$row['nama_pelanggaran'],1,0,'L');
	$pdf->Cell(30,6,$row['point'],1,1,'C');
}

$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'Sisa Point',1,0,'C');
$pdf->Cell(30,6,$data['sisa_point'],1,1,'C');
$pdf-> Ln(15);
$pdf->SetFont('Arial','',12);
$pdf-> cell(188.5,10,'Cimahi ,'. date('d M Y'),0,1,'R');
$pdf->Cell(173.5,5,'Mengetahui,',0,1,'R');
$pdf->Cell(183,5,'Waka Kesiswaan',0,1,'R');
$pdf-> Ln(25);
$pdf->Line(160,$pdf->GetY(),200,$pdf->GetY());
$pdf->Cell(159.5,5,'NIP.',0,1,'R');

$pdf-> Output();
?>