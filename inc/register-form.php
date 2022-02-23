<?php


// Add form
add_action( 'register_form', 'myplugin_register_form' );


function myplugin_register_form() {
    $success = false;
    if (!empty($_POST['wp-submit'])) {
    global $registrationError;
    $user_login = (!empty( $_POST['user_login'])) ? cleanXss('user_login') : '';
    $user_email = (!empty( $_POST['user_email'])) ? cleanXss('user_email') : '';
    $user_pass = (!empty( $_POST['user_pass'])) ? cleanXss('user_pass') : '';
    $confirm_pass = (!empty( $_POST['confirm_pass'])) ? cleanXss('confirm_pass') : '';
    $first_name = (!empty( $_POST['first_name'])) ? cleanXss('first_name') : '';
    $last_name = (!empty( $_POST['last_name'])) ? cleanXss('last_name') : '';

    if(!isset($_POST['readmention'])){
        $registrationError .= '<p>Veuillez prendre connaissance de nos CGU</p>';
    }
    if ($user_login == '') {
        $registrationError .= '<p>Entrer un noms d\'utilisateur</p>';
    }
  
    if (username_exists($user_login)) {
        $registrationError .= '<p>Ce noms d\'utilisateur existe déjà</p>';
    }
  
    if ($user_email == '') {
        $registrationError .= '<p>Entrer un email</p>';
    }
  
    if ($user_pass == '' || $confirm_pass == '') {
        $registrationError .= '<p>Entrer un mots de passe</p>';
    }
  
    if (strlen($user_pass) < 8) {
        $registrationError .= '<p>Mots de passe trop court</p>';
    }
  
    if ($user_pass != $confirm_pass) {
        $registrationError .= '<p>Mots de passe différent</p>';
    }
  
    if ($user_email != '' && !is_email($user_email)) {
        $registrationError .= '<p>Entrer un email valide</p>';
    }
  
    if (email_exists($user_email) != false) {
        $registrationError .= '<p>Cette email existe déjà</p>';
    }
    if ($first_name == '') {
        $registrationError .= '<p>Ajouté votre prénom</p>';
    }
    if ($last_name == '') {
        $registrationError .= '<p>Ajouté votre nom</p>';
    }
    if (empty($registrationError)) {
        $data = [
            'user_pass'             =>  $user_pass,   //(string) The plain-text user password.
            'user_login'            => $user_login,   //(string) The user's login username.
            'user_nicename'         => $user_login,   //(string) The URL-friendly user name.
            'user_url'              => '',   //(string) The user URL.
            'user_email'            => $user_email,   //(string) The user email address.
            'first_name'            => $first_name,   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
            'last_name'             => $last_name,   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
            'user_registered'       => currentTimeDate(),   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
            'show_admin_bar_front'  => false,   //(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
            'role'                  => 'candidate',   //(string) User's role.
    
           
        ];
          
        $user_id = wp_insert_user( $data );
          
        if ( ! is_wp_error( $user_id ) ) {
             
            $success = true;
             
        }
    } 
}  
        if($success){ ?>
            <div class="success">
            <p>Merci pour votre inscription</p>
            <p>Cliquez sur le liens ci-dessous pour vour connecter</p>
            </div>
        <?php } else { ?>
       <form action="" method="post">
           <p>
               <label for="user_login">Noms d'utilisateur</label>
               <input type="text" name="user_login" id="user_login" class="input" value="<?= recupInputValue('user_login'); ?>">
           </p>
            <p>
                <label for="user_email">Email</label>
                <input type="email" name="user_email" id="user_email" class="input" value="<?= recupInputValue('user_email'); ?>">
            </p>
            <p>
                <label for="user_pass">Mots de passe</label>
                <input type="password" name="user_pass" id="user_pass" class="input">
            </p>
            <p>
                <label for="confirm_pass">Confirmer le mots de passe</label>
                <input type="password" name="confirm_pass" id="confirm_pass" class="input">
            </p>
            <p>
                <label for="first_name">Prénom</label>
                <input type="text" name="first_name" id="first_name" class="input" value="<?= recupInputValue('first_name'); ?>">
            </p>
            <p>
                <label for="last_name">Nom</label>
                <input type="text" name="last_name" id="last_name" class="input" value="<?= recupInputValue('last_name'); ?>">
            </p>
            <p>
           
                <span><a href="<?= path('/cookie')?>">données personnelles et cookies</a> 
								<a href="<?= path('/mention-legal')?>">mentions légal</a>
                <label><input name="readmention" type="checkbox" id="readmention" value="true">Lu</label></span>
            </p>
        <p>
            <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="S'enregistrer">
        </p>
        
        </form>
        <?php }
}
