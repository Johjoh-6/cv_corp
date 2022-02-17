<?php

//350 x 250
// add_image_size('img_menu', 130, 130, true);
add_image_size('img_compte', 150, 150, true);


function remove_default_img_sizes($sizes)
{
    // ['thumbnail','medium', 'medium_large', 'large', '1536x1536', '2048x2048'];
    unset($sizes['medium']);
    unset($sizes['large']);
    unset($sizes['medium_large']);
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
}

add_filter('intermediate_image_sizes_advanced' ,'remove_default_img_sizes', 10, 1);