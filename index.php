<?php
/*
Plugin Name: Simple Social
Plugin URI: http://bcooling.com.au
Description: Simple plugin by Ben Cooling to add facebook like and pinterest pin it buttons using shortcodes: [pinit] [fblike]
Version: 0.1
Author: Ben Cooling
Author URI: http://bcooling.com.au
License: Copyright Ben Cooling
*/

/**
 * 
 * Bootstrap file for simple_social
 * 
 */

// Plugin Constants
define('SIMPLESOCIAL_PREFIX', 'sso_');
define('SIMPLESOCIAL_FILE', __FILE__);
define('SIMPLESOCIAL_DIR_PATH', plugin_dir_path(__FILE__));

// Required files
require_once( SIMPLESOCIAL_DIR_PATH . '/buttons/Button.php' );
require_once( SIMPLESOCIAL_DIR_PATH . '/buttons/Fblike.php' );
require_once( SIMPLESOCIAL_DIR_PATH . '/buttons/Fbfollow.php' );
require_once( SIMPLESOCIAL_DIR_PATH . '/buttons/Pinit.php' );

// Determine context for plugin
if ( is_admin() ) {
  if ( defined('DOING_AJAX') && DOING_AJAX ){
    $file = 'Ajax';
  }
  else {
    $file = 'Admin';
  }
}
else {
  $file = 'Public';
}

function uniqueInstantiation($file){
  $className = SIMPLESOCIAL_PREFIX . $file;
  if (! class_exists($className) ){
    require( SIMPLESOCIAL_DIR_PATH . $file . '.php');
    return new $className;
  }
}

if ( !function_exists('has_shortcode') ) {
  function has_shortcode($shortcode = '') {
    global $post;
    $found = false;
    if (!$shortcode) return $found;
    if ( stripos( $post->post_content, '[' . $shortcode ) !== false ) $found = true;
    return $found;
  }
}

// Instantiate required plugin controller and generic class
$specific = uniqueInstantiation($file);
$generic = uniqueInstantiation('General');