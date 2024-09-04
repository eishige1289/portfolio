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
    <div class="base content-page">
    <?php if(have_posts()) :?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="wrapper">
                <h2><?php the_title(); ?></h2>
                <?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
                <div class="content-page-box">
                    <p>404 Error<br />
                        Not Found<br />
                        お探しのページはみつかりませんでした。<br />
                        <br />
                        掲載期間が終了し削除されたか、別の場所に移動された可能性があります。<br />
                        <br />
                        こちらから<a href="<?php echo home_url(); ?>">TOPに戻れます。</a>
                        引き続きウェブサイトをご利用ください。</p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
