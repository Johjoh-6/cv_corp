<?php

add_action('wp_ajax_ajax_account', 'gNuUserDetails');
add_action('wp_ajax_nopriv_ajax_account', 'gNuUserDetails');


function gNuUserDetails() {

    $ID = $_POST['id'];
    $meta_user = get_user_meta($ID);

    $errors = [];
    $succes = false;

        // Faille xss
        $first_name = cleanXss('first_name');
        if(!empty($first_name)){
            $errors = textValidation($errors, $first_name,'first_name',2 , 200);
        } else {
            $first_name = $meta_user['first_name'][0];
        }
        $last_name = cleanXss('last_name');
        if(!empty($last_name)){
            $errors = textValidation($errors,$last_name,'last_name',2, 200);
        } else{
            $last_name = $meta_user['last_name'][0];
        }
        $email = cleanXss('email');
        if(!empty($email)){
            $errors = emailValidation($errors,$email,'email');
        } else{
            $email = $meta_user['email'][0];
        }
        $phone = cleanXss('phone');
        if(!empty($phone)){
            $errors = validatePhoneNumber($errors, $phone, 'phone');
        } else {
            $phone = $meta_user['phone'][0];
        }
    
        if(count($errors) == 0) {
            wp_update_user([
                'ID'=> $ID,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
            update_user_meta( $ID, 'email', $email);
            update_user_meta( $ID, 'phone', $phone);
            // update_user_meta( $ID, 'img', $img);
            $succes = true;
        }
    
  
   
    $data = [
        'id'=> $ID,
        'first_name'=> $meta_user['first_name'][0],
        'last_name'=> $meta_user['last_name'][0],
        'email'=>  $meta_user['email'][0],
        'phone'=> $meta_user['phone'][0],
        // 'img'=> $img,
        'errors'=> $errors,
        'succes'=>$succes
        ];
    
    showJson($data);
};