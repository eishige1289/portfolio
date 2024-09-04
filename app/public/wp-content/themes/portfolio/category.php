<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tedaadam
 */
get_header();
?>
    <div class="base">
        <?php get_template_part('includes/header'); ?>
        <div class="subpage base-content m-center">
            <section class="heading">
                <div class="wrapper">
                    <div class="heading-hd01 base-flex-center">
                        <h1><?php the_archive_title(); ?></h1>
                    </div>
                    <?php breadcrumb(); ?>
                </div>
            </section>
            <main>
                <section id="category">
                    <div class="wrapper">
                        <div class="category-list">
                        <?php
                            if (have_posts()) :
                                while ( have_posts() ) :the_post();
                                    $terms = get_the_terms(get_the_ID(),(get_post_type()=='post' ? 'category' : 'itemlist_terms'));
                        ?>
                        <a href="<?php the_permalink(); ?>" class="category-item">
                            <div class="thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                <img src="<?php echo esc_url( home_url( '/' ) ); ?>img/ファイル名" alt="<?php the_title(); ?>">
                                <?php endif ; ?>
                            </div>
                            <span class="category-date"><?php echo get_the_date('Y.m.d'); ?></span>
                            <p class="category-title"><?php the_title(); ?></p>
                        </a>
                        <?php endwhile; ?>
                        </div>
                        <div class="news-pagination">
                            <?php
                                if(function_exists('wp_pagenavi')){ wp_pagenavi( ); }
                            ?>
                        </div>
                    </div>
                    <?php
                        wp_reset_postdata();
                        endif;
                    ?>
                </section>
            </main>
        </div>
        <?php get_template_part('includes/footer'); ?>
    </div>
    <?php get_footer(); ?>
