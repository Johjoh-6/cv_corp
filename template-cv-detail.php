<?php
/* Template Name: CV Detail*/

get_header(); 
//For get the current user
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);

//For get the current CV
$id_cv = $_GET['cv'];
$cv = getCvById($id_cv);
debug($cv);
?>

<h1>cv details</h1>

<section id="pdf-cv">
    <div class="box-info-cv">
        <img src="<?= asset('img/photo-profil-test.png')?>" alt="photoProfil">
        <div class="info-cv">
            <p>Prenom : <?php ?></p>
            <p>Nom : <?php ?></p>
        </div>
    </div>
    <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
            <img src="<?php //pdf bdd ?>" alt="">
            <div class="btn-modif">
                <a href="">modifier</a>
            </div>
        </div>
        <!--changement de page navigation-->
        <!--
        <div id="navigation_controls">
            <button id="go_previous">Previous</button>
            <input id="current_page" value="1" type="number"/>
            <button id="go_next">Next</button>
        </div>-->
        <div id="zoom_controls">
            <button id="zoom_in">+</button>
            <button id="zoom_out">-</button>
        </div>
        
    </div>
</section>
<button id="getPdf" data-fisrt-name="<?=  metaField($meta_user, 'first_name');?>" data-last-name="<?=  metaField($meta_user, 'last_name');?>">Click here</button>


<?php get_footer();