<?php
/**
 Template Name: Cyclothon Certificate 2017 page
 */
get_header();
session_start();
//$_GET['reg'] = 157;
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
				<div class="header-img" style="background-color:#fff;">
				<img src="http://jpsport.in/wp-content/uploads/2016/10/website.jpg">
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
							<form class="form-div" action="<?php echo get_site_url(); ?>/cyclothon-certificate-2017/" method="post" accept-charset="UTF-8"  onsubmit="return validation();">
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
								$bib_no_search = $search;
								//echo "select * from user_events WHERE userid = '".$search."' ";exit;
								//echo "select * from wp_result WHERE bib_no = '".$search."'" ;exit;
								$search  = "select * from user_success WHERE bip_no = '".$search."' or bip_no1 = '".$search."'";
								$s_query = mysql_query($search); 
								if(mysql_num_rows($s_query) <= 0)
								{
									$search  = "select * from user WHERE (bip_no = '".$bib_no_search."' or bip_no1 = '".$bib_no_search."') AND race_category = '525' AND status = 'success' ";									
									$s_query = mysql_query($search); 
								}
								
								if(mysql_num_rows($s_query) <= 0)
								{
									echo "No Data Found";
								}
								else{
								$pdf_url = '';
								$pdf_url_itt = '';
								while ($row = mysql_fetch_array($s_query)){
									$row['bib_no'] = $row['bip_no'];
									$row['bib_no1'] = $row['bip_no1'];
									
									/* 100 KM condition */
									if($row['category'] == 'Full cyclothon Ride' && $row['gender'] == '0'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("100km-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									}
									/*50km fixie Female(15-39)*/									
									 else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Fixie' && $row['gender'] == '1' && $row['age_group'] == '15-39 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-Female-15-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-Female-15-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-Female-15-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-Female-15-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-Female-15-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-fixie-Female-15-39-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									}
									/* 50km fixie male 15-39 Rank */ 
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Fixie' && $row['gender'] == '0' && $row['age_group'] == '15-39 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-15-39-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-fixie-MALE-15-39-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									}
									/* 50km fixie male 40 and above Rank */ 
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Fixie' && $row['gender'] == '0' && $row['age_group'] == '40'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-40-and-above-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-40-and-above-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-fixie-male-40-and-above-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-fixie-MALE-40-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open female 15-39/19-39 Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '1' && $row['age_group'] == '19–39 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-15-39-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-FEMALE-19-39-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open female 40+/40-60+ Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '1' && $row['age_group'] == '40-59 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-female-40-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-FEMALE-40-59-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open male 15-18 Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '0' && $row['age_group'] == '15-18 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-15-18-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-15-18-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-15-18-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-15-18-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-15-18-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-MALE-15-18-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open male 19-39 Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '0' && $row['age_group'] == '19–39 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-19-39-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-MALE-19-39-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open male 40-59 Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '0' && $row['age_group'] == '40-59 years'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '4'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '5'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '6'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-6.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '7'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-7.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '8'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-8.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '9'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-9.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '10'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-40-59-10.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-MALE-40-59-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									/* 50km open male 60 and above  Rank */
									else if($row['category'] == 'Half cyclothon Ride' && $row['geared'] == 'Open' && $row['gender'] == '0' && $row['age_group'] == '60'){
										if($row['rank'] == '1'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-60-and-above-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '2'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-60-and-above-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else if($row['rank'] == '3'){
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50km-open-male-60-and-above-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										} else {
											$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("50Km-OPEN-MALE-60-completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no']);
										}
									} 
									
									if($row['cyclothon_type'] == 'CYCLOTHON + ITT RACE'){
										/* ITT Male 15-39 years */
										if($row['gender'] == '0' && $row['age_group1'] == '15-39 years'){
											if($row['rank_itt'] == '1'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '2'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '3'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '4'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '5'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else {
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-15-39-Completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1']);
											}
										}										
										/* ITT Male 40+ years */
										else if($row['gender'] == '0' && $row['age_group1'] == '40'){
											if($row['rank_itt'] == '1'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-40-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '2'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-40-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '3'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-40-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else {
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Male-40-Completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1']);
											}
										}
										/* ITT Female 15-39 years */
										else if($row['gender'] == '1' && $row['age_group1'] == '15-39 years'){
											if($row['rank_itt'] == '1'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '2'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '3'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-3.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '4'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-4.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '5'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-5.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else {
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-15-39-Completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1']);
											}
										}										
										/* ITT Female 40+ years */
										else if($row['gender'] == '1' && $row['age_group1'] == '40'){
											if($row['rank_itt'] == '1'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-40-1.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else if($row['rank_itt'] == '2'){
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-female-40-2.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1'])."&grosstime=".base64_encode($row['grosstime'])."&flag_type=1";
											} else {
												$pdf_url_itt = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode("ITT-Female-40-Completion.jpg")."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no1']);
											}
										}
									}
									
									
									if($row['cyclothon_type'] == 'CYCLOTHON + ITT RACE' && $pdf_url_itt != ''){ 
										echo 
										'<div class="certi_list">
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>BIB No: </label>'.$row['bip_no'].'</li>
												<li style="list-style:none;"><label>ITT BIB No: </label>'.$row['bip_no1'].'</li>
												<li style="list-style:none;"><label>NAME: </label>'.$row['full_name'].'</li>
												</ul>
											</div>
										
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>EVENT NAME: </label>'.$row['category'].'</li>
												<li style="list-style:none;"><label>RANK: </label>'.$row['rank'].'</li>
												<li style="list-style:none;"><label>ITT RANK: </label>'.$row['rank_itt'].'</li>
												</ul>
											</div>
											<ul class="certificate_detail" style="clear:both;padding:10px 0px;margin-left:0px;">
												<li style="list-style:none;"><a href="'.$pdf_url.'" target="_blank" class="download_certi">Download Certificate</a> <a href="'.$pdf_url_itt.'" target="_blank" class="download_certi">Download Certificate</a></li>
											</ul>
										</div>';
									} else {
										echo 
										'<div class="certi_list">
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>BIB No: </label>'.$row['bip_no'].'</li>
												<li style="list-style:none;"><label>NAME: </label>'.$row['full_name'].'</li>
												</ul>
											</div>
										
											<div class="certificate_sec">
												<ul class="certificate_detail">
												<li style="list-style:none;"><label>EVENT NAME: </label>'.$row['category'].'</li>
												<li style="list-style:none;"><label>RANK: </label>'.$row['rank'].'</li>
												</ul>
											</div>
											<ul class="certificate_detail" style="clear:both;padding:10px 0px;margin-left:0px;">
												<li style="list-style:none;"><a href="'.$pdf_url.'" target="_blank" class="download_certi">Download Certificate</a></li>
											</ul>
										</div>';
									}									
							}
							
							
						}
					}
					
					else if($name != ''){						
								//echo "select * from user_events WHERE userid = '".$search."' ";exit;
								//echo "select * from wp_result WHERE bib_no = '".$search."'" ;exit;
								$search  = "select * from user WHERE full_name = '".$name."' AND (category ='Kids Ride' OR category ='Fashion Ride' OR category ='Ahmedabad Green Ride') AND status ='success' group by full_name";
								$s_query = mysql_query($search); 
								
								if(mysql_num_rows($s_query) <= 0)
								{
									echo "No Data Found";
								}
								else{
								while ($row = mysql_fetch_array($s_query)){
									$pdf_url = ''; //get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&img_name=".base64_encode($row['image_url'])."&user_name=".base64_encode($row['full_name'])."&bib=".base64_encode($row['bib_no'])."&grosstime=".base64_encode($row['grosstime']);
									
									//echo "Male";
									if($row['category']=='Kids Ride'){
										$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&flag_type=2&img_name=".base64_encode('Kids-Ride.jpg')."&user_name=".base64_encode($row['full_name']);
									} 
									else if($row['category']=='Fashion Ride'){
										$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&flag_type=2&img_name=".base64_encode('Fashion-Ride.jpg')."&user_name=".base64_encode($row['full_name']);
									}
									else if($row['category']=='Ahmedabad Green Ride'){						
										$pdf_url = get_site_url()."/?page_id=99&event_name=".base64_encode('cyclothon2017')."&flag_type=2&img_name=".base64_encode('Green-Ride.jpg')."&user_name=".base64_encode($row['full_name']);									
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
