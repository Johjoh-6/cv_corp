<?php
add_action('wp_ajax_ajax_cv', 'getTheCvWithAjax');
add_action('wp_ajax_nopriv_ajax_cv', 'getTheCvWithAjax');
function getTheCvWithAjax() {

    $userId = get_current_user_id();
    global $wpdb;
    $post = $_POST['data'];

    if (empty($post['ID'])) {
        $hasId = 0;
    } else {
        $hasId = 1;
    }
    if($hasId == 0) {
        $cvCount = $wpdb->get_row(
            $wpdb->prepare("SELECT id FROM cv_cv ORDER BY id DESC LIMIT 1")
        );
        $cvCount = json_decode(json_encode($cvCount), true);
//        debug($cvCount);
        $cvCount = $cvCount['id'];
        $post['ID'] = ($cvCount+1);
        $id = array(
            'id'=>$post['ID'],
        );
        $meta_user = get_user_meta($userId);
        $wpdb->insert('cv_cv', array(
            'id' =>$id['id'],
            'cv_title' => $post['titleCv'],
            'id_user' => $userId,
            'user_firstname' => $post['prenomCv'],
            'user_lastname' => $post['nomCv'],
            'user_email' => $post['emailCv'],
            'user_phone' => $post['phoneCv'],
            'user_adress' => $post['adresseCv'],
            'id_picture' => $meta_user['img'][0],
        ));

        $hasId = 1;
    } else {
        echo $post['ID'];
    }
    $meta_user = get_user_meta($userId);

        $wpdb->update('cv_cv', array(
            'cv_title' => $post['titleCv'],
            'id_user' => $userId,
            'user_firstname' => $post['prenomCv'],
            'user_lastname' => $post['nomCv'],
            'user_email' => $post['emailCv'],
            'user_phone' => $post['phoneCv'],
            'user_adress' => $post['adresseCv'],
            'id_picture' => $meta_user['img'][0],
        ),array('id'=>$post['ID']));

    $wpdb->delete('cv_langues_pivot', array('id_cv' => $post['ID']));

    foreach ($post['langues'] as $langue) {
        $langueCount = $wpdb->get_var("SELECT count(*) AS total FROM cv_langues WHERE langue_name='".$langue['langue']."'");
        if ($langueCount == 0) {
            $wpdb->insert('cv_langues', array(
                    'langue_name' => $langue['langue']
                )
            );
        }
        $currentLangue = $wpdb->get_col("SELECT id FROM cv_langues WHERE langue_name='".$langue['langue']."'");
//        debug($currentLangue);
        $wpdb->insert('cv_langues_pivot', array(
            'id_cv' => $post['ID'],
            'id_langue' => $currentLangue[0],
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
        $wpdb->insert('cv_studies', array(
                'id_cv' => $post['ID'],
                'study_name' => $formation['nomFormation'],
                'study_details' => $formation['formDetails'],
                'school_name' => $formation['organisme'],
                'school_location' => $formation['formLieu'],
                'date_start' => $formation['formStart'],
                'date_end' => $formation['formEnd'],
            )
        );
    }

    $wpdb->delete('cv_hobbie_pivot', array('id_cv' => $post['ID']));
    foreach ($post['hobbies'] as $hobby) {

        $hobbyCount = $wpdb->get_var("SELECT count(*) AS total FROM cv_hobbie WHERE hobbie_name='".$hobby['hobby_name']."'");
        if ($hobbyCount == 0) {
            $wpdb->insert('cv_hobbie', array(
                    'hobbie_name' => $hobby['hobby_name']
                )
            );
        }
        $currentHobby = $wpdb->get_col("SELECT id FROM cv_hobbie WHERE hobbie_name='".$hobby['hobby_name']."'");
//        debug($currentHobby);
        $wpdb->insert('cv_hobbie_pivot', array(
                'id_cv' => $post['ID'],
                'id_hobbie' => $currentHobby[0],
                'hobbie_details' => $hobby['hobby_details'],
            )
        );
    }

    $wpdb->delete('cv_skill_pivot', array('id_cv' => $post['ID']));
    foreach ($post['skills'] as $skill) {

        $skillCount = $wpdb->get_var("SELECT count(*) AS total FROM cv_skills WHERE skill_name='".$skill['skill']."'");
        if ($skillCount == 0) {
            $wpdb->insert('cv_skills', array(
                    'skill_name' => $skill['skill']
                )
            );
        }
        $currentSkill = $wpdb->get_col("SELECT id FROM cv_skills WHERE skill_name='".$skill['skill']."'");
//        debug($currentSkill);
        $wpdb->insert('cv_skill_pivot', array(
                'id_cv' => $post['ID'],
                'id_skill' => $currentSkill[0],
                'skill_level' => $skill['niveau'],
            )
        );
    }
    debug($id);
}