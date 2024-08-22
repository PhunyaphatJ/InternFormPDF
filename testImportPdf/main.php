<?php
use setasign\Fpdi\Fpdi;

require_once('vendor/autoload.php');
require '../database/db_connection.php';


if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$id = $_POST['id'];
}

$sql = "SELECT * FROM student WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$conn = null;

$pdf = new Fpdi();
$pdf->AddFont('THSarabun','','THSarabunNew.php');
$pdf->AddFont('THSarabun','b','THSarabunNew Bold.php');
// $pdf->AddFont('THSarabun','i','vendor/setasign/fpdf/font/THSarabunNew Italic.php');
// $pdf->AddFont('THSarabun','bi','vendor/setasign/fpdf/font/THSarabunNew BoldItalic.php');
$pdf->AddPage();
$pdf->setSourceFile("เอกสารฝึกงาน01.pdf");
$pdf->SetFont('THSarabun','b',15);
$id = $pdf->importPage(1);
$pdf->useTemplate($id);
$pdf->SetXY(70,49);
$pdf->Cell(20,5,iconv('utf-8','cp874',$data['name']),0,1,'L'); 
$pdf->SetXY(155,49);
$pdf->Cell(20,5,iconv('utf-8','cp874',$data['phone']),0,1,'L'); 
$pdf->Output()



?>