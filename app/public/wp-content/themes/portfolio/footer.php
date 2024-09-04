<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package EriIshige
 */
?>
<!-- JavaScript start -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/pep/0.4.3/pep.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/common/js/splide-extension-auto-scroll.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/common/js/bable.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/common/js/top.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/common/js/general.js"></script>
<?php wp_footer(); ?>
</body>
</html>
