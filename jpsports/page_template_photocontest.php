<?php
/**
 Template Name: Photo Contest Page
 */
Header("HTTP/1.1 301 Moved Permanently");
Header("Location: http://jpsport.in");
get_header();
session_start();
//$userId = rand();
//$_SESSION["user"] = $userId;

?>
<?php
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
?>   
<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script> 

<script type="text/javascript">
	
    function validateEmail(email) {
        var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return reg.test(email);
    }

    function validation()
    {
		//var productinfo  = $("#product_info").val();
		var amount  = $("#amt").val();
		var fname  = $("#fullname").val();
        var em  = $("#email").val();
        var contact  = $("#contact_no").val();      
        var tshirt  = $("#t_shirt_size").val();        
		var mailvalid = validateEmail(em); 
		
         if(fname == '') {
            $("#fullname").addClass("error");
        }
        else if(fname != ''){
            $("#fullname").removeClass("error");
        }
        if(em == '') {
            $("#email").addClass("error");
        }
        else if(em != ''){
            $("#email").removeClass("error");
        }
        if(contact == '') {
            $("#contact_no").addClass("error");
        }
        else if(contact != ''){
            $("#contact_no").removeClass("error");
        }

        if(tshirt == '') {
            $("#t_shirt_size").addClass("error");
        }
        else if(tshirt != ''){
            $("#t_shirt_size").removeClass("error");
        }
      
        if(mailvalid == false) {
            $("#email").addClass("error");
        }
        else if(mailvalid == true){
            $("#email").removeClass("error");
        }
         
        if(fname != ''&& contact != '' && mailvalid == true){        	 
            return true;
        } else {
            return false;
        }
    }
    function validatePhone(txtPhone) {
		var a = txtPhone;		
		var filter = /^[/(/)0-9-+ ]+$/;
		if (filter.test(a)) {
	/*if (a.length != 10) {
			return false;
	  }*/	  
			return true;
		}
		else {			
			return false;
		}
	}
</script> 

<?php 
$image = wp_get_attachment_image_src( get_post_thumbnail_id(298), 'single-post-thumbnail' );
if ( isset($_POST['btn_submit']) ) 
				{
					$fullname=$_POST['fullname'];
					$email=$_POST['email'];
					$contactno=$_POST['contact_no'];					
					$city=$_POST['city'];
					$state=$_POST['state'];					
					
					$table_name = "wp_citycontest";
					global  $wpdb;
					
					$insert_val .= "full_name=".$fullname."<br/>";
					$insert_val .= "contact_no=".$contactno."<br/>";
					$insert_val .= "email=".$email."<br/>";
					$insert_val .= "city=".$city."<br/>";
					$insert_val .= "state=".$state."<br/>";
						
					$headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From:priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query-photo contest',$insert_val,$headers);
				
					if($wpdb->insert( $table_name, array(					
						
						'full_name'=>$fullname,
						'email_id' => $email,
						'm_number'=>$contactno,
						'city'=>$city,
						'state'=>$state,	

						))) {
						
							$smsmsg = "Congratulations!! You have successfully registered for Sugar Free Cyclothon Click the Thrill Open Photo Contest.Kindly collect your ID card on 19th February from Sugar free Cyclothon Expo,RiverFront,Vallabhsadan";				
							$pass_data = "mobile=9879766651&pass=jpsports@123&senderid=JPEVNT&to=".$contactno."&msg=".$smsmsg;

							$url = "http://smsidea.dynasoft.in/sendsms.aspx";
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL,$url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_POST, 1);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $pass_data);
							$data = curl_exec($ch);
							//print_r($data);exit;
							
							if (curl_errno($ch)){
								print curl_error($ch);
							} else {
								curl_close($ch);		
							}
							$subject = 'Successful Registration';
		
							$body = '
							<b>Congratulations!! You have successfully registered for Sugar Free Cyclothon Click the Thrill Open Photo Contest.Kindly collect your ID card on 19th February from Sugar free Cyclothon Expo,RiverFront,Vallabhsadan.</b><br /><br />
							

							Name: '.$fullname.'<br />
							Mobile: '.$contactno.'<br />
							Email: '.$email.'<br />
							City:'.$city.'<br />
							State:'.$state.'<br /><br />
																		  
							Regards,<br />
							JPSports
							';

							$to = $email;
							$toName = $fullname;
							//$toName = $this->data['firstname']." ".$this->data['lastname'];
							

							$from = 'contact@jpsport.in';
							$fromName = 'Jpsports';

							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: '.$from." <".$fromName.">\r\n";
							$headers .= 'Cc:contact@jpsport.in' . "\r\n";

							//echo $to;
							//echo $subject;
							//echo $body;
							//echo $headers;
							//exit;
							mail($to,$subject,$body,$headers);

							
							
							header("Location:http://jpsport.in/thank-you/");	
				}
				else
				{
					header("Location:http://jpsport.in/");	
				}
			} ?>
			<div id="slider">
				<div class="header-img" style="background-color:#03c6dc;">
				<img src="<?php echo $image[0]; ?>">
				</div>
            <!--<div class="top-bar">									
            <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>-->
			<div class="main-container">

			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>
			<section class="page-container page-container-new"><?php the_content();?></section>	
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="certificate_main tshirt_main">
						<div class="certificate_sec tshirt_sec">					
							<div class="runnersup">
								<form method="POST">
							
								<div class="left_fields">
									<div class="left_label">
										<label>Full Name: </label>
									</div>
									<div class="left_text"> 
										<input type="text" name="fullname" id="fullname"/>
									</div>
								</div>
								<div class="clear"></div>

								<div class="left_fields">
									<div class="left_label">
										<label>Mobile Number: </label>
									</div>
									<div class="left_text">
										<input type="text" name="contact_no" id="contact_no" maxlength="10" placeholder="1234567890"/>
									</div>
								</div>
								<div class="clear"></div>
								<div class="right_fields">
									<div class="left_label">
										<label>Email Id:</label>
									</div>
									<div class="left_text"> 
										<input type="text" name="email" id="email"/>
									 </div>
								</div>
								<div class="clear"></div>

							</div>
						</div>
						<div class="certificate_sec">			
							<div class="runnersup">
								<div class="right_fields">
									<div class="right_label">
										<label>City</label>
									</div>
									<div class="right_text"> 
										<input type="text" name="city" id="city"/>
									 </div>
								</div>
								<div class="clear"></div>
			
				
								<div class="right_fields">
									<div class="right_label">
										<label>State</label> 
									</div>
									<div class="right_text"> 
										<input type="text" name="state" id="state"/>
									 </div>
								</div>
								<div class="clear"></div>

							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">
				
			
			<input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			
			
															
		<!--</div>	-->

<?php get_footer(); ?>
