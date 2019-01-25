<?php
require('fpdf17/fpdf.php');
//$con=mysqli_connect('localhost','root','');
//mysqli_select_db($con,'phpfpdftutorial');
require '../connection/dbconnect.php';

		
		
class PDF extends FPDF {

	private $name;
	private $image;
	private $peso;
	private $address;
	private $menuid;
	private $alloted;


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
    public function setMenuId($menuid){
        $this->menuid = $menuid;
    }
    public function getMenuId(){
        return $this->menuid;
    }
     public function setAlloted($alloted){
        $this->alloted = $alloted;
    }
    public function getAlloted(){
        return $this->alloted;
    }
    public function setPeso($peso){
        $this->peso = $peso;
    }
    public function getPeso(){
        return $this->peso;
    }

	function Header(){
		
		
		$menuName = ''.$_GET['menuName'].'';
		$dateNow = "Date: ".date('y-m-d');
		$alloted = ' P '. $GLOBALS['alloted'];
		$total_expenses = "Total Expenses: P ". $GLOBALS['expenses'].'.00';
		$remaining = "Remaining: P ". $GLOBALS['remaining'].'.00';
		$address = $this->getAddress();
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
			
		//put logo ./images/noimage.png
		$this->Image($this->getImage(),85,10,40,30);
		
		$this->SetY(40);
		$this->Cell(0,5,$this->getName(),0,1,'C');
		$this->SetX($this->lMargin);

		$this->SetFont('Arial','',10);
		$this->Cell(0,10,$address,0,1,'C');		
		$this->Cell(0,5,$dateNow,0,2,'C');

		$this->SetY(75);
		
		$this->SetX(30);		
		$this->SetFont('Arial','B',10);
		$this->Cell(100,10,'Menu Name: ',0,0);
		$this->Cell(50,10,$menuName,0,1);
		$this->SetX(30);
		$this->Cell(100,8,'Cash Beginning: ',0,0);
		$this->Cell(50,8,$alloted,0,1);

		$this->SetX(30);
		$this->Cell(100,8,'Less: ',0,1);

		$this->SetX(38);
		$this->Cell(100,8,'Expenses: ',0,1);

		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:

		$this->Ln(5);
		
		
		
		/*
		$this->Cell(30,5,'Ingridient',1,0,'',false);
		$this->Cell(45,5,'qty',1,0,'',false);		
		//$this->Cell(15,5,'Budget',1,0,'',true);
		$this->Cell(25,5,'',1,1,'',false);		
		*/
	}
	function Footer(){

		$total_expenses = " P ". $GLOBALS['expenses'];
		$remaining = " P ". $GLOBALS['remaining'];
		$prepared_by = $GLOBALS['prepared'];
		$cssdo_incharge = $GLOBALS['cssdo'];

		$this->Cell(91,5,'',0,1);

		$this->SetX(38);	
		$this->SetFont('Arial','B',10);
		$this->Cell(91,10,'Total Expenses: ',0,0);
		$this->Cell(20 ,10,$total_expenses,'B',1,1);
		
		$this->Cell(91,5,'',0,1);
		$this->SetFont('Arial','',10);
		$this->SetX(30);	

		
		$this->Cell(99,8,'Excess Cash on Hand: ',0,0);
		$this->SetFont('Arial','B',10);
		$this->Cell(20 ,8,$remaining,'B',1,1);



		$this->SetFont('Arial','',10);

		$this->SetY(-40);
		$this->SetX(30);
		$this->Cell(99,5,'Prepared by: ',0,0);	
		$this->Cell(99,5,'Noted by: ',0,1);	
		$this->SetX(30);
		$this->Cell(99,5,$prepared_by,0,0);	
		$this->Cell(99,5,$cssdo_incharge,0,1);
		$this->SetX(30);
		$this->Cell(99,5,'DSWD in-charge: ',0,0);	
		$this->Cell(99,5,'CSSDO in-charge: ',0,1);	

		
		//$this->Cell(50,8,$remaining,0,1);
		//add table's bottom line
		//$this->Cell(115,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}

//initialize here to be able to read from pdf class
$sqlschool ="SELECT * FROM tbl_school ";
	$query=mysqli_query($mysqli,$sqlschool);
	$school_name ="";
	$address="";
	$image_path="";
	$alloted = "";
	$menuId = $_GET['menuId'];
	$expenses = 0;
	$remaining = 0;
	$prepared_by = "";
	$cssdo_incharge = "";
//initialize here to be able to read from pdf class

while($data=mysqli_fetch_array($query)){
	$school_name =$data['school_name'];
	$address=$data['address'];
	$image_path=$data['image_path'];
}

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//$menuid = $this->getMenuId();

$sql = "SELECT ingridient,quantity,budget,liquidation,alloted_budget,total_budget FROM tbl_ingridients INNER JOIN tbl_menu ON tbl_menu.id = tbl_ingridients.menu_id where menu_id='$menuId' ";

$query=mysqli_query($mysqli,$sql);
while($row=mysqli_fetch_array($query)){

	$alloted = $row['alloted_budget'];
	$expenses += $row['liquidation'];
}
$remaining = $alloted - $expenses;

// initialize person in charge

$sql_incharge = "SELECT firstname,middlename,lastname FROM tbl_menu INNER JOIN tbl_admin ON tbl_menu.prepared_by_id = tbl_admin.id WHERE tbl_menu.id = '$menuId'";
$query_incharge = mysqli_query($mysqli,$sql_incharge);
while($row_incharge = mysqli_fetch_array($query_incharge)){

	$prepared_by = $row_incharge['firstname'].' '.$row_incharge['middlename'].' '.$row_incharge['lastname'];
}

//inintialize CSSDO in charge
$sql_cssdo = "SELECT * FROM tbl_admin WHERE privilege =  'CSSDO' AND deleted = 0 LIMIT 1";
$query_cssdo = mysqli_query($mysqli,$sql_cssdo);
while($row_cssdo = mysqli_fetch_array($query_cssdo)){

	$cssdo_incharge = $row_cssdo['firstname'].' '.$row_cssdo['middlename'].' '.$row_cssdo['lastname'];
}

$pdf = new PDF('P','mm','A4'); //use new class
$GLOBALS['alloted'] = $alloted;
$GLOBALS['expenses'] = $expenses;
$GLOBALS['remaining'] = $remaining;
$GLOBALS['prepared'] = $prepared_by;
$GLOBALS['cssdo'] = $cssdo_incharge;
//initialize get variable



$pdf->setName($school_name);
$pdf->setAddress($address);
$pdf->setImage('./images/'.$image_path);
//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage('P');

$pdf->SetFont('Arial','',10);





$sql = "SELECT * FROM tbl_ingridients where menu_id='$menuId'";


$query=mysqli_query($mysqli,$sql);
while($data=mysqli_fetch_array($query)){

	$pdf->SetX(48);
	$pdf->Cell(30,10,$data['ingridient'],'',0);
	//$pdf->Cell(45,10,$data['quantity'],'',0,'C');	
	$pdf->Cell(40,10,'',0,'C');	
	//$pdf->Cell(15,10,'P '.$data['budget'],'LR',0,'C');
	$pdf->Cell(20,10,'P '.$data['liquidation'],'',1,'L');
	
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
	$pdf->SetX(48);
	$pdf->Cell(30,0,'','T',0,'L',true);
	//$pdf->Cell(45,10,$data['quantity'],'',0,'C');	
	$pdf->Cell(40,0,'',0,'C');	
	//$pdf->Cell(15,10,'P '.$data['budget'],'LR',0,'C');
	$pdf->Cell(20,0,''.'','T',1,'L',true);


$pdf->Output();
?>
