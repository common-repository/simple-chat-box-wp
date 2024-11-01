<?php

// Settings menu creation
function scbw_admin_menu() {
    add_menu_page( 'WhatsApp Chat', 'WhatsApp Chat','manage_options', SCBW_ROUTE . '/admin/config.php', '', 'dashicons-admin-comments');
}
add_action( 'admin_menu', 'scbw_admin_menu' );


// Custom admin styles registration
function scbw_load_custom_wp_admin_style() {
    wp_register_style( 'scbw_custom_wp_admin_css', plugins_url( 'simple-chat-box-wp/assets/styles/admin.css' ) );
    wp_enqueue_style( 'scbw_custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'scbw_load_custom_wp_admin_style' );

// Custom chat styles registration
function scbw_load_custom_style() {
    wp_register_style( 'scbw_custom_chat_css', plugins_url( 'simple-chat-box-wp/assets/styles/scbw.css' ) );
    wp_enqueue_style( 'scbw_custom_chat_css' );
}
add_action( 'wp_enqueue_scripts', 'scbw_load_custom_style' );

// Enable default Jquery
function scbw_add_jquery() {
    wp_enqueue_script( 'jquery' );
}    
add_action('init', 'scbw_add_jquery');


function scbw_load_admin_scripts() {
    wp_enqueue_script( 'scbw_custom_admin_script', plugins_url( 'simple-chat-box-wp/assets/js/admin.js' ));
}
add_action( 'admin_enqueue_scripts', 'scbw_load_admin_scripts' );

// Iniciamos carga de script que habilita el chat
if (get_option('scbw_mobile_number') && strlen(get_option('scbw_mobile_number')) > 0 ) {
    function scbw_hook_add_widget() {
        wp_enqueue_script( 'scbw_custom_script', plugins_url( 'simple-chat-box-wp/assets/js/whatsappChat.js'));
        
        $dataToBePassed = array(
            'number'           => get_option('scbw_mobile_number'),
            'auto_open'        => get_option('scbw_opening'),
            'delay'            => get_option('scbw_delay'),
            'text1'            => get_option('scbw_text1'),
            'text2'            => get_option('scbw_text2'),
            'text3'            => get_option('scbw_text3'),
            'baseUrl'          => get_bloginfo("url"),
        );
        wp_localize_script( 'scbw_custom_script', 'php_vars', $dataToBePassed );
    }
    add_action( 'wp_enqueue_scripts', 'scbw_hook_add_widget' );
}
