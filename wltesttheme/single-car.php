<?php
get_header();

while (have_posts()) {
    the_post();
    $car_id = get_the_ID();
    ?>

    <div class="single_car">
        <h1><?php the_title(); ?></h1>

        <div class="car-content">
            <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($car_id), 'thumbnail' ); ?>
            <img class="car-image img" src="<?php echo $image_url ?>" alt="Car image">
            <div class="meta-data">
                <div class="car-cat">
                    <?php $brand = get_the_terms($car_id, 'brand'); ?>
                    <span class="p-brand">Brand : <?php echo $brand[0]->name; ?></span>
                    <?php $county = get_the_terms($car_id, 'country'); ?>
                    <span class="p-county">Production country : <?php echo $county[0]->name; ?></span>
                </div>
                <div>
                    Price : <span class="size"><?= number_format(get_post_meta($car_id, "car_price", true), 0, '', ' '); ?></span>
                </div>
                <div class="flex">
                    Color : <div class="color-section" style=" background: <?= get_post_meta($car_id, "car_color", true) ?>;"></div>
                </div>
                <div>
                    Fuel : <span class="size"><?= get_post_meta($car_id, "car_fuel", true) ?></span>
                </div>
                <div>
                    Power : <span class="size"><?= get_post_meta($car_id, "car_power", true) ?></span>
                </div>
            </div>
        </div>

        <div class="car-description">
            <?php the_content(); ?>
        </div>

    </div>

    <?php
}

get_footer();
?>