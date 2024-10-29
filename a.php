<?php
/**
 * @author karim salim
 * @copyright 2011
 */
    global $jal_db_version;
    $jal_db_version = "1.0";
function jal_install() 
{
   global $wpdb;
   global $jal_db_version;
    $table_name = $wpdb->prefix . "tc_courses";
    $table_name2 = $wpdb->prefix . "tc_users";
    $table_name3 = $wpdb->prefix . "tc_category";
    $table_name4 = $wpdb->prefix . "tc_type";
    $table_name5 = $wpdb->prefix . "tc_contact";
   
   $sql =   "CREATE TABLE " . $table_name . " (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_status` enum('pending','active','deactive','archive') NOT NULL DEFAULT 'active',
  `course_time` varchar(20) NOT NULL DEFAULT '00:00 - 00:00',
  `course_date` date NOT NULL DEFAULT '0000-00-00',
  `last_enrollment_date` date NOT NULL DEFAULT '0000-00-00',
  `date_time` datetime NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_decscription` longtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `course_duration` varchar(20) NOT NULL,
  `course_country` varchar(250) NOT NULL,
  `course_zip` varchar(100) NOT NULL,
  `course_city` varchar(255) NOT NULL,
  `course_address` text NOT NULL,
  `course_requirements` longtext NOT NULL,
  `payment_info` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `other_content` longtext NOT NULL,
  `upload` varchar(255) NOT NULL,
  `total_enrollments` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);";


   $sql2 =   "CREATE TABLE " . $table_name2 . " (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `addition_enroll` bigint(20) NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL,
  `comments` text NOT NULL,
  `status` enum('active','deactive','waiting') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ;";

   $sql3 =   "CREATE TABLE " . $table_name3 . " (
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `category_name` VARCHAR( 255 ) NOT NULL ,
    `status` ENUM(  'active',  'deactive' ) NOT NULL DEFAULT 'active' ,
    PRIMARY KEY (  `id` )
    ) ;";
    
    
    $sql4 =   "CREATE TABLE " . $table_name4 . " (
    `id` BIGINT NOT NULL AUTO_INCREMENT ,
    `type_name` VARCHAR( 255 ) NOT NULL ,
    `status` ENUM(  'active',  'deactive' ) NOT NULL DEFAULT 'active' ,
    PRIMARY KEY (  `id` )
    ) ;";
    
    $sql5 =   "CREATE TABLE " . $table_name5 . " (
      `id` bigint(20) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `phone` varchar(20) NOT NULL,
      `date_time` datetime NOT NULL,
      `comments` text NOT NULL,
      PRIMARY KEY (`id`)
    ) ;";
    
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
   dbDelta($sql2);
   dbDelta($sql3);
   dbDelta($sql4);
   dbDelta($sql5);
   
   add_option("jal_db_version", $jal_db_version);
}
  function myplugin_update_db_check() {
    global $jal_db_version;
    if (get_site_option('jal_db_version') != $jal_db_version) {
        jal_install();
    }
}
function Unsetjal_install () {

			  delete_option("dot_pages_enable");
			  delete_option("dot_pages_slug");
			  delete_option("dot_pages_mode");
}
?>