<?php global $wpdb;
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
$allCv = $wpdb->get_results("SELECT * FROM cv_cv WHERE id_user= $id_user ORDER BY id DESC LIMIT 10");
?>

<section id="my-cv">
    <div class="candidat_profil">
        <h2>Mon profil</h2>
        <div class="box_profil">
            <?php if (is_user_logged_in() and !empty($meta_user['img'][0])) { ?>
                <img class="PFP" src="<?= metaFieldImg($meta_user, 'img', 'img_compte'); ?>" alt="">
            <?php } ?>
            <div>
                <h3><?= ucfirst(metaField($meta_user, 'first_name')); ?> <?= ucfirst(metaField($meta_user, 'last_name')); ?></h3>
                <a href="<?= path('/compte'); ?>">Modifier mes informations</a>
            </div>
        </div>
    </div>


    <div class="visuel_profil">
        <?php foreach ($allCv as $singleCv) {
            $singleCv = (array) $singleCv ?>
            <div class="box_candidat">
                    <div class="box_text_profil_candidat">
                        <i class="fa-regular fa-file-lines file"></i>
                        <h4><?= $singleCv["cv_title"] ?></h4>
                        <?php $urlEdit = add_query_arg(array(
                        'cvEdit' => $singleCv["id"], ), site_url('/cv')); ?>
                    </div>
                    <div class="cta_candit" data_cvid="<?= $singleCv["id"] ?>">
                        <a href="<?= path('/cv') ?>?cvEdit=<?= $singleCv["id"] ?>"><i class="fa-solid fa-pen-to-square"></i></i></a>
                        <a href="<?= path('/cv-detail') ?>?cv=<?= $singleCv["id"] ?>"><i class="fa-solid fa-eye"></i></a>
                        <a href="#"><i class="fa-solid fa-trash"></i></a>
                    </div>
            </div>
        <?php } ?>
    </div>
</section>


<?php include_once 'inc/cv-modales.php' ?>
</div>