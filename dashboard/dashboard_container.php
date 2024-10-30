<?php
/**
 * @ Author: Bill Minozzi
 * @ Copyright: 2022 www.BillMinozzi.com
 * Created: 2023 - Jan 16 23
 * 
 */
if (!defined('ABSPATH')) {
  die('We\'re sorry, but you can not directly access this file.');
}
?>
<div id="database-backup-logo">
  <img src="<?php echo esc_attr(BIGDUMP_RESTORE_IMAGES); ?>/logo.png" width="250">
</div>

<?php


 /*
  if (isset($_GET['tab'])) {
    $nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'database_backup_action')) {
      echo '<div class="error"><p>Invalid Nonce!</p></div>';
      die();
    }
    $active_tab = sanitize_text_field($_GET['tab']);
  }
  else
    $active_tab = 'dashboard';
    */

  $nonce = isset($_GET['nonce']) ? sanitize_text_field($_GET['nonce']) : '';
  if (!isset($_GET['process']) AND isset($_GET['tab']) AND !wp_verify_nonce($nonce, 'bigdump_restore_action')) {
      echo '<div class="error"><p>Invalid Nonce!!</p></div>';
      die();
    }
  else {
     if (isset($_GET['tab']))
        $active_tab = sanitize_text_field($_GET['tab']);
     else
        $active_tab = 'dashboard';

  }
    
  
  $nonce = wp_create_nonce('bigdump_restore_action');





?>

<h2 class="nav-tab-wrapper">
  <a href="tools.php?page=bigdump_restore_admin_page&tab=dashboard&nonce=<?php echo esc_attr($nonce); ?>"class="nav-tab">Dashboard</a>
  <a href="tools.php?page=bigdump_restore_admin_page&tab=settings&nonce=<?php echo esc_attr($nonce); ?>" class="nav-tab">Settings</a>
  <!-- <a href="tools.php?page=bigdump_restore_admin_page&tab=dashboard_more" class="nav-tab">Database Backup</a> -->
</h2>

<?php
  if($active_tab == 'dashboard_more'){
    // require_once(esc_attr(BIGDUMP_RESTORE_PATH) . 'dashboard/dashboard_more.php');
  }
  elseif($active_tab == 'settings')
     require_once(esc_attr(BIGDUMP_RESTORE_PATH) . 'dashboard/dashboard_settings.php');
  else
     require_once(esc_attr(BIGDUMP_RESTORE_PATH) . 'dashboard/dashboard.php');
