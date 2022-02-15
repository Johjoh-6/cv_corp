<?php

get_header();



$login  = (!empty($_GET['login']) ) ? $_GET['login'] : 0;
if ( $login === "failed" ) {
    echo '<p class="login-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
  } elseif ( $login === "empty" ) {
    echo '<p class="login-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
  } elseif ( $login === "false" ) {
    echo '<p class="login-msg"><strong>ERROR:</strong> You are logged out.</p>';
  }
?>



<div class="login-form form-style-account">
<?php
$args = [
    'redirect' => home_url(), 
    'id_username' => 'user',
    'id_password' => 'pass',
] 
;?>
<?php wp_login_form( $args ); ?>
</div>



<?php
get_footer();