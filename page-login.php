<?php

get_header();

$error;
$login  = (!empty($_GET['login']) ) ? $_GET['login'] : 0;
if ( $login === "failed" ) {
    $error = '<p> Nom de compte ou mots de passe incorrect.</p>';
  } elseif ( $login === "empty" ) {
    $error = '<p> Nom de compte ou mots de passe vide.</p>';
  } elseif ( $login === "false" ) {
    $error = '<p> Vous n\'êtes pas connecter.</p>';
  }
?>


<section id="login-page">
<div class="login-form form-style-account">
    <h2>Connection</h2>
<?php
$args = [
    'redirect' => home_url(), 
    'id_username' => 'user',
    'id_password' => 'pass',
    'label_username' => __( 'Identifiant' ),
    'label_password' => __( 'Mots de passe' ),
    'label_remember' => __( 'Rester connecter' ),
    'label_log_in' => __( 'Connection' ),
] 
;?>
<?php wp_login_form( $args ); ?>
<div class="error-form">
   <?= $error;?>
</div>
<div class="form-option">
    <a href="<?= path('/forgot-pwd');?>">Mots de passe oublié</a>
    <a href="<?= path('/register');?>">S'enregistrer</a>
</div>
</div>
</section>


<?php
get_footer();