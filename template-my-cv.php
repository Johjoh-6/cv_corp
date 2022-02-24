<?php

/* Template Name: MyCV */

can_access(['recruiter', 'candidate']);
get_header();

get_template_part('template-parts/content-mycv') ;

get_footer();


