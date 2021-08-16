<?php
/**
 Template Name: Media page
 */
get_header();

?>


		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( '340' ), 'single-post-thumbnail' );  
				?>
	
			
			<div id="slider">
				<div class="header-img" style="background-color:#ffffff;">
				<img src="<?php echo $image[0]; ?>">
			</div>
            <div class="main-container">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
					
					<?php endwhile; endif;?>			
			<section class="page-container page-container-new"><?php the_content();?></section>
			
		
			<div class="clear"></div>			
			
			
			
															
		<!--</div>	-->

<?php get_footer(); ?>
