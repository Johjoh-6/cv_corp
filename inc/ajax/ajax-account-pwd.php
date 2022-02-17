<?php

add_action('wp_ajax_ajax_account_pwd', 'updatePwd');
add_action('wp_ajax_nopriv_ajax_account_pwd', 'updatePwd');


function updatePwd() {

    $ID = $_POST['id'];
    $meta_user = get_user_meta($ID);

    $errors = [];
    $succes = false;

        // Faille xss
        $pwd = cleanXss('first_name');
        $errors = ['pwd'];
    
        if(count($errors) == 0) {
            wp_update_user([
                'ID'=> $ID,
                'user_pass' => $pwd
            ]);
           
            $succes = true;
        }
    
  
   
    $data = [
        'id'=> $ID,
        'errors'=> $errors,
        'succes'=>$succes
        ];
    
    showJson($data);
};