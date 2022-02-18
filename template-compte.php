<?php

/* Template Name: Compte */

get_header(); 

$id_user = get_current_user_id();

// update_user_meta( $id_user, 'phone', '123456789');

$meta_user = get_user_meta($id_user);

?>


<section id="account">
    <div id="box-account">
        <div class="header-account">
            <img id="img-profil" src="<?= metaFieldImg($meta_user, 'img', 'img_compte');?>" alt="">
            <div class="header-account_text">
                <p class="header-account_role">
                    <?= showRoleCurrentUser();?>
                </p>
                <p class="header-account_post">
                    dernier post: technicien
                </p>
            </div>
        </div>
        <div class="account-detail">
            <h3>Information personnel</h3>
            <form action="" method="$_POST" id="detail-account">
                <p>
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" value="" placeholder="<?=  metaField($meta_user, 'first_name');?>">
                </p>
                <p>
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name"  value="" placeholder="<?=  metaField($meta_user, 'last_name');?>">
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"  value="" placeholder="<?=  metaField($meta_user, 'email');?>">
                </p>
                <p>
                    <label for="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone"  value="" placeholder="<?=  metaField($meta_user, 'phone');?>">
                </p>
                <p>
                    <label for="img">Photos de profil</label>
                    <input type="file" id="img" name="img">
                </p>
                <p class="submit">
                    <input type="submit" id="edit" value="Editer" data-id="<?= $id_user;?>">
                </p>
                <div id="form-account" class="error-form">
                    
                </div>
            </form>
        </div>
        <div class="account-detail">
            <h3>Modifier le mots de passe</h3>
            <form action="" method="$_POST" id="pwd-account">
                <p>
                    <label for="user_pass">Mots de passe</label>
                    <input type="password" name="user_pass" id="user_pass" >
                </p>
                <p>
                    <label for="confirm_pass">Confirmer le mots de passe</label>
                    <input type="password" name="confirm_pass" id="confirm_pass">
                </p>
                <p class="submit">
                    <input type="submit" id="update_password" value="Modifier le mots de passe" data-id="<?= $id_user;?>">
                </p>
            </form>
            <div id="form-pwd" class="error-form">
                
            </div>
        </div>
    </div>
</section>



<?php get_footer();