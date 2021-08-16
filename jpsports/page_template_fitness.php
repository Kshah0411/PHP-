<?php
/**
 Template Name: Fitness page
 */
get_header();
session_start();
$_GET['reg'] = 502;
Header("HTTP/1.1 301 Moved Permanently");
Header("Location: http://jpsport.in");
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
            //yearRange: 'c-85:c+0',
            yearRange: '-100:+0',
			shortYearCutoff: '+10',
			dateFormat: 'dd/mm/yy',
    onSelect: function() {
        var date = $(this).datepicker('getDate');
        var today = new Date();
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        
        //var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
        
        var formattedDate = date;
		var d = ("0" + formattedDate.getDate()).slice(-2);
		var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
		var y = formattedDate.getFullYear();  
      
		dob = new Date(y+'-'+m+'-'+d);
		var today = new Date();		
		var age = (today-dob) / (365.25 * 60 * 60 * 24 * 1000);		
		var dayDiff = age;
      
      // alert(dayDiff);
		if(dayDiff<=18){ 			
			jQuery("#diffYear").val('Less than 18 years');
			jQuery("#select-cat").val('Less than 18 years');
       	}
        if(dayDiff<=22 && dayDiff>=19){ 
			jQuery("#diffYear").val('19-23 years');
			jQuery("#select-cat").val('19-23 years');
       	}
        else if(dayDiff<=40 && dayDiff>=23){
			jQuery("#diffYear").val('24–40 years');
			jQuery("#select-cat").val('24–40 years');
		}
        else if(dayDiff<=45 && dayDiff>=41){
			jQuery("#diffYear").val('41-45 years');
			jQuery("#select-cat").val('41-45 years');
		}
		else if(dayDiff<=59 && dayDiff>=46){
			jQuery("#diffYear").val('46-59 years');
			jQuery("#select-cat").val('46-59 years');
		}
		else if(dayDiff>=60){
			jQuery("#diffYear").val('Above 60 years');
			jQuery("#select-cat").val('Above 60 years');
			 //window.location = 'http://10.0.0.200/jpsports/';
		}
		//alert(jQuery("#diffYear").val());
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
	var confirm = document.getElementById("confirm");
	var confirm1 = document.getElementById("confirm1");
	var confirm2 = document.getElementById("confirm2");
	var confirm3 = document.getElementById("confirm3");
		
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
		if (!confirm.checked && !confirm1.checked && !confirm2.checked && !confirm3.checked) {
			alert ("You must enter activity!");
			return false;
		}
        
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != ''&& mailvalid == true){        	 
            return true;
        } else {
            return false;
        }
    }
</script> 
<script>
/*$(document).ready(function () {
    $("input[name='activity']").change(function () {		
        var maxAllowed = 2;
        var cnt = $("input[name='activity']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' activities!!');
        }
    });
});*/
$(document).ready(function () {
    $("input[name='activity[]']").change(function () {		
        var maxAllowed = 2;
        var cnt = $("input[name='activity[]']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' activity!!');
        }
    });
});
</script>

	
	
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
				$fullname=$_POST['firstname'].' '.$_POST['lastname'];
				$mihpayid=$_POST['mihpayid'];
				$issuing_bank=$_POST['issuing_bank'];
				$card_type=$_POST['card_type'];				
				$userid = $_SESSION["user"];
				$occupation=$_POST['occupation'];
				if($_POST['phone'] == ''){
					$contactno=$_POST['contact_no'];
				} else {
					$contactno=$_POST['phone'];
				}
				$email=$_POST['email'];
				$ecn=$_POST['ecn'];
				
				$table_name = "user_transaction";
				//echo "insert into user_transaction values userid='".$userid."',eventid='".$_GET['reg']."',transactionid='".$txnid."',amount='".$amount."',status='".$status."',pay_id='".$mihpayid."',issuing_bank='".$issuing_bank."',card_type='".$card_type."'";			
				
				$wpdb->insert( $table_name, array(
				//'product_info' => $product,
				'userid'=>$userid,
				'eventid'=>$_GET['reg'],				
				'transactionid' => $txnid,
				'amount'=>$amount,
				'status'=>$status,
				'pay_id'=>$mihpayid,
				'issuing_bank'=>$issuing_bank,
				'card_type'=>$card_type
				));
				
				/*if($wpdb->insert( $table_name, array(
				//'product_info' => $product,
				'userid'=>$userid,
				'eventid'=>$_GET['reg'],				
				'transactionid' => $txnid,
				'amount'=>$amount,
				'status'=>$status,
				'pay_id'=>$mihpayid,
				'issuing_bank'=>$issuing_bank,
				'card_type'=>$card_type
				)));*/

				$updateTable = "user_events";					
				
				if($_POST['select-cat'] >= 60)
				{
					$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='success' WHERE userid='".$_SESSION["user"]."' and eventid='".$_GET['reg']."' "));
					$wpdb->query($wpdb->prepare("UPDATE user_transaction SET status='success' WHERE userid='".$_SESSION["user"]."' and eventid='".$_GET['reg']."' "));
					$wpdb->query($wpdb->prepare("UPDATE user SET status='success' WHERE userid='".$userid."' "));
				}
				else
				{				
				$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='".$status."' WHERE userid='".$_SESSION["user"]."' and eventid='".$_GET['reg']."' "));
				$wpdb->query($wpdb->prepare("UPDATE user SET status='".$status."' WHERE userid='".$userid."' "));
				}
				
				
				

				$eveId = $_GET['reg'];
				$pageID = $eveId;
				$page = get_post($pageID);
				
				/* SMS send  */
				$smsmsg = "Bingo! You have successfully registered for Gujarat Fitness Bash. Please note reporting time is 5:45 am. See you on Sunday 1st May 2016 @ Rajpath Club";				
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
				/* End SMS send  */
				
			$querys2="Select * from user WHERE userid='".$_SESSION["user"]."'";				
				$query_run2 = $wpdb->get_results($querys2);						
				$participant_no = $query_run2[0]->participant_no;
				$activity1 = $query_run2[0]->activity1;
				$occupation = $query_run2[0]->occupation;
				$occp = $occupation;
								
				$subject = 'Successful Registration';
				
                        $body = '
                        <b>Registration Details</b><br /><br />
                        

                        Name: '.$fullname.'<br />                        
                        Occupation: '.$occp.'<br />
                        Activities: '.$activity1.'<br />
                        Contact Number: '.$contactno.'<br />                                               
                        Email: '.$email.'<br />                       
                        Event: '.$page->post_title.'<br />
						Participant No: '.$participant_no.'<br />
						Amount: '.$amount.'<br /><br /><br />
                       
                        Regards,<br />
                        JPSports
                        ';
                         //Gender: '.$gender.'<br />
                         //Blood Group: '.$bloodtype.'<br />
                        //echo $body;exit;
                        $to = $email;
                        $toName = $fullname;
                        //$toName = $this->data['firstname']." ".$this->data['lastname'];
                        

                        $from = 'contact@jpsport.in';
						$fromName = 'Jpsports';

                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From: '.$from." <".$fromName.">\r\n";
                        $headers .= 'Cc:contact@jpsport.in' . "\r\n";

						/*echo $to;
                        echo $subject;
						echo $body;
                        echo $headers;
						exit;*/
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
				'card_type'=>$card_type

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
						// echo '<pre>';
						// print_r($_POST);
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
						// $city=$_POST['city'];
						// $state=$_POST['state'];
						// $country=$_POST['con'];
						//$zip_code=$_POST['zip'];
						$contact_no=$_POST['ecn'];
						$checkBox = implode(',', $_POST['activity']);   
					

						$userid = rand();
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$participant_no = $query_run1[0]->participant_no + 1;
						
						$table_name = "user";	
					
					
										/*Main send for check query*/
					$insert_val .= "amount=".$amount."<br/>";
					$insert_val .= "full_name=".$fullname."<br/>";
					$insert_val .= "contact_no=".$contactno."<br/>";
					$insert_val .= "email=".$email."<br/>";
					$insert_val .= "occupation=".$occupation."<br/>";
					$insert_val .= "date_of_birth=".$dofb."<br/>";
					$insert_val .= "blood_type=".$bloodtype."<br/>";
					$insert_val .= "gender=".$gender."<br/>";
					$insert_val .= "race_category=".$racecategory."<br/>";
					$insert_val .= "category=".$category."<br/>";
					$insert_val .= "age_group=".$age_group."<br/>";
					$insert_val .= "t_shirt_size=".$t_shirt_size."<br/>";
					$insert_val .= "address=".$addressline."<br/>";
					// $insert_val .= "city=".$city."<br/>";
					// $insert_val .= "state=".$state."<br/>";
					// $insert_val .= "country=".$country."<br/>";
					//$insert_val .= "zipcode=".$zip_code."<br/>";
					$insert_val .= "contact_person_name=".$contactperson."<br/>";
					$insert_val .= "contact_person_name2=".$contactperson2."<br/>";
					$insert_val .= "contact_person_contact_no=".$contact_no."<br/>";
					$insert_val .= "contact_person_contact_no2=".$contact_no2."<br/>";
					$insert_val .= "participant_no=".$participant_no."<br/>";
					$insert_val .= "nationality=".$nationality."<br/>";
					$insert_val .= "bikemake=".$bikemake."<br/>";
					$insert_val .= "previous_cycling_experiences=".$previous_cycling_experiences."<br/>";
					$insert_val .= "other_adventure_sports=".$other_adventure_sports."<br/>";
					$insert_val .= "userid=".$userid."<br/>";							
					$insert_val .= "checkbox=".$checkBox."<br/>";							
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From: priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query -- fitness-bash',$insert_val,$headers);
					/*end mail*/
					
							
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
						// 'city'=>$city,
						// 'state'=>$state,
						// 'country'=>$country,
						//'zipcode'=>$zip_code,	
						//'contact_person_name'=>$contactperson,
						'contact_person_contact_no'=>$contact_no,
						'participant_no'=>$participant_no,	
						'activity1'=>$checkBox,					
						'userid'=>$userid
					
						) )) { 
					
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
									'contactperson'=>$_POST['ecp'],
									'contactno'=>$_POST['ecn'],
									'productinfo' => $_POST['productinfo'],
								), 
							'f0SXJsMM');
							exit;
							}
						//echo '1';
						} 
				//print_r($_POST);
				
				

					
			} else { 
			if($s_status != 'success') { ?>
			<div id="slider">
			<div class="header-img" style="background-color:#901d78;">
				<?php the_post_thumbnail(array( 1000, 1000) );  ?>
			</div>
            <!--<div class="top-bar">									
            <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>-->
			<div class="main-container">

			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class="page-container">
				<div class="contact-form-section middle-align">
					<?php the_content();?>
				</div>
			</section>
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
									<label>Gender:</label>  
								</div>
								<div class="left_text">
								<select name="gen" id="gen">
								 <option value="">Select</option>
								  <option value="Male">Male</option>
								  <option value="Female">Female</option>
								  </select>
								  </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
								  <label>Date of Birth:</label>
								 </div>
								 <div class="left_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Age Group:</label>  
								</div>
								<div class="left_text">								
									<select name="category" id="diffYear" disabled="disabled">
									 	<option value="">Select</option>
									 	<option value="Less than 18 years">Less than 18 years</option>
										<option value="19-23 years">19-23 years</option>								
										<option value="24–40 years">24–40 years</option>
										<option value="41-45 years">41-45 years</option>
										<option value="46-59 years">46-59 years</option>
										<option value="Above 60 years">Above 60 years</option>
									</select>
								</div> 
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Blood Group: </label>
								</div>
								<div class="left_text">
								  <select name="bld" id="bld">
								  <option value="">Select</option>
								  <option value="A+">A+</option>
								  <option value="A-">A-</option>
								  <option value="B+">B+</option>
								  <option value="B-">B-</option>
								  <option value="O-">O-</option>
								  <option value="O+">O+</option>
								  <option value="AB+">AB+</option>
								  <option value="AB-">AB-</option>
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
								  <label>Occupation: </label>
								 </div>
								 <div class="right_text">
								  <select name="occupation" id="occupation">
								  <option value="">Select</option>
								  <option value="Business">Business</option>
								  <option value="Self employed">Self employed</option>
								  <option value="Salaried">Salaried</option>
								  <option value="Govt. employed">Govt. employed</option>
								  <option value="Retired">Retired</option>
								  <option value="Housewife">Housewife</option>
								  <option value="Student">Student</option>
								  <option value="Sports Person">Sports Person</option>
								  <option value="Unemployed">Unemployed</option>
								  <option value="Others">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>

							<div class="right_fields">
								<div class="right_label">
									<label>Activities: </label>
								</div>
								<div class="right_text checked" style="text-align:left;"><br/>
									<input type="checkbox" name="activity[]" value="cycling" id="confirm"/> Cycling
									<input type="checkbox" name="activity[]" value="running" id="confirm1"/> Running
									<input type="checkbox" name="activity[]" value="yoga" id="confirm2"/> Yoga
									<input type="checkbox" name="activity[]" value="zumba" id="confirm3"/> Zumba									
								</div>																							
							</div>
							
							<div class="clear"></div>
							
							<div class="right_fields">
								<div class="right_label">
									<label><strong>Note:</strong> Please note participants can select</label>
								</div>
								<div class="right_text checked" style="text-align:left;">
									<label> maximum two activities.</label>
								</div>																							
							</div>
							
							<div class="clear"></div>

							<div class="right_fields">
								<div class="right_label">
									<label>Contact Number: </label>
								</div>
								<div class="right_text">
									<input type="text" name="contact_no" id="contact_no" />
								</div>
							</div>
							<div class="clear"></div>																				

							<div class="right_fields">
								<div class="right_label">
									<label>Email Id:</label>
								</div>
								<div class="right_text"> 
									<input type="text" name="email" id="email"/>
								 </div>
							</div>
							<div class="clear"></div>
																				
							<div class="right_fields">
								<div class="right_label">
									<label>Emergency Contact Number:</label>
								</div>
								<div class="right_text"> 
									<input type="text" name="ecn" id="ecn" />
								 </div>
							 </div>
								<div class="clear"></div>
							
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
				<input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			
			<?php } } ?>
			
															
		<!--</div>	-->

<?php get_footer(); ?>
