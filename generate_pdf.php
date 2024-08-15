<?php
// define('FPDF_FONTPATH','fpdf/fonts/');
include('fpdf/fpdf.php');
mb_internal_encoding("UTF-8");

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = htmlspecialchars($_POST['name']);
	$id = htmlspecialchars($_POST['id']);
	$address = htmlspecialchars($_POST['address']);
}


class PDF extends FPDF{

	function Header(){
		$this->SetFont('THSarabun','b',15);
		// First cell
		$this->Cell(0, 10, iconv('utf-8','cp874','แบบฟอร์มส่งตัวนักศึกษาฝึกงาน'), 0, 0, 'C');
		
		// Save the current position
		$x = $this->GetX();
		$y = $this->GetY();
		
		// MultiCell for the new cell
		$this->SetXY($x - 10, $y - 5); // Ensure the cursor is at the right position
		$this->MultiCell(21, 8, iconv('utf-8','cp874','คอมพิวเตอร์เอกสาร 1'), 1, 'C');
		// $this->SetXY($x + 20, $y);

		// $this->Ln(5);//ความกว้างบรรทัด
	}
}

class Student{
	public $name;
	public $id;
	public $address;
	public $phone;

	function __construct($name, $id,$address,$phone){
		$this->name = $name;
		$this->id = $id;
		$this->address = $address;
		$this->phone = $phone;
	}
}

class Company{
	public $name;
	public $address;
	public $phone;
	public $fax;

	function __construct($name, $address,$phone,$fax){
		$this->name = $name;
		$this->address = $address;
		$this->phone = $phone;
		$this->fax = $fax;
	}
}

$student = new Student($name, $id,$address,'0812345678');
$company = new Company('บริษัท Perfect Solution จำกัด', $address,'088888888','0777777777');
$pdf = new PDF('P','mm','A4');

$pdf->AddFont('THSarabun','','THSarabunNew.php');
$pdf->AddFont('THSarabun','b','THSarabunNew Bold.php');
$pdf->AddFont('THSarabun','i','THSarabunNew Italic.php');
$pdf->AddFont('THSarabun','bi','THSarabunNew BoldItalic.php');
$pdf->SetMargins(20,10,30); //กั้นหน้ากระดาษ
$pdf->AddPage();

$heightCell = 10;
$heightInput = 5;
$spaceXBox1 = 25;
$check = "4";
$space = 13;
$boxSize = 3;

$x = $pdf->GetX();
$pdf->SetFont('THSarabun','',16);
$pdf->SetY(18);
$pdf->ln(5);
$pdf->Cell(50,8,iconv('utf-8','cp874','เรื่อง ขอหนังสือส่งตัวนักศึกษา'),0,1,'L');
$pdf->ln(3);
//ตัวเลือกสาขาวิชา
$pdf->SetX($spaceXBox1);
$pdf->SetFont('ZapfDingbats','',12);
$pdf->Text($pdf->GetX()+0.5,$pdf->GetY()+3,$check);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetFont('THSarabun','',16);
$pdf->SetXY($x+10, $pdf->GetY()-5.8);
$pdf->Cell(0,8,iconv('utf-8','cp874','COS3101 (CS 391 Job Training)   (ต้องมีหน่วยกิตสะสม 100 หน่วยกิต ใช้ระยะเวลา 240 ชั่วโมง)'),0,1,'L');
$pdf->SetXY($spaceXBox1, $pdf->GetY()+3);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+10, $pdf->GetY()-5.8);
$pdf->Cell(0,8,iconv('utf-8','cp874','INT4107 (Job Training)               (ต้องมีหน่วยกิตสะสม 100 หน่วยกิต ใช้ระยะเวลา 240 ชั่วโมง)'),0,1,'L');
//เรียนหัวหน้าภาควิชา
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','เรียน หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์'),0,1,'L');
$pdf->SetX($x+$space);
//Input ข้อมูลนักศึกษา
$pdf->SetFont('THSarabun','b',16);
$pdf->Text($x+50,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$student->name),0,1,'L'); //<--Student Name
$pdf->Text($x+135,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$student->id),0,1,'L');// <--Student ID
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','ข้าพเจ้า(ชื่อ-สกุล)...........................................................................รหัสประจำตัว.........................................'),0,1,'L');
$pdf->Text($x+15,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$student->address),0,1,'L');//<<--Student Address
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','ที่อยู่..............................................................................................................................................................................'),0,1,'L');
$pdf->Text($x+130,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$student->phone),0,1,'L');//<<--Student Phone
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','................................................................................................................เบอร์โทรศัพท์...............................................'),0,1,'L');
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','มีความประสงค์จะขอหนังสือส่งตัวนักศึกษาไปฝึกงาน เพื่อประกอบการเรียน โดยรายละเอียดดังนี้'),0,1,'L');
$pdf->SetX($x+$space);
//Input ข้อมูลสถานที่ฝึกงาน
$pdf->Text($x+70,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$company->name),0,1,'L');//<<--Company Name
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','1.สถานที่ฝึกงาน (ชื่อ-ที่อยู่)...........................................................................................................................'),0,1,'L');
$pdf->Text($x+20,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$company->address),0,1,'L');//<<--Company Address
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','.....................................................................................................................................................................................'),0,1,'L');
$pdf->Text($x+30,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$company->phone),0,1,'L');//<<--Company Phone
$pdf->Text($x+120,$pdf->GetY()+$heightInput,iconv('utf-8','cp874',$company->fax),0,1,'L');//<<--Company Fax
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','เบอร์โทรศัพท์...............................................................เบอร์โทรสาร(Fax).....................................................'),0,1,'L');
$pdf->SetX($x+$space);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','2.หนังสือส่งตัวฝึกงานให้ส่งถึง (เรียน..............................................................................................................)'),0,1,'L');
$pdf->SetX($x+52);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','(ชื่อบุคคล/ชื่อหัวหน้าหน่วยงาน/ชื่อฝ่าย/ชื่อแผนก)'),0,1,'L');
$pdf->SetX($x+$space);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','3.ฝึกงานเพื่อลงทะเบียนวิชานี้ ภาคการศึกษา................................................................................................'),0,1,'L');
$pdf->SetX($x+$space);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','4.ระยะเวลาฝึกงาน เริ่มตั้งแต่วันที่...................................ถึงวันที่..........................................รวม............ชั่วโมง'),0,1,'L');
$pdf->SetX($x+$space);
$pdf->Cell(55,$heightCell,iconv('utf-8','cp874','5.หลักฐานที่ประกอบการพิจารณา'),0,1,'L');
$y = $pdf->GetY();
$spaceCheckBox = 55;
$spaceAfterCheckBox = 5;
$pdf->SetXY($x+$space+$spaceCheckBox,$y-6);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+$space+$spaceCheckBox+$spaceAfterCheckBox,$y-10);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','ใบรายงานการเช็คเกรด (Check grade) ฉบับจริง 1 ฉบับ'),0,1,'L');
$pdf->SetX($x+$space+$spaceCheckBox);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+$space+$spaceCheckBox+$spaceAfterCheckBox,$y-4);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','สำเนาบัตรประจำตัวนักศึกษา                         1 ฉบับ'),0,1,'L');
$pdf->SetX($x+$space+$spaceCheckBox);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+$space+$spaceCheckBox+$spaceAfterCheckBox,$y+2);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','สำเนาใบเสร็จลงทะเบียนภาคล่าสุด                  1 ฉบับ'),0,1,'L');
$pdf->SetX($x+$space);
$pdf->Cell(25,$heightCell,iconv('utf-8','cp874','6.สถานทีฝึกงาน'),0,1,'L');
$spaceBox6 = 30;
$spaceBox6_2 = 53;
$miniSpace = 5;
$pdf->SetXY($x+$space+$spaceBox6,$y+16);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+$space+$spaceBox6+$miniSpace,$y+12.2);
$pdf->Cell(33,$heightCell,iconv('utf-8','cp874','ได้สถานที่ฝึกงานแล้ว'),0,1,'L');
$pdf->SetXY($x+$space+$spaceBox6+$spaceBox6_2,$y+16);
$pdf->Cell($boxSize,$boxSize,iconv('utf-8','cp874',''),1,1,'C');
$pdf->SetXY($x+$space+$spaceBox6+$spaceBox6_2+$miniSpace,$y+12.2);
$pdf->Cell(33,$heightCell,iconv('utf-8','cp874','ยังไม่ได้สภานที่ฝึกงาน'),0,1,'L');
$pdf->SetX($x+$space+2);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','จึงเรียนมาเพื่อโปรดพิจารณา'),0,1,'L');
$pdf->ln();
$pdf->MultiCell(65, $heightCell, iconv('utf-8', 'cp874', "อนุมัตจัดทำหนังสือส่งตัวฝึกงาน\n....................................................\nหัวหน้าภาควิชาวิทยาการคอมพิวเตอร์\n"), 1, 'C');
$y = $pdf->GetY();
$pdf->SetXY($x+75,$y - 35);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','ลงชื่อนักศึกษา.................................................................'),0,1,'L');
$pdf->SetXY($x+138,$y - 25);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','(......................................................................)'),0,1,'R');
$pdf->SetXY($x+138,$y - 15);
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','วันเดือนปี....................................................................'),0,1,'R');
$pdf->ln(3.5);
$pdf->SetX($x+2);
$pdf->SetFont('','U');
$pdf->Cell(20,$heightCell,iconv('utf-8','cp874','รายละเอียดวิชา'),0,1,'L');
$pdf->SetFont('','');
$pdf->SetX($x+2);
$pdf->Cell(20,$heightCell-2,iconv('utf-8','cp874','COS3101 (Job Training) ฝึกงาน สำหรับนักศึกษารหัส 52 เป็นต้นไปซึ่งใช้หลักสูตร (CS/COS)'),0,1,'L');
$pdf->SetX($x+2);
$pdf->Cell(20,$heightCell-2,iconv('utf-8','cp874','INT4107 (Job Training) ฝึกงานทางเทคโนโลยีสารสนเทศ สำหรับนักศึกษารหัส 55 เป็นต้นไป'),0,1,'L');
$pdf->Output();
?>