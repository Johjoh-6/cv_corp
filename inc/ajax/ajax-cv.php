<?php
add_action('wp_ajax_ajax_cv', 'getTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv', 'getTheCvWithAjax');

function getTheCvWithAjax() {
    $post = $_POST['data'];

//    showJson($post);
    global $wpdb;
    debug($post);
    foreach ($post['langues'] as $langue) {
        debug($langue);
        $wpdb->insert('cv_langues_pivot', array(
            'id_cv' => 6,
            'id_langue' => 4,
            'langue_level' => 3
        ),
            array(
                '%d',
                '%d',
                '%d',
            )
        );
    }
}