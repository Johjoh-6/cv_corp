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
    <div id="sidebar">
            <h2>Journal de board</h2>
            <?php if(is_user_logged_in() AND !empty(metaField($meta_user, 'img'))) { ?>
                <img src="<?= metaFieldImg($meta_user, 'img', 'img_compte'); ?>" alt="ici photo du recruteur">
            <?php } ?>
                <h3><?= metaField($meta_user, 'first_name'); ?> <?= metaField($meta_user, 'last_name'); ?></h3>
                
            <div class="box_recherche">
                <form action="">
                        <input class="cta_recherche" type="text" name="recherche" id="searchDash" placeholder="Recherche un CV">
                </form>
            </div>

    </div>
    <div id="board">
    <div class="visuel_profil">
        <div class="container_candidat">
            <?php foreach ($allCv as $singleCv) {  
                ?>
                <div class="box_candidat default">
                    <div class="box_candidat_1">
                    <?php if ($singleCv->id_picture != 0) { ?>
                        <div class="candidat_picture">
                            <img src="<?= wp_get_attachment_url($singleCv->id_picture, 'img_compte'); ?>" alt="Photo de <?= $singleCv->user_lastname;?>">
                        </div>
                    <?php } ?>
                            <div class="box_text_profil_candidat">
                                <h1><?= $singleCv->cv_title; ?></h1>
                                <p>Nom : <?= $singleCv->user_lastname; ?></p>
                                <p>Prénom : <?= $singleCv->user_firstname; ?></p>
                                <div class="cta_candit">
                                    <a href="<?= path('/cv-detail') ?>?cv=<?= $singleCv->id; ?>">Voir ce CV</a>
                                </div>
                            </div>
                    </div>
                </div>
            <?php } ?>

        </div>
            <div class="container_candidat_search">


        </div>
    </div>
</section>


<?php get_footer();