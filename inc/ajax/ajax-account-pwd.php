<?php

add_action('wp_ajax_ajax_account_pwd', 'updatePwd');
add_action('wp_ajax_nopriv_ajax_account_pwd', 'updatePwd');


function updatePwd() {

    $ID = $_POST['id'];
    $meta_user = get_user_meta($ID);

    $errors = [];
    $succes = false;

        // Faille xss
        $user_pass = (!empty( $_POST['user_pass'])) ? cleanXss('user_pass') : '';
        $confirm_pass = (!empty( $_POST['confirm_pass'])) ? cleanXss('confirm_pass') : '';

        if ($user_pass == '' || $confirm_pass == '') {
            $errors['password'] = 'Entrer tout les champs';
        }
      
        if (strlen($user_pass) < 8) {
            $errors['short-pwd'] = 'Mots de passe trop court';
        }
      
        if ($user_pass != $confirm_pass) {
            $errors['different-pwd'] = 'Mots de passe différent';
        }
        if(count($errors) == 0) {
            wp_update_user([
                'ID'=> $ID,
                'user_pass' => $user_pass
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