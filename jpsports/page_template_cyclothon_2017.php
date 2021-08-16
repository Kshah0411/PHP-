<?php
/**
 Template Name: Cyclothon page 2017
 */

get_header();
session_start();
//$userId = rand();
//$_SESSION["user"] = $userId;
$_GET['reg'] = 525;
$cyclothon_itt_select = $_GET['cyclothon_itt_select'];
//$cyclothon_itt_select = 1;
if($cyclothon_itt_select == 2){
	$cyclothon_type = 'CYCLOTHON + ITT RACE';
} else {
	$cyclothon_type = 'CYCLOTHON';
}
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
        var racecategory  = $("#race").val();
        var category  = $("#diffYear").val();        
        var geared_select  = $("#geared").val();
        var cyclothon_type  = $("#cyclothon_type").val();
        
        var ecp  = $("#ecp").val();
        var ecn  = $("#ecn").val();
        var ecp2  = $("#ecp2").val();
        var ecn2  = $("#ecn2").val();
        
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
        
        if(category == 'Half cyclothon Ride' || category == 'ITT Half cyclothon Ride'){				
			if(geared_select == '') {
				$("#geared").addClass("error");
			}
			else if(geared_select != ''){
				$("#geared").removeClass("error");
			}
		}
        
        if(ecp.toLowerCase() == fname.toLowerCase() && ecp != "") {
            $("#ecp").addClass("error");
            alert('Your name and Emergency Contact Person1 can not same.');
            return false;
        } else {
			$("#ecp").removeClass("error");
		}
		
		if(ecp2.toLowerCase() == fname.toLowerCase() && ecp2 != "" ) {
            $("#ecp2").addClass("error");
            alert('Your name and Emergency Contact Person2 can not same.');
            return false;
        } else {
			$("#ecp2").removeClass("error");
		}
		
		
		if(ecn == contact && ecn != "") {
            $("#ecn").addClass("error");
            alert('Your number and Emergency Contact Number1 can not same.');
            return false;
        } else {
			$("#ecn").removeClass("error");
		}
		if(ecn2 == contact && ecn2 != "") {
            $("#ecn2").addClass("error");
            alert('Your number and Emergency Contact Number2 can not same.');
            return false;
        } else {
			$("#ecn2").removeClass("error");
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
		
        if(dob != '' && category != ''){
			if(category == 'Full cyclothon Ride' || category == 'Half cyclothon Ride'){				
				if(category == 'Full cyclothon Ride' && gender == 1){
					alert ("Females are Not Eligible for selected Race Category.");
					return false;
				}
				if(yeardiff < 15){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}
			} /*else if(category == 'ITT Full cyclothon Ride' || category == 'ITT Half cyclothon Ride'){
				if(category == 'ITT Full cyclothon Ride' && gender == 1){
					alert ("Females are Not Eligible for selected Race Category.");
					return false;
				}
				if(yeardiff < 15){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}
			}*/ else if(category == 'Ahmedabad Green Ride' || category == 'Fashion Ride'){				
				/*22-12-2016
				if(yeardiff < 10){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}*/
				$("#select-cat").val(category);
			} else if(category == 'Kids Ride'){
				//22-12-2016 if(yeardiff >= 15 && yeardiff <= 18){
				if(yeardiff <= 18){
					$("#select-cat").val(category);
				} else {
					alert("You are not Eligible for Kids Ride.");
					return false;
				}
				//alert("You must need to register offline for Kids Ride.");
				//return false;
			} else {
				$("#select-cat").val(category);
			}
		}
		var age_group = $("#age_group").val();  
		
		/*22-12-2016
		if(yeardiff<15){ 
			alert("Under 15 years age you must need to register offline. Please go to JP Sports & Events office.");
			return false;
		}*/
		      
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
        if (document.getElementById('confirm_prize').checked == false) {
                alert ("You must accept the Prize Money Rules!");
                document.getElementById('confirm_prize').focus();
                return false;
         }
        if (document.getElementById('confirm_confirmation').checked == false) {
                alert ("You must accept the Entry Confirmation!");
                document.getElementById('confirm_confirmation').focus();
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
           <?php if($cyclothon_itt_select == '2'){ ?>
           if(category != 'Kids Ride' && category != 'Ahmedabad Green Ride' && category != 'Fashion Ride'){
				 if (document.getElementById('itt_confirm1').checked == false) {
						alert ("Please select I understand that there will be no seperate prizes for fixie bike category.");
						document.getElementById('itt_confirm1').focus();             
						return false;
					}
				}
            <?php } ?>
            
        var googleCaptch = get_action(this);
        if(googleCaptch == false)
        {
			document.getElementById('captcha_div').focus();
			return false
		}
            
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != '' && mailvalid == true && validatePhone(contact) == true && check_geared_select() == true && googleCaptch == true){
			
			if(category == 'Full cyclothon Ride' && cyclothon_type == "CYCLOTHON"){
				$("#amt").val(700);
			} else if(category == 'Half cyclothon Ride' && cyclothon_type == "CYCLOTHON"){
				$("#amt").val(700);
			} else if(category == 'Full cyclothon Ride' && cyclothon_type == "CYCLOTHON + ITT RACE"){
				$("#amt").val(1000);
			} else if(category == 'Half cyclothon Ride' && cyclothon_type == "CYCLOTHON + ITT RACE"){
				$("#amt").val(1000);
			} else if(category == 'Ahmedabad Green Ride'){
				$("#amt").val(250);
			} else if(category == 'Fashion Ride'){
				$("#amt").val(100);
			} else if(category == 'Kids Ride'){
				$("#amt").val(100);
			} 
			/*if(category == 'Full cyclothon Ride' && cyclothon_type == "CYCLOTHON"){
				$("#amt").val(1);
			} else if(category == 'Half cyclothon Ride' && cyclothon_type == "CYCLOTHON"){
				$("#amt").val(1);
			} else if(category == 'Full cyclothon Ride' && cyclothon_type == "CYCLOTHON + ITT RACE"){
				$("#amt").val(1);
			} else if(category == 'Half cyclothon Ride' && cyclothon_type == "CYCLOTHON + ITT RACE"){
				$("#amt").val(1);
			} else if(category == 'Ahmedabad Green Ride'){
				$("#amt").val(1);
			} else if(category == 'Fashion Ride'){
				$("#amt").val(1);
			} else if(category == 'Kids Ride'){
				$("#amt").val(1);
			}*/
			
			finalSubmit(true);
            return false;
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
    
  function finalSubmit(isSubmit)
  {
	  if(isSubmit == true)
	  {
		  $('.modal').css('display','block');
		  $('#display_name').html($('#fullname').val());
		  var gen = $('#gen').val();
		  if(gen == 0) {
			  gen = 'Male';
		  } else {
			  gen = 'Female';
		  }
		  $('#display_gender').html(gen);
		  $('#display_bloodgroup').html($('#email').val());
		  
		  var racecat = $('#diffYear').val();
		  if(racecat == 'Full cyclothon Ride')
		  {
			  $('#display_racecategory').html("Champions' Ride(Elite Riders) - 100 Km - 700 Rs");
			  $('.display_geared').hide();
		  } else if(racecat == 'Half cyclothon Ride')
		  {
			  $('#display_racecategory').html("Challengers' Ride - 50 Km - 700 Rs");
			  var dis_geared = $('#geared').val();
			  if(dis_geared == 'Open'){dis_geared = 'Open'; } else { dis_geared = 'Fixie (Non Gear)'; }
			  $('#display_geared1').html(dis_geared);
			  $('.display_geared').show();
			  //display_geared
		  } else if(racecat == 'Ahmedabad Green Ride')
		  {
			  $('#display_racecategory').html('Ahmedabad Green Ride - 14 km - 250 Rs');
			  $('.display_geared').hide();
		  } else if(racecat == 'Fashion Ride')
		  {
			  $('#display_racecategory').html('Fashion Ride - 5 km - 100 Rs');
			  $('.display_geared').hide();
		  } else if(racecat == 'Kids Ride')
		  {
			  $('#display_racecategory').html('Kids Ride - 2 km - 100 Rs');
			  $('.display_geared').hide();
		  } else if(racecat == 'ITT Full cyclothon Ride')
		  {
			  $('#display_racecategory').html('ITT With 100 Km - 1000 Rs');
			  $('.display_geared').hide();
		  } else if(racecat == 'ITT Half cyclothon Ride')
		  {
			  $('#display_racecategory').html('ITT With 50 Km - 1000 Rs');
			  var dis_geared = $('#geared').val();
			  if(dis_geared == 'Open'){dis_geared = 'Open'; } else { dis_geared = 'Fixie (Non Gear)'; }
			  $('#display_geared1').html(dis_geared);
			  $('.display_geared').show();
			  //display_geared
		  }
		  $('#display_tshirt').html($('#t_shirt_size').val());
		  $('#display_birthdate').html($('#dob').val());
		  $('#display_mobile').html($('#contact_no').val());	
		  var age_group_var = '';
		  if($('#age_group').val() == '40'){
			  age_group_var = '40 years and above';
		  } else if($('#age_group').val() == '60'){
			  age_group_var = '60 years and above';
		  } else {
			  age_group_var = $('#age_group').val();
		  }
		  $('#display_agegroup_id').html(age_group_var);		  
	  }
  }
    
  // rushi
  function closeModel(){
	  $('.modal').css('display','none');
	  return false;
  }  
    
  function check_geared_select(){
	  var category  = $("#diffYear").val();        
      var geared_select  = $("#geared").val();
	  
	  if(category == 'Half cyclothon Ride' || category == 'ITT Half cyclothon Ride'){				
			if(geared_select == '') {
				$("#geared").addClass("error");
				return false;
			}
			else{
				$("#geared").removeClass("error");
				return true;
			}
		}
		return true;
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
		$("#cat_open").show();
		$("#cat_fixie").hide();
		if(category == 'Half cyclothon Ride'){
			$("#display_Geared").show();
		} else {
			$("#display_Geared").hide();			
			$("#geared").val('');
		}		
		
		if(category == 'Kids Ride' || category == 'Ahmedabad Green Ride' || category == 'Fashion Ride'){
			$("#for_itt_race_box").hide();			
		} else {
			$("#for_itt_race_box").show();
		}
		
		if(category == 'Full cyclothon Ride' || category == 'Ahmedabad Green Ride' || category == 'Fashion Ride'){
			$("#display_agegroup").hide();
			$("#cat_fixie").hide();			
		} else {
			$("#display_agegroup").show();
			$("#cat_fixie").hide();						
		}
	}
	
	function display_geared()
	{
		var geared = $("#geared").val(); 
		//alert($("#dob").val(''));
		$("#dob").val(''); 
		//alert($("#dob").val(''));
		if(geared == 'Fixie'){				
		//if(geared == ''){				
			//$("#display_agegroup").hide();					
			$("#cat_fixie").show();			
			$("#cat_open").hide();			
		} else {
			//$("#display_agegroup").show();			
			$("#cat_fixie").hide();			
			$("#cat_open").show();			
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

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '525' ), 'single-post-thumbnail' );  ?>
	<?php	
			require_once dirname( __FILE__ ) . '/payu.php';			
			$s_status=$_POST['status'];
			
	if($s_status == 'success') 	
			{
				//echo 'hello';exit;
				payment_success();
			}
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
				$querys3="Select * from user WHERE userid='".$userid."'";				
				$query_run3 = $wpdb->get_results($querys3);						
				$age_year = $query_run3[0]->age_year;
				if($age_year >= 60)
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
				$bip_no1 = $query_run2[0]->bip_no1;
				$category_name = $query_run2[0]->category;
				$geared_name = $query_run2[0]->geared;
				$cyclothon_type = $query_run2[0]->cyclothon_type;
				$gender = $query_run2[0]->gender;
				if($gender == 0){
					$gender = 'Male';
				} else if($gender == 1){
					$gender = 'Female';
				} else {
					$gender = '';
				}
								
				if($category_name == 'Full cyclothon Ride' && $cyclothon_type == 'CYCLOTHON + ITT RACE'){
					$category_name_final = "ITT Race With Champions' Category(100km)";
				} else if($category_name == 'Half cyclothon Ride' && $cyclothon_type == 'CYCLOTHON + ITT RACE'){
					if($geared_name == 'Fixie'){
						$category_name_final = "ITT Race With Challengers' Ride (50 km-Fixie)";
					}else{
						$category_name_final = "ITT Race With Challengers' Ride (50 km-Open)";
					}
				} else if($category_name == 'Full cyclothon Ride' && $cyclothon_type == 'CYCLOTHON'){
					$category_name_final = "Champions' Category(100km)";
				} else if($category_name == 'Half cyclothon Ride' && $cyclothon_type == 'CYCLOTHON'){
					if($geared_name == 'Fixie'){
						$category_name_final = "Challengers' Ride (50 km-Fixie)";
					}else{
						$category_name_final = "Challengers' Ride (50 km-Open)";
					}
				} else if($category_name == 'Ahmedabad Green Ride'){
					$category_name_final = "Ahmedabad Green Ride (14 km)";
				} else if($category_name == 'Fashion Ride'){
					$category_name_final = "Fashion Ride (5 km)";
				} else if($category_name == 'Kids Ride'){
					$category_name_final = "Kids Ride (2 km)";
				} else {
					$category_name_final = '';
				}
				
				/* SMS send  */
				if($bip_no != '' && $bip_no != 0){
					$smsmsg = "Congratulations! You have successfully registered for Sugar Free Cyclothon Ahmedabad 29 January 2017, ".$category_name_final." - ".$gender.". Your Bib No. is ".$bip_no." Save it for further correspondence";					
					if($bip_no1 != '' && $bip_no1 != 0){
						$smsmsg = "Congratulations! You have successfully registered for Sugar Free Cyclothon Ahmedabad 29 January 2017, ".$category_name_final." - ".$gender.". Your Cyclothon Bib No. is ".$bip_no." and ITT Bib No. is ".$bip_no1." Save it for further correspondence";					
					}
				} else {
					$smsmsg = "Successful Registration for Sugar Free Cyclothon Ahmedabad 29th January 2017.";				
				}
				//echo $smsmsg;exit;
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
					$bip_no1 == '';
				}
				if($cyclothon_type == 'CYCLOTHON + ITT RACE' && $category != 'Fashion Ride' && $category != 'Kids Ride' && $category != 'Ahmedabad Green Ride'){
					$body = '
                        <b>Congratulations! Your registration for Sugar Free Cyclothon Ahmedabad '.$category_name_final.' has been confirmed. Here are the details of your transaction for your reference:</b><br /><br />
                        

                        Name: '.$fullname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />
                        Occupation: '.$occp.'<br />
                        Gender: '.$gender.'<br />
                        Event: '.$page->post_title.'<br />
						Registration No: '.$participant_no.'<br />
						Bib No. for Cyclothon: '.$bip_no.'<br />
						Bib No. for ITT Race: '.$bip_no1.'<br />
						Amount: '.$amount.'<br /><br />
						
						Please note that the paid amount is non-transferable and non-refundable under any circumstances.<br /><br /><br />

                       
                        Regards,<br />
                        Ahmedabad Cyclothon 2017
                        ';
				} else {
                        $body = '
                        <b>Congratulations! Your registration for Sugar Free Cyclothon Ahmedabad '.$category_name_final.' has been confirmed. Here are the details of your transaction for your reference:</b><br /><br />
                        

                        Name: '.$fullname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />
                        Occupation: '.$occp.'<br />
                        Gender: '.$gender.'<br />
                        Event: '.$page->post_title.'<br />
						Registration No: '.$participant_no.'<br />
						Bib No.: '.$bip_no.'<br />
						Amount: '.$amount.'<br /><br />
						
						Please note that the paid amount is non-transferable and non-refundable under any circumstances.<br /><br /><br />

                       
                        Regards,<br />
                        Ahmedabad Cyclothon 2017
                        ';
				}
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
						<div class='success-title'>SUGAR FREE CYCLOTHON<br/> ".$category_name_final."</div></div>";
						
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
				$bip_no1 = $query_run2[0]->bip_no1;
				
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
                        <b>Thank you for your interest for participating in the Sugar Free Cyclothon Ahmedabad 29th January 2017 to be held at Ahmedabad on 29-1-2017.</b><br />                          
                        
                        Please note that your registration request no is '.$participant_no.'.<br />
                        
                        Please quote it for any future communication with us.<br />
						To confirm your registration you are required to pay your fees.<br />
						Please choose from any one of the following payment options. Please note that for payments made through Cheque, Demand Draft and Direct Deposit, transaction delays are common owing to factors beyond our control. Your registration will be complete only after successful receipt of your payment. You will also receive an email from us confirming your payment and your registration.<br />
						We look forward to seeing you at the race!<br /><br /><br />
                        
						Regards,<br />
                        Ahmedabad Cyclothon 2017<br/><br/>
                        
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
	
	if ( isset($_POST['btn_submit'])  || isset($_POST['btn_submit1']) ) 
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
						$age_group1=$_POST['age_group1'];
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
						$cyclothon_year=$_POST['cyclothon_year'];
						$cyclothon_type=$_POST['cyclothon_type'];						
						$hd_age_year=$_POST['hd_age_year'];
						
						$querys1="Select id from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$userid_db = $query_run1[0]->id + 1;						
						
						$userid = time().$userid_db;																		
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						/*bip no logic*/						
						$bip_no = '';
						$bip_no1 = '';
						if($category == 'Fashion Ride' || $category == 'Kids Ride' || $category == 'Ahmedabad Green Ride'){
							$bip_no = '';
							$bip_no1 = '';
						} else {
							if($cyclothon_type == 'CYCLOTHON + ITT RACE'){
								if($category == 'Full cyclothon Ride'){
									//$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' order by id desc limit 0,1";
									//$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and offline is NULL order by id desc limit 0,1";
									$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and offline is NULL order by bip_no desc limit 0,1";
									
									//$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type == 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
									if($gender == '0' && $age_group1 == '15-39 years'){
										$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' and offline is NULL order by bip_no1 desc limit 0,1";
									} else {
										$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by bip_no1 desc limit 0,1";
									}
									
								} else if($category == 'Half cyclothon Ride'){									
									$querys1="Select gender,category,bip_no,race_category from user WHERE race_category='".$racecategory."' and category='".$category."' and gender='".$gender."' and geared='".$geared."' and age_group='".$age_group."' order by id desc limit 0,1";
									
									//$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
									if($gender == '0' && $age_group1 == '15-39 years'){
										$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' and offline is NULL order by bip_no1 desc limit 0,1";
									} else {
										$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by bip_no1 desc limit 0,1";
									}
								}
								
								$query_run1 = $wpdb->get_results($querys1);							
								if($wpdb->num_rows > 0){																								
									$bip_no = $query_run1[0]->bip_no + 1;
									
									// rushi 12-1-2017 give new bib series
									if($bip_no == 1100 && $gender == '0' && $geared == 'Open' && $age_group == '15-18 years' && $category == 'Half cyclothon Ride'){
										$bip_no = 6900;  // male & open & 15-18
									}
									
								} else {
									if($category == 'Full cyclothon Ride'){
										$bip_no = 101;  // male
									} else if($category == 'Half cyclothon Ride'){
										if($gender == '0' && $geared == 'Open' && $age_group == '15-18 years'){
											$bip_no = 1000;  // male & open & 15-18
										}else if($gender == '1' && $geared == 'Open' && $age_group == '15-18 years'){
											$bip_no = 1100; // female & open & 15-18
										}else if($gender == '0' && $geared == 'Open' && $age_group == '19–39 years'){										
											$bip_no = 300;  // male & open & 19-39
										}else if($gender == '1' && $geared == 'Open' && $age_group == '19–39 years'){
											$bip_no = 1200; // female & open & 19-39
										}else if($gender == '0' && $geared == 'Open' && $age_group == '40-59 years'){
											$bip_no = 700;  // male & open & 40-59
										}else if($gender == '1' && $geared == 'Open' && $age_group == '40-59 years'){
											$bip_no = 1300; // female & open & 40-59
										}else if($gender == '0' && $geared == 'Open' && $age_group == '60'){
											$bip_no = 1400;  // male & open & 60+
										}else if($gender == '1' && $geared == 'Open' && $age_group == '60'){
											$bip_no = 1500; // female & open & 60+
										}
										
										if($gender == '0' && $geared == 'Fixie' && $age_group == '15-39 years'){
											$bip_no = 2000;  // male & fixie & 15-39
										}else if($gender == '1' && $geared == 'Fixie' && $age_group == '15-39 years'){
											$bip_no = 2400; // female & fixie & 15-39
										}else if($gender == '0' && $geared == 'Fixie' && $age_group == '40'){
											$bip_no = 2300;  // male & fixie & 40
										}else if($gender == '1' && $geared == 'Fixie' && $age_group == '40'){
											$bip_no = 2500; // female & fixie & 40
										}
									}
								}
								
								
								$query_run2 = $wpdb->get_results($querys2);												
								if($wpdb->num_rows > 0 && $query_run2[0]->bip_no1 > 1){									
										$bip_no1 = $query_run2[0]->bip_no1 + 1;							
								} else {				
									if($category == 'Full cyclothon Ride'){
										if($gender == '0' && $age_group1 == '15-39 years'){
											$bip_no1 = 5100;  // male & 15-39
										}else if($gender == '1' && $age_group1 == '15-39 years'){
											$bip_no1 = 6000;  // female & 15-39
										}else if($gender == '0' && $age_group1 == '40'){
											$bip_no1 = 5600;  // male & 40+
										}else if($gender == '1' && $age_group1 == '40'){
											$bip_no1 = 6300;  // female & 40+
										}
									} else if($category == 'Half cyclothon Ride'){
										
										if($gender == '0' && $age_group1 == '15-39 years'){
											$bip_no1 = 5100;  // male & 15-39
										}else if($gender == '1' && $age_group1 == '15-39 years'){
											$bip_no1 = 6000;  // female & 15-39
										}else if($gender == '0' && $age_group1 == '40'){
											$bip_no1 = 5600;  // male & 40+
										}else if($gender == '1' && $age_group1 == '40'){
											$bip_no1 = 6300;  // female & 40+
										}
									} else {
										$bip_no1 = '';
									} 
								}
								
								
							} else {
								if($category == 'Full cyclothon Ride'){
									//$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' order by id desc limit 0,1";
									//$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' offline is NULL order by id desc limit 0,1";
									$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and offline is NULL order by bip_no desc limit 0,1";
								} else if($category == 'Half cyclothon Ride'){
									$querys1="Select gender,category,bip_no,race_category from user WHERE race_category='".$racecategory."' and category='".$category."' and gender='".$gender."' and geared='".$geared."' and age_group='".$age_group."' order by id desc limit 0,1";
								}

								$query_run1 = $wpdb->get_results($querys1);							
								if($wpdb->num_rows > 0){																								
									$bip_no = $query_run1[0]->bip_no + 1;
									
									// rushi 12-1-2017 give new bib series
									if($bip_no == 1100 && $gender == '0' && $geared == 'Open' && $age_group == '15-18 years' && $category == 'Half cyclothon Ride'){
										$bip_no = 6900;  // male & open & 15-18
									}
																
								} else {
									if($category == 'Full cyclothon Ride'){
										$bip_no = 101;  // male
									} else if($category == 'Half cyclothon Ride'){
										if($gender == '0' && $geared == 'Open' && $age_group == '15-18 years'){
											$bip_no = 1000;  // male & open & 15-18
										}else if($gender == '1' && $geared == 'Open' && $age_group == '15-18 years'){
											$bip_no = 1100; // female & open & 15-18
										}else if($gender == '0' && $geared == 'Open' && $age_group == '19–39 years'){										
											$bip_no = 300;  // male & open & 19-39
										}else if($gender == '1' && $geared == 'Open' && $age_group == '19–39 years'){
											$bip_no = 1200; // female & open & 19-39
										}else if($gender == '0' && $geared == 'Open' && $age_group == '40-59 years'){
											$bip_no = 700;  // male & open & 40-59
										}else if($gender == '1' && $geared == 'Open' && $age_group == '40-59 years'){
											$bip_no = 1300; // female & open & 40-59
										}else if($gender == '0' && $geared == 'Open' && $age_group == '60'){
											$bip_no = 1400;  // male & open & 60+
										}else if($gender == '1' && $geared == 'Open' && $age_group == '60'){
											$bip_no = 1500; // female & open & 60+
										}
										
										if($gender == '0' && $geared == 'Fixie' && $age_group == '15-39 years'){
											$bip_no = 2000;  // male & fixie & 15-39
										}else if($gender == '1' && $geared == 'Fixie' && $age_group == '15-39 years'){
											$bip_no = 2400; // female & fixie & 15-39
										}else if($gender == '0' && $geared == 'Fixie' && $age_group == '40'){
											$bip_no = 2300;  // male & fixie & 40
										}else if($gender == '1' && $geared == 'Fixie' && $age_group == '40'){
											$bip_no = 2500; // female & fixie & 40
										}
									}else{
										$bip_no = '';
									}									
								}
							}
										
										
														
							/*else if($category == 'ITT Half cyclothon Ride'){									
									if($gender == '0' && $geared == 'Open' && ($hd_age_year >= 15 && $hd_age_year < 19)){
										$bip_no = 1000;  // male & open & 15-18
									}else if($gender == '1' && $geared == 'Open' && ($hd_age_year >= 15 && $hd_age_year < 19)){
										$bip_no = 1100; // female & open & 15-18
									}else if($gender == '0' && $geared == 'Open' && ($hd_age_year >= 19 && $hd_age_year < 40)){
										$bip_no = 300;  // male & open & 19-39
									}else if($gender == '1' && $geared == 'Open' && ($hd_age_year >= 19 && $hd_age_year < 40)){
										$bip_no = 1200; // female & open & 19-39
									}else if($gender == '0' && $geared == 'Open' && ($hd_age_year >= 40 && $hd_age_year < 60)){
										$bip_no = 700;  // male & open & 40-59
									}else if($gender == '1' && $geared == 'Open' && ($hd_age_year >= 40 && $hd_age_year < 60)){
										$bip_no = 1300; // female & open & 40-59
									}else if($gender == '0' && $geared == 'Open' && ($hd_age_year >= 60)){
										$bip_no = 1400;  // male & open & 60+
									}else if($gender == '1' && $geared == 'Open' && ($hd_age_year >= 60)){
										$bip_no = 1500; // female & open & 60+
									}
									
									if($gender == '0' && $geared == 'Fixie' && $age_group == '15-39 years'){
										$bip_no = 2000;  // male & fixie & 15-39
									}else if($gender == '1' && $geared == 'Fixie' && $age_group == '15-39 years'){
										$bip_no = 2400; // female & fixie & 15-39
									}else if($gender == '0' && $geared == 'Fixie' && $age_group == '40'){
										$bip_no = 2300;  // male & fixie & 40
									}else if($gender == '1' && $geared == 'Fixie' && $age_group == '40'){
										$bip_no = 2500; // female & fixie & 40
									}
								} else{
									$bip_no = '';
								}*/
						}
						//echo 'bib_no-'.$bip_no.'=============bib_no1-'.$bip_no1;exit;
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
					$insert_val .= "age_group1=".$age_group1."<br/>";
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
					$insert_val .= "bip_no1=".$bip_no1."<br/>";							
					$insert_val .= "userid=".$userid."<br/>";							
					$insert_val .= "cyclothon_type=".$cyclothon_type."<br/>";							
					$insert_val .= "age_year=".$hd_age_year."<br/>";							
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From:priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query',$insert_val,$headers);
					/*end mail*/
//					echo "INSERT INTO user (amount, full_name, contact_no,email,occupation,date_of_birth,blood_type,gender,race_category,category,age_group,t_shirt_size,address,city,state,country,zipcode,contact_person_name,contact_person_name2,contact_person_contact_no,contact_person_contact_no2,participant_no,nationality,bikemake,previous_cycling_experiences,other_adventure_sports,geared,bip_no,userid,cyclothon_type,cyclothon_year,create_date) VALUES ('".$amount."','".$fullname."','".$contactno."','".$email."','".$occupation."','".$dofb."','".$bloodtype."','".$gender."','".$racecategory."','".$category."','".$age_group."','".$t_shirt_size."','".$addressline."','".$city."','".$state."','".$country."','".$zip_code."','".$contactperson."','".$contactperson2."','".$contact_no."','".$contact_no2."','".$participant_no."','".$nationality."','".$bikemake."','".$previous_cycling_experiences."','".$other_adventure_sports."','".$geared."','".$bip_no."','".$userid."','".$cyclothon_type."','".$cyclothon_year."',now())";

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
						'age_group1'=>$age_group1,	
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
						'bip_no1'=>$bip_no1,												
						'userid'=>$userid,			
						'cyclothon_type'=>$cyclothon_type,			
						'cyclothon_year'=>$cyclothon_year,			
						'age_year'=>$hd_age_year						
						) )) { 
										
						$id=$userid;
						$eid=$racecategory;
						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";			
								header("location:http://jpsport.in/cyclothon/?cyclothon_itt_select=".$cyclothon_itt_select);
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
						
			} else {
				header("location:http://jpsport.in/cyclothon/?cyclothon_itt_select=".$cyclothon_itt_select);
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
																
																<?php 
																$id=174; 
																$post = get_post($id); ?>
																<?php
																$content = apply_filters('the_content', $post->post_content); 
																//echo $content;  
																?>
			
			<div class="middle-align">
					<div class="main_menu_tab">
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#home">HOME</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#event_info">EVENT INFO</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#registration">REGISTRATION</a></div>						
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#form">FORM AVAILABILITY</a></div>
						<!--<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#philonthrophy">PHILONTHROPHY</a></div>-->
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#sponsors">SPONSORS</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#route">RESULTS</a></div>
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#prize">PRIZE BIFURCATION</a></div>						
						<div class="menu_tab"><a href="http://jpsport.in/cyclothon/?cyclothon_itt_select=<?php echo $cyclothon_itt_select; ?>#contact">CONTACT</a></div>
					</div>
					<div class="clear"></div>
				</div>
			
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class="page-container page-container-new"><?php the_content();?></section>
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="clear"></div>
					<div class="register_select">
						<!--<div class="left_label">
							<label><strong>Register Now For:</strong></label>
						</div>								
						<select name="racecat" id="racecat" style="border: 1px solid #999;color: #000;font-family: 'verdana';font-size: 14px;padding: 5px;width: 295px;height:40px;">
							<option value="http://jpsport.in/cyclothon/?cyclothon_itt_select=1#registration" <?php if($cyclothon_itt_select != '2') { echo 'selected'; } ?> >CYCLOTHON</option>
							<option value="http://jpsport.in/cyclothon/?cyclothon_itt_select=2#registration" <?php if($cyclothon_itt_select == '2') { echo 'selected'; } ?> >CYCLOTHON + ITT RACE</option>
						</select>-->
						
						<div class="home_reg_btn home_reg_btn_a">
							<a href="<?php echo site_url(); ?>/cyclothon/?cyclothon_itt_select=2#registration_form">
								<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff;background-color: #019259;font-weight:bold;">REGISTER FOR<br><font style="color:#FCE748;"> CYCLOTHON + ITT</font></span>
							</a>&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url(); ?>/cyclothon/?cyclothon_itt_select=1#registration_form">
								<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff; background-color: #1761a2;font-weight:bold;">REGISTER FOR<br><font style="color:#FCE748;"> CYCLOTHON</font></span>
							</a>
							<p id="registration_form" style="color:#656364;font-weight:bold;margin-top: 10px;">ITT RACE - 28 JANUARY 2017 | CYCLOTHON - 29 JANUARY 2017</p>
						</div>
						
					</div>
					<?php if($cyclothon_itt_select != '') { ?>
					<div id="closed_itt_regs" style="display:none;text-align:center;font-weight:bold;">Registration Closed</div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">
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
											<?php /*<input type="submit" class="menu_tab" id="btn_submit1" name="btn_submit1" value="Submit">
											<input type="button" id="cancel" class="menu_tab" onclick="closeModel()" value="Cancel"> */ ?>
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
							
<!--							<div class="left_fields">
								<div class="left_label">
									<label>Nationality:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="nationality" id="nationality" />
								 </div>
							</div>
							<div class="clear"></div>-->
							<div class="left_fields">
								<div class="left_label">
									<label>Bicycle Brand:</label> 
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
									<select name="t_shirt_size" id="t_shirt_size">
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
							<!--<div class="right_fields">
								<div class="right_label"></div>
									<label>Other Adventure Sports:</label>
								<div class="right_text"> 
									<input type="text" name="other_adventure_sports" id="other_adventure_sports" />
								 </div>
							 </div>
								<div class="clear"></div>-->
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
										<?php /* if($cyclothon_itt_select == '2'){ ?>
											<select name="category" id="diffYear" onchange="display_field(this);">
												<option value="">Select</option>
												<option value="ITT Full cyclothon Ride">ITT With 100 Km - 1000 Rs</option>								
												<option value="ITT Half cyclothon Ride">ITT With 50 Km - 1000 Rs</option>
											</select>
										<?php } else { */ ?>
											<select name="category" id="diffYear" onchange="display_field(this);">
												<option value="">Select</option>
												<!--<option value="Full cyclothon Ride">Champions' Ride(Elite Riders) - 100 Km - 700 Rs</option>								
												<option value="Half cyclothon Ride">Challengers' Ride - 50 Km - 700 Rs</option>-->
												<option value="Ahmedabad Green Ride">Ahmedabad Green Ride - 14 km - 250 Rs</option>
												<option value="Fashion Ride">Fashion Ride - 5 km - 100 Rs</option>
												<option value="Kids Ride">Kids Ride - 2 km - 100 Rs</option>
												<!--<option value="Divyang Ride">Divyang Ride - 2 km - Nil</option>-->
											</select>
										<?php /* } */  ?>
									</div> 
							</div>
							<div class="clear"></div>
							<div id="display_Geared" style="display:none;">
								<div class="left_fields">
									<div class="left_label">
										<label>Geared/Non-geared:<span style="color:red;">*</span></label> 
									</div>
									<div class="left_text">
										<select name="geared" id="geared" onchange="display_geared(this);">
										  <option value="">Select</option>
										  <option value="Fixie">Fixie (Non Gear)</option>
										  <option value="Open">Open</option>										  
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
										<div id="cat_open" style="display:block;">
											<select name="agegroup" id="agegroup" disabled="disabled">
												<option value="">Select</option>
												<option value="15-18 years">15-18 years</option>
												<option value="19–39 years">19-39 years</option>
												<option value="40-59 years">40-59 years</option>
												<option value="60">60 years and above</option>										
											</select>
										</div>
										<div id="cat_fixie" style="display:none;">
											<select name="agegroup" id="agegroup" disabled="disabled">
												<option value="">Select</option>											
												<option value="15-39 years">15-39 years</option>
												<option value="40">40 years and above</option>
											</select>
										</div>
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
							</div>-->
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
									<label>Emergency Contact Person1:</label>
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
									<label>Emergency Contact Person2:</label>
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
<!--								  <option value="8">Unemployed</option>-->
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>								
							<!--<div class="right_fields">
								<div class="right_label"></div>
									<label>Previous Cycling Experiences:</label>
								<div class="right_text"> 
									<input type="text" name="previous_cycling_experiences" id="previous_cycling_experiences" />
								 </div>
							 </div>
								<div class="clear"></div>							-->
							
							<?php //$id = $_GET['reg'];?>
							<!--<input name="amt" id="amt" type="hidden" value="<?php echo the_field('price', $id);?>">-->
							<input name="amt" id="amt" type="hidden" value="">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							<input name="age_group" id="age_group" type="hidden" value="">
							<input name="age_group1" id="age_group1" type="hidden" value="">
							<input name="cyclothon_type" id="cyclothon_type" type="hidden" value="<?php echo $cyclothon_type; ?>">
							<input name="cyclothon_year" id="cyclothon_year" type="hidden" value="2017">
							<input name="hd_age_year" id="hd_age_year" type="hidden" value="">
							</div>
						</div>
						
						<div class="clear"></div>
						<?php if($cyclothon_itt_select == '2'){ ?>
						<!-- separate field for itt race-->
						<div id="for_itt_race_box" class="register_select">
							<div class="clear"></div>
							<div class="left_label" style="font-size: 25px; padding: 32px 0 0; color:#CE3430;">
								<label><strong>For ITT Race</strong></label>
							</div>
							<div class="runnersup">
								<div class="right_fields">
									<div class="right_label">
										<label>Age Group:</label>  
									</div>
									<div class="right_text">
										<select disabled="disabled" id="agegroup1" name="agegroup1">
											<option value="">Select</option>											
											<option value="15-39 years">15-39 years</option>
											<option value="40">40 years and above</option>
										</select>
									</div>
								</div>
								<div class="clear"></div>
							</div>
							<div class="runnersup">
								<div class="right_fields">
									<div class="right_label">
										<label>Date of Birth:</label>
									</div>
									<div class="right_text">
										<input type="text" readonly="readonly" id="dob1" name="dob1" class="hasDatepicker" disabled="disabled">
									</div>
								</div>
								<div class="clear"></div>
								
							<div class="clear"></div>
							
						</div>						
						<div class="cyclothon_confirm" style="clear:both;display:block;padding: 20px 0 20px;"><input type="checkbox" id="itt_confirm1" class="confirm"> &nbsp;I understand that there will be no seperate prizes for fixie bike category.</div>
					</div>
					
					<!-- itt end -->
					<?php } ?>
				 </div>
				<div class="clear"></div>
				</div>
				
				<div class="certi_search">

				<section class="page-container page-container-new" style="text-align:left;">
																<?php 
																$id=520; 
																$post = get_post($id);?>
																<?php 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;
																?>
																
				<div class="clear"></div>
			</section><div class="clear"></div>
			
			<div class="static-text"><strong>Waiver:</strong><br>
				<input class="confirm" id="confirm" type="checkbox" /> &nbsp;I declare, confirm and agree as follows that I/my ward
				</div>
				<section class="page-container-bottom">					
					<?php echo the_field('waiver', '522');?>
				</section>
				
			<div class="clear"></div>
			<div style="border:none;" class="page-container-bottom" id="captcha_div">
				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="g-recaptcha" data-sitekey="6LczogwUAAAAALTfW2HPnsD_qd2EyeIsTNVac9yA"></div>
				<span id="captcha" style="color:#000;" />
			</div>

			<div class="clear"></div>
			
		
			 <?php /* <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();" style="cursor:pointer;">*/ ?>
				</form>
				</div>
				<?php } ?>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>			
			
			<section class="page-container page-container-new">
			<?php 
					$id=538; 
					$post = get_post($id);
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;  
					?>
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
       	
       	/*22-12-2016
       	if(dayDiff<15){ 
			//alert("Under 15 years age you can not register for selected Race Category.");
			alert("Under 15 years age you must need to register offline. Please go to JP Sports & Events office.");
		}*/
		<?php if($cyclothon_itt_select == '2'){ ?>
			// itt 
		var geared_val = jQuery("#geared").val();		
		if(geared_val == 'Fixie'){			
			
			if(dayDiff<39 && dayDiff>=15){
				jQuery("#cat_fixie #agegroup").val('15-39 years');
				jQuery("#age_group").val('15-39 years');
				jQuery("#agegroup1").val('15-39 years');
				jQuery("#age_group1").val('15-39 years');
			} else if(dayDiff > 39){
				jQuery("#cat_fixie #agegroup").val('40');
				jQuery("#age_group").val('40');
				jQuery("#age_group1").val('40');
				jQuery("#agegroup1").val('40');
			}			
		} else {
			if(dayDiff<19 && dayDiff>=15){ 
				jQuery("#agegroup").val('15-18 years');
				jQuery("#age_group").val('15-18 years');
			}
			else if(dayDiff<40 && dayDiff>=19){
				jQuery("#agegroup").val('19–39 years');
				jQuery("#age_group").val('19–39 years');
			}
			else if(dayDiff<60 && dayDiff>=40){
				jQuery("#agegroup").val('40-59 years');
				jQuery("#age_group").val('40-59 years');
			}
			else if(dayDiff>=60){
				jQuery("#agegroup").val(60);
				jQuery("#age_group").val(60);
			}
			
			if(dayDiff<39 && dayDiff>=15){
				jQuery("#age_group1").val('15-39 years');
				jQuery("#agegroup1").val('15-39 years');
			} else if(dayDiff > 39){
				jQuery("#age_group1").val('40');
				jQuery("#agegroup1").val('40');
			}
		}
		<?php } else { ?>
		
		var geared_val = jQuery("#geared").val();		
		if(geared_val == 'Fixie'){			
			
			if(dayDiff<39 && dayDiff>=15){
				jQuery("#cat_fixie #agegroup").val('15-39 years');
				jQuery("#age_group").val('15-39 years');
				jQuery("#age_group1").val('15-39 years');
				jQuery("#agegroup1").val('15-39 years');
			} else if(dayDiff > 39){
				jQuery("#cat_fixie #agegroup").val('40');
				jQuery("#age_group").val('40');
				jQuery("#age_group1").val('40');
				jQuery("#agegroup1").val('40');
			}			
		} else {		
			
			if(dayDiff<19 && dayDiff>=15){ 
				jQuery("#agegroup").val('15-18 years');
				jQuery("#age_group").val('15-18 years');
			}
			else if(dayDiff<40 && dayDiff>=19){
				jQuery("#agegroup").val('19–39 years');
				jQuery("#age_group").val('19–39 years');
			}
			else if(dayDiff<60 && dayDiff>=40){
				jQuery("#agegroup").val('40-59 years');
				jQuery("#age_group").val('40-59 years');
			}
			else if(dayDiff>=60){
				jQuery("#agegroup").val(60);
				jQuery("#age_group").val(60);
			}else {
				jQuery("#agegroup").val('');
			}
		}
		 <?php } ?>
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
    
    <?php if($cyclothon_itt_select == '2' || $cyclothon_itt_select == '1'){ ?>
    $('#closed_itt_regs').show();
    $('.certificate_main').hide();
    $('.static-text').hide();
    $('.page-container-bottom').hide();
    $('#btn_submit').hide();
    <?php } ?>
    
});
</script>
<?php get_footer(); ?>
