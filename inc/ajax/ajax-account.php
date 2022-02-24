<?php

add_action('wp_ajax_ajax_account', 'gNuUserDetails');
add_action('wp_ajax_nopriv_ajax_account', 'gNuUserDetails');


function gNuUserDetails() {

    $ID = $_POST['id'];
    $meta_user = get_user_meta($ID);
    $errors = [];
    $succes = false;
    
        // IMG
        $imgFile = $_FILES['img'];
    
        // Faille xss
        $first_name = cleanXss('first_name');
        $last_name = cleanXss('last_name');
        $email = cleanXss('email');
        $phone = cleanXss('phone');
        $adress = cleanXss('adress');
    

        //Validation
        if(!empty($first_name)){
            $errors = textValidation($errors, $first_name,'first_name',2 , 200);
            if(!empty($errors['first_name'])){
                $first_name = $meta_user['first_name'][0];
            }
        } else {
            $first_name = $meta_user['first_name'][0];
        }
        if(!empty($last_name)){
            $errors = textValidation($errors,$last_name,'last_name',2, 200);
            if(!empty($errors['last_name'])){
                $last_name = $meta_user['last_name'][0];
            }
        } else{
            $last_name = $meta_user['last_name'][0];
        } 
        if(!empty($email)){
            $errors = emailValidation($errors,$email,'email');
            if(!empty($errors['email'])){
                $email = $meta_user['email'][0];
            }
        } else{
            $email = $meta_user['email'][0];
        }
        if(!empty($phone)){
            $errors = validatePhoneNumber($errors, $phone, 'phone');
            if(!empty($errors['phone'])){
                $phone = $meta_user['phone'][0];
            }
        } else {
            $phone = $meta_user['phone'][0];
        }
        if(!empty($adress)){
            $errors = textValidation($errors, $adress, 'adress', 5, 255);
            if(!empty($errors['adress'])){
                $adress = $meta_user['adress'][0];
            }
        } else {
            $adress = $meta_user['adress'][0];
        }
        if(!empty($imgFile)){
            $errors = validateImgProfil($errors, 'img', 'img');
            if(!empty($errors['img'])){
                $img = $meta_user['img'][0];
            }
        } else {
            $img = $meta_user['img'][0];
        }
       
        if(count($errors) == 0) {
            $attachment_id = media_handle_upload( 'img', $ID, array(), array('test_form' => false) );
            $attachment_url = wp_get_attachment_url($attachment_id);
            wp_update_user([
                'ID'=> $ID,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
            update_user_meta( $ID, 'email', $email);
            update_user_meta( $ID, 'phone', $phone);
            update_user_meta( $ID, 'adress', $adress);
            update_user_meta( $ID, 'img', $attachment_id);
            
            $succes = true;
        }
    
  
   
    $data = [
        'id'=> $ID,
        'first_name'=> stripslashes($first_name),
        'last_name'=> stripslashes($last_name),
        'email'=>  $email,
        'phone'=> $phone,
        'adress'=> $adress,
        'img'=> $attachment_id,
        'img_url'=> $attachment_url,
        'errors'=> $errors,
        'succes'=>$succes
        ];
    
    showJson($data);
};