<?php
/**
 Template Name: Cyclothon Back up page
 */

get_header();
session_start();
//$userId = rand();
//$_SESSION["user"] = $userId;
$_GET['reg'] = 157;
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
        var date = jQuery(this).datepicker('getDate');
        var today = new Date();
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        
        //var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
      
      // alert(dayDiff);
		/*if(dayDiff<=15){ 
			alert('Not Eligible for selected Race Category.');
			jQuery("#dob").val("");
       	}*/
       	
       	var formattedDate = date;
		var d = ("0" + formattedDate.getDate()).slice(-2);
		var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
		var y = formattedDate.getFullYear();  
      
		dob = new Date(y+'-'+m+'-'+d);
		var today = new Date();		
		var age = (today-dob) / (365.25 * 60 * 60 * 24 * 1000);		
		var dayDiff = age;
       	
       	
        if(dayDiff<=18 && dayDiff>15){ 
			jQuery("#agegroup").val('15-18 years');
			jQuery("#age_group").val('15-18 years');
			//alert("You must need to register offline for 15-18 age group category.");
       	}
        else if(dayDiff<=40 && dayDiff>18){
			jQuery("#agegroup").val('19–40 years');
			jQuery("#age_group").val('19–40 years');
		}
        else if(dayDiff<=60 && dayDiff>40){
			jQuery("#agegroup").val('41-60 years');
			jQuery("#age_group").val('41-60 years');
		}
		else if(dayDiff>60){
			jQuery("#agegroup").val(60);
			jQuery("#age_group").val(60);
		}else {
			jQuery("#agegroup").val('');
		}
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
		//var confirm = document.getElementById ("confirm");       
      
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
        
        if(dob != '' && category != ''){
			if(category == 'Full cyclothon Ride' || category == 'Half cyclothon Ride'){				
				
				var d = new Date(dob);
				var n = d.getFullYear();				
				var yeardiff = 2016 - n;
				
				if(yeardiff <= 15){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}
			} else {
				$("#select-cat").val(category);
			}
		}
		var age_group = $("#age_group").val();        
		/*if(age_group == '15-18 years'){
			alert("You must need to register offline for 15-18 age group category.");
			return false;
		}*/
        if (document.getElementById('confirm_guidelines').checked == false) {
                alert ("You must accept the Registration guidelines!");
                document.getElementById('confirm_guidelines').focus();
                return false;
         }
        if (document.getElementById('confirm_rules').checked == false) {
                alert ("You must accept the Registration Rules!");
                document.getElementById('confirm_rules').focus();
                return false;
         }
        if (document.getElementById('confirm_confirmation').checked == false) {
                alert ("You must accept the Entry Confirmation!");
                document.getElementById('confirm_confirmation').focus();
                return false;
         }
        if (document.getElementById('confirm_prize').checked == false) {
                alert ("You must accept the Prize Money Rules!");
                document.getElementById('confirm_prize').focus();
                return false;
         }
        if (document.getElementById('confirm_participants').checked == false) {
                alert ("You must accept the Rules for participants!");
                document.getElementById('confirm_participants').focus();
                return false;
         }
       /* if (document.getElementById('confirm_liability').checked == false) {
                alert ("You must accept the Liability Waiver!");
                document.getElementById('confirm_liability').focus();
                return false;
         }*/
        if (document.getElementById('confirm_appeals').checked == false) {
                alert ("You must accept the Protests & Appeals!");   
                document.getElementById('confirm_appeals').focus();             
                return false;
         }
         if (document.getElementById('confirm').checked == false) {
                alert ("You must accept the User Agreement to Register!");
                document.getElementById('confirm').focus();             
                return false;
            }
        
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != '' && mailvalid == true && validatePhone(contact) == true){       
			
			if(category == 'Full cyclothon Ride'){
				$("#amt").val(700);
			} else if(category == 'Half cyclothon Ride'){
				$("#amt").val(700);
			} else if(category == 'Green Ride'){
				$("#amt").val(250);
			} else if(category == 'Fashion Ride'){
				$("#amt").val(100);
			} else if(category == 'Kids Ride'){
				$("#amt").val('');
			}
			/*if(category == 'Full cyclothon Ride'){
				$("#amt").val(1);
			} else if(category == 'Half cyclothon Ride'){
				$("#amt").val(1);
			} else if(category == 'Green Ride'){
				$("#amt").val(1);
			} else if(category == 'Fashion Ride'){
				$("#amt").val(1);
			} else if(category == 'Kids Ride'){
				$("#amt").val('');
			}*/
			
            return true;
        } else {
            return false;
        }
    }
    
  function checkregistrationemail()
    {	

    	//jQuery("#email").on('change', function(){
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
						//alert(response);
						if(response > 0){
							jQuery('#error_email').html("email address already exists.");	
							return false;						
						} else{
							jQuery('#error_email').html("");
						}
					}
				);
			}
		//})
	}
	
	function display_field()
	{
		var category  = $("#diffYear").val(); 
		if(category == 'Half cyclothon Ride'){
			$("#display_Geared").show();
		} else {
			$("#display_Geared").hide();			
			$("#geared").val('Fixie');
		}		
		
		if(category == 'Full cyclothon Ride'){
			$("#display_agegroup").hide();
		} else {
			var geared = $("#geared").val(); 
			if(category == 'Half cyclothon Ride' && geared == 'Fixie'){				
				$("#display_agegroup").hide();			
			} else {
				$("#display_agegroup").show();			
			}
		}
	}
	
	function display_geared()
	{
		var geared = $("#geared").val(); 
		if(geared == 'Fixie'){				
			$("#display_agegroup").hide();			
		} else {
			$("#display_agegroup").show();			
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

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '153' ), 'single-post-thumbnail' );  
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
				//echo '<pre>';
				//print_r($_POST);
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
				//$contact_no=$_POST['contact_no'];
				
				/* Insert into User Transaction Table */
				$table_name = "user_transaction";				
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
				if($_POST['select-cat'] == 'Kids Ride')
				{					
					$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='success' WHERE userid='".$userid."' and eventid='".$_GET['reg']."' "));
					$wpdb->query($wpdb->prepare("UPDATE user_transaction SET status='success' WHERE userid='".$userid."' and eventid='".$_GET['reg']."' "));
					
					$wpdb->query($wpdb->prepare("UPDATE user SET status='success' WHERE userid='".$userid."' "));
					
					$contactno=$_POST['contact_no'];
					$fullname=$_POST['fullname'];
				}
				else
				{				
					$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='".$status."' WHERE userid='".$userid."' and eventid='".$_GET['reg']."' "));

					$wpdb->query($wpdb->prepare("UPDATE user SET status='".$status."' WHERE userid='".$userid."' "));
					
					$contactno=$_POST['phone'];
					$fullname=$_POST['firstname'].' '.$_POST['lastname'];					
				}					
				
				$eveId = $_GET['reg'];
				$pageID = $eveId;
				$page = get_post($pageID);
				
				
				$querys2="Select * from user WHERE userid='".$userid."'";				
				$query_run2 = $wpdb->get_results($querys2);						
				$participant_no = $query_run2[0]->participant_no;
				$bip_no = $query_run2[0]->bip_no;
				$category_name = $query_run2[0]->category;
				$geared_name = $query_run2[0]->geared;
				if($category_name == 'Full cyclothon Ride'){
					$category_name_final = '100 Km Road Bike';
				} else if($category_name == 'Half cyclothon Ride'){
					if($geared_name == 'Fixie'){
						$category_name_final = '50 Km Fixie Bike';
					}else{
						$category_name_final = '50 Km Road Bike';
					}
				} else {
					$category_name_final = '';
				}
				
				/* SMS send  */
				if($bip_no != '' && $bip_no != 0){
					//$smsmsg = "Successful Registration for ".$page->post_title." Ahmedabad 21st February 2016. Bib No. =".$bip_no;									
					$smsmsg = "Successful Registration for Sugar Free Cyclothon Ahmedabad 21st February 2016 ".$category_name_final.". Bib No. =".$bip_no;									
				} else {
					//$smsmsg = "Successful Registration for ".$page->post_title." Ahmedabad 21st February 2016.";				
					$smsmsg = "Successful Registration for Sugar Free Cyclothon Ahmedabad 21st February 2016.";				
				}
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
/*							else if($occupation == 8)
				{
					$occp="Unemployed";
				}*/
				else if($occupation == 9)
				{
					$occp="Others";
				}
						$subject = 'PAYMENT SUCCESSFUL - REGISTRATION CONFIRMED';
				if($bip_no == '' && $bip_no == 0){
					$bip_no == '';
				}
                        $body = '
                        <b>Congratulations! Your registration for Sugar Free Cyclothon Ahmedabad 21st February 2016 '.$category_name_final.' has been confirmed. Here are the details of your transaction for your reference:</b><br /><br />
                        

                        Name: '.$fullname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />
                        Occupation: '.$occp.'<br />
                        Event: '.$page->post_title.'<br />
						Registration No: '.$participant_no.'<br />
						Bib No.: '.$bip_no.'<br />
						Amount: '.$amount.'<br /><br />
						
						Please note that the paid amount is non-transferable and non-refundable under any circumstances.<br /><br /><br />

                       
                        Regards,<br />
                        Ahmedabad Cyclothon 2016
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
						<p>Your payment was received successfully for</p><br>
						<div class='success-title'>Sugar Free Cyclothon Ahmedabad 21st February 2016 ".$category_name_final."</div></div>";
						
				
			}
	
			function payment_failure() {
				/* Payment failure logic goes here. */
				//echo "We are sorry. The Payment has failed";
				//echo "Payment Success" . "<pre>" . print_r( $_POST, true ) . "</pre>";
				global  $wpdb;
				$status=$_POST['status'];
				$txnid=$_POST['txnid'];
				$amount=$_POST['amount'];
				$fullname=$_POST['fullname'];					
				$mihpayid=$_POST['mihpayid'];
				$issuing_bank=$_POST['issuing_bank'];
				$card_type=$_POST['card_type'];								
				if($_POST['udf1'] == ''){
					$userid = $_SESSION["user"];
				} else {
					$userid = $_POST['udf1'];
				}				
				$occupation=$_POST['occupation'];
				$contactno=$_POST['contact_no'];
				$email=$_POST['email'];
				
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
				$wpdb->query($wpdb->prepare("UPDATE user_events SET payment='".$status."' WHERE userid='".$userid."' and eventid='".$_GET['reg']."' "));

				$wpdb->query($wpdb->prepare("UPDATE user SET status='".$status."' WHERE userid='".$userid."' "));
				
				$eveId = $_GET['reg'];
				$pageID = $eveId;
				$page = get_post($pageID);
				
				$querys2="Select * from user WHERE userid='".$userid."'";				
				$query_run2 = $wpdb->get_results($querys2);						
				$participant_no = $query_run2[0]->participant_no;
				$bip_no = $query_run2[0]->bip_no;
				
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
							/*else if($occupation == 8)
							{
								$occp="Unemployed";
							}*/
							else if($occupation == 9)
							{
								$occp="Others";
							}
						$subject = 'Failure Registration';
				
                        $body = '
                        <b>Thank you for your interest for participating in the Sugar Free Cyclothon Ahmedabad 21st February 2016 to be held at Ahmedabad on 21-2-2016.</b><br />                          
                        
                        Please note that your registration request no is '.$participant_no.'.<br />
                        
                        Please quote it for any future communication with us.<br />
						To confirm your registration you are required to pay your fees.<br />
						Please choose from any one of the following payment options. Please note that for payments made through Cheque, Demand Draft and Direct Deposit, transaction delays are common owing to factors beyond our control. Your registration will be complete only after successful receipt of your payment. You will also receive an email from us confirming your payment and your registration.<br />
						We look forward to seeing you at the race!<br /><br /><br />
                        
						Regards,<br />
                        Ahmedabad Cyclothon 2016<br/><br/>
                        
                        <b>Cheque / Demand Draft:</b><br />
						Expect delays from your courier service and/or bank clearing. Only available for Indian Residents.<br /><br />

						In favor of JP Sports & Events payable at Ahmedabad and send it to following address:<br /><br />

						<b>JP Sports & Events</b><br />
						236 Akshar Arcade,<br />
						Opp. Memnagar fire station,<br />
						Ahmedabad 380014<br />
						Gujarat, India.<br /><br /><br />
						 
						<b>Pay Online:</b><br />
						Fastest, Swiftest and Always the Easiest for Everyone!<br /><br /> 

						http://jpsport.in/cyclothon  to pay online through BillDesk using Credit Card / Debit Card / Online Banking.

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

				echo "<div id='slider1' style='background:url(".site_url()."/wp-content/themes/jpsports/images/new-crop.jpg) no-repeat scroll center center / cover  rgba(0, 0, 0, 0)'>
				<div class='top-bar'><img src='".site_url()."/wp-content/themes/jpsports/images/logo.png'></div>
            	</div><div class='payment-success'>
				<div class='thank-you-msg'>Sorry</div><br>
				<p>Your payment has failed for</p><br>
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
						$t_shirt_size=$_POST['t_shirt_size'];
						$category=$_POST['select-cat'];
						$age_group=$_POST['age_group'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$nationality=$_POST['nationality'];
						$bikemake=$_POST['bikemake'];
						if($category == 'Half cyclothon Ride'){
							$geared=$_POST['geared'];
						} else {
							$geared = '';
						}
						$zip_code=$_POST['zip'];
						$contactperson=$_POST['ecp'];
						$contactperson2=$_POST['ecp2'];
						$contact_no=$_POST['ecn'];
						$contact_no2=$_POST['ecn2'];
						$previous_cycling_experiences=$_POST['previous_cycling_experiences'];
						$other_adventure_sports=$_POST['other_adventure_sports'];
						
						$querys1="Select id from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$userid_db = $query_run1[0]->id + 1;						
						
						//$userid = rand();
						$userid = time().$userid_db;																		
						//$userid = time().$userid_db;						
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						/*bip no logic*/						
						$bip_no = '';
						if($category == 'Fashion Ride' || $category == 'Kids Ride'){
							$bip_no = '';
						} else {
							if($category == 'Full cyclothon Ride'){
								$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and gender='".$gender."' order by id desc limit 0,1";				
							} else if($category == 'Half cyclothon Ride'){
								$querys1="Select gender,category,bip_no,race_category from user WHERE race_category='".$racecategory."' and category='".$category."' and gender='".$gender."' and geared='".$geared."' order by id desc limit 0,1";				
							} else {
								$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' order by id desc limit 0,1";				
							}						
							$query_run1 = $wpdb->get_results($querys1);
							if($wpdb->num_rows > 0){
								$bip_no = $query_run1[0]->bip_no + 1;
							} else {							
								if($category == 'Full cyclothon Ride'){
									if($gender == '0'){
										$bip_no = 10000;  // male
									}else{
										$bip_no = 9000; // female
									}
								}else if($category == 'Half cyclothon Ride'){
									if($gender == '0' && $geared == 'Geared'){
										$bip_no = 11000;  // male & bike
									}else if($gender == '1' && $geared == 'Geared'){
										$bip_no = 16000; // female & bike
									}else if($gender == '0' && $geared == 'Fixie'){
										$bip_no = 14000; // male & fixie
									}else if($gender == '1' && $geared == 'Fixie'){
										$bip_no = 18000; // female & fixie
									}
								}else if($category == 'Green Ride'){
									$bip_no = 5000; // male & female
								}else{
									$bip_no = '';
								}
							}
						}
						/*end logic*/
						
						/*$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$participant_no = $query_run1[0]->participant_no + 1;						*/
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
					$insert_val .= "age_group=".$age_group."<br/>";
					$insert_val .= "t_shirt_size=".$t_shirt_size."<br/>";
					$insert_val .= "address=".$addressline."<br/>";
					$insert_val .= "city=".$city."<br/>";
					$insert_val .= "state=".$state."<br/>";
					$insert_val .= "country=".$country."<br/>";
					$insert_val .= "zipcode=".$zip_code."<br/>";
					$insert_val .= "contact_person_name=".$contactperson."<br/>";
					$insert_val .= "contact_person_name2=".$contactperson2."<br/>";
					$insert_val .= "contact_person_contact_no=".$contact_no."<br/>";
					$insert_val .= "contact_person_contact_no2=".$contact_no2."<br/>";
					$insert_val .= "participant_no=".$participant_no."<br/>";
					$insert_val .= "nationality=".$nationality."<br/>";
					$insert_val .= "bikemake=".$bikemake."<br/>";
					$insert_val .= "previous_cycling_experiences=".$previous_cycling_experiences."<br/>";
					$insert_val .= "other_adventure_sports=".$other_adventure_sports."<br/>";
					$insert_val .= "geared=".$geared."<br/>";							
					$insert_val .= "bip_no=".$bip_no."<br/>";							
					$insert_val .= "userid=".$userid."<br/>";							
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From:priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query',$insert_val,$headers);
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
						'age_group'=>$age_group,	
						't_shirt_size'=>$t_shirt_size,
						'address'=>$addressline,
						'city'=>$city,
						'state'=>$state,
						'country'=>$country,
						'zipcode'=>$zip_code,	
						'contact_person_name'=>$contactperson,
						'contact_person_name2'=>$contactperson2,
						'contact_person_contact_no'=>$contact_no,
						'contact_person_contact_no2'=>$contact_no2,
						'participant_no'=>$participant_no,
						'nationality'=>$nationality,
						'bikemake'=>$bikemake,
						'previous_cycling_experiences'=>$previous_cycling_experiences,
						'other_adventure_sports'=>$other_adventure_sports,
						'geared'=>$geared,												
						'bip_no'=>$bip_no,												
						'userid'=>$userid					
						) )) { 
					
					
						$id=$userid;
						$eid=$racecategory;
						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";			
								header("location:http://jpsport.in/cyclothon/");
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
									'amount'=> $_POST['amt'],
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
						//echo '1';
						
			} else {
				header("location:http://jpsport.in/cyclothon/");
				exit;	
			}
				//echo $_POST['txnid'];exit;
				
					
			} else { 
			if($s_status != 'success') { ?>
			<!--<div id="slider" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">-->
			<div id="slider">
				<!--<img src="<?php echo $image[0]; ?>" style="width:100%;">-->
				<!--<div class="header-img" style="background-color:#f1ce74;">-->
				<div class="header-img" style="background-color:#aabcca;">
				<img src="<?php echo $image[0]; ?>">
				</div>
            <!--<div class="top-bar">									
            <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>-->
			<div class="main-container">
			<!--<section class="how-can-main" id="section6">
				<div class="how-can-new middle-align">
																
																<?php 
																$id=174; 
																$post = get_post($id); ?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
				<div class="clear"></div>
			</section><div class="clear"></div>-->
			
			<div class="middle-align">
					<div class="main_menu_tab">
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#home">HOME</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#event_info">EVENT INFO</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#sponsors">SPONSORS</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#form">FORM AVAILABILITY</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#route">ROUTE INFO</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#prize">PRIZE BIFURCATION</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#registration">REGISTRATION</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/#contact">CONTACT</a></div>
					</div>
					<div class="clear"></div>
				</div>
			
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class="page-container page-container-new"><?php the_content();?></section>
			<!--<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">

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
								  <option value="0">Male</option>
								  <option value="1">Female</option>
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
							
							<div class="left_fields">
								<div class="left_label">
									<label>Nationality:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="nationality" id="nationality" />
								 </div>
							</div>
							<div class="clear"></div>																										
							<div class="left_fields">
								<div class="left_label">
									<label>Bike make:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="bikemake" id="bikemake" />
								 </div>
							</div>
							<div class="clear"></div>		
							<div class="left_fields">
								<div class="left_label">
									<label>T-shirt Size:</label> 
								</div>
								<div class="left_text">
									<!--<input type="radio" name="t_shirt_size">&nbsp;S&nbsp;
									<input type="radio" name="t_shirt_size">&nbsp;M&nbsp;
									<input type="radio" name="t_shirt_size">&nbsp;L&nbsp;
									<input type="radio" name="t_shirt_size">&nbsp;XL&nbsp;
									<input type="radio" name="t_shirt_size">&nbsp;XXL&nbsp;-->
									<!--<select name="t_shirt_size" id="t_shirt_size">
										<option value="">Select</option>
										<option value="S">S</option>								
										<option value="M">M</option>
										<option value="L">L</option>
										<option value="XL">XL</option>
										<option value="XXl">XXL</option>
									</select>
								 </div>
							</div>
							<div class="clear"></div>		
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Other Adventure Sports:</label>
								<div class="right_text"> 
									<input type="text" name="other_adventure_sports" id="other_adventure_sports" />
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
										<label>Race Category:<span style="color:red;">*</span></label>  
									</div>
									<div class="right_text">								
										<select name="category" id="diffYear" onchange="display_field(this);">
											<option value="">Select</option>
											<option value="Full cyclothon Ride">Full cyclothon Ride(Elite Riders) - 100 Km - 700 Rs</option>								
											<option value="Half cyclothon Ride">Half cyclothon Ride - 50 Km - 700 Rs</option>
											<option value="Green Ride">Green Ride - 14 km - 250 Rs</option>
											<option value="Fashion Ride">Fashion Ride - 5 km - 100 Rs</option>
											<option value="Kids Ride">Kids Ride - 2 km - Nil</option>
										</select>
									</div> 
							</div>
							<div class="clear"></div>
							<div id="display_Geared" style="display:none;">
								<div class="left_fields">
									<div class="left_label">
										<label>Geared/Non-geared:</label> 
									</div>
									<div class="left_text">
										<select name="geared" id="geared" onchange="display_geared(this);">
										  <!--<option value="">Select</option>-->
										 <!-- <option value="Fixie">Fixie (Made in India)</option>
										  <option value="Geared">Geared (Road Bike)</option>
										</select> 
									 </div>
								</div>
								<div class="clear"></div>																										
							</div>
							
							<div class="right_fields">
								<div class="right_label">
								  <label>Date of Birth:<span style="color:red;">*</span></label>
								 </div>
								 <div class="right_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>
							
							<div id="display_agegroup">
								<div class="right_fields">
									<div class="right_label">
										<label>Age Group:</label>  
									</div>
									<div class="right_text">								
										<select name="agegroup" id="agegroup" disabled="disabled">
											<option value="">Select</option>
											<option value="15-18 years">15 years and above</option>								
											<option value="19–40 years">19 years and above</option>
											<option value="41-60 years">41 years and above</option>										
											<option value="60">60 years and above</option>
										</select>
									</div> 
								</div>
								<div class="clear"></div>
							</div>
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

						<!--	<div class="right_fields">
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
									<label>Emergency Contact Name1:</label>
								</div>
								<div class="right_text">  
									<input type="text" name="ecp" id="ecp"/>
								</div>
							</div>
							<div class="clear"></div>
							
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Emergency Contact Number1:</label>
								<div class="right_text"> 
									<input type="text" name="ecn" id="ecn" />
								 </div>
							 </div>
								<div class="clear"></div>
								
							<div class="right_fields">
								<div class="right_label">
									<label>Emergency Contact Name2:</label>
								</div>
								<div class="right_text">  
									<input type="text" name="ecp2" id="ecp2"/>
								</div>
							</div>
							<div class="clear"></div>
							
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Emergency Contact Number2:</label>
								<div class="right_text"> 
									<input type="text" name="ecn2" id="ecn2" />
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
								  <option value="0">Business</option>
								  <option value="1">Self employed</option>
								  <option value="2">Salaried</option>
								  <option value="3">Govt. employed</option>
								  <option value="4">Retired</option>
								  <option value="5">House wife</option>
								  <option value="6">Student</option>
								  <option value="7">Sports Person</option>
								  <!--<option value="8">Unemployed</option>
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>								
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Previous Cycling Experiences:</label>
								<div class="right_text"> 
									<input type="text" name="previous_cycling_experiences" id="previous_cycling_experiences" />
								 </div>
							 </div>
								<div class="clear"></div>							
							
							<?php //$id = $_GET['reg'];?>
							<!--<input name="amt" id="amt" type="hidden" value="<?php //echo the_field('price', $id);?>">
							<input name="amt" id="amt" type="hidden" value="">
							<input name="race" id="race" type="hidden" value="<?php //echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php //echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php //echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							<input name="age_group" id="age_group" type="hidden" value="">
							</div>
						</div>
					</div>																
				 </div><!-- middle-align 
				<div class="clear"></div>
				<div class="certi_search">

				<!--<div class="static-text"><strong>Waiver:</strong><br>
				<input class="confirm" id="confirm" type="checkbox" /> &nbsp;I declare, confirm and agree as follows that I/my ward
				</div>
				<section class="page-container-bottom">					
					<?php //echo the_field('waiver', $_GET['ID']);?>
				</section>	-->
				
				<section class="page-container page-container-new" style="text-align:left;">
																<?php 
																$id=155; 
																$post = get_post($id);?>
																<?php 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;
																?>
																
				<div class="clear"></div>
			</section><div class="clear"></div>
			
			<!--<div class="static-text"><strong>Waiver:</strong><br>
				<input class="confirm" id="confirm" type="checkbox" /> &nbsp;I declare, confirm and agree as follows that I/my ward
				</div>
				<section class="page-container-bottom">					
					<?php //echo the_field('waiver', '153');?>
				</section>
			<div class="clear"></div>
			
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();" style="cursor:pointer;">
				</form>
				</div>
				<div class="clear"></div>
			
			</section>	-->
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

<?php get_footer(); ?>
