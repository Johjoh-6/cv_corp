<?php
add_action('wp_ajax_ajax_cv_delete', 'deleteTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv_delete', 'deleteTheCvWithAjax');

function deleteTheCvWithAjax() {
    global $wpdb;
    $id = $_POST['id'];

    $wpdb->delete('cv_experience',array(
        'id_cv'=> $id
    ));

    $wpdb->delete('cv_hobbie_pivot',array(
        'id_cv'=>$id
    ));

    $wpdb->delete('cv_langues_pivot',array(
        'id_cv'=>$id
    ));

    $wpdb->delete('cv_skill_pivot',array(
        'id_cv'=>$id
    ));

    $wpdb->delete('cv_studies',array(
        'id_cv'=>$id
    ));

    $wpdb->delete('cv_cv',array(
        'id'=>$id
    ));

}