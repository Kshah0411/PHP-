<?php
/**
 Template Name: Front page
 */

get_header(); ?>
<style>
	 .home_video{text-align:center;width:560px;height:315px;}
	 @media screen and (min-width:320px) and (max-width: 767px) {
		 .home_video{width:auto;height:auto;}
	 }
 </style>
 <?php echo do_shortcode('[srMenu theme_location=primary]');?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '11' ), 'single-post-thumbnail' );  
				?>
	<div id="slider" style="height:638px;background:url('<?php echo site_url();?>/wp-content/uploads/2015/09/cropped-1.jpg') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
                	            <div class="top-bar">									
                <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>
		<div class="main-container">
         <!--<section  id="section9" style="text-align:center;background-color:#fff;">
					<img src="http://jpsport.in/wp-content/uploads/2016/10/website.jpg">
					<div class="clear"></div>					
					<div class="home_reg_btn home_reg_btn_a">
						<a href="<?php echo site_url(); ?>/cyclothon/?cyclothon_itt_select=2#route">
							<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff;background-color: #019259;font-weight:bold;"><font style="color:#FCE748;">RESULTS</font></span>
						</a>&nbsp;&nbsp;&nbsp;
						<a href="<?php echo site_url(); ?>/cyclothon-certificate-2017/">
							<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff; background-color: #1761a2;font-weight:bold;"><font style="color:#FCE748;">CERTIFICATES</font></span>
						</a>
						<p style="color:#656364;font-weight:bold;margin-top: 10px;">ITT RACE - 28 JANUARY 2017 | CYCLOTHON - 29 JANUARY 2017</p>
					</div>
				</section>
				<section>
					<div style="text-align:center;margin:0 auto 20px;">
					<iframe src="https://www.youtube.com/embed/MZhj-NMWGsU" frameborder="0" allowfullscreen class="home_video"></iframe>
					</div>
					<div class="clear"></div>					
				</section>-->
	            <section class=" welcome-box-bg" id="section1">
                    <div class="welcome-box middle-align">
                                       <?php
															$id=11; 
															$post = get_post($id);?>
															<h1><?php echo $post->post_title; ?></h1>
															<?php  
															$content = apply_filters('the_content', $post->post_content); 
															//echo $content;  
															?>
					<div class="clear">
					</div>
					</div><!-- middle-align -->
					<div class="clear"></div>
				</section><div class="clear"></div>

				 <?php 
				   //echo $post->ID;
				    $today = date('Ymd');
					$my_query = new WP_Query( array(
										'post_type' => 'event',
										 //'posts_per_page' => 1,										
										  'meta_query' => array(
										   'relation' => 'AND',
								   			//array(
											//	'key'		=> 'price',
											//	'value'		=> '',
											//),
											array(
												'key'		=> 'status',
												'value'		=> 'Active',
											),											
											array(
												'key'		=> 'start_date_',
												'compare'	=> '<=',
												'value'		=> $today,
											),
											 array(
												'key'		=> 'end_date_',
												'compare'	=> '>=',
												'value'		=> $today,
											)
										),
								  ));
						//echo '<pre>';
						//print_r($my_query);exit; 						
						  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();							
							//echo the_field('register_as');
						  	$eId = get_the_ID();
						  $image = wp_get_attachment_image_src( get_post_thumbnail_id($eId), 'single-post-thumbnail' );
						  /*
						  ?>   
				<section  id="section9" style="text-align:center;background-color:#f1ce74;">
					<img src="<?php echo $image[0]; ?>">
								<!--<div class="top-grey-box middle-align" >
									<?php
									 // echo "<h1>" . get_the_title() . " </h1>";
									  //echo "<p>" . get_the_excerpt() . "</p>";
									  //echo "<p>". the_field(start_date_) ."</p>"
									 // echo "<p>" . get_the_post_thumbnail(). "</p>";
									    ?>								
								</div>-->
								<div class="clear"></div>
					<div class="home_reg_btn"><a href="<?php echo site_url(); ?>/cyclothon/"><span class="search_btn">Register Now</span></a></div>
				</section>	
				<!--<div class="resultList">
								<?php 								
									$register = get_field('register_as');
									if($register[0] == 'Individual' || $register[1] == 'Individual')
									{
										//echo '<a href="'.site_url().'/registration?reg='.get_the_ID().'"><input type="submit" value="Register Now" class="search_btn"></a>';
										echo '<div class="search_btn">Registration Closed</div>';
									}
									if($register[0] == 'Team' || $register[1] == 'Team')
									{
										echo '<a href="'.site_url().'/registration?reg='.get_the_ID().'"><input type="submit" value="Team" class="search_btn"></a>';
									}
								?>
								</div>-->

								<div class="clear"></div>
				<?php  */
							endwhile; endif;
							
								 ?>	
								 
					<?php// $image = wp_get_attachment_image_src( get_post_thumbnail_id('231'), 'single-post-thumbnail' ); ?>  <!-- New-->
				<!--<section  id="section9" style="text-align:center;background-color:#62b661;">
					<img src="<?php echo $image[0]; ?>">
					<div class="clear"></div>
					<div class="home_reg_btn"><a href="<?php echo site_url(); ?>/iim_chaos/?reg=231"><span class="search_btn">Register Now</span></a></div>
				</section>	
				<div class="clear"></div>-->
				
				
				<?php //$image = wp_get_attachment_image_src( get_post_thumbnail_id('157'), 'single-post-thumbnail' ); ?>  <!-- Sugerfree-->
				<!--<section  id="section9" style="text-align:center;background-color:#aabcca;"> <!--f1ce74
					<img src="<?php echo $image[0]; ?>">
					<div class="clear"></div>					
					<div class="home_reg_btn"><a href="<?php echo site_url(); ?>/cyclothon-certificate/"><span class="search_btn">Result</span></a></div>
				</section>	
				<div class="clear"></div>-->
				
<!--				<section  id="section9" style="text-align:center;background-color:#901D78;">
					<img src="http://jpsport.in/wp-content/uploads/2016/04/fitness-bash.jpg">
					<div class="clear"></div>					
					<div class="home_reg_btn"><a href="<?php echo site_url(); ?>/fitness-bash/"><span class="search_btn">Register Now</span></a></div>
				</section>	
				
				<div class="clear"></div>-->				 						
								 
					<div class="clear"></div>
				
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '43' ), 'single-post-thumbnail' );  
				?>
				<section class="menu_page top-grey-box-bg" id="section2" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
				
					<div class="top-grey-box middle-align" >
						<div class="middle-block-section">
											
<?php
															$id=43; 
															$post = get_post($id);?>
															<h1><?php echo $post->post_title; ?></h1>
															<?php  
															$content = apply_filters('the_content', $post->post_content); 
															echo $content;  
															?>
							</div>								
					</div><!-- middle-align -->
					<div class="clear"></div>
					
				</section><div class="clear"></div>
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '45' ), 'single-post-thumbnail' );  
				?>
								<div class="bottom-shape"></div>
								
				<section class="work-section-bg" id="section3" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
					<div class="work-section middle-align">
						<div class="middle-block-section">
																
																<?php 
																$id=45; 
																$post = get_post($id);?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php  
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
							</div>
					 </div><!-- middle-align -->
					 <div class="clear"></div>
			  </section><div class="clear"></div>
														
				<section class=" feature-services-bg" id="section4">
					<div class="feature-services middle-align">
																
																<?php 
																$id=48; 
																$post = get_post($id);?>
																<h3><?php echo $post->post_title; ?></h3>
																
																	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '48' ), 'single-post-thumbnail' );  
				?>
																<div class="left-image"><img align="left" alt="" src="<?php echo $image[0]; ?>"></div>
																<?php 
																$id=48; 
																$post = get_post($id); 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content; 
																?> 
					 </div><!-- middle-align -->
					 <div class="clear"></div>
			  </section><div class="clear"></div>
			  		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '51' ), 'single-post-thumbnail' );  
				?>
				<section class="menu_page what-we-offer-main" id="section5" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
					<div class="top-grey-box middle-align	">
																
																<?php 
																$id=51; 
																$post = get_post($id);?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php  
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
					 </div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
			
												<div class="bottom-shape"></div>
															
			<section class="how-can-main" id="section6">
				<div class="how-can middle-align">
																
																<?php 
																$id=53; 
																$post = get_post($id); ?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
					</div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '55' ), 'single-post-thumbnail' );  
				?>
			<section class=" hsc-main" id="section7" style="background:url('<?php echo $image[0]; ?>') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
				<div class="hsc middle-align">
																<div class="first-row">
																<?php 
																$id=55; 
																$post = get_post($id); 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
				 </div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
														
			<section class=" contact-form-section-bg" id="section8">
				<div class="contact-form-section middle-align">
																<?php 
																$id=25; 
																$post = get_post($id);?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
				 </div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
			<section class=" contact-form-section-bg" id="contact">
				<div class="contact-form-section middle-align">
					
																<?php 
																$id=159; 
																$post = get_post($id);?>
																<h1><?php echo $post->post_title; ?></h1>
																<?php 
																echo do_shortcode( '[contact-form-7 id="442" title="Contact form 1"]' );
																?> 
																<?php 
																$content = apply_filters('the_content', $post->post_content); 
																echo $content;  
																?>
													
																
				</div><!-- middle-align -->
				<div class="clear"></div>
			</section><div class="clear"></div>
														
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
// create the back to top button
$('body').prepend('<a href="#" class="back-to-top">Back to Top</a>');

var amountScrolled = 300;

$(window).scroll(function() {
	if ( $(window).scrollTop() > amountScrolled ) {
		$('a.back-to-top').fadeIn('slow');
	} else {
		$('a.back-to-top').fadeOut('slow');
	}
});

$('a.back-to-top, a.simple-back-to-top').click(function() {
	$('html, body').animate({
		scrollTop: 0
	}, 700);
	return false;
});
</script>
			

<?php get_footer(); ?>
