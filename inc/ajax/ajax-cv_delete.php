<?php
add_action('wp_ajax_ajax_cv_delete', 'deleteTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv_delete', 'deleteTheCvWithAjax');

function deleteTheCvWithAjax() {
    global $wpdb;
    $idCheck = $wpdb->get_col('SELECT * FROM cv_cv WHERE id = '.$_POST['data'].' AND id_user = '.get_current_user_id());
//    $_POST['data']['mabite']= $idCheck;
    $loadedData = getCvById($_POST['data']);
//    var_dump($idCheck);
//    $loadedData::append($idCheck[0]);
    if ($idCheck[0] != 0) {
        showJson($loadedData);
    } else {
        echo 'ERREUR';
    }

}