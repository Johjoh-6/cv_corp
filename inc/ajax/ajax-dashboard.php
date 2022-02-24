<?php
add_action('wp_ajax_ajax_dash_search', 'searchTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_dash_search', 'searchTheCvWithAjax');

function searchTheCvWithAjax() {
    global $wpdb;
    $search = $_POST['search'];
    $allCvNew = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}cv WHERE cv_title LIKE '%$search%' OR user_firstname LIKE '%$search%' OR user_lastname LIKE '%$search%'", ARRAY_A);
    // $allCvNew = $wpdb->get_results("SELECT cv.id, cv.cv_title, cv.user_id, cv.user_firstname, cv.user_lastname, cv.user_email, cv.user_phone, cv.user_adress, cv.id_picture, cv.cv_title,experience.job_name, experience.company_name, experience.date_start, experience.date_end, experience.details ,  studies.study_name, studies.study_details, studies.school_name, studies.school_location, studies.date_start, studies.date_end, skills.skill_name, spivot.skill_level , langue.langue_name, lpivot.langue_level, hobbie.hobbie_name, hpivot.hobbie_details
    // FROM {$wpdb->prefix}cv AS cv
    // JOIN {$wpdb->prefix}experience AS experience
    // ON experience.id_cv = cv.id
    // JOIN {$wpdb->prefix}studies AS studies
    // ON studies.id_cv = cv.id
    // JOIN {$wpdb->prefix}skill_pivot AS spivot
    // ON spivot.id_cv = cv.id
    // JOIN {$wpdb->prefix}skills AS skills 
    // ON spivot.id_skill = skills.id
    // JOIN {$wpdb->prefix}langues_pivot AS lpivot
    // ON lpivot.id_cv = cv.id
    // JOIN {$wpdb->prefix}langues AS langue 
    // ON lpivot.id_langue = langue.id
    // JOIN {$wpdb->prefix}hobbie_pivot AS hpivot
    // ON hpivot.id_cv = cv.id
    // JOIN {$wpdb->prefix}hobbie AS hobbie 
    // ON hpivot.id_hobbie = hobbie.id
    // WHERE cv.cv_title LIKE '%$search%' OR cv.user_firstname LIKE '%$search%' OR cv.user_lastname LIKE '%$search%'", ARRAY_A);
    
    $allCV = [];
    foreach ($allCvNew as $singleCv) {
        $id_user = $singleCv['id_user'];
        $meta_user = get_user_meta($id_user);
        if(!empty($meta_user['img'])){
            $img = wp_get_attachment_url($meta_user['img'][0]);
        } else {
            $img = asset('img/random-user.png');
        }
        $CV = array(
            'id' => $singleCv['id'],
            'title' => $singleCv['cv_title'],
            'imgSrc' => $img,
            'link' => add_query_arg( 'cv', $singleCv['id'], path('/cv-detail') ),
            'nom' =>$singleCv['user_lastname'],
            'prenom' => $singleCv['user_firstname'],
        );
        array_push($allCV,$CV);

    }
    showJson($allCV);
}