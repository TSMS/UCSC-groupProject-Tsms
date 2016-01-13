<?php
	require("fpdf/fpdf.php");
	include_once("pdfCalculations.php");

	class PDF extends FPDF{
		function Header(){
			$this->Image("logo/logo.png", 55, 2, 100, 20);
		}

		function Footer(){
			$this->SetY(-7);
			$this->SetX(-40);
			$this->SetFont("Arial", "", 7);
			$this->Cell(0, 10, "Tea Supply Management System");
			$this->SetX(1);
			$this->Cell(0, 10, "If you have any doubt or complains you should inform that to the office within a month");
			$this->SetY(-17);
			$this->SetX(10);
			$this->SetFont("Times", "", 10);
			$this->Cell(0, 5, "I assure above details are true and I get the money");
			$this->Ln(6);
			$this->Cell(65, 5, "Signature :", 0);
			$this->Cell(65, 5, "Date :", 0);
			$this->SetY(-15);
			$this->SetX(-60);
			$this->Cell(0, 5, "__________________________",0, 0, "C");
			
			$this->SetY(-10);
			$this->SetX(-60);
			$this->Cell(0, 4, "Transporter Signature", 0, 0, "C");
		}

		function PDFBorder(){
			$this->Rect(2, 2, 206, 143, "D");
		}

		public function Contents($row){

			date_default_timezone_set('Asia/Colombo'); //set the time zone to Colombo time
			$dt = new DateTime(); //create DateTime object

			$this->SetY(18);
			$this->SetFont("Times", "", 10);
			$this->Ln(6);
			$this->Cell(28, 4, "Month of supply :", 0);
			$this->Cell(28, 4, $dt->format('M'), 0); //parameter
			$this->Cell(12, 4, "Date :", 0);
			$this->Cell(25, 4, $dt->format('y-m-d'), 0); //parameter
			$this->Ln(4);
			$this->Cell(28, 4, "Sup. Code :", 0);
			$this->Cell(28, 4, $row['supp_code'], 0); //parameter
			$this->Cell(12, 4, "Name :", 0);
			$this->Cell(81, 4, $row['f_name']." ".$row['l_name'], 0); //parameter
			$this->Ln(6);


			$this->Cell(31, 4, "Supplied tea leaves :", 0);
			$this->Cell(20, 4, $row['total_supp_kgs'], 0); //parameter
			$this->Cell(27, 4, "Price of 1kg : Rs.", 0);
			$this->Cell(15, 4, 50, 0); //parameter IN HERE 50 IS A DUMY DATA> WE SHOULD ORGANIZE THIS
			$suppliedTotal = Calculations::calculateSuppliedTotal($row['total_supp_kgs'], 50);
			$this->Cell(30, 4, $suppliedTotal, 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(27, 4, "Direct additions :", 0);
			$this->Cell(96, 4, $row['direct_addition'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(27, 4, "Other additions :", 0);
			$this->Cell(96, 4, $row['other_addition'], 0, 0, "R"); //parameter
			$this->Ln(5);
			$mothlyTotalIncome = Calculations::total($suppliedTotal, $row['direct_addition'], $row['other_addition']);
			$this->Cell(27, 4, "Total :", 0);
			$this->Cell(96, 4, number_format($mothlyTotalIncome, 2), 0, 0, "R"); //parameter
			$this->Ln(6);


			$this->SetFont("Times", "B", 12);
			$this->Cell(48, 4, "Abscissions", 0);
			$this->Ln(6);
			$this->SetFont("Times", "", 10);
			$this->Cell(48, 4, "Last month arrears :", 0);
			$this->Cell(30, 4, $row['last_month_debt'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Loan :", 0);
			$this->Cell(30, 4, $row['debt'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Advancement :", 0);
			$this->Cell(30, 4, $row['advance'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "This month manure installment :", 0);
			$this->Cell(30, 4, $row['manure'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Tea :", 0);
			$this->Cell(30, 4, $row['tea'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Stationaries :", 0);
			$this->Cell(30, 4, $row['stationary'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Transport charge :", 0);
			$this->Cell(30, 4, $row['transport'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Other/scripts :", 0);
			$this->Cell(30, 4, $row['other_bscissions'], 0, 0, "R"); //parameter
			$this->Ln(4);
			$this->Cell(48, 4, "Stamp :", 0);
			$this->Cell(30, 4, $row['stamp'], 0, 0, "R"); //parameter
			$this->Ln(5);
			$this->Cell(48, 4, "Total abscissions :", 0);
			$totalAbscissions = Calculations::totalAbscissions($row['last_month_debt'], $row['debt'], $row['advance'], $row['manure'], $row['tea'], $row['stationary'], $row['transport'], $row['other_bscissions'], $row['stamp']);
			$this->Cell(75, 4, number_format($totalAbscissions, 2), 0, 0, "R"); //parameter
			$this->Ln(5);

			$this->SetFont("Times", "B", 12);
			$this->Cell(48, 4, "Balance :", 0);
			$balance = Calculations::balance($mothlyTotalIncome, $totalAbscissions);
			$this->Cell(75, 4, "Rs. ".number_format($balance, 2), 0, 0, "R"); //parameter
			$this->Ln(10);

			$this->SetFont("Times", "B", 10);
			$this->Cell(20, 4, "Land Details", 0, 1);
			$this->SetFont("Times", "", 10);
			$this->Cell(20, 4, "Land name :", 0);
			$this->Cell(75, 4, $row['estate_name'], 0, 0, "L"); //parameter
			$this->Ln(4);
			$this->Cell(20, 4, "Land area :", 0);
			$this->Cell(75, 4, $row['size_of_estate'], 0, 0, "L"); //parameter
			$this->Ln(4);
			$this->Cell(20, 4, "Reg. No. :", 0);
			$this->Cell(75, 4, $row['reg_no'], 0, 0, "L"); //parameter
			$this->Ln(1);
		}

		public function Lines(){
			$this->Line(90, 46, 132, 46);
			$this->Line(62, 95, 88, 95);
			$this->Line(90, 100, 132, 100);
			$this->Line(90, 105.5, 132, 105.5);
			$this->Line(90, 106, 132, 106);
		}

		//This function create a bill for a supplier
		public function createPage($pdf, $row){
			$pdf->AddPage();
			$pdf->PDFBorder();
			$pdf->Lines();
			$pdf->Contents($row);
		}

		//This function create the monthly bill PDF
		public function createAPDF($supCode, $unformatedDate){
			$pdf = new PDF("L", "mm", "A5");
			PDFDBOperations::getValues($pdf, $supCode, $unformatedDate);			
			$pdf->output();
		}
		public function createAllPDF($unformatedDate){
			$pdf = new PDF("L", "mm", "A5");
			PDFDBOperations::getValues($pdf,"",$unformatedDate);			
			$pdf->output();
		}
		//Create supplier code
		/*
		public function createSupCode($num){
			if(strlen("{$num}") < 4){
				$code = $num;
				for($i = strlen("{$num}"); $i <= 4; $i++){
					$code = "0".$code;
				}
				return $code;
			}
		}*/
	}
?>