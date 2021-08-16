<?php
/**
 Template Name: Event page
 */

get_header();
$stat=$_GET['status'];

 ?>
 
		<div class="main-container">
          <?php echo "<div id='slider1' style='background:url(".site_url()."/wp-content/themes/jpsports/images/new-crop.jpg) no-repeat scroll center center / cover  rgba(0, 0, 0, 0)'>
						<div class='top-bar'><a href='".site_url()."'><img src='".site_url()."/wp-content/themes/jpsports/images/logo.png'></a></div>
						</div>";?>
	            <section class=" welcome-box-bg" id="section1">
                    <div class="welcome-box middle-align">
           						<?php
								$id=236; 
								$post = get_post($id);?>
								<?php
								if($_GET['status']=='active')
								{
									echo "<h1>CURRENT EVENTS</h1>";
								}
								else if($_GET['status']=='inactive')
								
								{
									echo "<h1>PAST EVENTS</h1>";
								}
								else
								{
									echo "<h1>UPCOMING EVENTS</h1>";
								}
								?>
								<?php  
								$content = apply_filters('the_content', $post->post_content); 
								echo $content;  
								?>
					<div class="clear"></div>
					</div><!-- middle-align -->
					<div class="clear"></div>
				</section><div class="clear"></div>
				<div  style="width:100%;text-align:center;">
					<a href="http://jpsport.in/obstacle-circuit/" title="Click here to register"><img src="http://jpsport.in/wp-content/uploads/2017/04/ObstcaleCircuit-825x510.png" style="max-width:100%;"/></a>
				</div>

				 <?php 
				   //echo $post->ID;				 
				    $today = date('Ymd');
					$my_query = new WP_Query( array(
							'post_type' => 'event',
							'post_status' => 'publish',
							 //'posts_per_page' => 1,										
							  'meta_query' => array(
							   'relation' => 'AND',
					   			
								array(
									'key'		=> 'status',
									'value'		=> $stat,
								),											
								
							),
					  ));

					  ?>
					
						<div class="middle-align">
							<?php		
								$i = 1;				
								if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();							
							   $eId = get_the_ID();
							   $image = wp_get_attachment_image_src( get_post_thumbnail_id($eId), 'single-post-thumbnail' );
									?>   
									<div class="post-image">
									 <a href="<?php the_field('redirect_url') ?>"><img src="<?php echo $image[0]; ?>"></a>
									<h3><?php echo the_title() ?></h3>
									<p><?php echo get_the_content() ?></p>
									</div>
							 			
								<?php 
								if($i%2 == 0){
									?>
									<div style="clear:both;padding-bottom:0px;"></div>
									<?php
								}
								$i++;
								
								endwhile; ?>
							<?php else : ?>
							<div class='payment-success'>
								<?php /* <div class='thank-you-msg'>No Upcoming Events</div> */ ?>
								<div class='thank-you-msg' style="font-size:24px;"><a href="http://jpsport.in/obstacle-circuit/" title="Click here to register">Obstacle Circuit Workshop</a></div>
							</div>
							<?php endif; ?> 
				 	</div>
					<div class="clear"></div>
					
					
							
					</div>
<?php get_footer(); ?>
