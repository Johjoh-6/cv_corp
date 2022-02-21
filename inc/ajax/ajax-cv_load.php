<?php
add_action('wp_ajax_ajax_cv_load', 'loadTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv_load', 'loadTheCvWithAjax');

function loadTheCvWithAjax() {
    global $wpdb;

}