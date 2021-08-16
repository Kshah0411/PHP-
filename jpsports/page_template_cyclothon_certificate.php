<?php
/**
 Template Name: Cyclothon Certificate page
 */
get_header();
session_start();
$_GET['reg'] = 157;
?>
<script>
function validation()
    {
		//var txt_search  = $("#txt_search").val();
		var txt_search=document.getElementById('txt_search').value;
		var txt_name=document.getElementById('txt_name').value;
		
		 if(txt_search == '') {			
            jQuery("#txt_search").addClass("error");
        }
        else if(txt_search != ''){			
            jQuery("#txt_search").removeClass("error");
        }
        
        /*if(txt_name == '') {			
            jQuery("#txt_search").addClass("error");
        }
        else if(txt_name != ''){			
            jQuery("#txt_search").removeClass("error");
        }*/
        
        
        if(txt_search != '' || txt_name != '')
        {
			return true;
			}
		else
		{
			return false;
			}
      }
</script>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '153' ), 'single-post-thumbnail' );  
				?>
	
			<div id="slider">
				<div class="header-img" style="background-color:#f1ce74;">
				<img src="<?php echo $image[0]; ?>">
				</div>
           
			<div class="main-container">
				
				
			
			
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">

				</div>
				<div class="clear"></div>
			
			</section>			
			
			<!-- Certificate section  -->
				<section class="page-container" id="section_certificate">
					<h1>Certificate</h1>
					<section class="cyclothon_certi contact-form-section-bg">
						<div class="contact-form-section middle-align">				
						<div class="clear"></div>
						<div class="certi_search">
							<form class="form-div" action="<?php echo get_site_url(); ?>/cyclothon-certificate/" method="post" accept-charset="UTF-8"  onsubmit="return validation();">
							<?php if($_POST['txt_search'] != ''){
									$search = $_POST['txt_search'];
								} else {
									$search = '';
								}
								
								if($_POST['txt_name'] != ''){
									$name = $_POST['txt_name'];
								} else {
									$name = '';
								}
							 ?>
								BIB No: <input class="search_txt" type="text" id="txt_search" name="txt_search" value="<?php echo $search; ?>">
								Name: <input class="search_txt" type="text" id="txt_name" name="txt_name" value="<?php echo $name; ?>"> <input class="search_btn" type="submit" name="btn_submit" id="btn_submit" value="Search">
								<br/><br/><small><b>Note:</b> Name search option is applicable for <b> Green Ride,Kids Ride & Fashion Ride</b></small>
							</form>
							
							<?php
							if($search != ''){						
								//echo "select * from user_events WHERE userid = '".$search."' ";exit;
								//echo "select * from wp_result WHERE bib_no = '".$search."'" ;exit;
								$search  = "select * from wp_result WHERE bib_no = '".$search."' AND (event !='Green Ride')";
								$s_query = mysql_query($search); 
								if(mysql_num_rows($s_query) <= 0)
								{
									echo "No Data Found";
								}
								else{
								while ($row = mysql_fetch_array($s_query)){
									$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon')."&img_name=".base64_encode($row['image_url'])."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
									if($row['gender']=='M')
									{
										//echo "Male";
									 }
									else{
										//echo "Female";
										}
									echo 
												/*<li style="list-style:none;"><label>Gender: </label>'.$row['gender'].'</li>*/	
										'<div class="certi_list">
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>BIB No: </label>'.$row['bib_no'].'</li>
												<li style="list-style:none;"><label>NAME: </label>'.$row['full_name'].'</li>
												<li style="list-style:none;"><label>EVENT NAME: </label>'.$row['event'].'</li>
												
												
												</ul>
											</div>
										
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>EVENT CATEGORY: </label>'.$row['event_category'].'</li>
												<li style="list-style:none;"><label>GROSS TIME: </label>'.$row['grosstime'].'</li>
												<li style="list-style:none;"><label>CATEGORY RANK: </label>'.$row['category_rank'].'</li>
												</ul>
											</div>
											<ul class="certificate_detail" style="clear:both;padding:10px 0px;margin-left:0px;">
												<li style="list-style:none;"><a href="'.$pdf_url.'" target="_blank" class="download_certi">Download Certificate</a></li>
											</ul>
										</div>';
							}
							
							
						}
					}
					
					else if($name != ''){						
								//echo "select * from user_events WHERE userid = '".$search."' ";exit;
								//echo "select * from wp_result WHERE bib_no = '".$search."'" ;exit;
								$search  = "select * from user WHERE full_name = '".$name."' AND (category ='Kids Ride' OR category ='Fashion Ride') AND status ='success' group by full_name";
								$s_query = mysql_query($search); 
								
								if(mysql_num_rows($s_query) <= 0)
								{
									$search  = "select * from wp_result WHERE full_name = '".$name."' AND `event` = 'Green Ride'";
									$s_query = mysql_query($search);
								}
								
								if(mysql_num_rows($s_query) <= 0)
								{
									echo "No Data Found";
								}
								else{
								while ($row = mysql_fetch_array($s_query)){
									$pdf_url = ''; //get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon')."&img_name=".base64_encode($row['image_url'])."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
									
									//echo "Male";
									if($row['category']=='Kids Ride'){
										$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon')."&flag_type=2&img_name=".base64_encode('completion-Fashion-2.jpg')."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
									} 
									else if($row['category']=='Fashion Ride'){
										$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon')."&flag_type=2&img_name=".base64_encode('completion-Fashion-1.jpg')."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
									}
									else if($row['event']=='Green Ride'){
										$row['category'] = $row['event'];
										if($row['gender'] == 'M'){
											$pdf_url = get_site_url()."/?page_id=99&flag_type=1&event_name=".base64_encode('cyclothon')."&img_name=".base64_encode('Green-Ride-2.jpg')."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
										else
										{
											$pdf_url = get_site_url()."/?page_id=99&flag_type=1&event_name=".base64_encode('cyclothon')."&img_name=".base64_encode('Green-Ride-1.jpg')."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									
									}
									echo  '<div class="certi_list">
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>NAME: </label>'.ucfirst($row['full_name']).'</li>
												</ul>
											</div>
										
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>EVENT NAME: </label>'.ucfirst($row['category']).'</li>
												</ul>
											</div>
											
											<ul class="certificate_detail" style="clear:both;padding:10px 0px;margin-left:0px;">
												<li style="list-style:none;"><a href="'.$pdf_url.'" target="_blank" class="download_certi">Download Certificate</a></li>
											</ul>
											
										</div>';
							}
							
							
						}
					}
					
					?>
						</div>
						<div class="clear"></div>
					</section>
				</section>
			<!-- End certificate section -->
			<?php 
			/* end Condition for certificate form */
			?>
			<div class="clear"></div>			
			
		
			
															
		<!--</div>	-->

<?php get_footer(); ?>
