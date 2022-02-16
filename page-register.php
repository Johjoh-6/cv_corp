<?php

get_header();

global $registrationError;
?>

<section id="register-page">
<div class="register-form form-style-account">
    <h2>S'enregistrer</h2>
    <?php do_action('register_form'); ?>   
<div class="error-form">
   <?= $registrationError;?>
</div>
<div class="form-option">
    <a href="<?= path('/login');?>">Se connecter</a>
</div>
</div>
</section>

<?php
get_footer();