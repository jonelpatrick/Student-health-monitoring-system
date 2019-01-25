<?php
require('fpdf17/fpdf.php');
//$con=mysqli_connect('localhost','root','');
//mysqli_select_db($con,'phpfpdftutorial');
require '../connection/dbconnect.php';

		
		
class PDF extends FPDF {

	private $name;
	private $image;
	private $address;
	

	public function setAddress($address){
        $this->address = $address;
    }
    public function getAddress(){
        return $this->address;
    }
	public function setImage($image){
        $this->image = $image;
    }
    public function getImage(){
        return $this->image;
    }

	public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
  

	function Header(){
	

		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo ./images/noimage.png
		$this->Image($this->getImage(),10,10,10);
		
		$this->Cell(100,10,$this->getName(),0,1);
		$this->SetFont('Arial','',10);
		$this->Cell(100,10,$this->getAddress(),0,1);
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
		$this->SetFont('Arial','B',11);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		
		$this->Cell(30,5,'Date',1,0,'',true);
		$this->Cell(45,5,'Name',1,0,'',true);		
		$this->Cell(15,5,'Age',1,0,'',true);
		$this->Cell(25,5,'Gender',1,0,'',true);
		$this->Cell(25,5,'Section',1,0,'',true);
		$this->Cell(25,5,'BMI',1,0,'',true);
		$this->Cell(25,5,'Class',1,1,'',true);
		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


$sqlschool ="SELECT * FROM tbl_school ";
$query=mysqli_query($mysqli,$sqlschool);
$school_name ="";
$address="";
$image_path="";

while($data=mysqli_fetch_array($query)){
	$school_name =$data['school_name'];
	$address=$data['address'];
	$image_path=$data['image_path'];
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//initialize get variable
$fromDate=$_GET['fromDate'];
$toDate=$_GET['toDate'];
$health=$_GET['health'];


$pdf->setName($school_name);
$pdf->setAddress($address);
$pdf->setImage('./images/'.$image_path);
//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

if($fromDate!="" && $toDate!=""){

	if($health == 'all'){

		$sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass,tbl_health_profile.bmi hfbmi FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.date_check_up BETWEEN '$fromDate' AND '$toDate'";	                                
		}else{
			 $sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass,tbl_health_profile.bmi hfbmi FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.date_check_up BETWEEN '$fromDate' AND '$toDate' AND tbl_health_profile.classification='$health'";
		}

}else{
	if($health == 'all'){
		 $sql = "SELECT tbl_health_profile.id hfid,tbl_health_profile.date_check_up hfdate,tbl_student.firstname sfname,tbl_student.middlename smname,tbl_student.lastname slname,tbl_student.age sage,tbl_student.gender sgender,tbl_section.section ssection,tbl_health_profile.classification hfclass,tbl_health_profile.bmi hfbmi FROM `tbl_health_profile` INNER JOIN tbl_student on tbl_health_profile.student_id=tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id ORDER BY tbl_health_profile.id desc ";	                                
	}else{
		$sql = "SELECT tbl_health_profile.id hfid, tbl_health_profile.date_check_up hfdate, tbl_student.firstname sfname, tbl_student.middlename smname, tbl_student.lastname slname, tbl_student.age sage, tbl_student.gender sgender, tbl_section.section ssection, tbl_health_profile.classification hfclass,tbl_health_profile.bmi hfbmi FROM  `tbl_health_profile` INNER JOIN tbl_student ON tbl_health_profile.student_id = tbl_student.id INNER JOIN tbl_section ON tbl_student.class_section_id=tbl_section.id WHERE tbl_health_profile.classification='$health' ORDER BY tbl_health_profile.id desc";	
	}
}

$query=mysqli_query($mysqli,$sql);
while($data=mysqli_fetch_array($query)){

	$name = $data['sfname']." ".$data['smname']." ".$data['slname'];
	 $gender="";
    if($data['sgender']==1){
      $gender="Male";
    }else{
      $gender="Female";
    }

	$pdf->Cell(30,5,$data['hfdate'],'LR',0);
	$pdf->Cell(45,5,$name,'LR',0);	
	$pdf->Cell(15,5,$data['sage'],'LR',0);
	$pdf->Cell(25,5,$gender,'LR',0);
	$pdf->Cell(25,5,$data['ssection'],'LR',0);
	$pdf->Cell(25,5,$data['hfbmi'],'LR',0);
	$pdf->Cell(25,5,$data['hfclass'],'LR',1);
	/*
	if($pdf->GetStringWidth($data['email']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(65,5,$data['email'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(65,5,$data['email'],'LR',0);
	}
	$pdf->Cell(60,5,$data['address'],'LR',1);
	*/
}

$pdf->Output();
?>
