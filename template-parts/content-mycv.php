<?php global $wpdb;
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
$allCv = $wpdb->get_results("SELECT * FROM cv_cv WHERE id_user='".$id_user."'");
?>

<section class="flex">
    <div class="candidat_dash">
        <div class="candidat_profil">
            <h2>Mon profil</h2>
            <div class="box_profil">
                <?php if(is_user_logged_in() AND !empty($meta_user['img'][0])) { ?>
                    <img class="PFP" src="<?= wp_get_attachment_url($meta_user['img'][0]) ?>" alt="">
                <?php } ?>
                <h2><?=  metaField($meta_user, 'first_name'); ?> <?=  metaField($meta_user, 'last_name'); ?></h2>
            </div>
        </div>
    </div>

    <div class="visuel_profil">

        <div class="container_candidat">
            <?php foreach ($allCv as $singleCv) {
               $singleCv = (array) $singleCv ?>
                <div class="box_candidat">
                    <div class="box_candidat_1 flex">
                        <i class="fa-regular fa-file"></i>
                        <div class="box_text_profil_candidat">
                            <h2><?= $singleCv["cv_title"] ?></h2>
                            <?php $urlEdit = add_query_arg( array(
                                'cvEdit' => $singleCv["id"],
                            ), site_url('/cv') ); ?>
                            <div class="cta_candit" data_cvid="<?= $singleCv["id"] ?>">
                                <a href="<?= path('/cv') ?>?cvEdit=<?= $singleCv["id"] ?>">Editer ce CV</a>
                                <a href="<?= path('/cv-detail') ?>?cv=<?= $singleCv["id"] ?>">Voir ce CV</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>


    </div>
</section>


    <?php include_once 'inc/cv-modales.php' ?>
</div>

