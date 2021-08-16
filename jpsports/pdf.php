<?php
error_reporting(0);
/**
 Template Name: PDF page
 */
 include_once( 'fpdf.php' );
	$img_name = '';
	$user_name = '';
	if($_GET['img_name'] != ''){
		 $img_name = base64_decode($_GET['img_name']);
	 }
	 if($_GET['user_name'] != ''){
		 $user_name = ucwords(base64_decode($_GET['user_name']));
	 }
	 if($_GET['bib'] != ''){
		 $bib = ucwords(base64_decode($_GET['bib']));
	 }
	 if($_GET['grosstime'] != ''){
		 $grosstime = ucwords(base64_decode($_GET['grosstime']));
	 }
	 if(trim(base64_decode($_GET['event_name'])) != ""){
		$event_name = base64_decode($_GET['event_name']);
	 }
	 
	// below if added by rushi on 25-feb-2016

	if($event_name == 'cyclothon') // this condition will display only cyclothon certificate
	{
		
		$center_text = $user_name;
		$center_text1 = $user_name;
		$image_height = 40;
		$image_width = 200;
		$pdf = new FPDF('P','mm','Letter');
		$pdf->AddPage();
		$start_x = $pdf->GetX();
		$start_y = $pdf->GetY();
		$pdf->Image(get_site_url().'/wp-content/themes/jpsports/cerfiticates/'.$img_name,$start_x+0,$start_y-2,195,260);
		$pdf->SetFont( 'times', '', 15 );
		$pdf->SetX($pdf->lMargin);    
		if($_GET['flag_type'] == 1){
			//$pdf->Cell(0,225,$center_text,0,0,'C');
			$pdf->MultiCell(0,230,$center_text,0,'C');
			$pdf->SetLeftMargin(85);
			$pdf->MultiCell(180,-112,$bib);
		} else if($_GET['flag_type'] == 2){
			$pdf->Cell(0,230,$center_text,0,0,'C');
		}
		else {
		//	$pdf->SetLeftMargin(75);
			$pdf->MultiCell(0,205,$center_text,0,'C');
			$pdf->SetLeftMargin(85);
			$pdf->MultiCell(180,-65,$bib);
			$pdf->MultiCell(180,90,$grosstime);
		}
		$pdf->Output("pexeso".date("Y-m-d"),"I");
		
	} else if($event_name == 'cyclothon2017') // this condition will display only cyclothon 2017 certificate
	{
		$center_text = $user_name;
		$center_text1 = $user_name;
		$image_height = 40;
		$image_width = 200;
		$pdf = new FPDF('P','mm','Letter');
		$pdf->AddPage();
		$start_x = $pdf->GetX();
		$start_y = $pdf->GetY();
		$pdf->Image(get_site_url().'/wp-content/themes/jpsports/cerfiticates/2017/'.$img_name,$start_x+0,$start_y-2,195,260);
		$pdf->SetFont( 'times', '', 15 );
		$pdf->SetX($pdf->lMargin);    
		if($_GET['flag_type'] == 1){
			//$pdf->Cell(0,225,$center_text,0,0,'C');
			$pdf->SetLeftMargin(20);
			$pdf->MultiCell(0,180,$center_text,0,'C');
			//$pdf->SetLeftMargin(107);
			$pdf->SetLeftMargin(100);
			$pdf->MultiCell(0,-31,$bib);						
			$pdf->MultiCell(0,62,$grosstime);
		} else if($_GET['flag_type'] == 2){
			$pdf->SetLeftMargin(20);
			$pdf->Cell(0,205,$center_text,0,0,'C');
		}
		else {
		//	$pdf->SetLeftMargin(75);
			$pdf->SetLeftMargin(20);
			$pdf->MultiCell(0,180,$center_text,0,'C');
			$pdf->SetLeftMargin(107);
			$pdf->MultiCell(0,-31,$bib);
		}
		$pdf->Output("pexeso".date("Y-m-d"),"I");
		
	}
	else 
	{
		 
		$center_text = $user_name;
		$image_height = 40;
		$image_width = 200;
		$pdf = new FPDF('P','mm','Letter');
		$pdf->AddPage();
		$start_x = $pdf->GetX();
		$start_y = $pdf->GetY();
		$pdf->Image(get_site_url().'/wp-content/themes/jpsports/cerfiticates/'.$img_name,$start_x+0,$start_y-2,195,260);
		$pdf->SetFont( 'times', '', 15 );
		$pdf->SetX($pdf->lMargin);    
		if($_GET['flag_type'] == 1){
			$pdf->Cell(0,225,$center_text,0,0,'C');
		} else {
			$pdf->Cell(0,210,$center_text,0,0,'C');
		}
		$pdf->Output("pexeso".date("Y-m-d"),"I"); 
	}
?>
