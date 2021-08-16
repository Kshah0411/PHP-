<?php
/**
 * jpsports functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
/*require_once get_stylesheet_directory() . '/vendor/acf/acf.php';
	require_once get_stylesheet_directory() . '/vendor/acf-repeater/acf-repeater.php';
	require_once get_stylesheet_directory() . '/vendor/acf-gallery/acf-gallery.php';*/

function twentyfifteen_child_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );
	
	wp_enqueue_style('twentyfifteen-computer-style', get_stylesheet_directory_uri().'/css/computer.css','','','screen and (min-width:940px)');
	wp_enqueue_style('twentyfifteen-tab-style', get_stylesheet_directory_uri().'/css/tablet.css','','','screen and (min-width: 720px) and (max-width:939px)');
	wp_enqueue_style('twentyfifteen-mobhor-style', get_stylesheet_directory_uri().'/css/mobile_hz.css','','','screen and (min-width: 480px) and (max-width:719px)');
	wp_enqueue_style('twentyfifteen-mobile-style', get_stylesheet_directory_uri().'/css/mobile.css','','','screen and (max-width: 479px)');
	
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}

add_action( 'wp_enqueue_scripts', 'twentyfifteen_child_scripts' );
add_action( 'init', 'codex_event_init' );
/**
 * Register a event post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_event_init() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'event', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Event', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Event', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Event', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Event', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Events', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Events', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Events:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No events found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'event', $args );
}
function my_recent_post()
	 {
		global $post;
		$html = "";

		$my_query = new WP_Query( array(
					'post_type' => 'event',
					'posts_per_page' => 3
	  ));

	  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

		   $html .= "<h2>" . get_the_title() . " </h2>";
		   $html .= "<p>" . get_the_excerpt() . "</p>";
		   $html .= '<a href="'. get_permalink() . '">' . 'Read More &raquo;' . '</a>';

	  endwhile; endif;

	  return $html;
	 }
add_shortcode( 'recent', 'my_recent_post' );

/*function members_parse_request($wp) {
	global  $wpdb;	
	if (array_key_exists('fullname', $wp->query_vars)) {
	
	//echo $product;
		
		//$product = $wp->query_vars['product_info'];
		$amount=$wp->query_vars['amt'];	
		//echo $amount;exit;	
		$fullname=$wp->query_vars['fullname'];
		$email=$wp->query_vars['email'];
		$contactno=$wp->query_vars['contact_no'];
		$occupation=$wp->query_vars['occupation'];
		$dofb=$wp->query_vars['dob'];
		$bloodtype=$wp->query_vars['bld'];
		$gender=$wp->query_vars['gen'];	
		$racecategory=$wp->query_vars['race'];
		//$tshirtsize=$wp->query_vars['tss'];
		$category=$wp->query_vars['category'];
		$addressline=$wp->query_vars['address'];
		$city=$wp->query_vars['city'];
		$state=$wp->query_vars['state'];
		$country=$wp->query_vars['con'];
		$zip_code=$wp->query_vars['zip'];
		$contactperson=$wp->query_vars['ecp'];
		$contact_no=$wp->query_vars['ecn'];

		$userid = rand();
		
		$table_name = "user";
		
			/*$query="SELECT max(userid) as maxid FROM user GROUP BY userid ORDER BY userid DESC";
			$result1=$wpdb->get_row($query);
			echo $query;
			exit;*/		
					
		/*if($wpdb->insert( $table_name, array(
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
			//'t_shirt_size'=>$tshirtsize,
			'address'=>$addressline,
			'city'=>$city,
			'state'=>$state,
			'country'=>$country,
			'zipcode'=>$zip_code,	
			'contact_person_name'=>$contactperson,
			'contact_person_contact_no'=>$contact_no,
			'userid'=>$userid
			
		) )) { 
			
				$id=$userid;
				$eid=$racecategory;
				$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
				$query_run = $wpdb->query($querys);
				
				if($wpdb->num_rows > 0) {
					//echo "already exits";				
				}
				else{
					$queryi= "Insert INTO user_events(eventid,userid) VALUES ('".$racecategory."','".$userid."')";
					$wpdb->query($queryi);	
				}
				echo '1';
		} else {
			

			echo '0';
		}
	
		
		die();
	}
}
function members_query_vars($vars) {
	//$vars[] = 'product_info'; 
	$vars[] = 'amt'; 
	$vars[] = 'fullname'; 
	$vars[] = 'email'; 
	$vars[] = 'contact_no'; 
	$vars[] = 'occupation'; 
	$vars[] = 'dob'; 
	$vars[] = 'bld'; 
	$vars[] = 'gen'; 
	$vars[] = 'race';
	$vars[] = 'category';
	//$vars[] = 'tss';
	$vars[] = 'address';
	$vars[] = 'city';
	$vars[] = 'state';
	$vars[] = 'con';
	$vars[] = 'zip';
	$vars[] = 'ecp';
	$vars[] = 'ecn';
	$vars[] = 'userid';
		 
	return $vars;
}
add_action('parse_request','members_parse_request');
add_filter('query_vars', 'members_query_vars');*/


/*add_filter( 'post_row_actions', 'remove_row_actions', 10, 1 );
function remove_row_actions( $actions )
{
    if( get_post_type() === 'post' )
        unset( $actions['edit'] );
        unset( $actions['view'] );
        unset( $actions['trash'] );
        unset( $actions['inline hide-if-no-js'] );
    return $actions;
}*/
function search($actions, $post)
{
   $actions['list_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=custompage&event_id=' . $post->ID . '" class="list_link">' . __('Participants') . '</a>';
  
   
   return $actions;
}
 
add_filter('post_row_actions', 'search', 10, 2);


add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
	add_menu_page( 'custom menu title', 'Custom Menu', 'manage_options', 'custompage', 'my_custom_menu_page', plugins_url( 'myplugin/images/icon.png' )); 
}

function my_custom_menu_page(){
	
	global $wpdb;
	if(isset($_POST["btn_submit"]))
	{
		$eventid = $_GET['event_id'];
		$queryu="Update user_events SET rank1 = '',rank2 = '',rank3 = '' WHERE eventid='".$eventid."'";		
		$wpdb->query($queryu);
		
		foreach($_POST as $key=>$value )
		{
			$userid = explode('_',$key);			
			if($value === '1'){
				$query="Update user_events SET rank1 = '1' WHERE userid='".$userid[1]."' and eventid='".$eventid."' ";
				$wpdb->query($query);
			} else if($value === '2'){
				$query1="Update user_events SET rank2 = '1' WHERE userid='".$userid[1]."' and eventid='".$eventid."' ";
				$wpdb->query($query1);
			} else if($value === '3'){
				$query2="Update user_events SET rank3 = '1' WHERE userid='".$userid[1]."' and eventid='".$eventid."'";
				$wpdb->query($query2);
			} 			
		}		
	}
	?>
	<script>
	function checkcount(id){
		var classname = jQuery('#'+id).attr("class");
		
		jQuery("input:radio[class^="+classname+"]").each(function(i) {
			this.checked = false;
        });
		var allRadios = document.getElementById(id);
		allRadios.checked=true;	
}
	
	function validation(){
		var rank1 = '';
		jQuery("input:radio[class^=radio1]").each(function() {
			if(this.checked){
				rank1 = 1;
				return false;
			}			
        });
        var rank2 = '';
        jQuery("input:radio[class^=radio2]").each(function() {
			if(this.checked){
				rank2 = 1;
				return false;
			}			
        });
         var rank3 = '';
        jQuery("input:radio[class^=radio3]").each(function() {
			if(this.checked){
				rank3 = 1;
				return false;
			}			
        });
        
        var msg='';
        if(rank1 == ''){
			alert("Please Select Rank 1st");
			return false;
			//msg="Rank 1st";
		}
		//alert(rank2);
		//return false;
		if(rank2 == ''){
			alert("Please Select Rank 2nd");
			return false;
			//msg="Rank 2nd";
		}
		if(rank3 == ''){
			alert("Please Select Rank 3rd");
			return false;
			//msg="Rank 3rd";
		}
        return true;
	}
	
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
/*$(document).ready(function(){
    $("#toggle").click(function(){
        $("p").toggle();
    });
});*/
function toggledata(showdata)
{
 //document.getElementbyId(showdata).display;
 $("#"+showdata).toggle();
}
</script>
<div class="wrap">
  <h1>Participants List</h1>
   <form method="post" name="form" onsubmit="return validation();">
     <table class="widefat"  cellpadding="0" cellspacing="0" width="100%" style="border: 1px;" rules="none">
		 <thead>
					<tr>
						<th>ID</th>
						<th>User ID</th>
						<th>Participant No</th>
						<th>Name</th>
						<th>Transaction ID</th>
						<th>Status</th>
						 <!--<th>Rank</th>-->					 
					</tr>
			</thead>
			
			<tbody>
				<?php
				$num_rec_per_page=100;
				$page = '';
				if (isset($_GET["pageno"])) { $page  = $_GET["pageno"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page; 
				$result = $wpdb->get_results ( "SELECT * FROM user_events WHERE eventid='". $_GET["event_id"] ."' ORDER BY id asc LIMIT $start_from, $num_rec_per_page ");
				//$result = $wpdb->get_results ( "SELECT * FROM user_events WHERE eventid='". $_GET["event_id"] ."' ORDER BY id asc ");
				$i=1;
				if($wpdb->num_rows > 0) {
				foreach ( $result as $print )   {
						
				?>
				<tr>
					<td>
					<?php
					//echo $i;
					echo  ($page-1) * $num_rec_per_page + $i;					
					$queryst="SELECT * FROM user where userid = '".$print->userid."' ";
					$pageposts = $wpdb->get_results($queryst, OBJECT);
					?>
					</td>
					<td>
						<?php
							echo $pageposts[0]->userid;?>
					</td>
					<td>
						<?php
							echo $pageposts[0]->participant_no;?>
					</td>
					<td>
							<?php
							echo $pageposts[0]->full_name;?>
						</td>
						<td>
							<?php
							$querytra="SELECT transactionid FROM user_transaction where userid = '".$print->userid."'";
							$querytrap = $wpdb->get_results($querytra, OBJECT);
							echo $querytrap[0]->transactionid;?>
						</td>
						<td>
							<?php
							$querysta="SELECT status FROM user_transaction where userid = '".$print->userid."'";
							$querystatus = $wpdb->get_results($querysta, OBJECT);
							echo $querystatus[0]->status;?>
						</td>
						
						<!-- <td> 
						 1<sup>st</sup> <input type="radio" value="1" class="radio1" <?php if($print->rank1 ==1){echo 'checked="checked"';} ?> onclick="checkcount(this.id)" name="radiob_<?php echo $pageposts[0]->userid?>" id="radio1_<?php echo $pageposts[0]->userid?>"/>
						 2<sup>nd</sup><input type="radio" value="2" class="radio2" onclick="checkcount(this.id)" <?php if($print->rank2 ==1){echo 'checked="checked"';} ?> name="radiob_<?php echo $pageposts[0]->userid?>" id="radio2_<?php echo $pageposts[0]->userid?>" /> 
						 3<sup>rd</sup><input type="radio" value="3" class="radio3" onclick="checkcount(this.id)" <?php if($print->rank3 ==1){echo 'checked="checked"';} ?> name="radiob_<?php echo $pageposts[0]->userid?>" id="radio3_<?php echo $pageposts[0]->userid?>"/>
						 </td>	-->						 
				<td>
						<button id="toggle" type="button" onclick="toggledata(<?php echo $print->userid;?>)">+</button>
						</td>
				</tr>
				
				<tr id="<?php echo $print->userid;?>" style="display:none;">
				<td>
				<ul data-role="listview">

						<?php if( $_GET['event_id'] != 502 ){ ?>
							
							<li>Address: <?php
							echo $pageposts[0]->address;?></li>						
							<li>Pincode: <?php
							echo $pageposts[0]->zipcode;?></li>
							<li>City: <?php
							echo $pageposts[0]->city;?></li>
							<li>State: <?php
							echo $pageposts[0]->state;?></li>
							<li>Country: <?php
							echo $pageposts[0]->country;?></li>

						<?php } ?>

							<li>Gender: <?php
							if($pageposts[0]->gender == '0')
							{
								echo "Male";
							}
							else if($pageposts[0]->gender == '1')
							{
								echo "Female";
							} else {
								echo $pageposts[0]->gender;
							}?></li>
							<!--</li>-->
							<!--<li>School/College/Occupation: <?php
							//echo $pageposts[0]->school_name;?></li>-->
							<li>Date of Birth: <?php
							echo $pageposts[0]->date_of_birth;?></li>
							<?php if( $_GET['event_id'] != 737 ){ ?>
							<li>Age Group:<?php
								echo $pageposts[0]->age_group;
								?>
								</li>
							<?php } ?>
								<li>Bip No: <?php
							echo $pageposts[0]->bip_no;?></li>
							<?php
							if(trim($pageposts[0]->bip_no1) != '') { ?>
							<li>Bip No 2 : <?php echo $pageposts[0]->bip_no1;?></li>
							<?php } ?>
							</ul>
							</td>
							<td>
								
							<ul data-role="listview">

							<?php if( $_GET['event_id'] != 502 ){ ?>

								<li>Nationality: <?php
								echo $pageposts[0]->nationality;?></li>
								<?php if( $_GET['event_id'] == 737 ){ ?>
								<li> Time Slot: <?php echo $pageposts[0]->category; ?> </li>
								<?php } ?>
									
								<?php if( $_GET['event_id'] != 502 && $_GET['event_id'] != 737 ){ ?>
								<li>Race Category: <?php
								if($pageposts[0]->category == 'Full cyclothon Ride')
								{
									echo "Full cyclothon Ride - 100 Km - 700 Rs";
								}
								else if($pageposts[0]->category == 'Half cyclothon Ride')
								{
									echo "Half cyclothon Ride - 50 Km - 700 Rs";
								}
								else if($pageposts[0]->category == 'Green Ride')
								{
									echo "Green Ride - 14 km - 250 Rs";
								}
								else if($pageposts[0]->category == 'Fashion Ride')
								{
									echo "Fashion Ride - 5 km - 100 Rs";
								}
								else if($pageposts[0]->category == 'Kids Ride')
								{
									echo "Kids Ride – 2 km - Nil";
								} else {
									echo $pageposts[0]->category;
								}
								?>
								</li>
								<li>Bike Make: <?php
								echo $pageposts[0]->bikemake;?></li>
								<li>T-Shirt Size: <?php
								if($pageposts[0]->t_shirt_size == 'S')
								{
									echo "S";
								}
								else if($pageposts[0]->t_shirt_size == 'M')
								{
									echo "M";
								}
								else if($pageposts[0]->t_shirt_size == 'L')
								{
									echo "L";
								}
								else if($pageposts[0]->t_shirt_size == 'XL')
								{
									echo "XL";
								}
								else if($pageposts[0]->t_shirt_size == 'XXl')
								{
									echo "XXl";
								}
								?>
								</li>

							<?php } } ?>

							<li>EmailId: <?php
							echo $pageposts[0]->email;?></li>
							 
							<li>Blood Type: <?php
							if($pageposts[0]->blood_type == '0')
							{
								echo "A+";
							}
							else if($pageposts[0]->blood_type == 1)
							{
								echo "A-";
							}
							else if($pageposts[0]->blood_type == 2)
							{
								echo "B+";
							}
							else if($pageposts[0]->blood_type == 3)
							{
								echo "B-";
							}
							else if($pageposts[0]->blood_type == 4)
							{
								echo "O-";
							}
							else if($pageposts[0]->blood_type == 5)
							{
								echo "O+";
							}else if($pageposts[0]->blood_type == 6)
							{
								echo "AB+";
							}
							else if($pageposts[0]->blood_type == 7)
							{
								echo "AB-";
							} else {
								echo $pageposts[0]->blood_type;
							}
							?></li>
							
						
							</li>
							
							<!--<li>Parents Name: <?php
							//echo $pageposts[0]->parents_name;?></li>-->
							
							<li>ContactNo: <?php
							echo $pageposts[0]->contact_no;?></li>
							<li>Occupation: <?php
							if($pageposts[0]->occupation == '0')
							{
								echo "Business";
							}
							else if($pageposts[0]->occupation == 1)
							{
								echo "Self employed";
							}
							else if($pageposts[0]->occupation == 2)
							{
								echo "Salaried";
							}
							else if($pageposts[0]->occupation == 3)
							{
								echo "Govt. employed";
							}
							else if($pageposts[0]->occupation == 4)
							{
								echo "Retired";
							}
							else if($pageposts[0]->occupation == 5)
							{
								echo "House wife";
							}else if($pageposts[0]->occupation == 6)
							{
								echo "Student";
							}
							else if($pageposts[0]->occupation == 7)
							{
								echo "Sports Person";
							}
							/*else if($pageposts[0]->occupation == 8)
							{
								echo "Unemployed";
							}*/
							else if($pageposts[0]->occupation == 9)
							{
								echo "Others";
							} else {
								echo $pageposts[0]->occupation;
							}
							?></li>
							</ul>
							</td>
							
							<td>
							<ul data-role="listview">

							<?php if( $_GET['event_id'] != 502 ){ ?>

								<li>Emergency Contact Person Name 1: <?php
								echo $pageposts[0]->contact_person_name;?></li>

							<?php } ?>

							<li>Emergency Contact Person Contact No 1: <?php
							echo $pageposts[0]->contact_person_contact_no;?></li>

							<?php if( $_GET['event_id'] != 502 && $_GET['event_id'] != 737 ){ ?>

								<li>Emergency Contact Person Name 2: <?php
								echo $pageposts[0]->contact_person_name2;?></li>
								<li>Emergency Contact Person Contact No 2: <?php
								echo $pageposts[0]->contact_person_contact_no2;?></li>
								
								
								<li>Geared/Fixie: <?php
								if($pageposts[0]->geared == 'Fixie')
								{
									//echo "Fixie (Made in India)";
									echo "Fixie (Non Gear)";
								}
								else if($pageposts[0]->geared == 'Geared')
								{
									echo "Geared";
								}
								else if($pageposts[0]->geared == 'Open')
								{
									echo "Open";
								}
								?></li>
								
								<li>Previous Cycling Experience: <?php
								echo $pageposts[0]->previous_cycling_experiences;?></li>
								<li>Other Adventure Sports: <?php
								echo $pageposts[0]->other_adventure_sports;?></li>

							<?php } ?>

							</ul>
							</td>							
							</tr>					
				<?php
				$i++;
				?>
							<?php }
							?>
							<tr>
					<!--<td><input class="search_btn" type="submit" name="btn_submit" id="btn_submit" value="Save"></td>-->
				</tr>
				
				<tr>
					<td colspan="7">
					
					
					<?php 
					$result1 = $wpdb->get_results ( "SELECT * FROM user_events WHERE eventid='". $_GET["event_id"] ."' ORDER BY id asc ");				
					$total_records = $wpdb->num_rows;
					$total_pages = ceil($total_records / $num_rec_per_page); 

					echo "<a href='http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=525&pageno=1'>".'|<'."</a> "; // Goto 1st page  

					for ($i=1; $i<=$total_pages; $i++) { 
						if($_GET['pageno'] == $i){
							$active = 'style="color:black;font-weight:bold;"';
						} else if($_GET['pageno'] == '' && $i == 1){
							$active = 'style="color:black;font-weight:bold;"';
						} else {
							$active = '';
						}
								echo "<a ".$active." href='http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=525&pageno=".$i."'>".$i."</a> "; 
					}; 
					echo "<a href='http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=525&pageno=$total_pages'>".'>|'."</a> "; // Goto last page
					?>
					
					</td>
					</tr>
				
							<?php
						} else 
						{
							?>
							<tr>
					<td colspan="4" style="text-align:center;">
					<?php
					echo "No Record Found";
					?>
					</td>
					</tr>
							<?php
						}
							?>  
			 <tbody>
		</table>
			<!--<input type="text" name="hd_count" id="hd_count" value=""/>-->		   
	</form>	
    </div>
    <?php
}
/*function remove_admin_menu_items() {
	$remove_menu_items = array(__('custom menu title'));
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}

add_action('admin_menu', 'remove_admin_menu_items');*/


/*add_action('wp_head','hideMenu');
function hideMenu()
{ ?>
<script type="text/javascript">
	jQuery(document).ready(function(){		
		jQuery('#toplevel_page_custompage').css('display', 'none');
	})
</script>
<?php } */
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
   #toplevel_page_custompage {
      display:none;
  }
  #toplevel_page_offlinepage{display:none;}
   .contact-form-section-bg{background-color:#ffffff;text-align:center}
		.certificate_main{width:100%;}
		.certificate_sec{width:50%;float:left;text-align:center;}
		.runnersup a, .search_list a{color:#000;}
		.runnersup a:hover, .search_list a:hover{color:#CE3430;}
		.search_btn { background-color: #ce3430;border: medium none; color: #fff; padding: 5px;margin-top:15px;}
		.reg_search_btn {background-color: #ce3430;border: medium none;color: #fff;font-size: 25px;margin-top: 15px;padding:15px 50px;text-transform: uppercase;}
		.runnersup label{float:left;font-family: Verdana;font-size:14px;}
		.runnersup input{float:right;padding:5px;width:300px;border:1px solid #999;}
		.runnersup{float:left;padding-left:80px;}
		.runnersup select{float:left;width:300px;padding:5px;color:#000;border:1px solid #999;font-family:"verdana";font-size:14px;}
		.error{background-color:#FF8282 !important;}
		.runnersup .left_fields{padding: 10px;}
		.runnersup .right_fields{padding: 10px;}
		.left_text{clear:both;float:left;}

		.payment-success {
			background: none repeat scroll 0 0 #fff !important;
			color: #ce3430 !important;
			font-size: 20px;
			font-weight: bold;
			padding: 25px;
			text-align: center;
		}
#post-502 .fitnessregister_link{display:block !important;}
		.iimregister_link{display:none;}
		.paging-nav {
		  text-align: right;
		  padding-top: 2px;
		}
		.fitnessregister_link{
			display:none;
		}
		.edit_link{
			display:none;
		}
		.delete_link{
			display:none;
		}
		.payment-success .thank-you-msg {
			font-size: 45px;
		}
		.success-title {
			font-size: 30px;
		}
		.register_link{display:none;}
		#post-157 .register_link{display:block !important;}
		.offline{text-decoration:none;color:#ce3430;}
		#toplevel_page_offlineiimpage{display:none;}
#post-231 .iimregister_link{display:block !important;}
.iimregister_link{display:none;}
.register_link{display:none;}		
#post-157 .register_link{display:none !important;}
#post-525 .register_link{display:block !important;}
  </style>';
}
function offline($actions, $post)
{
$actions['register_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlinepage&event_id=' . $post->ID . '" class="register_link">' . __('Offline Registration') . '</a>';
 
   return $actions;
}
add_filter('post_row_actions', 'offline', 10, 2);


add_action( 'admin_menu', 'register_my_offline_menu_page' );

function register_my_offline_menu_page(){
	add_menu_page( 'register menu title', 'Register Menu', 'manage_options', 'offlinepage', 'my_offline_menu_page', plugins_url( 'myplugin/images/icon.png' )); 
}
function my_offline_menu_page(){
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
            yearRange: '-100:+0',
			shortYearCutoff: '+10',
			dateFormat: 'dd/mm/yy',
    onSelect: function() {
        var date = jQuery(this).datepicker('getDate');
        var today = new Date();
        
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        //var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
      //alert("She is " + calculateAge(26,2,1975) + " years old");
      
      
      var formattedDate = date;
//var d = formattedDate.getDate();
var d = ("0" + formattedDate.getDate()).slice(-2);
//var m =  formattedDate.getMonth();
var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
//m += 1;  // JavaScript months are 0-11
var y = formattedDate.getFullYear();
  //    alert(y+'-'+m+'-'+d);
      
    dob = new Date(y+'-'+m+'-'+d);
	var today = new Date();
	
	//var age = (today-dob) / (365 * 24 * 60 * 60 * 1000);	
	var age = (today-dob) / (365.25 * 60 * 60 * 24 * 1000);	
	var dayDiff = age;
      //alert(dayDiff);
      // alert(dayDiff);
		/*if(dayDiff<=15){ 
			alert('Not Eligible for selected Race Category.');
			jQuery("#dob").val("");
       	}*/
        
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

function calculateAge(birthMonth, birthDay, birthYear)
{
  todayDate = new Date();
  todayYear = todayDate.getFullYear();
  todayMonth = todayDate.getMonth();
  todayDay = todayDate.getDate();
  age = todayYear - birthYear; 

  if (todayMonth < birthMonth - 1)
  {
    age--;
  }

  if (birthMonth - 1 == todayMonth && todayDay < birthDay)
  {
    age--;
  }
  return age;
}
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
        /*if(occ == '') {
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
        }*/

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
        
        //if(dob != '' && category != ''){
        if(category != ''){
			if(category == 'Full cyclothon Ride' || category == 'Half cyclothon Ride'){				
				
				var d = new Date(dob);
				var n = d.getFullYear();				
				var yeardiff = 2016 - n;
				
				/*if(yeardiff <= 15){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}*/
				$("#select-cat").val(category);
			} else {
				$("#select-cat").val(category);
			}
		}
		
		var age_group = $("#age_group").val();        
		/*if(age_group == '15-18 years'){
			alert("You must need to register offline for 15-18 age group category.");
			return false;
		}*/
		
       // if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != '' && mailvalid == true && validatePhone(contact) == true){   
       if(fname != ''&& contact != ''&& category != '' && mailvalid == true && validatePhone(contact) == true){    
			
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
<script>
$(window).load(function() {
    $('form').get(0).reset(); 
});
</script>
<?php
if ( isset($_POST['btn_submit']) ) 
			
			{
				
				global  $wpdb;
				
				//$status=$_POST['status'];
				$txnid=$_POST['txnid'];
				$amount=$_POST['amt'];
				$fullname=$_POST['firstname'].' '.$_POST['lastname'];					
				$occupation=$_POST['occupation'];
				$contactno=$_POST['phone'];
				$email=$_POST['email'];
				$racecategory=$_POST['race'];
				/*echo "Select id from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";
				exit;*/
				$querys1="Select id from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";	
				$query_run1 = $wpdb->get_results($querys1);						
				$userid_db = $query_run1[0]->id + 1;						
				$userid = time().$userid_db;																		
				$_SESSION["user"]=$userid;
				if($_POST['phone'] == ''){
					$contactno=$_POST['contact_no'];
				} else {
					$contactno=$_POST['phone'];
				}
				/* Insert into User Transaction Table */
				$table_name = "user_transaction";				
				if($wpdb->insert( $table_name, array(
				//'product_info' => $product,
				'userid'=>$userid,
				'eventid'=>$_GET['reg'],				
				'transactionid' => $txnid,
				'amount'=>$amount,
				'status'=>'success',
				'offline'=>'Yes',
				)));
				
			}
				
			if ( isset($_POST['btn_submit']) ) 
			{
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
						//$tshirtsize=$wp->query_vars['tss'];
						$category=$_POST['select-cat'];
						$age_group=$_POST['age_group'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$nationality=$_POST['nationality'];
						$bikemake=$_POST['bikemake'];
						$t_shirt_size=$_POST['t_shirt_size'];
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

						//$userid = rand();
						//$_SESSION["user"]=$userid;
						$querys1="Select id from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$userid_db = $query_run1[0]->id + 1;						
						
						//$userid = rand();
						$userid = time().$userid_db;						
						$_SESSION["user"] = $userid;
												
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
						$participant_no = time();
						
						$table_name = "user";	
				
						/*echo "insert into user set amount='".$amount."',full_name='".$fullname."',contact_no='".$contactno."',email='".$email."',occupation='".$occupation."',
						date_of_birth='".$dofb."',blood_type='".$bloodtype."',gender='".$gender."',race_category='".$racecategory."',category='".$category."',						
						age_group='".$age_group."',address='".$addressline."',city='".$city."',state='".$state."',country='".$country."',zipcode='".$zip_code."',	
						contact_person_name='".$contactperson."',contact_person_name2='".$contactperson2."',contact_person_contact_no='".$contact_no."',
						contact_person_contact_no2='".$contact_no2."',participant_no='".$participant_no."',nationality='".$nationality."',bikemake='".$bikemake."',
						t_shirt_size='".$t_shirt_size."',previous_cycling_experiences='".$previous_cycling_experiences."',other_adventure_sports='".$other_adventure_sports."',
						geared='".$geared."',bip_no='".$bip_no."',userid='".$userid."'	";	*/	
						
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
							
						
					if($wpdb->insert( $table_name, array(
						'status'=>'success',
						'offline'=>'Yes',
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
						't_shirt_size'=>$t_shirt_size,
						'previous_cycling_experiences'=>$previous_cycling_experiences,
						'other_adventure_sports'=>$other_adventure_sports,
						'geared'=>$geared,												
						'bip_no'=>$bip_no,												
						'userid'=>$userid					
						) )) { 
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
								echo $headers;*/
								//exit;
								mail($to,$subject,$body,$headers);
							
								$eveResult = get_post($eveId); 
								$eveTitle = $eveResult->post_title;
								echo "<div class='payment-success'>
								<div class='thank-you-msg'>Thank you</div><br>
								<p>Your payment was received successfully for</p><br>
								<div class='success-title'>Sugar Free Cyclothon Ahmedabad 21st February 2016 ".$category_name_final."</div></div>";
								
								echo "<div class='payment-success'>
								<a class='offline' href='http://jpsport.in/wp-admin/admin.php?page=offlinepage&event_id=157'>Back To form</a> |
								<a class='offline' href='http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=157'>Participants List</a></div>";
								
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
										$queryi= "Insert INTO user_events(eventid,userid,create_date,payment,offline) VALUES ('".$racecategory."','".$userid."',now(),'success','Yes')";
										$wpdb->query($queryi);	
									exit;
									}
								//echo '1';
								} 
			}  ?>

<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<h1><?php echo "Registration";?></h1>
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
									<label>Gender:<!--<span style="color:red;">*</span>--></label>  
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
									<label>Blood Group:<!--<span style="color:red;">*</span>--> </label>
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
								  <label>Date of Birth:</label>
								 </div>
								 <div class="right_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>
							
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
							
							<div class="right_fields">
									<div class="right_label">
										<label>Race Category:<span style="color:red;">*</span></label>  
									</div>
									<div class="right_text">								
										<select name="category" id="diffYear" onchange="display_field(this);">
											<option value="">Select</option>
											<option value="Full cyclothon Ride">Full cyclothon Ride - 100 Km - 700 Rs</option>								
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
										<select name="geared" id="geared">
										  <!--<option value="">Select</option>-->
										  <option value="Fixie">Fixie (Made in India)</option>
										  <option value="Geared">Geared (Road Bikes)</option>
										</select> 
									 </div>
								</div>
								<div class="clear"></div>																										
							</div>
							
							<div class="right_fields">
								<div class="right_label">
									<label>Mobile Number:<span style="color:red;">*</span> </label>
								</div>
								<div class="right_text">
									<input type="text" name="contact_no" id="contact_no"/>
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
								  <label>Occupation:<!--<span style="color:red;">*</span> --></label>
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
								  <!--<option value="8">Unemployed</option>-->
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
							<?php $id = $_GET['reg'];?>
							<!--<input name="amt" id="amt" type="hidden" value="<?php echo the_field('price', $id);?>">-->
							<input name="amt" id="amt" type="hidden" value="">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							<input name="age_group" id="age_group" type="hidden" value="">					
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">
			
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>	
<?php			
}
function iimoffline($actions, $post)
{
$actions['iimregister_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlineiimpage&event_id=' . $post->ID . '" class="iimregister_link">' . __('IIM Offline Registration') . '</a>';
 
   return $actions;
}
add_filter('post_row_actions', 'iimoffline', 10, 2);

add_action( 'admin_menu', 'register_iim_offline_menu_page' );

function register_iim_offline_menu_page(){
	add_menu_page( 'register iim menu title', 'Register IIM Menu', 'manage_options', 'offlineiimpage', 'iim_offline_menu_page', plugins_url( 'myplugin/images/icon.png' )); 
}
function iim_offline_menu_page(){
$_GET['reg'] = 231;
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
        var date = $(this).datepicker('getDate');
        var today = new Date();
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        
        //var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
        
        var formattedDate = date;
		var d = ("0" + formattedDate.getDate()).slice(-2);
		var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
		var y = formattedDate.getFullYear();  
      
		dob = new Date(y+'-'+m+'-'+d);
		var today = new Date();		
		var age = (today-dob) / (365.25 * 60 * 60 * 24 * 1000);		
		var dayDiff = age;
       	
      
      // alert(dayDiff);
		if(dayDiff<=18){ 			
			jQuery("#diffYear").val(18);
			jQuery("#select-cat").val(18);
       	}
        if(dayDiff<=22 && dayDiff>=19){ 
			jQuery("#diffYear").val(19);
			jQuery("#select-cat").val(19);
       	}
        else if(dayDiff<=40 && dayDiff>=23){
			jQuery("#diffYear").val(23);
			jQuery("#select-cat").val(23);
		}
        else if(dayDiff<=45 && dayDiff>=41){
			jQuery("#diffYear").val(41);
			jQuery("#select-cat").val(41);
		}
		else if(dayDiff<=59 && dayDiff>=46){
			jQuery("#diffYear").val(46);
			jQuery("#select-cat").val(46);
		}
		else if(dayDiff>=60){
			jQuery("#diffYear").val(60);
			jQuery("#select-cat").val(60);
			 //window.location = 'http://10.0.0.200/jpsports/';
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
        else{
			$("#contact_no").removeClass("error");
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
        
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != '' && mailvalid == true && validatePhone(contact) == true)       
		{	
			return true;
        } else {
            return false;
        }
    }
    

</script>
<?php

				
			if ( isset($_POST['btn_submit']) ) 
			{
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
						//$tshirtsize=$wp->query_vars['tss'];
						$category=$_POST['select-cat'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$zip_code=$_POST['zip'];
						$contactperson=$_POST['ecp'];
						$contact_no=$_POST['ecn'];
					
						$userid = rand();
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$participant_no = $query_run1[0]->participant_no + 1;
						
						$table_name = "user";	
						
						
						/*echo "insert into user set amount='".$amount."',full_name='".$fullname."',contact_no='".$contactno."',email='".$email."',occupation='".$occupation."',
						date_of_birth='".$dofb."',blood_type='".$bloodtype."',gender='".$gender."',race_category='".$racecategory."',category='".$category."',						
						age_group='".$age_group."',address='".$addressline."',city='".$city."',state='".$state."',country='".$country."',zipcode='".$zip_code."',	
						contact_person_name='".$contactperson."',contact_person_name2='".$contactperson2."',contact_person_contact_no='".$contact_no."',
						contact_person_contact_no2='".$contact_no2."',participant_no='".$participant_no."',nationality='".$nationality."',bikemake='".$bikemake."',
						t_shirt_size='".$t_shirt_size."',previous_cycling_experiences='".$previous_cycling_experiences."',other_adventure_sports='".$other_adventure_sports."',
						geared='".$geared."',bip_no='".$bip_no."',userid='".$userid."'	";	*/		
						
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
					$insert_val .= "userid=".$userid."<br/>";							
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From: priyankp@elegantmicroweb.com'." <Priyank>\r\n";

                        mail('priyankp@elegantmicroweb.com','insert query -- iim chaos',$insert_val,$headers);
					/*end mail*/				
						
					if($wpdb->insert( $table_name, array(
						'status'=>'success',
						'offline'=>'Yes',
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
						//'t_shirt_size'=>$tshirtsize,
						'address'=>$addressline,
						'city'=>$city,
						'state'=>$state,
						'country'=>$country,
						'zipcode'=>$zip_code,	
						'contact_person_name'=>$contactperson,
						'contact_person_contact_no'=>$contact_no,
						'participant_no'=>$participant_no,						
						'userid'=>$userid					
						) ))
						
						$status=$_POST['status'];
						$txnid=$_POST['txnid'];
						$amount=$_POST['amt'];				
						if($_POST['fullname'] == ''){
							$fullname=$_POST['firstname'].' '.$_POST['lastname'];									
						} else {
							$fullname=$_POST['fullname'];	
						}
						$mihpayid=$_POST['mihpayid'];
						$issuing_bank=$_POST['issuing_bank'];
						$card_type=$_POST['card_type'];				
						$_SESSION["user"]=$userid;
						$occupation=$_POST['occupation'];
						if($_POST['phone'] == ''){
							$contactno=$_POST['contact_no'];
						} else {
							$contactno=$_POST['phone'];
						}
						$email=$_POST['email'];
						$table_name = "user_transaction";				
						$wpdb->insert( $table_name, array(
						//'product_info' => $product,
						'userid'=>$userid,
						'eventid'=>$_GET['reg'],				
						'transactionid' => $txnid,
						'amount'=>$amount,
						'status'=>'success',
						'offline'=>'Yes',
						'pay_id'=>$mihpayid,
						'issuing_bank'=>$issuing_bank,
						'card_type'=>$card_type,
				
				));
				
						
						 { 
						$eveId = $_GET['reg'];
						$pageID = $eveId;
						$page = get_post($pageID);
				
				
				/* SMS send  */
				$smsmsg = "Successful Registration for ".$page->post_title." event.";				
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
				
				$querys2="Select * from user WHERE userid='".$_SESSION["user"]."'";				
				$query_run2 = $wpdb->get_results($querys2);						
				$participant_no = $query_run2[0]->participant_no;
				
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
							else if($occupation == 8)
							{
								$occp="Unemployed";
							}
							else if($occupation == 9)
							{
								$occp="Others";
							}
						$subject = 'Successful Registration';
				
                        $body = '
                        <b>Registration Details</b><br /><br />
                        

                        Name: '.$fullname.'<br />
                        Mobile: '.$contactno.'<br />
                        Email: '.$email.'<br />
                        Occupation: '.$occp.'<br />
                        Event: '.$page->post_title.'<br />
						Participant No: '.$participant_no.'<br /><br /><br />
                       
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

						/*echo $to;
						echo $subject;
						echo $body;
						echo $headers;
						//exit;*/
                        mail($to,$subject,$body,$headers);
						
						
						$eveResult = get_post($eveId); 
						$eveTitle = $eveResult->post_title;
						echo "<div class='payment-success'>
						<div class='thank-you-msg'>Thank you</div><br>
						<p>your payment was received successfully for</p><br>
						<div class='success-title'>".$eveTitle."</div></div>";
								
								echo "<div class='payment-success'>
								<a class='offline' href='http://jpsport.in/wp-admin/admin.php?page=offlineiimpage&event_id=231'>Back To form</a> |
								<a class='offline' href='http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=231'>Participants List</a></div>";
								
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
										$queryi= "Insert INTO user_events(eventid,userid,create_date,payment,offline) VALUES ('".$racecategory."','".$userid."',now(),'success','Yes')";
										$wpdb->query($queryi);	
									exit;
									}
								//echo '1';
								} 
			}  ?>

<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<h1><?php echo "Registration";?></h1>
					<div id="message"></div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">

							<!--<div class="left_fields">	
								<div class="left_label">					
									<label>ProductInfo:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="product_info" id="product_info" />
								</div>
							 </div>
							 <div class="clear"></div>
							 
							 <div class="left_fields">
								<div class="left_label">
									<label>Amount:</label>
								</div>
								<div class="left_text">  
									<input type="text" name="amt"  id="amt"/>
								</div>
							</div>
							<div class="clear"></div>-->
							
							<div class="left_fields">
								<div class="left_label">
									<label>Full Name: </label>
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
									<label>Gender:</label>  
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
									<label>Blood Group: </label>
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
						</div>

						</div>
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">

							<div class="right_fields">
								<div class="right_label">
								  <label>Date of Birth:</label>
								 </div>
								 <div class="right_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>

							<div class="right_fields">
								<div class="right_label">
									<label>Age Group:</label>  
								</div>
								<div class="right_text">								
									<select name="category" id="diffYear" disabled="disabled">
									 	<option value="">Select</option>
									 	<option value="18">Less than 18 years</option>
										<option value="19">19-23 years</option>								
										<option value="23">24–40 years</option>
										<option value="41">41-45 years</option>
										<option value="46">46-59 years</option>
										<option value="60">Above 60 years</option>
									</select>
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
									<label>Emergency Contact Name:</label>
								</div>
								<div class="right_text">  
									<input type="text" name="ecp" id="ecp"/>
								</div>
							</div>
							<div class="clear"></div>
							
							<div class="right_fields">
								<div class="right_label"></div>
									<label>Emergency Contact Number:</label>
								<div class="right_text"> 
									<input type="text" name="ecn" id="ecn" />
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
								  <label>Occupation: </label>
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
								  <option value="8">Unemployed</option>
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>	
				
							<!--<div class="right_fields">
								<div class="right_label">
									<label>TEE SHIRT SIZE:</label>
								</div>
								<div class="right_text">  
								<select name="tss" id="tss">
								<option value="">Select</option>
								<option value="0">S</option>
								<option value="1">M</option>
								<option value="2">L</option>
								<option value="3">XL</option>
								<option value="4">XLL</option>
								</select>
								</div>
							</div>
							<div class="clear"></div>-->
							<?php $id = $_GET['reg'];?>
							<input name="amt" id="amt" type="hidden" value="<?php echo the_field('price', $id);?>">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				<div class="clear"></div>
				<div class="certi_search">

				
					
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>	
<?php			
}


// rushi
// fitness bash offline registration link

function fitnessoffline($actions, $post)
{
//$actions['fitnessegister_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlinefitnesspage&event_id=' . $post->ID . '" class="iimregister_link">' . __('Fitness Offline Registration') . '</a>'; 
$actions['fitnessegister_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlinefitnesspage&event_id=502" class="fitnessregister_link">' . __('Fitness Offline Registration') . '</a>'; 
   return $actions;
}

add_filter('post_row_actions', 'fitnessoffline', 10, 2);

add_action( 'admin_menu', 'register_fitness_offline_menu_page' );

function register_fitness_offline_menu_page(){
	add_menu_page( 'register fitness menu title', 'Register Fitness Menu', 'manage_options', 'offlinefitnesspage', 'fitness_offline_menu_page', plugins_url( 'myplugin/images/icon.png' )); 
}

function fitness_offline_menu_page(){

$_GET['reg'] = 502;
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
        var date = $(this).datepicker('getDate');
        var today = new Date();
        // alert(date.getFullYear()+":::"+today.getFullYear());
        //var dayDiff = Math.ceil((today - date) / (365*60*60*24));
        
        //var dayDiff   = Math.ceil(( today.getFullYear()-date.getFullYear()));
        
        var formattedDate = date;
		var d = ("0" + formattedDate.getDate()).slice(-2);
		var m = ("0" + (formattedDate.getMonth() + 1)).slice(-2);
		var y = formattedDate.getFullYear();  
      
		dob = new Date(y+'-'+m+'-'+d);
		var today = new Date();		
		var age = (today-dob) / (365.25 * 60 * 60 * 24 * 1000);		
		var dayDiff = age;
       	
      
      // alert(dayDiff);
		if(dayDiff<=18){ 			
			jQuery("#diffYear").val(18);
			jQuery("#select-cat").val(18);
       	}
        if(dayDiff<=22 && dayDiff>=19){ 
			jQuery("#diffYear").val(19);
			jQuery("#select-cat").val(19);
       	}
        else if(dayDiff<=40 && dayDiff>=23){
			jQuery("#diffYear").val(23);
			jQuery("#select-cat").val(23);
		}
        else if(dayDiff<=45 && dayDiff>=41){
			jQuery("#diffYear").val(41);
			jQuery("#select-cat").val(41);
		}
		else if(dayDiff<=59 && dayDiff>=46){
			jQuery("#diffYear").val(46);
			jQuery("#select-cat").val(46);
		}
		else if(dayDiff>=60){
			jQuery("#diffYear").val(60);
			jQuery("#select-cat").val(60);
			 //window.location = 'http://10.0.0.200/jpsports/';
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
		/*//var productinfo  = $("#product_info").val();
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
		var confirm = document.getElementById ("confirm"); 
		
		
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
         if (!confirm.checked) {
                //alert ("You must enter activity!");
                return true;
            }
      */
        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != ''&& mailvalid == true){        	 
            return true;
        } else {
            return true;
        }
    }
</script> 

<script>
$(document).ready(function () {
    $("input[name='activity']").change(function () {
        var maxAllowed = 2;
        var cnt = $("input[name='activity']:checked").length;
        if (cnt > maxAllowed) {
            $(this).prop("checked", "");
            alert('You can select maximum ' + maxAllowed + ' activities!!');
        }
    });
});
</script>

	
	
<?php
			
			$s_status=$_POST['status'];

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
						//$tshirtsize=$wp->query_vars['tss'];
						$category=$_POST['select-cat'];
						$addressline=$_POST['address'];
						$city=$_POST['city'];
						$state=$_POST['state'];
						$country=$_POST['con'];
						$zip_code=$_POST['zip'];
						$contactperson=$_POST['ecp'];
						$contact_no=$_POST['ecn'];
						$checkBox = implode(',', $_POST['activity']); 
						  
					

						$userid = rand();
						$_SESSION["user"]=$userid;
						//echo $category;exit;
						
						$querys1="Select * from user WHERE race_category='".$racecategory."' order by id desc limit 0,1";				
						$query_run1 = $wpdb->get_results($querys1);						
						$participant_no = $query_run1[0]->participant_no + 1;
						
						$table_name = "user";	

/*
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
						//'t_shirt_size'=>$tshirtsize,
						'address'=>$addressline,
						'city'=>$city,
						'state'=>$state,
						'country'=>$country,
						'zipcode'=>$zip_code,	
						'contact_person_name'=>$contactperson,
						'contact_person_contact_no'=>$contact_no,
						'participant_no'=>$participant_no,	
						'activity1'=>$checkBox,					
						'userid'=>$userid,
						'status'=>'success',
						'offline'=>'yes',
						) ))*/

$insert_fitness = "insert into user set amount='".$amount."', full_name = '".$fullname."',contact_no='".$contactno."', email='".$email."',occupation='".$occupation."',date_of_birth='".$dofb."',blood_type='".$bloodtype."',gender='".$gender."',race_category='".$racecategory."',category='".$category."',address='".$addressline."',city='".$city."',state='".$state."',country='".$country."',zipcode='".$zip_code."',contact_person_name='".$contactperson."',contact_person_contact_no='".$contact_no."',participant_no=".$participant_no.",activity1='".$checkBox."',userid=".$userid.",status='success',offline='yes'";
//echo $insert_fitness; exit;
$query_ins = $wpdb->query($insert_fitness);
if($query_ins)
 { 

						$id=$userid;
						$eid=$racecategory;

						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";				
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";				
							}
							else{
								$queryi= "Insert INTO user_events(eventid,userid,create_date) VALUES ('".$racecategory."','".$userid."',now())";
								$wpdb->query($queryi);	
								
$table_name = "user_transaction";				
								$wpdb->insert( $table_name, array(
								//'product_info' => $product,
'userid'=>$userid,
'eventid'=>$_GET['reg'],				
'transactionid' => $txnid,
'amount'=>$amount,
								'status'=>'success',
								'offline'=>'Yes',
								'pay_id'=>$mihpayid,
								'issuing_bank'=>$issuing_bank,
								'card_type'=>$card_type,
								));

								/*pay_page( array (				
									'surl' => 'payment_success',
									'furl' => 'payment_failure',
									'key' => 'gtKFFx',
									'txnid' => $_POST['txnid'],
									'amount'=> $_POST['amt'],
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
									'zip_code'=>$_POST['zip'],
									'contactperson'=>$_POST['ecp'],
									'contactno'=>$_POST['ecn'],
									'productinfo' => $_POST['productinfo'],
									'status'=>'offline',
								), 
							'eCwWELxi');*/
							//exit;
							}
						//echo '1';
						} 
				//print_r($_POST);
				
				
			echo "<script language='JavaScript'>window.location = 'http://jpsport.in/wp-admin/admin.php?page=custompage&event_id=502'; </script>";
			exit;
			//Header("Location: http://10.0.0.126/jpsports_new/wp-admin/edit.php?post_type=event");
					
			} else { $s_status = '';
			if($s_status != 'success') { ?>
			<div id="slider">
			<div class="header-img" style="background-color:#901d78;">
				<?php the_post_thumbnail(array( 1000, 1000) );  ?>
			</div>
            <!--<div class="top-bar">									
            <a href="<?php echo home_url();?>"><img width="340" height="300" alt="" src="<?php echo get_site_url(); ?>/wp-content/uploads/2015/09/logo.svg" title=""></a>            </div>-->
			<div class="main-container">

			<?php  if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>
			<section class="page-container"><?php the_content();?></section>
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<?php 
						$id=502; 
						$post = get_post($id);
					?>
					<h1><?php echo $post->post_title ?></h1>
					<div id="message"></div>
					<div class="certificate_main">
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">
							<form method="POST">

							<!--<div class="left_fields">	
								<div class="left_label">					
									<label>ProductInfo:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="product_info" id="product_info" />
								</div>
							 </div>
							 <div class="clear"></div>
							 
							 <div class="left_fields">
								<div class="left_label">
									<label>Amount:</label>
								</div>
								<div class="left_text">  
									<input type="text" name="amt"  id="amt"/>
								</div>
							</div>
							<div class="clear"></div>-->
							
							<div class="left_fields">
								<div class="left_label">
									<label>Full Name: </label>
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
									<label>Gender:</label>  
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
									<label>Blood Group: </label>
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
						</div>

						</div>
						<div class="certificate_sec">
							
							<div class="clear"></div>
							<div class="runnersup">

							<div class="left_fields">
								<div class="left_label">
								  <label>Date of Birth:</label>
								 </div>
								 <div class="left_text">
								  <input type="text" name="dob" id="dob" readonly="readonly" />
								  </div>
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Age Group:</label>  
								</div>
								<div class="left_text">								
									<select name="category" id="diffYear" disabled="disabled">
									 	<option value="">Select</option>
									 	<option value="18">Less than 18 years</option>
										<option value="19">19-23 years</option>								
										<option value="23">24–40 years</option>
										<option value="41">41-45 years</option>
										<option value="46">46-59 years</option>
										<option value="60">Above 60 years</option>
									</select>
								</div> 
							</div>
							<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Mobile Number: </label>
								</div>
								<div class="left_text">
									<input type="text" name="contact_no" id="contact_no" />
								</div>
							</div>
							<div class="clear"></div>

							
							
							<div class="left_fields">
								<div class="left_label"></div>
									<label>Emergency Contact Number:</label>
								<div class="left_text"> 
									<input type="text" name="ecn" id="ecn" />
								 </div>
							 </div>
								<div class="clear"></div>

							<div class="left_fields">
								<div class="left_label">
									<label>Email Id:</label>
								</div>
								<div class="left_text"> 
									<input type="text" name="email" id="email"/>
								 </div>
							</div>
							<div class="clear"></div>
																				
							<div class="left_fields">
								<div class="left_label">
								  <label>Occupation: </label>
								 </div>
								 <div class="left_text">
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
								  <option value="8">Unemployed</option>
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>	

							<div class="left_fields">
								<div class="left_label">
									<label>Activities: </label>
								</div>
								<div class="left_text checked">
									<input type="checkbox" name="activity[]" value="cycling" id="confirm" style="width: 30px;float: none!important;"/> Cycling
									<input type="checkbox" name="activity[]" value="running" id="confirm" style="width: 30px;float: none !important;"/> Running
									<input type="checkbox" name="activity[]" value="yoga" id="confirm" style="width: 30px;float: none !important;"/> Yoga
									<input type="checkbox" name="activity[]" value="zumba" id="confirm" style="width: 30px;float: none !important;"/> Zumba
								</div>
							</div>
							<div class="clear"></div>
							
							<?php $id = $_GET['reg'];?>
							<input name="amt" id="amt" type="hidden" value="<?php echo the_field('price', $id);?>">
							<input name="race" id="race" type="hidden" value="<?php echo $_GET['reg'];?>">		
							<input name="txnid" id="txnid" type="hidden" value="<?php echo rand();?>">
							<input name="productinfo" id="productinfo" type="hidden" value="<?php echo 'Registration';?>">
							<input name="select-cat" id="select-cat" type="hidden" value="">
							</div>
						</div>
					</div>																
				 </div><!-- middle-align -->
				 
				<div class="clear"></div>
				<div class="certi_search">

	
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();">
				</form>	
				</div>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
			
			<?php  } }
}


// cyclothon 2017 offline menu - rushi

function offline2017($actions, $post)
{
$actions['register_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlinepage2017&event_id=525" class="register_link">' . __('Offline Registration') . '</a>';
//$actions['fitnessegister_link'] = '<a href="' . site_url() . '/wp-admin/admin.php?page=offlinefitnesspage&event_id=502" class="fitnessregister_link">' . __('Fitness Offline Registration') . '</a>'; 
   return $actions;
}
add_filter('post_row_actions', 'offline2017', 10, 2);


add_action( 'admin_menu', 'register_my_offline_menu_page2017' );

function register_my_offline_menu_page2017(){
	add_menu_page( 'register menu title', 'Register Menu', 'manage_options', 'offlinepage2017', 'cyclothin2017_offline_menu', plugins_url( 'myplugin/images/icon.png' )); 
}
function cyclothin2017_offline_menu(){
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
			}  else if(category == 'Ahmedabad Green Ride' || category == 'Fashion Ride'){				
				/*if(yeardiff < 10){
					alert ("Not Eligible for selected Race Category.");
					return false;
				} else {
					$("#select-cat").val(category);
				}*/
				$("#select-cat").val(category);
			} else if(category == 'Kids Ride'){
				/*if(yeardiff >= 15 && yeardiff <= 18){
				} else {
					alert("You are not Eligible for Kids Ride.");
					return false;
				}*/
				if(yeardiff <= 18){
					$("#select-cat").val(category);
				} else {
					alert("You are not Eligible for Kids Ride.");
					return false;
				}
			} else {
				$("#select-cat").val(category);
			}
		}
		var age_group = $("#age_group").val();  
		
		/*if(yeardiff<15){ 
			alert("Under 15 years age you must need to register offline. Please go to JP Sports & Events office.");
			return false;
		}*/
		      

        if(fname != ''&& contact != ''&& occ != ''&& dob != ''&& blood != ''&& gender != ''&& category != '' && mailvalid == true && validatePhone(contact) == true && check_geared_select() == true){
			
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
			
            return true;
        } else {			
			
            return false;
        }
    }
    
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
	}
	
	function display_field()
	{
		var category  = $("#diffYear").val(); 
		if(category == 'Half cyclothon Ride' || category == 'ITT Half cyclothon Ride'){
			$("#display_Geared").show();
		} else {
			$("#display_Geared").hide();			
			$("#geared").val('');
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
			return true;
		}
		else {			
			return false;
		}
	}
</script> 
	<?php	
	if ( isset($_POST['btn_submit']) || isset($_POST['btn_submit1']) ) 
			{ // rushi101116
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
									$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and offline = 'yes' order by id desc limit 0,1";
									
									//$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type == 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
									if($gender == '0' && $age_group1 == '15-39 years'){
										$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' and offline = 'yes' order by bip_no desc limit 0,1";
									} else {
										$querys2="Select gender,category,bip_no1 from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Half cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
									}
								} else if($category == 'Half cyclothon Ride'){									
									$querys1="Select gender,category,bip_no,race_category from user WHERE race_category='".$racecategory."' and category='".$category."' and gender='".$gender."' and geared='".$geared."' and age_group='".$age_group."' order by id desc limit 0,1";
									
									//$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
									if($gender == '0' && $age_group1 == '15-39 years'){
										$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' and offline = 'yes' order by id desc limit 0,1";
									} else {
										$querys2="Select gender,category,bip_no1,race_category from user WHERE race_category='".$racecategory."' and (category='".$category."' or category='Full cyclothon Ride') and gender='".$gender."' and age_group1='".$age_group1."' and cyclothon_type = 'CYCLOTHON + ITT RACE' order by id desc limit 0,1";
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
										//$bip_no = 101;  // male
										$bip_no = 1;  // male
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
											//$bip_no1 = 5100;  // male & 15-39
											$bip_no1 = 5000;  // male & 15-39
										}else if($gender == '1' && $age_group1 == '15-39 years'){
											$bip_no1 = 6000;  // female & 15-39
										}else if($gender == '0' && $age_group1 == '40'){
											$bip_no1 = 5600;  // male & 40+
										}else if($gender == '1' && $age_group1 == '40'){
											$bip_no1 = 6300;  // female & 40+
										}
									} else if($category == 'Half cyclothon Ride'){
										
										if($gender == '0' && $age_group1 == '15-39 years'){
											$bip_no1 = 5000;  // male & 15-39
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
									$querys1="Select gender,category,bip_no from user WHERE race_category='".$racecategory."' and category='".$category."' and offline='yes' order by id desc limit 0,1";
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
										//$bip_no = 101;  // male
										$bip_no = 1;  // male
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
						}
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
					$insert_val .= "bip_no1=".$bip_no1."<br/>";
					$insert_val .= "userid=".$userid."<br/>";
					$insert_val .= "cyclothon_type=".$cyclothon_type."<br/>";
					$insert_val .= "age_year=".$hd_age_year."<br/>";
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $headers .= 'From:priyankp@elegantmicroweb.com'." <Priyank>\r\n";
					
					$bip_no = $_POST['bip_no'];
					$bip_no1 = $_POST['bip_no1'];
					
					if($wpdb->insert( $table_name, array(
						//'product_info' => $product,
						'status'=>'success',
						'offline'=>'Yes',
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
						'age_year'=>$hd_age_year,
						) )) { 
							
						$id=$userid;
						$eid=$racecategory;
						$querys="Select * from user_events WHERE userid='".$id."' and eventid='".$eid."'";
						$query_run = $wpdb->query($querys);
						
							if($wpdb->num_rows > 0) {
								//echo "already exits";			
								header("location:http://jpsport.in/sugar-free-cyclothon-2017?cyclothon_itt_select=".$cyclothon_itt_select);
								exit;	
							}
							else{								
								$queryi= "Insert INTO user_events(eventid,userid,create_date,offline) VALUES ('".$racecategory."','".$userid."',now(),'Yes')";
								$wpdb->query($queryi);
								
								$table_name = "user_transaction";				
								$wpdb->insert( $table_name, array(
									'userid'=>$userid,
									'eventid'=>$_GET['reg'],				
									'transactionid' => $txnid,
									'amount'=>$amount,
									'status'=>'success',
									'offline'=>'Yes',
									'pay_id'=>$mihpayid,
									'issuing_bank'=>$issuing_bank,
									'card_type'=>$card_type,
								));

								
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
						/*$pass_data = "mobile=9879766651&pass=jpsports@123&senderid=JPEVNT&to=".$contactno."&msg=".$smsmsg;

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
						}*/
						/* End SMS send  */
						
						/* start Email */
						
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
								Event: Sugar Free Cyclothon 2017<br />
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
								Event: Sugar Free Cyclothon 2017<br />
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
								//mail($to,$subject,$body,$headers);
						
						/* end Email*/
								
					}
						echo "<script language='JavaScript'>window.location = 'http://jpsport.in/wp-admin/admin.php?page=offlinepage2017&event_id=525'; </script>";
						exit;
			} else {
				header("location:http://jpsport.in/sugar-free-cyclothon-2017?cyclothon_itt_select=".$cyclothon_itt_select);
				exit;	
			}
	} else { 
		if($s_status != 'success') {
		?>
			<div id="slider">
			<div class="main-container">
																
			<?php 
			$id=174; 
			$post = get_post($id); ?>
			<?php
			$content = apply_filters('the_content', $post->post_content); 
			
			?>
			
			
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
			
			<?php endwhile; endif;?>			
			<section class="page-container page-container-new"><?php the_content();?></section>
			<section class=" contact-form-section-bg" id="section8">			
				<div class="contact-form-section middle-align">
					<div id="message"></div>
					<div class="clear"></div>
					<div class="register_select">
						<div class="home_reg_btn home_reg_btn_a">
							<a href="<?php echo site_url() ?>/wp-admin/admin.php?page=offlinepage2017&cyclothon_itt_select=1&event_id=525">
								<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff;line-height: 1em; background-color: #1761a2;font-weight:bold;">REGISTER FOR<br><font style="color:#FCE748;"> CYCLOTHON</font></span>
							</a>&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=offlinepage2017&cyclothon_itt_select=2&event_id=525">
								<span class="search_btn" style="font-size:25px;display:inline-block;color:#fff;line-height: 1em;background-color: #019259;font-weight:bold;">REGISTER FOR<br><font style="color:#FCE748;"> CYCLOTHON + ITT</font></span>
							</a><!-- 19-1-2017-->
							<p style="color:#656364;font-weight:bold;margin-top: 10px;">ITT RACE - 28 JANUARY 2017 | CYCLOTHON - 29 JANUARY 2017</p>
						</div>
					</div>
					
					<?php if($cyclothon_itt_select != '') { ?>
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
							<div class="left_fields">
								<div class="left_label">
									<label>Cyclothon BIB No.:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="bip_no" id="bip_no" />
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
											<option value="Ahmedabad Green Ride">Ahmedabad Green Ride - 14 km - 250 Rs</option>
											<option value="Fashion Ride">Fashion Ride - 5 km - 100 Rs</option>
											<option value="Kids Ride">Kids Ride - 2 km - 100 Rs</option>
										</select>
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
												<option value="15-18 years">15 years and above</option>
												<option value="19–39 years">19 years and above</option>
												<option value="40-59 years">40 years and above</option>
												<option value="60">60 years and above</option>										
											</select>
										</div>
										<div id="cat_fixie" style="display:none;">
											<select name="agegroup" id="agegroup" disabled="disabled">
												<option value="">Select</option>											
												<option value="15-39 years">15 years and above</option>
												<option value="40">40 years and above</option>
											</select>
										</div>
									</div> 
								</div>
								<div class="clear"></div>
							</div>

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
								  <option value="9">Others</option>
							</select>
							</div> 
							</div>
							<div class="clear"></div>
							<div class="left_fields">
								<div class="left_label">
									<label>ITT BIB No.:</label> 
								</div>
								<div class="left_text">
									<input type="text" name="bip_no1" id="bip_no1" />
								 </div>
							</div>
							<div class="clear"></div>		
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
						<div class="register_select">
							<div class="clear"></div>
							<div class="left_label">
								<label><strong>ITT Race</strong></label>
							</div>
							<div class="runnersup">
								<div class="right_fields">
									<div class="right_label">
										<label>Age Group:</label>  
									</div>
									<div class="right_text">
										<select disabled="disabled" id="agegroup1" name="agegroup1">
											<option value="">Select</option>											
											<option value="15-39 years">15 years and above</option>
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
						</div>
					</div>
					<!-- itt end -->
					<?php } ?>
				 </div>
				<div class="clear"></div>
				</div>
				
				<div class="certi_search">
			
				
			<div class="clear"></div>
			<main class="content cf">
		
			 <input class="reg_search_btn" type="submit" name="btn_submit" id="btn_submit" value="Submit" onclick="return validation();" style="cursor:pointer;">
				</form>
				</div>
				<?php } ?>
				<div class="clear"></div>
			
			</section>
			<div class="clear"></div>
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
       	
       	/*if(dayDiff<15){ 
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
	
	<?php 
	/* 19-1-2017 */
	/*if($cyclothon_itt_select == '2'){ ?>
    $('#closed_itt_regs').show();
    $('.certificate_main').hide();
    $('.static-text').hide();
    $('.page-container-bottom').hide();
    $('#btn_submit').hide();
    <?php } */ ?>
	
});
</script>
<?php
}
