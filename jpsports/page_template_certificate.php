<?php
/**
 Template Name: Certificate page
 */
get_header(); 
global $wpdb;
?>
<script>
function validation()
    {
		//var txt_search  = $("#txt_search").val();
		var txt_search=document.getElementById('txt_search').value;
		
		 if(txt_search == '') {			
            jQuery("#txt_search").addClass("error");
        }
        else if(txt_search != ''){			
            jQuery("#txt_search").removeClass("error");
        }
        
        if(txt_search != '')
        {
			return true;
			}
		else
		{
			return false;
			}
      }
</script>
		<!--<div id="primary" class="content-area middle-align">
		<div style="width:100%;text-align:left;"><a href="<?php echo home_url();?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentyfifteen/images/logo.png"></a></div>-->
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '11' ), 'single-post-thumbnail' );  
				?>
	<!--<div id="slider" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">-->
	<div id="slider" style="background:url('<?php echo site_url();?>/wp-content/uploads/2015/09/cropped-1.jpg') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
                	            <div class="top-bar">									
                <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>
		<div class="main-container">
			
         														
			<section class=" contact-form-section-bg" id="section8">
				<div class="contact-form-section middle-align">
					<?php 
						$id=101; 
						$post = get_post($id);
					?>
					<h1><?php echo $post->post_title; ?></h1>
					<div class="certificate_main">
						<div class="certificate_sec">
							<div class="certificate_inner">
								<?php
									$id=92; 
									$post = get_post($id);?>
									<h2><?php echo $post->post_title; ?> (Women's)</h2>
							</div>
							<div class="clear"></div>
							<div class="runnersup">
								<ul>
									<?php
										$Pdf_objSql_qry1 = $wpdb->get_results("select * from user_events WHERE rank1 = '1' and eventid = '92' ");
										$totalRows_PDF_objSql_qry1 = count($Pdf_objSql_qry1);
										if($totalRows_PDF_objSql_qry1 > 0){											
											$Pdf_objSql_qry2 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry1[0]->userid."' ");											
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed7.jpg')."&user_name=".base64_encode($Pdf_objSql_qry2[0]->full_name); 
										} else {
											$pdf_url = '';
										}
									?>
									<li><a href="<?php echo $pdf_url; ?>" target="_blank" >1<sup>st</sup> Prize</a></li>
									<?php
										$Pdf_objSql_qry12 = $wpdb->get_results("select * from user_events WHERE rank2 = '1' and eventid = '92' ");
										$totalRows_PDF_objSql_qry12 = count($Pdf_objSql_qry12);
										if($totalRows_PDF_objSql_qry12 > 0){											
											$Pdf_objSql_qry2 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry12[0]->userid."' ");											
											$pdf_url1 = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed6.jpg')."&user_name=".base64_encode($Pdf_objSql_qry2[0]->full_name); 
										} else {
											$pdf_url1 = '';
										}
									?>
									<li><a href="<?php echo $pdf_url1; ?>" target="_blank" >2<sup>nd</sup> Prize</a></li>
									<?php
										$Pdf_objSql_qry13 = $wpdb->get_results("select * from user_events WHERE rank3 = '1' and eventid = '92' ");
										$totalRows_PDF_objSql_qry13 = count($Pdf_objSql_qry13);
										if($totalRows_PDF_objSql_qry13 > 0){											
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry13[0]->userid."' ");											
											$pdf_url3 = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed4.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else {
											$pdf_url3 = '';
										}
									?>
									<li><a href="<?php echo $pdf_url3; ?>" target="_blank">3<sup>rd</sup> Prize</a></li>
								</ul>
							</div>
						</div>
						<div class="certificate_sec">
							<div class="certificate_inner">
								<?php
									$id=93; 
									$post = get_post($id);?>
									<h2><?php echo $post->post_title; ?> (Men's)</h2>
							</div>
							<div class="clear"></div>
							<div class="runnersup">
								<ul>
									<?php
										$Pdf_objSql_qry1 = $wpdb->get_results("select * from user_events WHERE rank1 = '1' and eventid = '93' ");
										$totalRows_PDF_objSql_qry1 = count($Pdf_objSql_qry1);
										if($totalRows_PDF_objSql_qry1 > 0){											
											$Pdf_objSql_qry2 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry1[0]->userid."' ");											
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed13.jpg')."&user_name=".base64_encode($Pdf_objSql_qry2[0]->full_name); 
										} else {
											$pdf_url = '';
										}
									?>
									<li><a href="<?php echo $pdf_url; ?>" target="_blank" >1<sup>st</sup> Prize</a></li>
									<?php
										$Pdf_objSql_qry12 = $wpdb->get_results("select * from user_events WHERE rank2 = '1' and eventid = '93' ");
										$totalRows_PDF_objSql_qry12 = count($Pdf_objSql_qry12);
										if($totalRows_PDF_objSql_qry12 > 0){											
											$Pdf_objSql_qry2 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry12[0]->userid."' ");											
											$pdf_url1 = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed12.jpg')."&user_name=".base64_encode($Pdf_objSql_qry2[0]->full_name); 
										} else {
											$pdf_url1 = '';
										}
									?>
									<li><a href="<?php echo $pdf_url1; ?>" target="_blank" >2<sup>nd</sup> Prize</a></li>
									<?php
										$Pdf_objSql_qry13 = $wpdb->get_results("select * from user_events WHERE rank3 = '1' and eventid = '93' ");
										$totalRows_PDF_objSql_qry13 = count($Pdf_objSql_qry13);
										if($totalRows_PDF_objSql_qry13 > 0){											
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Pdf_objSql_qry13[0]->userid."' ");											
											$pdf_url3 = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed10.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else {
											$pdf_url3 = '';
										}
									?>
									<li><a href="<?php echo $pdf_url3; ?>" target="_blank">3<sup>rd</sup> Prize</a></li>
								</ul>
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">
					<form class="form-div" action="<?php echo get_site_url(); ?>/certificate/" method="post" accept-charset="UTF-8"  onsubmit="return validation();">
					<?php if($_POST['txt_search'] != ''){
							$search = $_POST['txt_search'];
						} else {
							$search = '';
						}
					 ?>
						User ID: <input class="search_txt" type="text" id="txt_search" name="txt_search" value="<?php echo $search; ?>"> <input class="search_btn" type="submit" name="btn_submit" id="btn_submit" value="Search">
					</form>
					
					<?php
					if($search != ''){						
						$Rows_objSql_qry1 = $wpdb->get_results("select * from user_events WHERE userid = '".$search."' and (eventid = '93' or eventid = '92') ");
						$totalRows_objSql_qry1 = count($Rows_objSql_qry1);
						
						if($totalRows_objSql_qry1 > 0){
							?>							
							<div class="search_list">
								<ul>
								<?php
								foreach ($Rows_objSql_qry1 as $Rows_objSql_qry) { 									
									$post_id = get_post($Rows_objSql_qry->eventid);
									$evant_id= $Rows_objSql_qry->eventid;
									
									if($evant_id == 92){  //6km
										if($Rows_objSql_qry->rank1 != ''){	
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed7.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else if($Rows_objSql_qry->rank2 != ''){
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed6.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else if($Rows_objSql_qry->rank3 != ''){
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed4.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else {
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed2.jpg')."&flag_type=1&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										}
									} else {  //12km
										if($Rows_objSql_qry->rank1 != ''){
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed13.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else if($Rows_objSql_qry->rank2 != ''){
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed12.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else if($Rows_objSql_qry->rank3 != ''){
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed10.jpg')."&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										} else {
											$Pdf_objSql_qry3 = $wpdb->get_results("select * from user WHERE userid = '".$Rows_objSql_qry->userid."' ");
											$pdf_url = get_site_url()."/?page_id=99&img_name=".base64_encode('unnamed1.jpg')."&flag_type=1&user_name=".base64_encode($Pdf_objSql_qry3[0]->full_name); 
										}
									}									
									?>
									<li><a href="<?php echo $pdf_url; ?>" target="_blank" class="download_certi">Download Certificate</a></li>
									<?php
								}
								?>
								</ul>
							</div>
							<?php
						} else{
						?>
						<span>No Data Found</span>
						<?php }
					}
					
					?>
				</div>
				<div class="clear"></div>
			</section>
			<div class="clear"></div>
														
		<!--</div>	-->

<?php get_footer(); ?>
