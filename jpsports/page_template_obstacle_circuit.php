<?php
/**
 Template Name: Obstacle Circuit page
 */

get_header();
session_start();
//$userId = rand();
//$_SESSION["user"] = $userId;
$_GET['reg'] = 737;
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
        var occ  = $("#occupation").val();
        var dob  = $("#dob").val();
        var blood  = $("#bld").val();
        var gender  = $("#gen").val();
        var timeslot  = $("#select-cat").val();
        
        var ecp  = $("#ecp").val();
        var ecn  = $("#ecn").val();
        
        
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
			if(validatePhone(contact) == false){
				$("#contact_no").addClass("error");
			} else {
				$("#contact_no").removeClass("error");
			}
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
        
        if(timeslot == '') {
            $("#select-cat").addClass("error");
        }
        else if(gender != ''){
            $("#select-cat").removeClass("error");
        }
       
      
        if(mailvalid == false) {
            $("#email").addClass("error");
        }
        else if(mailvalid == true){
            $("#email").removeClass("error");
        }
        
        
        if(ecp.toLowerCase() == fname.toLowerCase() && ecp != "") {
            $("#ecp").addClass("error");
            alert('Your name and Emergency Contact Person can not same.');
            return false;
        } else {
			$("#ecp").removeClass("error");
		}
		
		if(ecn == contact && ecn != "") {
            $("#ecn").addClass("error");
            alert('Your number and Emergency Contact Number can not same.');
            return false;
        } else {
			$("#ecn").removeClass("error");
		}
        
		var res = dob.split("/");
		var d = res[0];
		var m = res[1];
		var y = res[2];

		var date1 = new Date(y+'-'+m+'-'+d);
		var date2 = new Date("2017-01-27");
		var timeDiff = date2.getTime() - date1.getTime();
		var yeardiff = (timeDiff) / (1000 * 3600 * 24 * 365.25); 
		$("#hd_age_year").val(yeardiff);
		
        if(dob != ''){
			if(yeardiff < 6){
				alert ("Not Eligible for selected Race Category.");
				return false;
			}
		}
		
		if (document.getElementById('confirm').checked == false) {
			alert ("You must accept the User Agreement to Register!");
			document.getElementById('confirm').focus();
			return false;
		}
            
       var googleCaptch = get_action(this);
        if(googleCaptch == false)
        {
			document.getElementById('captcha_div').focus();
			return false
		}
        //var googleCaptch = true;
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& timeslot != '' && gender != '' && mailvalid == true && validatePhone(contact) == true && check_geared_select() == true && googleCaptch == true){
			
            return true;
        } else {
			$("html, body").animate({ scrollTop: $('#section8').offset().top }, 1000);
            return false;
        }
    }
 // google captch validation  
function get_action(form) 
{
	var v = grecaptcha.getResponse();
	if(v.length == 0)
	{
		//document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
		alert("You can't leave Captcha Code empty");
		return false;
	} 
	else
	{
		//document.getElementById('captcha').innerHTML="Captcha completed";
		return true; 
	}
}
    
  
    
  function checkregistrationemail()
    {	
		if(jQuery("#email").val()!=''){
			var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
			var username=jQuery("#email").val();
			var eveId = jQuery("#race").val();
			//alert(eveId);
			jQuery.post(
				ajaxurl, 
				{
					'action': 'add_foobar',
					'data':   username + '###' + eveId,
					'type': 'POST',
					dataType: 'JSON',
				}, 
				function(response){
					if(response > 0){
						jQuery('#error_email').html("email address already exists.");	
						return false;
					} else{
						jQuery('#error_email').html("");
					}
				}
			);
		}
	}
	
	function validatePhone(txtPhone) {
		var a = txtPhone;		
		var filter = /^[/(/)0-9-+ ]+$/;
		if (filter.test(a)) {
			return true;
		}
		else {
			return false;
		}
	}
</script> 

	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '737' ), 'single-post-thumbnail' );  ?>
	<?php	
	require_once dirname( __FILE__ ) . '/payu.php';
	$s_status=$_POST['status'];
			
	if($s_status == 'success') 	
	//if($s_status == 'failure')
	{
		payment_success();
	}
	function payment_success() {
				/* Payment success logic goes here. */
				global  $wpdb;
				$status=$_POST['status'];

				$txnid=$_POST['txnid'];
				$amount=$_POST['amount'];
				$fullname=$_POST['firstname'].' '.$_POST['lastname'];
				$mihpayid=$_POST['mihpayid'];
				$issuing_bank=$_POST['issuing_bank'];
				$card_type=$_POST['card_type'];
				if($_POST['udf1'] == ''){
					$userid = $_SESSION["user"];
				} else {
					$userid = $_POST['udf1'];
				}
				$occupation=$_POST['occupation'];
				
				if($_POST['phone'] == ''){
					$contactno=$_POST['contact_no'];
				} else {
					$contactno=$_POST['phone'];
				}
				$email=$_POST['email'];
				
				/* Insert into User Transaction Table */
				$table_name = "user_transaction";
				
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
				
				$updateTable = "user_events";
				$querys3="Select * from user WHERE userid='".$userid."'";
				$query_run3 = $wpdb->get_results($querys3);
				$age_year = $query_run3[0]->age_year;
				$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='".$status."' WHERE userid='".$userid."' and eventid='".$_GET['reg']."' "));

				$wpdb->query($wpdb->prepare("UPDATE user SET status='".$status."' WHERE userid='".$userid."' "));
				
				$contactno=$_POST['phone'];
				$fullname=$_POST['firstname'].' '.$_POST['lastname'];
				
				$eveId = $_GET['reg'];
				$pageID = $eveId;
				$page = get_post($pageID);
				
				
				$querys2="Select * from user WHERE userid='".$userid."'";
				$query_run2 = $wpdb->get_results($querys2);
				$participant_no = $query_run2[0]->participant_no;
				$bip_no = $query_run2[0]->bip_no;
				$geared_name = $query_run2[0]->geared;
				$cyclothon_type = $query_run2[0]->cyclothon_type;
				$gender = $query_run2[0]->gender;
				$occp = $query_run2[0]->occupation;
				$timeslot = '';
				if($query_run2[0]->category == '6to7')
				{
					$timeslot = '6:00 To 7:00 AM';
				} else {
					$timeslot = '7:00 To 8:00 AM';
				}
				/*if($gender == 0){
					$gender = 'Male';
				} else if($gender == 1){
					$gender = 'Female';
				} else {
					$gender = '';
				}*/
				$category_name_final = '';
				
				$subject = 'PAYMENT SUCCESSFUL - REGISTRATION CONFIRMED';
				
				
					$body = '
                        <b>Congratulations! Your registration for Obstacle Circuit Workshop has been confirmed. Here are the details of your transaction for your reference:</b><br /><br />
                        

                        Name: '.$fullname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />
                        Occupation: '.$occp.'<br />
                        Gender: '.$gender.'<br />
                        Time Slot: '.$timeslot.'<br />
                        Event: Obstacle Circuit Workshop<br />
						Amount: '.$amount.'<br /><br />
						
						Please note that the paid amount is non-transferable and non-refundable under any circumstances.<br /><br /><br />

                       
                        Regards,<br />
                        Extreme Fitness
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
						<p>Payment is successfully received towards your registration for</p><br>
						<div class='success-title'>Obstacle Circuit Workshop</div></div>";
						
			}
	
	if ( (isset($_POST['btn_submit'])  || isset($_POST['btn_submit1'])) && trim($_POST['fullname']) !='' && trim($_POST['gen']) !='' && trim($_POST['bld']) !='' && trim($_POST['dob']) !='' && trim($_POST['contact_no']) !='' && trim($_POST['email']) !='' && trim($_POST['select-cat']) !='' ) 
			{
				//echo payment_success();exit;
				global  $wpdb;
					
						//$amount=$_POST['amt'];
						$amount=250;
						$fullname=$_POST['fullname'];
						$email=$_POST['email'];
						$contactno=$_POST['contact_no'];
						$occupation=$_POST['occupation'];
						$dofb=$_POST['dob'];
						$bloodtype=$_POST['bld'];
						$gender=$_POST['gen'];	
						$racecategory=$_POST['race'];
						$t_shirt_size=$_POST['t_shirt_size'];
						$category=$_POST['select-cat'];
						$age_group=$_POST['age_group'];
						$age_group1=$_POST['age_group1'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$nationality=$_POST['nationality'];
						
						$geared = '';
						$zip_code=$_POST['zip'];
						$contactperson=$_POST['ecp'];
						$contact_no=$_POST['ecn'];
						$cyclothon_year=$_POST['cyclothon_year'];
						
						$querys1="Select id from user WHERE race_category='737' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);
						$userid_db = $query_run1[0]->id + 1;
						
						$userid = time().$userid_db;
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						/*bip no logic*/
						$bip_no = '';
						$bip_no1 = '';
						$querys1 = "Select gender,category,bip_no,race_category from user WHERE race_category='737' order by id desc limit 0,1";
						
						$query_run1 = $wpdb->get_results($querys1);
						
						if($wpdb->num_rows > 0){
							$bip_no = $query_run1[0]->bip_no + 1;
						} else {
							$bip_no = 1;
						}
						
					$participant_no = time();
					
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
					$insert_val .= "address=".$addressline."<br/>";
					$insert_val .= "city=".$city."<br/>";
					$insert_val .= "state=".$state."<br/>";
					$insert_val .= "country=".$country."<br/>";
					$insert_val .= "zipcode=".$zip_code."<br/>";
					$insert_val .= "contact_person_name=".$contactperson."<br/>";
					$insert_val .= "contact_person_contact_no=".$contact_no."<br/>";
					$insert_val .= "participant_no=".$participant_no."<br/>";
					$insert_val .= "bip_no=".$bip_no."<br/>";
					$insert_val .= "userid=".$userid."<br/>";
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From:priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query',$insert_val,$headers);
					/*end mail*/
//					echo "INSERT INTO user (amount, full_name, contact_no,email,occupation,date_of_birth,blood_type,gender,race_category,category,age_group,t_shirt_size,address,city,state,country,zipcode,contact_person_name,contact_person_name2,contact_person_contact_no,contact_person_contact_no2,participant_no,nationality,bikemake,previous_cycling_experiences,other_adventure_sports,geared,bip_no,userid,cyclothon_type,cyclothon_year,create_date) VALUES ('".$amount."','".$fullname."','".$contactno."','".$email."','".$occupation."','".$dofb."','".$bloodtype."','".$gender."','".$racecategory."','".$category."','".$age_group."','".$t_shirt_size."','".$addressline."','".$city."','".$state."','".$country."','".$zip_code."','".$contactperson."','".$contactperson2."','".$contact_no."','".$contact_no2."','".$participant_no."','".$nationality."','".$bikemake."','".$previous_cycling_experiences."','".$other_adventure_sports."','".$geared."','".$bip_no."','".$userid."','".$cyclothon_type."','".$cyclothon_year."',now())";

					if($wpdb->insert( $table_name, array(
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
						'address'=>$addressline,
						'city'=>$city,
						'state'=>$state,
						'country'=>$country,
						'zipcode'=>$zip_code,	
						'contact_person_name'=>$contactperson,
						'contact_person_contact_no'=>$contact_no,
						'participant_no'=>$participant_no,
						'nationality'=>$nationality,
						'bikemake'=>$bikemake,
						'bip_no'=>$bip_no,
						'userid'=>$userid,
						'cyclothon_year'=>$cyclothon_year
						) )) { 
						
						$id=$userid;
						$eid=$racecategory;
						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";
								header("location:http://10.0.0.84/jpsports/obstacle-circuit/");
								exit;	
							}
							else{
								$queryi= "Insert INTO user_events(eventid,userid,create_date) VALUES ('".$racecategory."','".$userid."',now())";
								$wpdb->query($queryi);
								
								pay_page( array (
									'surl' => 'payment_success',
									'furl' => 'payment_failure',
									'key' => 'YpOaMs', // test : gtKFFx    ||    live : YpOaMs
									'txnid' => $_POST['txnid'],
									//'amount'=> $_POST['amt'],
									'amount'=> $amount,
									'udf1'=> $userid,
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
									'nationality'=>$_POST['nationality'],
									'bikemake'=>$_POST['bikemake'],
									't_shirt_size'=>$_POST['t_shirt_size'],
									'geared'=>$_POST['geared'],
									'zip_code'=>$_POST['zip'],
									'contactperson'=>$_POST['ecp'],
									'contactperson2'=>$_POST['ecp2'],
									'contactno'=>$_POST['ecn'],
									'contactno2'=>$_POST['ecn2'],
									'previous_cycling_experiences'=>$_POST['previous_cycling_experiences'],
									'other_adventure_sports'=>$_POST['other_adventure_sports'],
									'productinfo' => $_POST['productinfo'],
								), 
							'f0SXJsMM'); // test : eCwWELxi    ||    live : f0SXJsMM
								exit;
							}
						
			} else { 
				header("location:http://10.0.0.84/jpsports/obstacle-circuit/");
				exit;	
			}
	} else { 
		if($s_status != 'success') {
		?>
			<div id="slider">
				<div class="header-img" style="background-color:#fff;">
				<img src="<?php echo $image[0]; ?>">
			</div>
			<div class="main-container">
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="clear"></div>
					<h1>Registration Closed</h1>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">
							<?php /*
								<!-- The Modal -->
								<div id="myModal" class="modal">

								  <!-- Modal content  rushi -->
								  <div class="modal-content">
									<span class="close" id="closeBox" onclick="closeModel()">×</span>
									<div class="model-data">
										<h1>Registration Detail</h1>
										<span><strong>Name :</strong></span> <span id="display_name"></span><br>
										<span><strong>Gender :</strong></span> <span id="display_gender"></span><br>
										<span><strong>Email Id :</strong></span> <span id="display_bloodgroup"></span><br>
										<span><strong>Race Category :</strong></span> <span id="display_racecategory"></span><br>
										<span class="display_geared"><strong>Fixie (Non Gear)/Open :</strong></span> <span id="display_geared1" class="display_geared"></span><br class="display_geared">
										<span><strong>Date of Birth :</strong></span> <span id="display_birthdate"></span><br>
										<span><strong>Age Group :</strong></span> <span id="display_agegroup_id"></span><br>
										<span><strong>Mobile Number :</strong></span> <span id="display_mobile"></span><br>
										<span><strong>T-shirt Size :</strong></span> <span id="display_tshirt"></span><br>
										<div class="model-button">
											<input type="submit" class="menu_tab" id="btn_submit1" name="btn_submit1" value="Submit">
											<input type="button" id="cancel" class="menu_tab" onclick="closeModel()" value="Cancel"> 
										</div>
									</div>
								  </div>

								</div>
								<!-- The Modal End-->
							
							<div class="left_fields">
								<div class="left_label">
									<label>Full Name:<span style="color:red;">*</span> </label>
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
									<label>Gender:<span style="color:red;">*</span></label>  
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
									<label>Blood Group:<span style="color:red;">*</span> </label>
								</div>
								<div class="left_text">
								  <select name="bld" id="bld">
								  <option value="">Select</option>
								  <option value="A+">A+</option>
								  <option value="A-">A-</option>
								  <option value="B+">B+</option>
								  <option value="B-">B-</option>
								  <option value="O+">O+</option>
								  <option value="O-">O-</option>
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
								  <label>Date of Birth:<span style="color:red;">*</span></label>
								 </div>
								 <div class="right_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>
							

							<div class="right_fields">
								<div class="right_label">
									<label>Mobile Number:<span style="color:red;">*</span> </label>
								</div>
								<div class="right_text">
									<input type="text" name="contact_no" id="contact_no" maxlength="10" placeholder="1234567890"/>
								</div>
							</div>
							<div class="clear"></div>

							<div class="right_fields">
								<div class="right_label">
									<label>Emergency Contact Person:</label>
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
								<div class="clear"></div>
								
							<div class="right_fields">
								<div class="right_label">
									<label>Email Id:<span style="color:red;">*</span></label>
								</div>
								<div class="right_text"> 
									<input type="text" name="email" id="email" onkeydown="checkregistrationemail();"/>
									<span id="error_email" style="float:left;color:red;clear:both;" ></span>
								 </div>
							</div>
							<div class="clear"></div>
																				
							<div class="right_fields">
								<div class="right_label">
									<label>Occupation:<span style="color:red;">*</span> </label>
								 </div>
								 <div class="right_text">
									  <select name="occupation" id="occupation">
										  <option value="">Select</option>
										  <option value="Business">Business</option>
										  <option value="Self employed">Self employed</option>
										  <option value="Salaried">Salaried</option>
										  <option value="Govt. employed">Govt. employed</option>
										  <option value="Retired">Retired</option>
										  <option value="House wife">House wife</option>
										  <option value="Student">Student</option>
										  <option value="Sports Person">Sports Person</option>
										  <option value="9">Others</option>
									  </select>
								</div> 
							</div>
							<div class="clear"></div>
							<div class="right_fields">
								<div class="right_label">
									<label>Time Slot:<span style="color:red;">*</span> </label>
								 </div>
								 <div class="right_text">
									  <select name="select-cat" id="select-cat">
										  <option value="">Select</option>
										  <option value="6to7">6:00 To 7:00 AM</option>
										  <option value="7to8">7:00 To 8:00 AM</option>
									  </select>
								</div> 
							</div>
							<div class="clear"></div>
							
							
							<input name="amt" id="amt" type="hidden" value="0.50">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="cyclothon_type" id="cyclothon_type" type="hidden" value="<?php echo $cyclothon_type; ?>">
							<input name="cyclothon_year" id="cyclothon_year" type="hidden" value="2017">
							
							</div>
						</div>
						
						<div class="clear"></div>

				 </div>
				<div class="clear"></div>
				</div>
				
				<div class="certi_search">
				<div class="clear"></div>
			
			<div class="static-text"><strong>Waiver:</strong><br>
				<input class="confirm" id="confirm" type="checkbox" /> &nbsp;I declare, confirm and agree as follows that I/my ward
				</div>
				<section class="page-container-bottom">					
					<?php echo the_field('waiver', '738');?>
				</section>
				
			<div class="clear"></div>
			<div style="border:none;" class="page-container-bottom" id="captcha_div">
				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="g-recaptcha" data-sitekey="6LczogwUAAAAALTfW2HPnsD_qd2EyeIsTNVac9yA"></div>
				<span id="captcha" style="color:#000;" />
			</div>

			<div class="clear"></div>
			
		
			 <?php /* <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();" style="cursor:pointer;"> */ ?>
				</form>
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			
			<section class=" contact-form-section-bg" id="contact">
				<div class="contact-form-section middle-align">
					<?php 
					$id=159; 
					$post = get_post($id);?>
					<h1><?php echo $post->post_title; ?></h1>
					<?php 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;  
					?>

				 </div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
			<?php } } ?>
			

		<!--</div>	-->
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
        var date = jQuery(this).datepicker('getDate');
        var today = new Date();
        jQuery('#dob1').val(jQuery('#dob').val());
       	var formattedDate = date;
		var d = ("0" + formattedDate.getDate()).slice(-2);
		var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
		var y = formattedDate.getFullYear();  
      
		var date1 = new Date(y+'-'+m+'-'+d);
		var date2 = new Date("2017-01-27");
		var timeDiff = date2.getTime() - date1.getTime();
		var dayDiff = (timeDiff) / (1000 * 3600 * 24 * 365.25); 
       	
	}
});

$(function(){
      // bind change event to select
      $('#racecat').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
});
</script>
<?php get_footer(); ?>
