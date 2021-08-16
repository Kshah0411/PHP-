<?php
/**
 Template Name: Cyclothon Certificate page old
 */
get_header();
session_start();
?>

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
					<h1>Result Details</h1>
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
							 ?>
								BIB No: <input class="search_txt" type="text" id="txt_search" name="txt_search" value="<?php echo $search; ?>"> <input class="search_btn" type="submit" name="btn_submit" id="btn_submit" value="Search">
							</form>
							
							<?php
							if($search != ''){						
								//echo "select * from user_events WHERE userid = '".$search."' ";exit;
								//echo "select * from wp_result WHERE bib_no = '".$search."'" ;exit;
								$search  = "select * from wp_result WHERE bib_no = '".$search."'";
								$s_query = mysql_query($search); 
								if(mysql_num_rows($s_query) <= 0)
								{
									echo "No Data Found";
								}
								else{
								while ($row = mysql_fetch_array($s_query)){
									
									echo 
													
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
