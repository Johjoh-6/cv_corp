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