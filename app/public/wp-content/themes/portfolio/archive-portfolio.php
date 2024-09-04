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
 * @package tedaadam
 */
get_header();
?>
<?php get_template_part('includes/header'); ?>
    <div class="layer-results">
        <div class="wrapper">
            <h2>Portfolio</h2>
            <?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
            <div class="layer-results-box">
                <ul class="archive-list">
                <?php
                // アーカイブ用のサブループ
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = [
                    'post_type' => 'portfolio',
                    'posts_per_page' => 9, // 1ページあたりの件数
                    'paged' => $paged, // 現在のページ番号（何ページ目か）
                ];
                $my_query = new WP_Query( $args );
                if( $my_query->have_posts() ):
                    while( $my_query->have_posts() ): $my_query->the_post();
                ?>
                <li class="archive-list-wrapper">
                    <?php
                        $img  = get_field('portfolio_thm');
                        $txt = get_field('portfolio_txt');
                        $types = get_field('portfolio_type');
                    ?>
                    <article class="achieve-card">
                        <?php if ( has_post_thumbnail()): ?>
                        <div class="achieve-card-img"><?php the_post_thumbnail('full'); ?></div>
                        <?php else: ?>
                        <div class="achieve-card-img"></div>
                        <?php endif; ?>
                        <div class="achieve-card-txt">
                        <h3><?php the_title(); ?></h3>
                        <p class="achieve-card-excerpt"><?php the_excerpt(); ?></p>
                        <?php if( $types ): ?>
                        <p class="achieve-card-label">
                            <?php foreach( $types as $type ): ?>
                            <span class="label-<?php echo $type['value']; ?>"><?php echo $type['label']; ?></span>
                            <?php endforeach; ?>
                        </p>
                        <?php endif; ?>
                        </div>
                        <div class="achieve-card-btn">
                            <a href="<?php the_permalink(); ?>" target="_blank">more</a>
                        </div>
                    </article>
                    <?php
                    endwhile;
                    // wp_pagenavi( [ 'query' => $my_query ] );
                endif;
                wp_reset_postdata();
                ?>
                </ul>
                <p class="caption">他、案件についても追加予定です。</p>
            </div>
        </div>
    </div>
<?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>
