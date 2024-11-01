<?php 

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// eliminar opción previamente creada en DB
delete_option('scbw_mobile_number');
delete_option('scbw_opening');
delete_option('scbw_delay');
delete_option('scbw_text1');
delete_option('scbw_text2');
delete_option('scbw_text3');
