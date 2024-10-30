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



echo '<div class="wrap-bigdump-restore">' . "\n";
echo '<h2 class="title">'.esc_attr__("Dashboard", "bigdump-restore").'</h2>' . "\n";

echo '<div class="bugdump-restore-description">';
echo esc_attr__('This Plugin can help you to restore very large database backups, building a shell (wrapping) for the highly reputed free php script "bigdump".' , "bigdump-restore");
echo '<br>';
echo esc_attr__('Then, you can do the whole restore job in friendly GUI, without make php code changes or linux commands.', "bigdump-restore");
echo '<br>';

echo '<br><strong>';
echo esc_attr__("By security, after finishing the restore job, turn off this plugin (navigate to the Settings Tab) and delete the SQL files from the folder below.", "bigdump-restore");
echo '</strong><br>';
echo '<br>';

$bigdump_restore_status = trim(sanitize_text_field(get_option('bigdump_restore_status', 'off')));

if($bigdump_restore_status == 'off'){
    echo '<b>';
    echo esc_attr__("BigDump Restore is currently off. Navigate to the Settings tab and switch it on (to see the folder).", "bigdump-restore");
    echo '</b>';
}
else{

    echo esc_attr__("To Start to Restore Database job, go to this url:", "bugdump-restore");
    echo '<br>';
    echo '<br>';
    echo esc_url(get_site_url()).'/bigdump-restore/bigdump-restore.php';
    echo '<br>';
    echo '<a href="'.esc_url(get_site_url()).'/bigdump-restore/bigdump-restore.php" class="button button-primary">Go</a>';
    echo '<br>';
}


echo '<br> ';
echo '<br>';
echo '<br> ';
esc_attr_e('Visit the plugin site for more details and demo video.', 'bigdump-restore');
echo '<br>';
echo '<a href="https://bigdumprestore.com/" class="button button-primary">Plugin Site</a>';
echo '&nbsp;&nbsp;';
echo '</div>';
echo '</div>';
