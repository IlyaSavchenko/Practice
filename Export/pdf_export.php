<?php @session_start();
	function main() {
		$table = $_SESSION["export"];
		if ($table != null)
			CreateFile($table);
		else 
			echo "We so sorry, but we does not have information for export :(";
	}

	function CreateFile($table) {
		$pdf = new FPDF();
		$pdf->SetFont('Arial', '', 24);
		$pdf->AddPage();
		$pdf->Cell(10, 10, "Marks for " . $table["name"], 15);
		$pdf->Ln();

		$pdf->SetXY(10, 30);

		$pdf->SetFont('Arial', '', 16);
	    $pdf->SetFillColor(256, 256, 256);
	    $pdf->SetTextColor(0);
	    $pdf->SetDrawColor(92, 92, 92);
	    $pdf->SetLineWidth(.3);

	    $pdf->Cell(70, 7,"Subject", 1, 0, 'C', true); 
	    $pdf->Cell(20, 7,"Mark", 1, 0, 'C', true);
	    $pdf->Ln();

	    foreach ($table["marks"] as $key => $value) {
			if ($value >= 80)
	    		$pdf->SetFillColor(56, 256, 56);
			else if ($value >= 55)
    			$pdf->SetFillColor(120, 240, 256);
			else if ($value >= 30)
    			$pdf->SetFillColor(256, 230, 0);
			else if ($value > 0)
    			$pdf->SetFillColor(256, 20, 20);
    		else
    			$pdf->SetFillColor(256, 256, 256);
	    	$pdf->Cell(70, 7, $key, 1, 0, 'C' ,true);
		    $pdf->Cell(20, 7, $value, 1, 0, 'C', true);
		    $pdf->Ln();
	    }

		$pdf->Output('Marks for ' . $table["name"], 'I');
	}

	define('FPDF_FONTPATH','../FPDF/font/');
	require('../FPDF/fpdf.php');
	main();
?>