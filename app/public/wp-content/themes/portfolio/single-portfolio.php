<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EriIshige
 */
get_header();
?>
    <?php get_template_part('includes/header'); ?>
    <div class="base single-portfolio-page">
    <?php if(have_posts()) :?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="wrapper">
                <h2><?php the_title(); ?></h2>
            <?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
                <div class="single-page">
                    <?php the_content(); ?>
                </div>
                <div class="page-navi">
                    <?php
                    if (get_previous_post()) {
                        previous_post_link('%link', '<<戻る');
                    }
                    ?>
                    <a href="<?php echo home_url(); ?>/portfolio/">TOP</a>
                    <?php
                    if (get_next_post()) {
                        next_post_link('%link', '次へ＞＞');
                    }
                    ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>

