<?php
//include database file and fpdf library 
include_once("db.php");
include_once('libraries/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(60,10,'Salary Slip',1,0,'C');
    // Line break
    $this->Ln(20);
}
// Page footer
function Footer()
{	
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    //Signature
    $this->Image('icon/sample_signature.jpg',130,240,70);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$display_heading = array('id'=>'ID', 'emp_name'=> 'Name', 'emp_id'=> 'Employee ID', 'pf_no'=> 'PF Number', 'salary'=> 'Salary', 'hra'=> 'HRA', 'pf'=> 'PF', 'pt'=> 'PT', 'esi'=> 'ESI' );

$result = $conn->query("SELECT id,emp_name, emp_id, pf_no, salary, hra, pf, pt, esi FROM employee_details where id='".$_GET['id']."'");
$header = $conn->query("SHOW columns FROM employee_details");

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',9);

$header_row = $header->fetch_assoc();
$row = $result->fetch_assoc();

foreach($header as $heading) {

	$pdf->Cell(21,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
{
	$pdf->Cell(21,12,$column,1);
}
}
$pdf->Output();
?>