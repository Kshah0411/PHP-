<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
</div><!-- .site-content -->
<div id="footer" role="contentinfo">
	<?php wp_nav_menu( array('menu' => 'Menu 1' ));?>
	<div class="social-icons">
		<ul>
			<li>
				<a href="https://www.youtube.com/channel/UCoZmkHHaZbAQ1o1Vk2tSqpA" target="_blank"><div class="icon-youtube"></div>&nbsp;</a>
			</li>
			<li>
				<a href="http://instagram.com/jpsportsandevents" target="_blank"><div class="icon-rss"></div>&nbsp;</a>
			</li>
			<li>
				<a href="http://twitter.com/jpsportsevents" target="_blank"><div class="icon-twitt"></div>&nbsp;</a>
			</li>
			<li>
				<a href="http://facebook.com/jpsportsevents" target="_blank"><div class="icon-fb"></div>&nbsp;</a>
			</li>
		</ul>
		
	</div>
	<div class="footer-inner middle-align">
		<a href="<?php echo home_url();?>"><img src="<?php echo get_site_url(); ?>/wp-content/themes/twentyfifteen/images/logo.png" height="62px" style="width:70px"></a>
		<p>Copyright © <?php echo date('Y');?> JP Sports and Events LLP. Designed by <a href="http://www.elegantmicroweb.com/" target="_blank">Elegant MicroWeb</a>.</p><br />
	</div>
</div><!-- .site-footer -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
