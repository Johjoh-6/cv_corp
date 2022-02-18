<?php

/* Template Name: home */


get_header(); ?>

<div class="wrap">

    <section id="intro">
        <img src="<?= asset('img/imgIntro.png')?>" alt="image intro">
        <div class="text-intro">
            <div class="texte">
                <p>Générateur de CV simple, facile et rapide</p>
            </div>
            <diV class="intro-btn">
                <a href="<?= path('/register'); ?>">Incription</a>
                <a href="<?= path('/login'); ?>">Connexion</a>
            </diV>
        </div>
    </section>

    <section id="partenaire">
        <h2>Ils nous font confiance : </h2>
        <div class="keyframe">
            <div class="logo-entreprise">
                <ul>
                    <li><img src="<?= asset('img/decatlon.png')?>" alt=""></li>
                    <li><img src="<?= asset('img/normandie.png')?>" alt=""></li>
                    <li><img src="<?= asset('img/bouygues.png')?>" alt=""></li>
                </ul> 
            </div>
        </div>
    </section>

    <section id="fonction">
        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull1.svg')?>" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Sélection de CV</h2>
                <p>Choisissez un CV parmi tous nos modèles.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull2.svg')?>" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Crée un CV</h2>
                <p>Remplissez vos experiances et compétances avec nos phrases prêtes à l'emploi.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull3.svg"')?>" alt="">
            </div>
            <div class="fonction-texte">
                <h2>Téléchargement PDF</h2>
                <p>Téléchargez, imprimez et envoyer votre CV à volonté.</p>
            </div>
        </div>
    </section>

    <section id="avis">
        <div class="avis-box">
            <div class="backgroud-avis">
                <img src="<?= asset('img/avis1.svg')?>" alt="">
            </div>
            <div class="avis-texte">
                <p>"Un exenllent service, à l'écoute et efficace. Large gamme proposée pour crée un CV, et corrige également les fautes; Je recommande fortement."</p>
            </div>
        </div>
        <div class="avis-box">
            <div class="backgroud-avis">
                <img src="<?= asset('img/avis2.svg')?>" alt="">
            </div>
            <div class="avis-texte">
                <p>"Super ! J"ai directement été prise pour un poste. Merci !"</p>
            </div>
        </div>
        <div class="avis-box">
            <div class="backgroud-avis">
                <img src="<?= asset('img/avis3.svg')?>" alt="">
            </div>
            <div class="avis-texte">
                <p>"Tres pratique, très rapide et bonne mise en valeur du CV !!! Merci."</p>
            </div>
        </div>

    </section>
</div>

<?php get_footer();
