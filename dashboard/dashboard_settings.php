<?php
/**
 * @ Author: Bill Minozzi
 * @ Copyright: 2022 www.BillMinozzi.com
 * Created: Feb 13 24
 * 
 */
if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}
if (isset($_GET['page']) && $_GET['page'] == 'bigdump_restore_admin_page') {
  
        $bigdump_restore_updated = false;


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bigdump_restore_admin_page_settings_nonce'])) {
            if (wp_verify_nonce($_POST['bigdump_restore_admin_page_settings_nonce'], 'bigdump_restore_admin_page_settings_nonce')) {
            } else {
                die('Nonce verification failed!');
            }
        }
    
        // Check if the toggle option is set
        if (isset($_POST['toggle'])) {
            $toggle = sanitize_text_field($_POST['toggle']);
            // Verify if the selected value is valid ('on' or 'off')
            if ($toggle === 'on' || $toggle === 'off') {
                // Update the option with the selected value
                update_option('bigdump_restore_status', $toggle);
                $bigdump_restore_updated = true;
            }
        }
    
        /*
        // Check if the auto-update option is set
        if (isset($_POST['auto-update'])) {
            $auto_update = sanitize_text_field($_POST['auto-update']);
            // Verify if the selected value is valid ('yes' or 'no')
            if ($auto_update === 'yes' || $auto_update === 'no') {
                // Update the option with the selected value
                update_option('bigdump_auto_update', $auto_update);
                $bigdump_restore_updated = true;
            }
        }
        */
    
        // If any option was updated, display the success message
        if ($bigdump_restore_updated) {
            bigdump_restore_updated_message();
        }
    }

$bigdump_restore_status = trim(sanitize_text_field(get_option('bigdump_restore_status', 'off')));
$bigdump_auto_update = trim(sanitize_text_field(get_option('bigdump_auto_update', 'off')));


echo '<div class="wrap-bigdump-restore">' . "\n";
echo '<h2 class="title">'.esc_attr__("Manage BigDump Restore Plugin", "bigdump-restore").'</h2>' . "\n";
echo '<p class="description">'.esc_attr__("Toggle this plugin on or off. Turn it on to restore your database. After finishing the restoration, for security, switch it off.", "bigdump-restore").'</p>';

echo '<form class="bigdump_restore-form" method="post" action="admin.php?page=bigdump_restore_admin_page&tab=settings&process=ok">';
echo '<input type="hidden" name="process" value="bigdump_restore_admin_page_settings" />';

// Display radio buttons based on current option in WordPress options
//echo '<input type="radio" id="on" name="toggle" value="on" ' . ($bigdump_restore_status === 'on' ? 'checked' : '') . '>';
echo '<input type="radio" id="on" name="toggle" value="on" ' . ($bigdump_restore_status === 'on' ? 'checked' : '') . '>';
echo '<label for="on">'.esc_attr__("On", "bigdump-restore").'</label><br>';

echo '<input type="radio" id="off" name="toggle" value="off" ' . ($bigdump_restore_status === 'off' ? 'checked' : '') . '>';
echo '<label for="off">'.esc_attr__("Off", "bigdump-restore").'</label><br>';

/*
// New radio buttons and labels for automatic update
echo '<p class="description">';
echo '<label for="auto-update">'.esc_attr__("Automatically update this plugin via WordPress when a new version is available?", "bigdump-restore").'</label><br>';
echo '</p>';
echo '<input type="radio" id="auto-update-yes" name="auto-update" value="yes" ' . ($bigdump_auto_update === 'yes' ? 'checked' : '') . '>';
echo '<label for="auto-update-yes">'.esc_attr__("Yes", "bigdump-restore").'</label><br>';

echo '<input type="radio" id="auto-update-no" name="auto-update" value="no" ' . ($bigdump_auto_update === 'no' ? 'checked' : '') . '>';
echo '<label for="auto-update-no">'.esc_attr__("No", "bigdump-restore").'</label><br>';
*/

// Add nonce field for security
wp_nonce_field('bigdump_restore_admin_page_settings_nonce', 'bigdump_restore_admin_page_settings_nonce');
echo '<br>';
// Submit button
echo '<input class="bigdump_restore-submit button-primary" type="submit" value="'.esc_attr__("Update", "bigdump-restore").'" />';
echo '</form>';

echo '</div>';

function bigdump_restore_updated_message() {

    $bigdump_restore_status = trim(sanitize_text_field(get_option('bigdump_restore_status', 'off')));


    if($bigdump_restore_status == 'off'){
       // die(var_export($bigdump_restore_status));
       bigdump_bigdump_deactivate();
    }
    else {
       bigdump_bigdump_activate();
    }
     

    echo '<br />';
    echo '<div class="notice notice-success is-dismissible">';
    echo '<br /><b>';
    esc_attr_e('Settings Updated!', 'bigdump-restore');
    echo '<br /><br /></div>';
}
?>