<?php
/*
 * Template Name: Home
 */
global $post;
get_header();
the_post();


?>
    <section class="main-section">
        <div class="container">
            <div class="main-section-content">
                <div class="text-preview">
                    <h1><?php the_title() ?></h1>
                </div>
                <div class="content-inform">
                    <p><?php the_content(); ?></p>

                    <div class="car-list">
                        <?php echo do_shortcode('[recent_cars]'); ?>
                    </div>
                    <h2 class="header-catalog">Car catalog</h2>
                    <div id="car-catalog" class="container page-wrapper">
                        <div class="page-inner">
                            <div class="row">
                                <?php
                                $query = array(
                                    'post_type' => 'car' ,
                                    'post_status' => 'publish' ,
                                    'posts_per_page' => -1,
                                ) ;

                                $loop = new WP_Query( $query);

                                while ($loop->have_posts()) {
                                    $loop->the_post();
                                    $car_id = get_the_ID(); ?>

                                    <div class="el-wrapper">
                                        <div class="box-up">
                                            <?php $image_url = wp_get_attachment_url( get_post_thumbnail_id($car_id), 'thumbnail' ); ?>
                                            <img class="img" src="<?php echo $image_url ?>" alt="Car image">

                                        </div>
                                        <div class="img-info">
                                            <div class="info-inner">
                                                <span class="p-name"><?php the_title() ?></span>
                                                <?php $terms = get_the_terms($car_id, 'brand'); ?>
                                                <span class="p-company"><?php echo $terms[0]->name; ?></span>
                                            </div>
                                        </div>
                                        <div class="box-down">
                                            <span class="price">$<?= number_format(get_post_meta($car_id, "car_price", true), 0, '', ' '); ?></span>
                                            <a href="<?= get_permalink() ?>" class="btn btn-blue btn-animated">More details</a>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer();
