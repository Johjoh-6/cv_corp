<?php

// Role custom

$wp_roles = new WP_Roles();
$wp_roles->remove_role("candidate");
add_role( 'candidate', 'Candidat / candidate',  array(
        'read' => true
    ) );
$wp_roles = new WP_Roles();
$wp_roles->remove_role("recruiter");
add_role( 'recruiter', 'Recruteur / recruteuse',  array(
        'read' => true
    ) );

    //Make 'candidate' a default role

update_option('default_role','candidate');