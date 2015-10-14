<?php

function pixova_lite_custom_header_setup() {
    $args = array(
        'default-image'          => '',
        'default-text-color'     => '#000',
        'width'                  => 1920,
        'height'                 => 1080,
        'flex-height'            => true,
    );
 
    $args = apply_filters( 'pixova_lite_custom_header_args', $args );
        add_theme_support( 'custom-header', $args );
}

add_action( 'after_setup_theme', 'pixova_lite_custom_header_setup' );