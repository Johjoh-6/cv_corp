<?php

/* Template Name: home */

get_header();

?>

<div class="wrap">
    <div class="intro">
        <div class="imgsvg">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/imgIntro.png" alt="">
        </div>
        <div class="text-intro">
            <div class="texte">
                <p>Générateur de CV simple, facile et rapide</p>
            </div>
            <diV class="intro-btn">
                <a href="">Incription</a>
                <a href="">Connexion</a>
            </diV>
        </div>
    </div>

    <div class="confiance">
        <p>Ils nous font confiance : </p>
        <div class="entreprise-img">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/decatlon.png" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/normandie.png" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bouygues.png" alt="">
        </div>
    </div>

    <div class="posibilitée">
        <div class="posibilitée1">
            <div class="posibilitée-img1">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull1.svg" alt="">
            </div>
            <div class="posibilitée-texte">
                <h2>Sélection de CV</h2>
                <p>Choisissez un CV parmi tous nos modèles.</p>
            </div>
        </div>
        <div class="posibilitée1">
            <div class="posibilitée-img2">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull2.svg" alt="">
            </div>
            <div class="posibilitée-texte">
                <h2>Crée un CV</h2>
                <p>Remplissez vis experiances et compétances avec nos phrases prêtes à l'emploi.</p>
            </div>
        </div>
        <div class="posibilitée1">
            <div class="posibilitée-img3">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull3.svg" alt="">
            </div>
            <div class="posibilitée-texte">
                <h2>Téléchargement PDF</h2>
                <p>Téléchargez, imprimez et envoyer votre CV à volonté.</p>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>