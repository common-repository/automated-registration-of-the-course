<?php
/*
Plugin Name: Courses
Plugin URI:
Description: This Plugin Automated online registration of the course enrollments.
Author: K$M
Version: 1.0
Author URI:
*/
/**
 * @author karim
 * @copyright 2011
 */
///////////////////////////////////////////////////////////////////////////////
session_start();
//remove_filter('content_save_pre', 'wp_filter_post_kses');
include 'functions.php';
$course = new contact_course(); 
//CREATE NEW TABLE FOR COURCES 
include_once'a.php';
register_activation_hook(__FILE__,'jal_install');
register_activation_hook(__FILE__,'jal_install_data');
//register_deactivation_hook( __FILE__, array('Unsetjal_install') );
//register_uninstall_hook(__FILE__, 'uninstall_jal');
//register_deactivation_hook( __FILE__, array($this, "UnsetSettings") );
add_action('plugins_loaded', 'myplugin_update_db_check');
///////////////////////////////////////////////////////////////////////////////
//CREATE NEW SETTING TAB FOR COURCES
include_once'b.php';
add_action('admin_menu', 'courses_create_menu');

///////////////////////////////////////////////////////////////////////////////

//CREATE NEW WIDGETS TAB FOR COURCES
//include_once'c.php';
//add_action("plugins_loaded", "courses_init");
///////////////////////////////////////////////////////////////////////////////
include 'codes.php';
?>