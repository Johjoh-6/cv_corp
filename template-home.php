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
                <?php if(is_user_logged_in()){
						if (getRoleCurrentUser() === 'candidate'){ ?>
                            <a href="<?= path('/mycv'); ?>" >Mes CV</a>
                        <?php }elseif (getRoleCurrentUser() === 'recruiter' || getRoleCurrentUser() === 'administrator'){ ?>
                            <a href="<?= path('/dashboard'); ?>">Dashboard</a>
                        <?php } ?>
                        
                <?php } else { ?>
                    <a href="<?= path('/register'); ?>">Incription</a>
                    <a href="<?= path('/login'); ?>">Connexion</a>
                <?php } ?>
            </diV>
        </div>
    </section>

    <section id="partenaire">
        <h2>Ils nous font confiance : </h2>
            <div class="logo-entreprise">
                <ul>
                    <li><img src="<?= asset('img/decatlon.png')?>" alt="img-decatlon"></li>
                    <li><img src="<?= asset('img/normandie.png')?>" alt="img-normandie"></li>
                    <li><img src="<?= asset('img/bouygues.png')?>" alt="img-bouygues"></li>
                </ul> 
            </div>
    </section>

    <section id="fonction">
        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull1.svg')?>" alt="img-bull1">
            </div>
            <div class="fonction-texte">
                <h2>Sélection de CV</h2>
                <p>Choisissez un CV parmi tous nos modèles.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull2.svg')?>" alt="img-bull2">
            </div>
            <div class="fonction-texte">
                <h2>Crée un CV</h2>
                <p>Remplissez vos experiences et compétences avec nos fonctions prêtes à l'emploi.</p>
            </div>
        </div>

        <div>
            <div class="backgroud-circle">
                <img src="<?= asset('img/bull3.svg"')?>" alt="img-bull3">
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
                <img src="<?= asset('img/avis1.svg')?>" alt="img-avies1">
            </div>
            <div class="avis-texte">
                <p>"Un excellent service, à l'écoute et efficace. Large gamme d'outils proposés pour créer un CV; Je recommande fortement."</p>
            </div>
        </div>
        <div class="avis-box">
            <div class="backgroud-avis">
                <img src="<?= asset('img/avis2.svg')?>" alt="img-avies2">
            </div>
            <div class="avis-texte">
                <p>"Super ! J'ai directement été prise pour un poste. Merci !"</p>
            </div>
        </div>
        <div class="avis-box">
            <div class="backgroud-avis">
                <img src="<?= asset('img/avis3.svg')?>" alt="img-avies3">
            </div>
            <div class="avis-texte">
                <p>"Très pratique, très rapide et bonne mise en valeur du CV !!! Merci."</p>
            </div>
        </div>

    </section>
</div>

<?php get_footer();
