<?php
/**
 Template Name: Page Buy Tshirt
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
</script> 

			<?php 

			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );  		
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
				
				// echo '<pre>';
				// print_r($_POST);

				global  $wpdb;
				$status=$_POST['status'];
				$txnid=$_POST['txnid'];
				$amount=$_POST['amount'];
				$contactno=$_POST['phone'];	
				$email=$_POST['email'];			

				if($_POST['fullname'] == ''){
					$fullname=$_POST['firstname'].' '.$_POST['lastname'];									
				} else {
					$fullname=$_POST['fullname'];	
				}
				$payuId=$_POST['mihpayid'];
				
				//echo $payuId.'----------------'.$status.'--------'.$_SESSION["tshirt-id"];exit;			
				
				$wpdb->query($wpdb->prepare("UPDATE wp_tshirt SET status='".$status."', payu_id='".$payuId."' WHERE tshirt_id='".$_SESSION["tshirt-id"]."' "));								
				
				/* SMS send */  
				$smsmsg = "Successfully Purchased T-Shirt";				
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
				
				$querys2="Select * from wp_tshirt WHERE tshirt_id='".$_SESSION["tshirt-id"]."' ";
				$query_run2 = $wpdb->get_results($querys2);						
				$size = $query_run2[0]->tshirt_size;
				
				$subject = 'T-Shirt Purchased';
		
                $body = '
                <b>Purchased Details</b><br /><br />                
                Name: '.$fullname.'<br />
                Mobile: '.$contactno.'<br />
                Email: '.$email.'<br />
                Size: '.$size.'<br /><br /><br />
                                				              
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
				<p>for purchasing t-shirt</p>";
						
				
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
				'payuId'=>$mihpayid,
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
					//print_r($_POST);exit;
					
					
					$amount=$_POST['amt'];
					$fullname=$_POST['fullname'];
					$email=$_POST['email'];
					$contactno=$_POST['contact_no'];					
					$tshirtsize=$_POST['t_shirt_size'];
					$transaction_id = $_POST['txnid'];
					$date = date('Y-m-d H:i:s');						

					$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
					$query_run1 = $wpdb->get_results($querys1);						
					$participant_no = $query_run1[0]->participant_no + 1;
									
					
					$t_shirt_id = $_POST[''];
					$_SESSION["user"] = $userid;

					$table_name = "wp_tshirt";
					global  $wpdb;

					if($wpdb->insert( $table_name, array(					
						
						'full_name'=>$fullname,
						'email_id' => $email,
						'm_number'=>$contactno,
						'amount'=>$amount,
						'tshirt_size'=>$tshirtsize,
						'transaction_id'=>$transaction_id,
						'date'=>$date,	

						))) {

							pay_page( array (				
								'surl' => 'payment_success',
								'furl' => 'payment_failure',
								'key' => 'YpOaMs',
								'txnid' => $transaction_id,
								'amount'=> $_POST['amt'],
								'firstname'=>$_POST['fullname'],
								'email'=> $_POST['email'],
								'phone'=>$_POST['contact_no'],
							
								'productinfo' => $_POST['productinfo'],
							), 
							'f0SXJsMM');
							$lastInsertId = $wpdb->insert_id;
							$_SESSION["tshirt-id"]=$lastInsertId;

					} else {
						header("location:http://jpsport.in/cyclothon/");
						exit;	
					}	
			} else { 
			if($s_status != 'success') { ?>
			<div id="slider">
			<div class="header-img" style="background-color:#f1ce74;">
				<img src="<?php echo $image[0]; ?>">
			</div>
            <!--<div class="top-bar">									
            <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>-->
			<div class="main-container">

			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<?php 
						$id=123; 
						$post = get_post($id);
					?>
					<h1><?php echo "Buy T-Shirt";?></h1>
					<div id="message"></div>
					<div class="certificate_main tshirt_main">
						<div class="certificate_sec tshirt_sec">					
							<div class="runnersup">
								<form method="POST">
							
									<img src="<?php echo site_url();?>/wp-content/themes/jpsports/images/Buy-T-Shirt.jpg">

							</div>
						</div>
						<div class="certificate_sec tshirt_sec">			
							<div class="runnersup">

								<div class="right_fields">
									<div class="right_label">
										<label>Full Name: </label>
									</div>
									<div class="right_text"> 
										<input type="text" name="fullname" id="fullname"/>
									</div>
								</div>
								<div class="clear"></div>

								<div class="right_fields">
									<div class="right_label">
										<label>Mobile Number: </label>
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
										<label>T-shirt Size:</label> 
									</div>
									<div class="right_text">						
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

								<?php $id = $_GET['reg'];?>
								<input name="amt" id="amt" type="hidden" value="1200">							
								<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
								<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
								<input name="select-cat" id="select-cat" type="hidden" value="">
								<input class="reg_btn" type="submit" name="btn_submit" id="btn_submit" value="Buy Now" onclick="return validation();">
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">	
					
			 	
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			<section class="page-container"><?php the_content();?></section>
			<?php } } ?>
			
															
		<!--</div>	-->

<?php get_footer(); ?>
