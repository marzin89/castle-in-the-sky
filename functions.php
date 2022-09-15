<?php
// Stöd för utvald bild med olika storlekar
function add_thumbnail_support() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'mobil', '460', '250' );
    add_image_size( 'desktop', '580', '315' );
    add_image_size( 'employee-img-mobil', '360', '360' );
    add_image_size( 'employee-img-tablet', '460', '460' );
    add_image_size( 'employee-img-desktop', '380', '380' );
}
add_action( 'after_setup_theme', 'add_thumbnail_support' );
// Registrera menyer
function register_menu() {
    register_nav_menus( array(
        'main-nav' => 'Huvudmeny',
        'subnav'   => 'Undermeny',
    ) );   
}
add_action( 'init', 'register_menu' );
// Registrera widgetområde
function register_widget_area() {
    register_sidebar( array(
        'name'          => 'Widgetområde',
        'id'            => 'widget-area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'register_widget_area' );
// Räkna/returnera antal inlägg
function count_posts( $category ) {
    if ( is_string( $category ) ) {
        $cat_id = get_cat_ID( $category );
    } else if ( is_numeric( $category ) ) {
        $cat_id = $category;
    } else {
        return 0;
    }
    $cat = get_category( $cat_id );
    return $cat->count;
}

