<?php
/**
 Template Name: Cyclothon page
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
			
			
															
		<!--</div>	-->

<?php get_footer(); ?>
