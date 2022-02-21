<?php

/* Template Name: Dashboard */

get_header(); 

can_access();
?>
<section id="dashboard">
    <div class="container_dash">
        <div class="container_profil">
            <h2>Journal de board</h2>
                <div class="box_profil">
                    <img src="" alt="ici photo du recruteur">
                    <p>Recruteur chez : Bouygue</p>
                    <p>Charger de Recrutement Tech</p>
                </div>
        </div>
    </div>

    <div class="visuel_profil">
        <div class="box_recherche">
            <form action="">
                <div>
                    <input class="cta_recherche" type="text" name="recherche" id="" value="Recherche un Candidats ">
                    
                </div>
            </form>
        </div>

    <div class="container_candidat">
            <div class="box_candidat">
                <div class="box_candidat_1">
                    <div class="candidat_picture">
                        <img src="" alt="ici photo du candidat">
                    </div>
                        <div class="box_text_profil_candidat">
                            <p>Nom :</p>
                            <p>Prénom :</p>
                            <p>Offret : Techiciens</p>
                                <div class="cta_candit">
                                    <a href="">Voir CV</a>
                                </div>
                        </div>
                </div>
            </div>
            <div class="box_candidat">
                <div class="box_candidat_1">
                    <div class="candidat_picture">
                        <img src="" alt="ici photo du candidat">
                    </div>
                        <div class="box_text_profil_candidat">
                            <p>Nom :</p>
                            <p>Prénom :</p>
                            <p>Offret : Techiciens</p>
                                <div class="cta_candit">
                                    <a href="">Voir CV</a>
                                </div>
                        </div>
                </div>
            </div>

    </div>


    </div>
</section>


<?php get_footer();