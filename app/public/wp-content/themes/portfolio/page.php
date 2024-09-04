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
<?php
    global $wp_query;
    global $post;
    $post_id = $post->ID;//ID取得
    $post_obj = $wp_query->get_queried_object();
    $slug = $post_obj->post_name;  //投稿や固定ページのスラッグ
    $cat_slug = $post_obj->category_nicename;  //カテゴリーアーカイブページのスラッグ
    $tag_slug = $post_obj->slug;  //タグアーカイブページスラッグ
    $parent_id = $post->post_parent; // 親ページのIDを取得
    $parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
?>
    <?php get_template_part('includes/header'); ?>
    <div class="base content-page">
    <?php if(have_posts()) :?>
            <?php while (have_posts()) : the_post(); ?>
            <div class="wrapper">
                <h2><?php the_title(); ?></h2>
                <?php if( function_exists( 'aioseo_breadcrumbs' ) ) aioseo_breadcrumbs(); ?>
                <div class="content-page-box <?php echo $slug; ?>">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
    <?php get_template_part('includes/footer'); ?>
<?php get_footer(); ?>

