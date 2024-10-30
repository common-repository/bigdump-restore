<?php
/**
 * @author William Sergio Minossi
 * @copyright 2024
 */
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

//grep -r "add_option(" . > work.txt
//grep -r "update_option(" . > work1.txt

$bigdump_option_name[] = 'bigdump_restore_status';
$bigdump_option_name[] = 'bigdump_auto_update';

$wnum = count($bigdump_option_name);
for ($i = 0; $i < $wnum; $i++)
{
  delete_option( $bigdump_option_name[$i] );
  // For site options in Multisite
  delete_site_option( $bigdump_option_name[$i] );    
}
?>