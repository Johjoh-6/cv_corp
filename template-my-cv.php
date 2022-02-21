<?php

/* Template Name: MyCV */

get_header(); 

$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
debug(getCv($id_user));
$my_cv = getCv($id_user);
?>


<h1>My Cv</h1>
<?php 
foreach($my_cv as $cv){
    $id_cv =  $cv->id;
    echo $id_cv;
    echo $cv->user_lastname; ?>
    <a href="<?= path("/cv-detail/?cv=". $id_cv);?>">click ici</a>
    <?php
}
?>

<?php get_footer();