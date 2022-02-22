<?php

function debug($array){
echo '<pre style="height: 200px; overflow-y: scroll; font-size: .7rem; padding: .6rem; font-family: Consolas,monospace; background: #000000; color: #ffffff;">';
    print_r($array);
    echo '</pre>';
}

function asset($file){
return get_template_directory_uri() . '/src/asset/' . $file;
}

function path($slug = '/'){
return esc_url(home_url($slug));
}

function seoHeadWp(){
    $ID = get_queried_object()->ID;
    $meta_head = get_post_meta($ID);
    //title
    if(!empty($meta_head['title'][0])) {
        echo '<title>' . $meta_head['title'][0] . '</title>';
    } else {
        echo '<title>' .get_the_title() . '</title>';
    }
    //description
    if(!empty($meta_head['description'][0])) {
        echo '<meta name="description" content="' . $meta_head['description'][0] . '">';
    }
    // keyword
    if(!empty($meta_head['keyword'][0])) {
        echo '<meta name="keywords" content="' . $meta_head['keyword'][0] . '">';
    }
}

function metaField($meta, $string){
    if (!empty($meta[$string][0])){
        return nl2br($meta[$string][0]);
    } else{
        return '';
    }
}
function metaFieldImg($meta, $string, $img_size){
    if (!empty($meta[$string][0])){
        return wp_get_attachment_image_url($meta[$string][0], $img_size);
    } else{
        return 'Image not found';
    }
}

function showJson($data){
    header("Content-type: application/json");
    $json = json_encode($data,JSON_PRETTY_PRINT);
    if ($json){
        die($json);
    }else{
        die('error in json encoding');
    }
}

function cleanXss($nameInput)
{
    return trim(strip_tags($_POST[$nameInput]));
}

function recupInputValue($key)
{
    if(!empty($_POST[$key])) {
        echo $_POST[$key];
    }
}
function dateToRead($dateDb){
    $date = new DateTime();
    $date->setTimestamp($dateDb);
    return $date->format('d/m/Y H:i:s');
}
function currentTimeDate(){
    return date('Y-m-d H:i:s');
}


function getRoleCurrentUser(){
    if(is_user_logged_in()){
    return wp_get_current_user()->roles[0];
    }
}
function showRoleCurrentUser(){
    $role = wp_get_current_user()->roles[0];
    if($role === 'candidate'){
        return 'Candidat / candidate';
    } 
    if($role !== 'recruiter'){
        return 'Recruteur / recruteuse';
    }else {
        return '';
    }
}

function emailValidation($errors,$email,$key)
{
    if(!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[$key] = 'Veuillez renseigner un email valid';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner un email';
    }
    return $errors;
}

function textValidation($errors,$value,$key,$min = 3,$max = 50)
{
    if(!empty($value)) {
        if(mb_strlen($value) < $min) {
            $errors[$key] = 'Min '.$min.' caractères';
        } elseif (mb_strlen($value) > $max) {
            $errors[$key] = 'Max '.$max.' caractères';
        }
    } else {
        $errors[$key] = 'Veuillez renseigner ce champ.';
    }
    return $errors;
}

function validatePhoneNumber($errors, $phoneV, $key)
{
     $filtered_phone_number = filter_var($phoneV, FILTER_SANITIZE_NUMBER_INT);
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
        $errors[$key] = 'Veuillez renseigner un numéro de téléphone valide';
     } 
     return $errors;
}

function validateImgProfil($errors, $imgFile, $key){
        $fileinfo = @getimagesize($_FILES[ $imgFile]["tmp_name"]);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
        
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
        
        // Get image file extension
        $file_extension = pathinfo($_FILES[ $imgFile]["name"], PATHINFO_EXTENSION);
        
        // Validate file input to check if is not empty
        if (! file_exists($_FILES[ $imgFile]["tmp_name"])) {
            $errors[$key] = 'Fichier vide';
        }    // Validate file input to check if is with valid extension
        else if (! in_array($file_extension, $allowed_image_extension)) {
            $errors[$key] = 'Format non supporter ! (png, jpg, jpeg)';
    
        }    // Validate image file size
        else if (($_FILES["file-input"]["size"] > 2000000)) {
            $errors[$key] = 'Fichier trop volumineux';
        }    
        return $errors;
}

function getCv($idUser){
    global $wpdb;
    $table = $wpdb->prefix.'cv';
    return $wpdb->get_results("SELECT * FROM $table WHERE id_user = $idUser", OBJECT);
}

function getCvById($idcv){
    global $wpdb;
    $info = $wpdb->get_results("SELECT `user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_adress`, `id_picture`, `cv_title`  FROM {$wpdb->prefix}cv WHERE id = $idcv", OBJECT);
    $experience = $wpdb->get_results("SELECT `job_name`, `company_name`, `date_start`, `date_end`, `details` FROM {$wpdb->prefix}experience WHERE id_cv = $idcv", ARRAY_A);
    $studie = $wpdb->get_results("SELECT `study_name`, `study_details`, `school_name`, `school_location`, `date_start`, `date_end`  FROM {$wpdb->prefix}studies WHERE id_cv = $idcv", ARRAY_A);
    $skills = $wpdb->get_results("SELECT skills.skill_name, pivot.skill_level 
        FROM {$wpdb->prefix}skill_pivot AS pivot
        LEFT JOIN {$wpdb->prefix}skills AS skills ON pivot.id_skill = skills.id
        WHERE pivot.id_cv = $idcv", ARRAY_A);
    $langues = $wpdb->get_results("SELECT langue.langue_name, pivot.langue_level 
        FROM {$wpdb->prefix}langues_pivot AS pivot
        LEFT JOIN {$wpdb->prefix}langues AS langue ON pivot.id_langue = langue.id
        WHERE pivot.id_cv = $idcv", ARRAY_A);
    $hobbie = $wpdb->get_results("SELECT hobbie.hobbie_name, pivot.hobbie_details
        FROM {$wpdb->prefix}hobbie_pivot AS pivot
        LEFT JOIN {$wpdb->prefix}hobbie AS hobbie ON pivot.id_hobbie = hobbie.id
        WHERE pivot.id_cv = $idcv", ARRAY_A);
        
   
    $cv_obj = new stdClass();
    foreach($info[0] as $key => $value){
        $cv_obj->$key = $value;
    }
    foreach($experience as $key => $value){
        $cv_obj->experience[] = $value;
    }
    foreach($studie as $key => $value){
        $cv_obj->studie[] = $value;
    }
    foreach($skills as $key => $value){
        $cv_obj->skills[] = $value;
    }
    foreach($langues as $key => $value){
        $cv_obj->langues[] = $value;
    }
    foreach($hobbie as $key => $value){
        $cv_obj->hobbie[] = $value;
    }
   
    return $cv_obj;
};