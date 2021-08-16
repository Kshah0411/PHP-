<?php
/**
 Template Name: Gallery page
 */
get_header();

?>
 <?php echo "<div id='slider1' style='background:url(".site_url()."/wp-content/themes/jpsports/images/new-crop.jpg) no-repeat scroll center center / cover  rgba(0, 0, 0, 0)'>
						<div class='top-bar'><a href='".site_url()."'><img src='".site_url()."/wp-content/themes/jpsports/images/logo.png'></a></div>
						</div>";?>
<div class="main-container">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>

	<?php endwhile; endif;?>			
		
			<section class=" welcome-box-bg" id="section1">
				<div class="welcome-box middle-align">
					<h1><?php echo the_title() ?></h1>
				</div>
			</section>
		<section class="page-container page-container-new">
			<?php the_content();?>
		</section>
		<div class="clear"></div>			
</div>
<?php get_footer(); ?>
