<?php

/** Errors */
/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);*/

/**
 * Register stylesheets
 */

function theme_scripts(){
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', [], '', true);
 }
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

function customizer_settings( $wp_customize ) {

    $wp_customize->add_section( 'custom_logo_phone_section', array(
        'title' => 'Header settings',
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'custom_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo_control', array(
        'label' => 'Logo',
        'section' => 'custom_logo_phone_section',
        'settings' => 'custom_logo',
    ) ) );

    $wp_customize->add_setting( 'custom_phone', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'custom_phone_control', array(
        'label' => 'Phone',
        'section' => 'custom_logo_phone_section',
        'settings' => 'custom_phone',
        'type' => 'text',
    ) );
}
add_action( 'customize_register', 'customizer_settings' );

function custom_theme_register_car_post_type() {
    $labels = array(
        'name' => 'Cars',
        'singular_name' => 'Car',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Car',
        'edit_item' => 'Edit Car',
        'new_item' => 'New Car',
        'view_item' => 'View Car',
        'search_items' => 'Search Cars',
        'not_found' => 'No cars found',
        'not_found_in_trash' => 'No cars found in trash',
        'parent_item_colon' => '',
        'menu_name' => 'Cars',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'car' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'car', $args );
}
add_action( 'init', 'custom_theme_register_car_post_type' );


function register_brand_taxonomy() {
    $labels = array(
        'name' => 'Brand',
        'singular_name' => 'Brand',
        'search_items' => 'Search Brands',
        'all_items' => 'All Brands',
        'parent_item' => 'Parent Brand',
        'parent_item_colon' => 'Parent Brand:',
        'edit_item' => 'Edit Brand',
        'update_item' => 'Update Brand',
        'add_new_item' => 'Add New Brand',
        'new_item_name' => 'New Brand Name',
        'menu_name' => 'Brand',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'brand' ),
    );

    register_taxonomy( 'brand', 'car', $args );
}
add_action( 'init', 'register_brand_taxonomy' );


function register_country_taxonomy() {
    $labels = array(
        'name' => 'Country',
        'singular_name' => 'Country',
        'search_items' => 'Search Countries',
        'all_items' => 'All Countries',
        'parent_item' => 'Parent Country',
        'parent_item_colon' => 'Parent Country:',
        'edit_item' => 'Edit Country',
        'update_item' => 'Update Country',
        'add_new_item' => 'Add New Country',
        'new_item_name' => 'New Country Name',
        'menu_name' => 'Country',
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'country' ),
    );

    register_taxonomy( 'country', 'car', $args );
}
add_action( 'init', 'register_country_taxonomy' );


function register_car_meta_fields() {
    // Цвет
    add_meta_box( 'car_color_meta_box', 'Color', 'car_color_meta_box_callback', 'car', 'normal', 'high' );
    // Топливо
    add_meta_box( 'car_fuel_meta_box', 'Fuel', 'car_fuel_meta_box_callback', 'car', 'normal', 'high' );
    // Мощность
    add_meta_box( 'car_power_meta_box', 'Power', 'car_power_meta_box_callback', 'car', 'normal', 'high' );
    // Цена
    add_meta_box( 'car_price_meta_box', 'Price', 'car_price_meta_box_callback', 'car', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'register_car_meta_fields' );


function car_color_meta_box_callback($post) {
    $color = get_post_meta($post->ID, 'car_color', true); ?>
    <input type="color" name="car_color" id="car_color" value="<?php echo esc_attr($color); ?>" class="my-color-field" />
    <?php
}

function car_fuel_meta_box_callback( $post ) {
    $fuel = get_post_meta( $post->ID, 'car_fuel', true ); ?>
    <select name="car_fuel" id="car_fuel">
        <option value="petrol" <?php selected( $fuel, 'petrol' ); ?>>Petrol</option>
        <option value="diesel" <?php selected( $fuel, 'diesel' ); ?>>Diesel</option>
        <option value="electric" <?php selected( $fuel, 'electric' ); ?>>Electric</option>
    </select>
    <?php
}

function car_power_meta_box_callback( $post ) {
    $power = get_post_meta( $post->ID, 'car_power', true ); ?>
    <input type="number" name="car_power" id="car_power" value="<?php echo esc_attr( $power ); ?>">
    <?php
}

function car_price_meta_box_callback( $post ) {
    $price = get_post_meta( $post->ID, 'car_price', true ); ?>
    <input type="number" name="car_price" id="car_price" value="<?php echo esc_attr( $price ); ?>">
    <?php
}

function save_car_meta_fields( $post_id ) {
    if ( isset( $_POST['car_color'] ) ) {
        update_post_meta( $post_id, 'car_color', sanitize_text_field( $_POST['car_color'] ) );
    }
    if ( isset( $_POST['car_fuel'] ) ) {
        update_post_meta( $post_id, 'car_fuel', sanitize_text_field( $_POST['car_fuel'] ) );
    }
    if ( isset( $_POST['car_power'] ) ) {
        update_post_meta( $post_id, 'car_power', intval( $_POST['car_power'] ) );
    }
    if ( isset( $_POST['car_price'] ) ) {
        update_post_meta( $post_id, 'car_price', intval( $_POST['car_price'] ) );
    }
}
add_action( 'save_post_car', 'save_car_meta_fields' );

add_action( 'after_setup_theme', 'add_post_thumbnail_supports', 99 );
function add_post_thumbnail_supports() {
    add_theme_support( 'post-thumbnails' );
}

function recent_cars_shortcode() {
    $args = array(
        'post_type'      => 'car',
        'posts_per_page' => 10,
    );

    $query = new WP_Query($args);

    $output = '<ul>';
    while ($query->have_posts()) {
        $query->the_post();
        $output .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    }
    $output .= '</ul>';

    wp_reset_postdata();

    return $output;
}
add_shortcode('recent_cars', 'recent_cars_shortcode');




