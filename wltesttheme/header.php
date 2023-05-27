<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php bloginfo( 'name' ); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;600;700;800&family=Raleway:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;700;900&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header" class="header">

        <div class="fixed-header">
            <div class="brand-box">
                <a href="<?= site_url('/') ?>">
                    <?php $logo_url = get_theme_mod( 'custom_logo' ); ?>
                    <img src="<?= $logo_url ?>" class="site-logo" alt="logo">
                </a>
            </div>
            <div class="call-now">
                <?php
                   $phone_number = get_theme_mod( 'custom_phone' );
                ?>
                <a href="tel:<?= $phone_number ?>" class="call-btn"><span><?= $phone_number ?></span></a>
            </div>
        </div>


        <div class="text-box">
            <h1 class="heading-primary">
                <span class="heading-primary-main"><?php echo get_bloginfo( 'name' ); ?></span>
                <span class="heading-primary-sub"><?php echo get_bloginfo( 'description' );  ?></span>
            </h1>
            <a href="<?php if ( is_front_page() ) {
               echo '#car-catalog';
            } else {
                echo site_url('/');
            } ?>" class="btn btn-white btn-animated">Our catalog</a>
        </div>

</header>
<main class="main">