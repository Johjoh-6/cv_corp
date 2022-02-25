<?php

/* Template Name: Dashboard */
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
global $wpdb;
$allCv = $wpdb->get_results("SELECT * FROM cv_cv");


can_access(['administrator', 'recruiter']);
get_header(); 


?>

<section id="dashboard">
    <div id="box">
            <h2>Journal de board</h2>
            <?php if(is_user_logged_in() AND !empty(metaField($meta_user, 'img'))) { ?>
                <img src="<?= metaFieldImg($meta_user, 'img', 'img_compte'); ?>" alt="ici photo du recruteur">
            <?php } ?>
                <h3><?= metaField($meta_user, 'first_name'); ?> <?= metaField($meta_user, 'last_name'); ?></h3>
                
            <div class="box_recherche">
                <form action="" novalidate onSubmit="return false">
                        <input class="cta_recherche" type="text" name="recherche" id="searchDash" placeholder="Recherche un CV">
                </form>
            </div>

    </div>
    <div id="board">
            <div id="baseCV"  class="container_candidat">
                <?php foreach ($allCv as $singleCv) {  
                    ?>
                    <div  class="box_candidat default">
                                <?php if ($singleCv->id_picture != 0) { ?>
                                    <img  class="candidat_picture"src="<?= wp_get_attachment_url($singleCv->id_picture, 'img_compte'); ?>" alt="Photo de <?= $singleCv->user_lastname;?>">
                                <?php } else { ?>
                                    <img src="<?= asset('img/random-user.png'); ?>" alt="random image">
                                <?php } ?>
                                        <h4><?= $singleCv->cv_title; ?></h4>
                                        <p>Nom : <?= $singleCv->user_lastname; ?></p>
                                        <p>Prénom : <?= $singleCv->user_firstname; ?></p>
                                        <a class="cta_candit" href="<?= path('/cv-detail') ?>?cv=<?= $singleCv->id; ?>">Voir ce CV</a>
                    </div>
                <?php } ?>

            </div>
            <div id="result_search" class="container_candidat"></div>
    </div>
</section>


<?php get_footer();