<?php

/* Template Name: home */

get_header(); ?>

<div class="wrap">

    <section id="intro">
        <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/imgIntro.png" alt="">
        <div class="text-intro">
            <div class="texte">
                <p>Générateur de CV simple, facile et rapide</p>
            </div>
            <diV class="intro-btn">
                <a href="<?php path('/register'); ?>">Incription</a>
                <a href="<?php path('/login'); ?>">Connexion</a>
            </diV>
        </div>
    </section>

    <section id="partenaire">
        <p>Ils nous font confiance : </p>
        <div class="logo-entreprise">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/decatlon.png" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/normandie.png" alt="">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bouygues.png" alt="">
        </div>
    </section>

    <section id="fonction">
        <div>
            <div class="backgroud-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull1.svg" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Sélection de CV</h2>
                <p>Choisissez un CV parmi tous nos modèles.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull2.svg" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Crée un CV</h2>
                <p>Remplissez vis experiances et compétances avec nos phrases prêtes à l'emploi.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/bull3.svg" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Téléchargement PDF</h2>
                <p>Téléchargez, imprimez et envoyer votre CV à volonté.</p>
            </div>
        </div>
    </section>

    <section id="avis">
        <div class="avis">
            <div class="backgroud-avis">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/avis1.svg" alt="">
            </div>
            <div class="avis-texte">
                <p>"Un exenllent service, à l'écoute et efficace. Large gamme proposée pour crée un CV, et corrige également les fautes; Je recommande fortement."</p>
            </div>
        </div>
        <div class="avis" id="avis1">
            <div class="backgroud-avis">
                <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/avis2.svg" alt="">
            </div>
            <div class="avis-texte">
                <p>"Super ! J"ai directement été prise pour un poste. Merci !"</p>
            </div>
        </div>
        <div class="avis">
            <div class="backgroud-avis">
            <img src="<?php echo get_template_directory_uri(); ?>/src/asset/img/avis3.svg" alt="">
            </div>
            <div class="avis-texte">
                <p>"Tres pratique, très rapide et bonne mise en valeur du CV !!! Merci."</p>
            </div>
        </div>

    </section>
</div>

<?php get_footer();
