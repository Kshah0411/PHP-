<?php
error_reporting(0);
/**
 Template Name: PDF page old
 */
 include_once( 'fpdf.php' );
     if($_GET['img_name'] != ''){
		 $img_name = base64_decode($_GET['img_name']);
	 }
     if($_GET['user_name'] != ''){
		 $user_name = ucwords(base64_decode($_GET['user_name']));
	 }
     
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
    
?>
