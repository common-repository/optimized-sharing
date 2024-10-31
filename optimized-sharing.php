<?php

/*
Plugin Name: Optimized Sharing
Plugin URI: https://crunchify.com/optimized-sharing-premium/
Description: Social Sharing Button without loading any JavaScript. WordPress Speed Optimization Goal.
Author: App Shah
Author URI: https://crunchify.com
Version: 2.1
License: GNU General Public License v2.0 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: optimized-sharing
*/

// Let's use unique prefix for this plugin - crunchify_cos (Crunchify Optimized Sharing)

// the name of the settings page for the license input to be displayed
define( 'CRUNCHIFY_COS_PAGE', 'crunchify-cos' );

function crunchify_cos_header() {
		wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

		echo '<style type="text/css">.crunchify-link{padding:7px 18px 8px;color:#fff!important;font-size:12px;border-radius:20px;margin-right:5px;cursor:pointer;-moz-background-clip:padding;-webkit-background-clip:padding-box;box-shadow:inset 0 -3px 0 rgba(0,0,0,.2)!important;-moz-box-shadow:inset 0 -3px 0 rgba(0,0,0,.2)!important;-webkit-box-shadow:inset 0 -3px 0 rgba(0,0,0,.2)!important}.crunchify-link:active,.crunchify-link:hover{-webkit-box-shadow:none!important;box-shadow:none!important;color:#fff!important}.crunchify-twitter{background:#00aced}.crunchify-twitter:active,.crunchify-twitter:hover{background:#0084b4}.crunchify-facebook{background:#3B5997}.crunchify-facebook:active,.crunchify-facebook:hover{background:#2d4372}.crunchify-googleplus{background:#D64937}.crunchify-googleplus:active,.crunchify-googleplus:hover{background:#b53525}.crunchify-buffer{background:#444}.crunchify-buffer:active,.crunchify-buffer:hover{background:#222}.crunchify-pinterest,.crunchify-pinterest:active,.crunchify-pinterest:hover{background:#bd081c}.crunchify-email,.crunchify-email:active,.crunchify-email:hover{background:#8C8C8C}.crunchify-social{margin:20px 0 25px;-webkit-font-smoothing:antialiased;font-size:12px}.share-list{font-size:14px;line-height:1em;letter-spacing:.25px;color:#fff}.entry-share .share-list{display:flex;align-items:center}.share-list .share{border-radius:15px;margin:5px 0 0}.share-list .share:first-child{margin-top:0}.entry-share .share-list .share{margin:0 0 0 5px}.rtl .entry-share .share-list .share{margin:0 5px 0 0}.entry-share .share-list .share:first-child{margin-left:35px}.rtl .entry-share .share-list .share:first-child{margin-left:0;margin-right:35px}.share-list .url{display:flex;align-items:center;padding:8px 18px;color:inherit!important;text-decoration:none!important;-webkit-box-shadow:none!important;box-shadow:none!important}.share-list a:hover{-webkit-box-shadow:none!important;box-shadow:none!important;color:#fff!important}.share-list .genericon{font-size:21px;line-height:1em;margin:0 10px 0 0}.rtl .share-list .genericon{margin:0 0 0 10px}.share-list .facebook{background:#6788ce}.share-list .twitter{background:#29c5f6}.share-list .linkedin{background:#3a9bdc}.share-list .googleplus{background:#e75c3c}.share-list .pinterest{background:#bd081c}#shares{position:fixed;opacity:0}.rtl #shares{left:initial;right:50%}.shares-left ul>li{list-style-type:none;margin:1px!important}#shares,.shares-left{transition:opacity .5s ease-in-out}</style>';
}
add_action( 'wp_head', 'crunchify_cos_header', 100 );

function crunchify_cos_menu() {
	add_submenu_page( 'options-general.php', 'Optimized Sharing', 'Optimized Sharing', 'manage_options', CRUNCHIFY_COS_PAGE, 'CRUNCHIFY_COS_PAGE' );
}
add_action('admin_menu', 'crunchify_cos_menu');

add_action( 'crunchify_cos_settings_tab', 'crunchify_cos_welcome_tab', 1 );
function crunchify_cos_welcome_tab(){
	global $crunchify_active_tab; ?>
	<a class="nav-tab <?php echo $crunchify_active_tab == 'postoption' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=crunchify-cos&tab=postoption' ); ?>"><?php _e( 'Sharing Options', 'crunchify' ); ?> </a>
	<?php
}

add_action( 'crunchify_settings_content', 'crunchify_cos_welcome_options_page' );

function crunchify_cos_welcome_options_page() {

	global $crunchify_active_tab;
	if ( '' || 'postoption' != $crunchify_active_tab )
		return;
	?>

	<!-- Put your content here -->
	<div class="wrap">
		 <form method="post" action="options.php">
				<?php
					 settings_fields("crunchify_social_sharing_config_section");
					 do_settings_sections("crunchify-social-sharing");
					 submit_button();
				?>
		 </form>
	</div>
	<?php
}

add_action( 'crunchify_cos_settings_tab', 'crunchify_cos_tab2' );
function crunchify_cos_tab2(){
	global $crunchify_active_tab; ?>
	<a class="nav-tab <?php echo $crunchify_active_tab == 'somemore' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=crunchify-cos&tab=somemore' ); ?>"><?php _e( 'More Options', 'crunchify' ); ?> </a>
	<?php
}

add_action( 'crunchify_settings_content', 'crunchify_cos_another_options_page' );

function crunchify_cos_another_options_page() {
	global $crunchify_active_tab;
	if ( 'somemore' != $crunchify_active_tab )
		return;
	?>
	<!-- Put your content here -->
		<div class="wrap">
		<br><p></p><h3><?php _e('Coming soon...', 'crunchify'); ?></h3>
		</div>

	<?php
}

function CRUNCHIFY_COS_PAGE() {

	global $crunchify_active_tab;
		$crunchify_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'postoption'; ?>
		<h1 style="padding: 20px 0px 5px; font-weight: 400;">Optimized Sharing Options</h1>
		<h2 class="nav-tab-wrapper">
		<?php
			do_action( 'crunchify_cos_settings_tab' );
		?>
		</h2>

		<?php
			do_action( 'crunchify_settings_content' );
}


function crunchify_cos_sharing_buttons_settings(){
    add_settings_section("crunchify_social_sharing_config_section", "", null, "crunchify-social-sharing");

    add_settings_field("crunchify-social-sharing-facebook", "Post / Page Sharing Options", "crunchify_cos_sharing_post_page_options", "crunchify-social-sharing", "crunchify_social_sharing_config_section");

		add_settings_field("crunchify-social-sharing-global", "Global Options", "crunchify_cos_sharing_global", "crunchify-social-sharing", "crunchify_social_sharing_config_section");

    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-facebook");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-twitter");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-twitter-name");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-googleplus");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-buffer");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-pinterest");

    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-crunchify-rel-nofollow");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-crunchify-custom-label");
    register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-email");

		register_setting("crunchify_social_sharing_config_section", "crunchify-social-sharing-post-page-global");
}

	function crunchify_cos_sharing_global(){
		?>
		<div class="postbox" style="width: 65%; padding: 30px;">
			 	<input type="checkbox" name="crunchify-social-sharing-crunchify-rel-nofollow" value="1" <?php checked(1, get_option('crunchify-social-sharing-crunchify-rel-nofollow'), true); ?> /> add rel="nofollow" to all links
			 	<br><br><input type="text" name="crunchify-social-sharing-twitter-name" value="<?php echo esc_attr(get_option('crunchify-social-sharing-twitter-name')); ?>" /> Twitter Username (without @)
			</div>
			<div>Checkout <a href="https://crunchify.com" target="_blank">Home Page</a> for more details.</div>
			<?php
		}

	function crunchify_cos_sharing_post_page_options(){
   ?>
    <div class="postbox" style="width: 65%; padding: 30px;">
				<input type="checkbox" name="crunchify-social-sharing-post-page-global" value="1" <?php checked(1, get_option('crunchify-social-sharing-post-page-global'), true); ?> /> Gloabl Flag (Check to enable Post/Page Options)
        <br><br><br><br><input type="checkbox" name="crunchify-social-sharing-facebook" value="1" <?php checked(1, get_option('crunchify-social-sharing-facebook'), true); ?> /> Facebook
        <br><br><input type="checkbox" name="crunchify-social-sharing-twitter" value="1" <?php checked(1, get_option('crunchify-social-sharing-twitter'), true); ?> /> Twitter
        <br><br><input type="checkbox" name="crunchify-social-sharing-googleplus" value="1" <?php checked(1, get_option('crunchify-social-sharing-googleplus'), true); ?> /> Google+
        <br><br><input type="checkbox" name="crunchify-social-sharing-buffer" value="1" <?php checked(1, get_option('crunchify-social-sharing-buffer'), true); ?> /> Buffer
        <br><br><input type="checkbox" name="crunchify-social-sharing-pinterest" value="1" <?php checked(1, get_option('crunchify-social-sharing-pinterest'), true); ?> /> Pinterest
        <br><br><input type="checkbox" name="crunchify-social-sharing-email" value="1" <?php checked(1, get_option('crunchify-social-sharing-email'), true); ?> /> Email
				<br><br><br><br><input type="text" name="crunchify-social-sharing-crunchify-custom-label" value="<?php echo esc_attr(get_option('crunchify-social-sharing-crunchify-custom-label')); ?>" /> Custom Header

    </div>
   <?php
}

add_action("admin_init", "crunchify_cos_sharing_buttons_settings");

function crunchify_cos_add_crunchify_social_sharing_buttons($content) {

		// Get current page URL
		$crunchifyURL = get_permalink();

		// Get current page title
		$crunchifyTitle = str_replace( ' ', '%20', get_the_title());

		// Get Post Thumbnail for pinterest
		$crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		// Construct sharing URL without using any script
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL;

		$twitterUserName = get_option("crunchify-social-sharing-twitter-name");
		if(!empty($twitterUserName)){
			$twitterURL .= '&amp;via='.$twitterUserName;
		}

		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
		$googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
		$bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle;

		// Based on popular demand added Pinterest too
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
 		$emailURL = 'mailto:?subject=' . $crunchifyTitle . '&amp;body=Check out this site: '. $crunchifyURL .'" title="Share by Email';

 		if(get_option("crunchify-social-sharing-crunchify-rel-nofollow") == 1){
 			$rel_nofollow = 'rel="nofollow"';
 		}else{
 			$rel_nofollow = '';
 		}

		if(!is_singular()){
			return;
		}
		if(get_option("crunchify-social-sharing-post-page-global") == 1){
		// Add sharing button at the end of page/page content
			$content .= '<div class="crunchify-social">';
			$content .= '<!-- Social Sharing Buttons Plugin without any Java Script Loading by Crunchify.com - START-->';
			$content .= '<h5>'.get_option("crunchify-social-sharing-crunchify-custom-label").'</h5>';

      	if(get_option("crunchify-social-sharing-facebook") == 1){
			$content .= '<a class="crunchify-link crunchify-facebook" href="'.$facebookURL.'" target="_blank" '. $rel_nofollow .'><i class="fa fa-facebook"></i></a>';
        }
        if(get_option("crunchify-social-sharing-twitter") == 1){
			$content .= '<a class="crunchify-link crunchify-twitter" href="'. $twitterURL .'" target="_blank" '. $rel_nofollow .'><i class="fa fa-twitter"></i></a>';
        }
        if(get_option("crunchify-social-sharing-googleplus") == 1){
			$content .= '<a class="crunchify-link crunchify-googleplus" href="'.$googleURL.'" target="_blank" '. $rel_nofollow .'><i class="fa fa-google-plus"></i></a>';
        }
        if(get_option("crunchify-social-sharing-pinterest") == 1){
			$content .= '<a class="crunchify-link crunchify-pinterest" href="'.$pinterestURL.'" target="_blank" '. $rel_nofollow .'><i class="fa fa-pinterest-p"></i></a>';
        }
        if(get_option("crunchify-social-sharing-email") == 1){
			$content .= '<a class="crunchify-link crunchify-email" href="'.$emailURL.'" target="_blank" '. $rel_nofollow .'><i class="fa fa-envelope"></i></a>';
        }
				if(get_option("crunchify-social-sharing-buffer") == 1){
			$content .= '<a class="crunchify-link crunchify-buffer" href="'.$bufferURL.'" target="_blank" '. $rel_nofollow .'>Buffer</a>';
        }
        $content .= '<!-- Social Sharing Buttons Plugin - END-->';
				$content .= '</div>';
			}

			if(get_option("crunchify-social-sharing-float-global") == 1){

				$top_padding = get_option("crunchify-social-sharing-top-padding");
				$left_padding = get_option("crunchify-social-sharing-left-padding");

				$content .='<div id="shares" class="shares-left" style="top: '.$top_padding .'px; margin-left: -'.$left_padding .'px; position: fixed; opacity: 0;">';

				$content .='<ul class="share-list">';

				if(get_option("crunchify-social-sharing-float-facebook") == 1){
					$content .= '<li class="share facebook"><a '. $rel_nofollow .' class="url" target="_blank" href="'.$facebookURL.'"><i class="fa fa-facebook"></i></a></li>';
				}
				if(get_option("crunchify-social-sharing-float-twitter") == 1){
					$content .= '<li class="share twitter"><a '. $rel_nofollow .' class="url" target="_blank" href="'.$twitterURL.'"><i class="fa fa-twitter"></i></a></li>';
				}
				if(get_option("crunchify-social-sharing-float-googleplus") == 1){
					$content .= '<li class="share googleplus"><a '. $rel_nofollow .' class="url" target="_blank" href="'.$googleURL.'"><i class="fa fa-google-plus"></i></a></li>';
				}
				if(get_option("crunchify-social-sharing-float-pinterest") == 1){
					$content .= '<li class="share pinterest"><a '. $rel_nofollow .' class="url" target="_blank" href="'.$pinterestURL.'"><i class="fa fa-pinterest-p"></i></a></li>';
				}
					$content .='</ul></div>';
			}
		return $content;
};

add_filter( 'the_content', 'crunchify_cos_add_crunchify_social_sharing_buttons');
