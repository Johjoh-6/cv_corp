<?php
add_action('wp_ajax_ajax_dash_search', 'searchTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_dash_search', 'searchTheCvWithAjax');

function searchTheCvWithAjax() {
    global $wpdb;
    $allCvNew = $wpdb->get_results("SELECT * FROM cv_cv WHERE cv_title = '".$_POST['searchData']['value']."' OR user_firstname = '".$_POST['searchData']['value']."' OR user_lastname = '".$_POST['searchData']['value']."'");
    $allCvNew = json_decode(json_encode($allCvNew), true);
    $allCV = [];
    foreach ($allCvNew as $singleCv) {
        $id_user = $singleCv['id_user'];
        $meta_user = get_user_meta($id_user);
        $CV = array(
            'id' => $singleCv['id'],
            'title' => $singleCv['cv_title'],
            'imgSrc' => wp_get_attachment_url($meta_user['img'][0]),
            'link' => add_query_arg( 'cv', $singleCv['id'], path('/cv-detail') ),
            'nom' =>$singleCv['user_lastname'],
            'prenom' => $singleCv['user_firstname'],
        );
        array_push($allCV,$CV);

    }
    showJson($allCV);
}