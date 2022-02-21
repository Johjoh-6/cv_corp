<?php
add_action('wp_ajax_ajax_cv', 'getTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv', 'getTheCvWithAjax');

function getTheCvWithAjax() {
    global $wpdb;
    $post = $_POST['data'];

    if (empty($post['ID'])) {
        $hasId = 0;
    } else {
        $hasId = 1;
    }
    if($hasId == 0) {
        $cvCount = $wpdb->get_col(
            $wpdb->prepare("SELECT count(*) AS total FROM {$wpdb->prefix}cv")
        );
        $cvCount = $cvCount[0];
        $post['ID'] =($cvCount+1);
        echo $post['ID'];
        debug($post['ID']);
        $hasId = 1;
    } else {
        echo $post['ID'];
    }



    $userId = get_current_user_id();
    $wpdb->insert('cv_cv', array(
        'id' => $post['ID'],
        'id_user' => $userId,
        'user_firstname' => $post['prenomCv'],
        'user_lastname' => $post['nomCv'],
        'user_email' => $post['emailCv'],
        'user_phone' => $post['phoneCv'],
        'user_adress' => $post['adresseCv'],
        'id_picture' => '',
    ));

    $wpdb->update('cv_cv', array(
        'id' => $post['ID'],
        'id_user' => $userId,
        'user_firstname' => $post['prenomCv'],
        'user_lastname' => $post['nomCv'],
        'user_email' => $post['emailCv'],
        'user_phone' => $post['phoneCv'],
        'user_adress' => $post['adresseCv'],
        'id_picture' => '',
    ),array('id'=>$post['ID']));
    debug($post);
    $wpdb->delete('cv_langues_pivot', array('id_cv' => $post['ID']));
    foreach ($post['langues'] as $langue) {
        $wpdb->insert('cv_langues_pivot', array(
            'id_cv' => $post['ID'],
            'id_langue' => $langue['id'],
            'langue_level' => $langue['niveau']
        )
        );
    };

    $wpdb->delete('cv_experience', array('id_cv' => $post['ID']));
    foreach ($post['experiences'] as $experience) {
        $wpdb->insert('cv_experience', array(
                'id_cv' => $post['ID'],
                'job_name' => $experience['job'],
                'company_name' => $experience['entreprise'],
                'date_start' => $experience['expStart'],
                'date_end' => $experience['expEnd'],
                'details' => $experience['expDetails'],
            )
        );
    }

    $wpdb->delete('cv_studies', array('id_cv' => $post['ID']));
    foreach ($post['formations'] as $formation) {
        $wpdb->insert('cv_experience', array(
                'id_cv' => $post['ID'],
                'study_name' => $formation['nomFormation'],
                'study_details	' => $formation['formDetails'],
                'school_name' => $formation['organisme'],
                'school_location' => $formation['formLieu'],
                'date_start' => $formation['formStart'],
                'date_end' => $formation['formEnd'],
            )
        );
    }
}