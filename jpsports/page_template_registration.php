<?php
/**
 Template Name: Registration page
 */
get_header();
session_start();
//$userId = rand();
//$_SESSION["user"] = $userId;

?>
<?php
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
?>
<script>
jQuery(document).ready(function() {
	jQuery('#dob').datepicker({
		 changeMonth: true,
            changeYear: true,
            yearRange: 'c-85:c+0',
			shortYearCutoff: '+10',
    onSelect: function() {
        var date = jQuery(this).datepicker('getDate');
        var today = new Date();
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
      
      // alert(dayDiff);
		if(dayDiff<=7){ 
			alert('Not Eligible');
			jQuery("#dob").val("");
       	}
        
        /*if(dayDiff<=23 && dayDiff>=19){ 
			jQuery("#diffYear").val(19);
			jQuery("#select-cat").val(19);
       	}
        else if(dayDiff<=40 && dayDiff>=24){
			jQuery("#diffYear").val(23);
			jQuery("#select-cat").val(23);
		}
        else if(dayDiff<=45 && dayDiff>=41){
			jQuery("#diffYear").val(41);
			jQuery("#select-cat").val(41);
		}
		else if(dayDiff<=59 && dayDiff>=46){
			jQuery("#diffYear").val(46);
			jQuery("#select-cat").val(46);
		}
		else if(dayDiff>=60){
			jQuery("#diffYear").val(60);
			jQuery("#select-cat").val(60);
			 //window.location = 'http://10.0.0.200/jpsports/';
		}*/
	}
});
});
</script>
   
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
        var occ  = $("#occupation").val();
        var dob  = $("#dob").val();
        var blood  = $("#bld").val();
        var gender  = $("#gen").val();
        var racecategory  = $("#race").val();
        var category  = $("#diffYear").val();
        //var tshirt  = $("#tss").val();
		var mailvalid = validateEmail(em); 
		var confirm = document.getElementById ("confirm");
       
      
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
        if(occ == '') {
            $("#occupation").addClass("error");
        }
        else if(occ != ''){
            $("#occupation").removeClass("error");
        }
         if(dob == '') {
            $("#dob").addClass("error");
        }
        else if(dob != ''){
            $("#dob").removeClass("error");
        }
        if(blood == '') {
            $("#bld").addClass("error");
        }
        else if(blood != ''){
            $("#bld").removeClass("error");
        }
        if(gender == '') {
            $("#gen").addClass("error");
        }
        else if(gender != ''){
            $("#gen").removeClass("error");
        }

        if(category == '') {
            $("#diffYear").addClass("error");
        }
        else if(category != ''){
            $("#diffYear").removeClass("error");
        }
      
        if(mailvalid == false) {
            $("#email").addClass("error");
        }
        else if(mailvalid == true){
            $("#email").removeClass("error");
        }
        if (!confirm.checked) {
                alert ("You must accept the User Agreement to Register!");
                return false;
            }
        
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != ''&& mailvalid == true){        	 
            return true;
        } else {
            return false;
        }
    }
</script> 

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '11' ), 'single-post-thumbnail' );  
				?>
	
			<?php
			require_once dirname( __FILE__ ) . '/payu.php';
			$s_status=$_POST['status'];
			if($s_status == 'success') 	
			{
				//echo 'hello';exit;
				payment_success();
			}
			/*if($s_status != 'success' )			
			{
				payment_failure();
			}*/
				
			function payment_success() {

				/* Payment success logic goes here. */
				//echo "Congratulations !! The Payment is successful.";
				//echo "Payment Success" . "<pre>" . print_r($_POST) . "</pre>";
				global  $wpdb;
				$status=$_POST['status'];
				$txnid=$_POST['txnid'];
				$amount=$_POST['amount'];
				
				$firstname=$_POST['firstname'];
				$lastname=$_POST['lastname'];

				$mihpayid=$_POST['mihpayid'];
				$issuing_bank=$_POST['issuing_bank'];
				$card_type=$_POST['card_type'];				
				$userid = $_SESSION["user"];
				$occupation=$_POST['occupation'];
				$contactno=$_POST['phone'];
				$email=$_POST['email'];
				
				$table_name = "user_transaction";
					
				if($wpdb->insert( $table_name, array(
				//'product_info' => $product,
				'userid'=>$userid,
				'eventid'=>$_GET['reg'],				
				'transactionid' => $txnid,
				'amount'=>$amount,
				'status'=>$status,
				'pay_id'=>$mihpayid,
				'issuing_bank'=>$issuing_bank,
				'card_type'=>$card_type,


				))); //{ echo 'saved';} else { echo "error saving records";}

				$updateTable = "user_events";					
				//$where = "WHERE eventid = '".$_GET['reg']."' AND userid = '".$userId."' '"
				//echo "UPDATE user_events SET payment='".$status."' WHERE userid='".$userId."' and eventid='".$_GET['reg']."' ";exit;
				$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='".$status."' WHERE userid='".$_SESSION["user"]."' and eventid='".$_GET['reg']."' "));

				$eveId = $_GET['reg'];
				$pageID = $eveId;
				$page = get_post($pageID);

				/* SMS send  */
				$smsmsg = "Successful Registration for ".$page->post_title." event.";				
				$pass_data = "mobile=9879766651&pass=jpsports@123&senderid=JPEVNT&to=".$_POST['phone']."&msg=".$smsmsg;

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
				/* End SMS send  */
				
				$querys2="Select * from user WHERE userid='".$_SESSION["user"]."'";				
				$query_run2 = $wpdb->get_results($querys2);						
				$participant_no = $query_run2[0]->participant_no;
				
				if($occupation == 0)
							{
								$occp="Business";
							}
							else if($occupation == 1)
							{
								$occp="Self employed";
							}
							else if($occupation == 2)
							{
								$occp="Salaried";
							}
							else if($occupation == 3)
							{
								$occp="Govt. employed";
							}
							else if($occupation == 4)
							{
								$occp="Retired";
							}
							else if($occupation == 5)
							{
								$occp="House wife";
							}
							else if($occupation == 6)
							{
								$occp="Student";
							}
							else if($occupation == 7)
							{
								$occp="Sports Person";
							}
							else if($occupation == 8)
							{
								$occp="Unemployed";
							}
							else if($occupation == 9)
							{
								$occp="Others";
							}
						$subject = 'Successful Registration';
				
                        $body = '
                        <b>Registration Details</b><br /><br />
                        

                        Name: '.$firstname.' '.$lastname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />                        
                        Event: '.$page->post_title.'<br />
						Participant No: '.$participant_no.'<br /><br /><br />
                       
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

						
						$eveResult = get_post($eveId); 
						$eveTitle = $eveResult->post_title;
						echo "<div id='slider1' style='background:url(".site_url()."/wp-content/themes/jpsports/images/new-crop.jpg) no-repeat scroll center center / cover  rgba(0, 0, 0, 0)'>
						<div class='top-bar'><a href='".site_url()."'><img src='".site_url()."/wp-content/themes/jpsports/images/logo.png'></a></div>
						</div><div class='payment-success'>
						<div class='thank-you-msg'>Thank you</div><br>
						<p>your payment was received successfully for</p><br>
						<div class='success-title'>".$eveTitle."</div></div>";
						
				
			}
	
			function payment_failure() {
				/* Payment failure logic goes here. */
				//echo "We are sorry. The Payment has failed";
				//echo "Payment Success" . "<pre>" . print_r( $_POST, true ) . "</pre>";
				global  $wpdb;
				$status=$_POST['status'];
				$txnid=$_POST['txnid'];
				$amount=$_POST['amount'];
				$fullname=$_POST['firstname'];					
				$mihpayid=$_POST['mihpayid'];
				$issuing_bank=$_POST['issuing_bank'];
				$card_type=$_POST['card_type'];				
				$userId = $_SESSION["user"];
				
				$table_name = "user_transaction";
					
				if($wpdb->insert( $table_name, array(
				//'product_info' => $product,
				'userid'=>$userId,
				'eventid'=>$_GET['reg'],				
				'transactionid' => $txnid,
				'amount'=>$amount,
				'status'=>$status,
				'pay_id'=>$mihpayid,
				'issuing_bank'=>$issuing_bank,
				'card_type'=>$card_type,

				)));

				$eveId = $_GET['reg'];
				$eveResult = get_post($eveId); 
				$eveTitle = $eveResult->post_title;

				echo "<div id='slider1' style='background:url(".site_url()."/wp-content/themes/jpsports/images/new-crop.jpg) no-repeat scroll center center / cover  rgba(0, 0, 0, 0)'>
				<div class='top-bar'><img src='".site_url()."/wp-content/themes/jpsports/images/logo.png'></div>
            	</div><div class='payment-success'>
				<div class='thank-you-msg'>Sorry</div><br>
				<p>your payment was failed for</p><br>
				<div class='success-title'>".$eveTitle."</div>";
			}			

			/* Payments made easy. */

			if ( isset($_POST['btn_submit']) ) 
			{
				//echo payment_success();exit;	
				global  $wpdb;
					
						$amount=$_POST['amt'];
						$fullname=$_POST['fullname'];
						$email=$_POST['email'];
						$contactno=$_POST['contact_no'];
						$occupation=$_POST['occupation'];
						$dofb=$_POST['dob'];
						$bloodtype=$_POST['bld'];
						$gender=$_POST['gen'];	
						$racecategory=$_POST['race'];
						//$tshirtsize=$wp->query_vars['tss'];
						$category=$_POST['select-cat'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$zip_code=$_POST['zip'];
						$contactperson=$_POST['ecp'];
						$contact_no=$_POST['ecn'];

						$school = $_POST['school'];
						$parents_name=$_POST['pname'];

						$userid = rand();
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$participant_no = $query_run1[0]->participant_no + 1;
						
						$table_name = "user";	

					if($wpdb->insert( $table_name, array(
						//'product_info' => $product,
						'amount'=>$amount,
						'full_name'=>$fullname,
						'contact_no'=>$contactno,
						'email' => $email,
						'occupation'=>$occupation,
						'date_of_birth'=>$dofb,
						'blood_type'=>$bloodtype,
						'gender'=>$gender,
						'race_category'=>$racecategory,
						'category'=>$category,
						//'t_shirt_size'=>$tshirtsize,
						'address'=>$addressline,
						'city'=>$city,
						'state'=>$state,
						'country'=>$country,
						'zipcode'=>$zip_code,	
						'contact_person_name'=>$contactperson,
						'contact_person_contact_no'=>$contact_no,
						'participant_no'=>$participant_no,	
						'school_name'=>$school,
						'parents_name'=>$parents_name,					
						'userid'=>$userid
					
						) )) { // echo $wpdb->last_query; echo 'in'; exit;
					
						$id=$userid;
						$eid=$racecategory;
						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";				
							}
							else{
								$queryi= "Insert INTO user_events(eventid,userid,create_date) VALUES ('".$racecategory."','".$userid."',now())";
								$wpdb->query($queryi);	
							}
						//echo '1';
						} // else { echo $wpdb->last_query;  echo 'not inserted'; exit;}
				//echo $_POST['txnid'];exit;
				pay_page( array (				
					'surl' => 'payment_success',
					'furl' => 'payment_failure',
					'key' => 'YpOaMs',
					'txnid' => $_POST['txnid'],
					'amount'=> $_POST['amt'],
					'firstname'=>$_POST['fullname'],
					'email'=> $_POST['email'],
					'phone'=>$_POST['contact_no'],
					'occupation'=>$_POST['occupation'],
					'dofb'=>$_POST['dob'],
					'bloodtype'=>$_POST['bld'],
					'gender'=>$_POST['gen'],
					'racecategory'=>$_POST['race'],
					'addressline'=>$_POST['address'],
					'city'=>$_POST['city'],
					'state'=>$_POST['state'],
					'country'=>$_POST['con'],
					'zip_code'=>$_POST['zip'],
					'contactperson'=>$_POST['ecp'],
					'contactno'=>$_POST['ecn'],
					'productinfo' => $_POST['productinfo'],
				), 
			'f0SXJsMM');

					
			} else { 
			if($s_status != 'success') { ?>
			<div id="slider-reg">
			<div class="header-img"><img src="<?php echo $image[0]; ?>"></div>
            <div class="top-bar">									
           	</div>
			<div class="main-container">

			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<?php 
						$id=123; 
						$post = get_post($id);
					?>
					<h1><?php echo $post->post_title ?></h1>
					<div id="message"></div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">

							<!--<div class="left_fields">	
								<div class="left_label">					
									<label>ProductInfo:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="product_info" id="product_info" />
								</div>
							 </div>
							 <div class="clear"></div>
							 
							 <div class="left_fields">
								<div class="left_label">
									<label>Amount:</label>
								</div>
								<div class="left_text">  
									<input type="text" name="amt"  id="amt"/>
								</div>
							</div>
							<div class="clear"></div>-->
							
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
									<label>Address:</label>
								</div>
								<div class="left_text">  
								<input type="text" name="address" id="address"/>
								</div>
							</div>
							<div class="clear"></div>
							<div class="left_fields">
								<div class="left_label">
									<label>School/College/Occupation:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="school" id="school" />
								 </div>
							</div>
							<div class="clear"></div>

							<!--<div class="left_fields">
								<div class="left_label">
								<label>City: </label>
								</div>
								<div class="left_text">
								 <input type="text" name="city" id="city" />
								 </div>
							</div>
							<div class="clear"></div>
							
							<div class="left_fields">
								<div class="left_label">
									<label>State:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="state" id="state"/>
								 </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>PinCode:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="zip" id="zip"/>
								 </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Country:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="con" id="con" />
								 </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">		
									<label>Gender:</label>  
								</div>
								<div class="left_text">
								<select name="gen" id="gen">
								 <option value="">Select</option>
								  <option value="0">Male</option>
								  <option value="1">Female</option>
								  </select>
								  </div>
							</div>
							<div class="clear"></div>-->

							<div class="left_fields">
								<div class="left_label">
									<label>Blood Group: </label>
								</div>
								<div class="left_text">
								  <select name="bld" id="bld">
								  <option value="">Select</option>
								  <option value="0">A+</option>
								  <option value="1">A-</option>
								  <option value="2">B+</option>
								  <option value="3">B-</option>
								  <option value="4">O-</option>
								  <option value="5">O+</option>
								  <option value="6">AB+</option>
								  <option value="7">AB-</option>
									</select> 
								</div>
							</div>
							<div class="clear"></div>																											
						</div>

						</div>
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">

							<div class="right_fields">
								<div class="right_label">
								  <label>Date of Birth:</label>
								 </div>
								 <div class="right_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>

							<!--<div class="right_fields">
								<div class="right_label">
									<label>Age Group:</label>  
								</div>
								<div class="right_text">								
									<select name="category" id="diffYear" disabled="disabled">
									 	<option value="">Select</option>
										<option value="19">19-23 years</option>								
										<option value="23">24–40 years</option>
										<option value="41">41-45 years</option>
										<option value="46">46-59 years</option>
										<option value="60">Above 60 years</option>
									</select>
								</div> 
							</div>
							<div class="clear"></div>-->

							<div class="right_fields">
								<div class="right_label">
									<label>Parents Name: </label>
								</div>
								<div class="right_text">
									<input type="text" name="pname" id="pname" />
								</div>
							</div>
							<div class="clear"></div>

							<div class="right_fields">
								<div class="right_label">
									<label>Parents Contact Number: </label>
								</div>
								<div class="right_text">
									<input type="text" name="contact_no" id="contact_no" />
								</div>
							</div>
							<div class="clear"></div>

							<!--<div class="right_fields">
								<div class="right_label">
									<label>Emergency Contact Name:</label>
								</div>
								<div class="right_text">  
									<input type="text" name="ecp" id="ecp"/>
								</div>
							</div>
							<div class="clear"></div>
							
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Emergency Contact Number:</label>
								<div class="right_text"> 
									<input type="text" name="ecn" id="ecn" />
								 </div>
							 </div>
								<div class="clear"></div>-->

							<div class="right_fields">
								<div class="right_label">
									<label>Email Id:</label>
								</div>
								<div class="right_text"> 
									<input type="text" name="email" id="email"/>
								 </div>
							</div>
							<div class="clear"></div>
																				
							<!--<div class="right_fields">
								<div class="right_label">
								  <label>Occupation: </label>
								 </div>
								 <div class="right_text">
								  <select name="occupation" id="occupation">
								  <option value="">Select</option>
								  <option value="0">Business</option>
								  <option value="1">Self employed</option>
								  <option value="2">Salaried</option>
								  <option value="3">Govt. employed</option>
								  <option value="4">Retired</option>
								  <option value="5">House wife</option>
								  <option value="6">Student</option>
								  <option value="7">Sports Person</option>
								  <option value="8">Unemployed</option>
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>	
				
							<div class="right_fields">
								<div class="right_label">
									<label>TEE SHIRT SIZE:</label>
								</div>
								<div class="right_text">  
								<select name="tss" id="tss">
								<option value="">Select</option>
								<option value="0">S</option>
								<option value="1">M</option>
								<option value="2">L</option>
								<option value="3">XL</option>
								<option value="4">XLL</option>
								</select>
								</div>
							</div>
							<div class="clear"></div>-->
							<?php $id = $_GET['reg'];?>
							<input name="amt" id="amt" type="hidden" value="<?php echo the_field('price', $id);?>">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">

				<div class="static-text"><strong>Waiver:</strong><br>
				<input class="confirm" id="confirm" type="checkbox" /> &nbsp;I declare, confirm and agree as follows that I/my ward
				</div>
				<section class="page-container-bottom">					
					<?php echo the_field('waiver', $_GET['ID']);?>
				</section>	
					
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			<section class="page-container"><?php the_content();?></section>
			<?php } } ?>
			
															
		<!--</div>	-->

<?php get_footer(); ?>
