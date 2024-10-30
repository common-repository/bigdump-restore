<?php
/*
Plugin Name: bigdump-restore
Description: Restore very large Bigdump Restores safetly and friendly.
Version: 1.24
Text Domain: bigdump-restore
Author: Bill Minozzi
Author URI: http://billminozzi.com
Domain Path: /language
License:     GPL2
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Make sure the file is not directly accessible.
if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}
$bigdump_plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$bigdump_plugin_version = $bigdump_plugin_data['Version'];
define('BIGDUMP_RESTORE_VERSION', $bigdump_plugin_version);
define('BIGDUMP_RESTORE', plugin_dir_url(__file__));
define('BIGDUMP_RESTORE_PATH', plugin_dir_path(__file__));
define('BIGDUMP_RESTORE_IMAGES', plugin_dir_url(__file__) . 'assets/images');
define('BIGDUMP_RESTORE_URL', plugin_dir_url(__file__));

$bigdump_restore_status = trim(sanitize_text_field(get_option('bigdump_restore_status', 'off')));
$bigdump_auto_update = trim(sanitize_text_field(get_option('bigdump_auto_update', 'yes')));

add_action('plugins_loaded', 'bigdump_restore_localization_init');
function bigdump_restore_localization_init()
{
    $loaded = load_plugin_textdomain( 'bigdump-restore', false, dirname( plugin_basename( __FILE__ ) ) . '/language' );
    if (!$loaded) {
        // error_log('Fail to load language File');
    }
}

// function exist...
// add_action('init', "bigdump_init", 1000);
add_action('admin_menu', 'bigdump_init');
function bigdump_init()
{
    if (is_admin())   
        add_management_page(
            'Bigdump Restore',
            'Bigdump Restore',
            'manage_options',
            'bigdump_restore_admin_page', // slug
            'bigdump_restore_admin_page'
        );
}

add_action('admin_enqueue_scripts', 'bigdump_enqueue', 1000);
function bigdump_enqueue()
{
    wp_enqueue_script('jquery');
    wp_register_style('bigdump-restore ', BIGDUMP_RESTORE_URL . 'assets/css/bigdump.css');
    wp_enqueue_style('bigdump-restore ');
    wp_enqueue_style('bigdump-restore-pointer', BIGDUMP_RESTORE_URL . 'assets/css/bill-wp-pointer.css');
    wp_register_script('bigdump-restore-js', BIGDUMP_RESTORE_URL . 'assets/js/bigdump_restore.js', false);
    wp_enqueue_script('bigdump-restore-js');
}

function bigdump_restore_admin_page()
{
    require_once BIGDUMP_RESTORE_PATH . "/dashboard/dashboard_container.php";
}
function bigdump_settings_link($links)
{
  $settings_link = '<a href="admin.php?page=bigdump_restore_admin_page">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}
$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'bigdump_settings_link');
/**
 * Activate the plugin.
 */
function bigdump_bigdump_activate() { 
    $dir = ABSPATH .'/bigdump-restore/';
    try{
        if(!is_dir($dir))
           mkdir($dir);
     }
     catch(Exception $e) {
         error_log($e->getMessage());
         // wp_die($e->getMessage());
     }
    if(!is_dir($dir)){
        add_action( 'admin_notices', 'bigdump_admin_error' );
    }
    try{
        fopen($dir.'index.php', 'w');
    }
     catch(Exception $e) {
         error_log($e->getMessage());
         // wp_die($e->getMessage());
    }
    $source = BIGDUMP_RESTORE_PATH .'tools/tools.txt';


    // The file does not exist: /home/bigdumpr/public_html/wp-content/plugins/bigdump-restore/tools/tools.txt
    
    try {
        // Check if the file exists
        if (file_exists($source)) {
            // File exists
            //echo "The file exists: $target";
        } else {
            // File does not exist
            echo "The file does not exist: ".esc_attr($source);
            error_log("The file does not exist: esc_attr($source)");
        }
    } catch (Exception $e) {
        // Exception occurred
        echo 'Error: ' . esc_attr($e->getMessage());
        error_log('Error: ' . $e->getMessage());
    }



    $target = ABSPATH .'/bigdump-restore/bigdump-restore.php';
    try{
        copy($source,$target);
     }
     catch(Exception $e) {
         error_log($e->getMessage());
         // wp_die($e->getMessage());
     }
    


     
     // Define the path to the file
     // $target = ABSPATH . '/bigdump-restore/bigdump-restore.php';
     
     try {
         // Check if the file exists
         if (file_exists($target)) {
             // File exists
             //echo "The file exists: $target";
         } else {
             // File does not exist
             echo "The file does not exist: ".esc_attr($target);
             error_log("The file does not exist: $target");
         }
     } catch (Exception $e) {
         // Exception occurred
         echo 'Error: ' . esc_attr($e->getMessage());
         error_log('Error: ' . $e->getMessage());
     }
     
     






     $source = BIGDUMP_RESTORE_PATH .'tools/header.txt';
     $target = ABSPATH .'/bigdump-restore/header.inc';
     try{
         copy($source,$target);
      }
      catch(Exception $e) {
          error_log($e->getMessage());
          // wp_die($e->getMessage());
      }
    $filepath = BIGDUMP_RESTORE_PATH .'bkp/bigdump.inc';
    if(file_exists($filepath)){
        $filepath_target = ABSPATH .'/bigdump-restore/bigdump.php';
        try{
            copy($filepath,$filepath_target);
         }
         catch(Exception $e) {
             error_log($e->getMessage());
             // wp_die($e->getMessage());
         }
    }
    $filepath = BIGDUMP_RESTORE_PATH .'assets/images/logo.png';
    $filepath_target = ABSPATH .'/bigdump-restore/logo.png';
    try{
        copy($filepath,$filepath_target);
     }
     catch(Exception $e) {
         error_log($e->getMessage());
         // wp_die($e->getMessage());
     }
}
register_activation_hook( __FILE__, 'bigdump_bigdump_activate' );
//bigdump_bigdump_activate();
/**
 * Deactivation hook.
 */
function bigdump_bigdump_deactivate() {
    $filepath = ABSPATH .'/bigdump-restore/bigdump.php';
    if(file_exists($filepath)){
        $filepath_target = BIGDUMP_RESTORE_PATH .'bkp/bigdump.inc';
        try{
            copy($filepath,$filepath_target);
            unlink($filepath);
         }
         catch(Exception $e) {
             error_log($e->getMessage());
             // wp_die($e->getMessage());
         }
    }
    $filepath = ABSPATH .'/bigdump-restore/bigdump-restore.php';
    if(file_exists($filepath)){
        try{
            unlink($filepath);
         }
         catch(Exception $e) {
             error_log($e->getMessage());
             // wp_die($e->getMessage());
         }
    }
}



register_deactivation_hook( __FILE__, 'bigdump_bigdump_deactivate' );
function bigdump_admin_notice() {
    ?>
    <div class="notice notice-warning is-dismissible">
      <p>
      <?php echo esc_attr__("For security, within the BigDump Restore Dashboard plugin, you have the option to toggle this plugin on or off. After restoring the database, turn it off.","bigdump-restore");?>
    </div>
    <?php
}
if($bigdump_restore_status == 'on')
  add_action( 'admin_notices', 'bigdump_admin_notice' );


function bigdump_admin_error($txt) {
    ?>
    <div class="notice notice-warning is-dismissible">
      <p>Unable to Create Folder "bigdump-restore". Check for file permissions.</p>
    </div>
    <?php
}

/////////// Pointers ////////////////

register_activation_hook(__FILE__, 'bigdump_activated');
function bigdump_activated()
{
	$r = update_option('bigdump_was_activated', '1');
	if (!$r) {
		add_option('bigdump_was_activated', '1');
	}
	$pointers = get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true);
	$pointers = ''; // str_replace( 'plugins', '', $pointers );
	update_user_meta(get_current_user_id(), 'dismissed_wp_pointers', $pointers);
}
function bigdump_dismissible_notice()
{
	$r = update_option('bigdump_dismiss', false);
	if (!$r) {
		$r = add_option('bigdump_dismiss', false);
	}
	wp_die(ec_attr($r));
}
add_action('wp_ajax_bigdump_dismissible_notice', 'bigdump_dismissible_notice');

/*
if (get_option('bigdump_dismiss', true) and is_admin())
	add_action('admin_notices', 'bigdump_dismiss_admin_notice');

function bigdump_dismiss_admin_notice()
{
	//if(!bill_check_resources(false))
	//   return;
	?>
		<div id="bigdump_an1" class="notice-warning notice is-dismissible">
			<p>
			Please, look the Bigdump Restore plugin Dashboard &nbsp;
			<a class="button button-primary" href="admin.php?page=bigdump_admin_page">or click here</a>
		   </p>
		</div>
	<?php
}
*/

require_once ABSPATH . 'wp-includes/pluggable.php';
if (is_admin() or is_super_admin()   ) {
    if (get_option('bigdump_was_activated', '0') == '1') {
         add_action('admin_enqueue_scripts', 'bigdump_adm_enqueue_scripts2');
     }
 }

function bigdump_load_upsell()
{
	wp_enqueue_style('bigdump-restore2', BIGDUMP_RESTORE_URL . 'includes/more/more2.css');
	wp_register_script('bigdump-restore2-js', BIGDUMP_RESTORE_URL . 'includes/more/more2.js', array('jquery'));
	wp_enqueue_script('bigdump-restore2-js');
	wp_localize_script('bigdump-restore2-js', 'bigdump', array('url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'bigdump_load_upsell', 1000);

function bigdump_do_ajax() {
	if (!function_exists('wp_get_current_user')) {
		require_once(ABSPATH . "wp-includes/pluggable.php");
	}
	if (is_admin() or is_super_admin()) {
		// add_action('admin_enqueue_scripts', 'bigdump_classic_load_upsell');
		add_action('wp_ajax_bigdump_install_plugin2', 'bigdump_install_plugin2');
		add_action('wp_ajax_nopriv_bigdump_install_plugin2', 'bigdump_install_plugin2');
	}
}
add_action('init', "bigdump_do_ajax", 1000);


 function bigdump_adm_enqueue_scripts2()
 {
     global $bill_current_screen;
     // wp_enqueue_style( 'wp-pointer' );
     wp_enqueue_script('wp-pointer');
     require_once ABSPATH . 'wp-admin/includes/screen.php';
     $myscreen = get_current_screen();
     $bill_current_screen = $myscreen->id;
     $dismissed_string = get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true);
     if ( !empty($dismissed_string))  {
         $r = update_option('bigdump_was_activated', '0');
         if (!$r) {
             add_option('bigdump_was_activated', '0');
         }
         return;
     }
     add_action('admin_print_footer_scripts', 'bigdump_admin_print_footer_scripts');
 }
 function bigdump_admin_print_footer_scripts()
 {
     global $bill_current_screen;
     $pointer_content = esc_attr__("Open Bigdump Restore Plugin Here!", "bigdump-restore");
     $pointer_content2 = esc_attr__("Just Click Over Tools => Bigdump Restore.","bigdump-restore");
  ?>
         <script type="text/javascript">
         //<![CDATA[
             // setTimeout( function() { this_pointer.pointer( 'close' ); }, 400 );
             jQuery(document).ready( function($) {
            console.log('entrou');
                jQuery('.dashicons-admin-tools').pointer({
                 content: '<?php echo '<h3>'.esc_attr($pointer_content).'</h3>'. '<div id="bill-pointer-body">'.esc_attr($pointer_content2).'</div>';?>',
                 position: {
                         edge: 'left',
                         align: 'right'
                     },
                 close: function() {
                     // Once the close button is hit
                     jQuery.post( ajaxurl, {
                         pointer: '<?php echo esc_attr($bill_current_screen); ?>',                        action: 'dismiss-wp-pointer'
                         });
                 }
             }).pointer('open');
             jQuery('.wp-pointer').css("margin-left", "100px");
             jQuery('#wp-pointer-0').css("padding", "10px");
         });
         //]]>
         </script>
         <?php
 }
 //


 

