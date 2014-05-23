<?php get_header(); ?>
<?php
if (have_posts()) {
    /* Start the Loop */
    while (have_posts()) {
        the_post();
        get_template_part('content', get_post_format());
    }
} else {
    get_template_part( 'content', 'none' );
}
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>