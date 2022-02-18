<?php

get_header(); ?>

<h1>cv details</h1>

<section id="pdf-cv">
    <div id="my_pdf_viewer">
        <div id="canvas_container">
            <canvas id="pdf_renderer"></canvas>
            <img src="<?php //pdf bdd ?>" alt="">
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


<?php get_footer();