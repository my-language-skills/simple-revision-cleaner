<?php

/*
Plugin Name: Simple Revision Cleaner
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: The plugin aim is to provide possibility for automatic deletion of old revisions on WordPress site or multisite.
Version: 0.1
Author: Daniil Zhitnitskii (My Language Skills)
Author URI: http://URI_Of_The_Plugin_Author
License: GPL 3.0
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * Main function that takes care of flushing database from old revisions
 *
 * @since 0.1
 * @author Daniil Zhitnitskii @danzhik
 */
function flush_revisions (){
	global $wpdb;
	$limit = 1000;

	$time_format = get_option( 'time_format' );
	$date_format = get_option( 'date_format' );

	//getting option responsible for time limit of deletion
	$timeLimit = get_option('fr_time_limit');
	//if not defined time limit for deleting, skip
	if (isset($timeLimit)) {
		$start = time();
		// We keep only 1 week worth of post revisions.
		$revision_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE (post_type = 'revision') AND post_date_gmt < DATE_SUB(NOW(), INTERVAL '.$timeLimit.' DAY) LIMIT %d", $limit ) );
		foreach ( $revision_ids as $revision_id ) {
			wp_delete_post_revision( $revision_id );
		}
		if (!empty($revision_ids)) {
			echo '<script type="text/javascript">alert("' . esc_html( date( $time_format . ' ' . $date_format ) ) . ': ' . count( $revision_ids ) . ' revisions deleted. Took ' . esc_html( time() - $start ) . 's.");</script>';
		}
	}

}


/**
 * Function to create settings section on General Settings page
 *
 * @since 0.1
 * @author Daniil Zhitnitskii @danzhik
 */
function sett_section(){

	//adding section to main options page
	add_settings_section('fr_settings', 'Revisions Flush', '', 'general');

	//registering setting for interval value
	register_setting('general', 'fr_time_limit');

	//callback function for setting field
	$create_field = function () {
		$disabled = get_blog_option(1,'fr_freeze_limit') ? 'readonly' : '';
		$value = get_option('fr_time_limit');
		$html = '<input type="number" id="fr_time_limit" name="fr_time_limit" '.$disabled.' value="'.$value.'">';
		$html .= '<p><i>Interval in days since today to store revisions. ';
		$html .= $disabled == 'readonly' ? 'Set by network administrator. In order to change value, please, contact him.</i></p>' : '</i></p>';
		echo $html;
	};
	add_settings_field('fr_time_limit', 'Time interval', $create_field, 'general', 'fr_settings');
}

/**
 * Function for displaying content of network settings page
 *
 * @since 0.1
 * @author Daniil Zhitnitskii
 */
function render_net_set(){
	?>
	<div class="wrap">
		<form method="POST" action="edit.php?action=update_network_options_flush">
			<?php
			settings_fields('fr_net_settings');
			do_settings_sections('fr_net_settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Function to create network settings page for plugin
 *
 * @since 0.1
 * @author Daniil Zhitnitskii @danzhik
 */
function net_sett_section(){

	add_submenu_page('settings.php', 'Flushing Revisions', 'Flush Revisions', 'manage_network_options', 'fr_net_settings' ,'render_net_set');

	//adding section to main options page
	add_settings_section('fr_net_settings', 'Revisions Flush', '', 'fr_net_settings');

	//registering setting for freezing value over all sites in multisite
	register_setting('fr_net_settings', 'fr_freeze_limit');
	//registering setting for interval value
	register_setting('fr_net_settings', 'fr_net_time_limit');

	//callback function for setting field
	$create_field = function () {
		$value = get_option('fr_net_time_limit');
		$html = '<input type="number" id="fr_net_time_limit" required name="fr_net_time_limit" value="'.$value.'">';
		$html .= '<p><i>Interval in days since today to store revisions.</i></p>';
		echo $html;
	};

	//callback function for freezing setting field
	$create_freeze_field = function () {
		$checked = get_option('fr_freeze_limit') ? 'checked' : '';
		$html = '<input type="checkbox" id="fr_freeze_limit" name="fr_freeze_limit" '.$checked.' value="1">';
		$html .= '<p><i>If selected, the interval value over all sites will be equal to one above.</i></p>';
		echo $html;
	};

	add_settings_field('fr_net_time_limit', 'Time interval', $create_field, 'fr_net_settings', 'fr_net_settings');
	add_settings_field('fr_freeze_limit', 'Set for all sites', $create_freeze_field, 'fr_net_settings', 'fr_net_settings');
}

/**
 * Function responsible for option overwriting over all sites
 */
function update_flush_options (){

	global $wpdb;

	check_admin_referer('fr_net_settings-options');

	//Grabbing all the site IDs
	$siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

	//Going through the sites
	foreach ($siteids as $site_id) {

		//Switching site
		switch_to_blog($site_id);
		if ($site_id == 1){
			update_option( 'fr_net_time_limit', $_POST['fr_net_time_limit'] );
			update_option('fr_freeze_limit', $_POST['fr_freeze_limit']);
			continue;
		}
		if (isset($_POST['fr_freeze_limit'])) {
			update_option( 'fr_time_limit', $_POST['fr_net_time_limit'] );
			flush_revisions();
		}
	}

	// At the end we redirect back to our options page.
	wp_redirect(add_query_arg(array('page' => 'fr_net_settings',
	                                'updated' => 'true'), network_admin_url('settings.php')));

	exit;
}

/**
 * Function called during activation process
 *
 * @since 0.1
 * @author Daniil Zhitnitskii @danzhik
 */
function activator() {

	global $wpdb;

	//Grabbing all the site IDs
	$siteids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

	//Going through the sites
	foreach ( $siteids as $site_id ) {
		switch_to_blog($site_id);
		if ($site_id == 1){
			update_option( 'fr_net_time_limit', '180' );
			continue;
		}
		update_option( 'fr_time_limit', '180' );
	}
}

//executing flush on admin area visiting
add_action('admin_init', 'flush_revisions');
//adding settings section on main settings page
add_action('admin_menu', 'sett_section');
//activation process
register_activation_hook(__FILE__, 'activator');

//add network page if is multisite installation and handle option updates
if (is_multisite()){
	add_action('network_admin_menu', 'net_sett_section');
	add_action('network_admin_edit_update_network_options_flush', 'update_flush_options');
}