<?php

/* Template Name: Dashboard */
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
global $wpdb;
$allCv = $wpdb->get_results("SELECT * FROM cv_cv");
//debug($meta_user);

can_access(['administrator', 'recruiter']);
get_header(); 


?>
<section id="dashboard">
    <div class="container_dash">
        <div class="container_profil">
            <h2>Journal de board</h2>
            <div class="box_profil">
            <?php if(is_user_logged_in() AND !empty($meta_user['img'][0])) { ?>
                <img src="<?= wp_get_attachment_url($meta_user['img'][0]) ?>" alt="ici photo du recruteur">
            <?php } ?>
                <h1><?= $meta_user['first_name'][0] ?> <?= $meta_user['last_name'][0] ?></h1>
            </div>
        </div>
    </div>

    <div class="visuel_profil">
        <div class="box_recherche">
            <form action="">
                <div>
                    <input class="cta_recherche" type="text" name="recherche" id="searchDash" placeholder="Recherche un CV">
                </div>
            </form>
        </div>

    <div class="container_candidat">
        <?php foreach ($allCv as $singleCv) {
            $singleCv = json_decode(json_encode($singleCv), true);
            ?>
            <div class="box_candidat default">
                <div class="box_candidat_1">
                <?php if ($singleCv['id_picture'] != 0) { ?>
                    <div class="candidat_picture">
                        <img src="<?= wp_get_attachment_url($singleCv['id_picture']) ?>" alt="ici photo du candidat">
                    </div>
                <?php } ?>
                        <div class="box_text_profil_candidat">
                            <h1><?= $singleCv['cv_title'] ?></h1>
                            <p>Nom : <?= $singleCv['user_lastname'] ?></p>
                            <p>Prénom : <?= $singleCv['user_firstname'] ?></p>
                            <div class="cta_candit">
                                <a href="<?= path('/cv-detail') ?>?cv=<?= $singleCv["id"] ?>">Voir ce CV</a>
                            </div>
                        </div>
                </div>
            </div>
        <?php } ?>

    </div>
        <div class="container_candidat_search">


    </div>
</section>


<?php get_footer();