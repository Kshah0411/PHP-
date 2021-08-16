<?php
/**
 Template Name: Sponsor page
 */
get_header();

?>

	<div id="slider" style="height:638px;background:url('<?php echo site_url();?>/wp-content/uploads/2015/09/cropped-1.jpg') no-repeat scroll center center / cover  rgba(0, 0, 0, 0)">
                	            <div class="top-bar">									
                <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>
            <div class="main-container">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
					
					<?php endwhile; endif;?>			
			<section class="page-container page-container-new"><?php the_content();?></section>
			
		
			<div class="clear"></div>			
			
			
			
															
		<!--</div>	-->

<?php get_footer(); ?>
?>
