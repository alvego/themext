<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        if ( is_single() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
        endif;
    ?>
<!-- start content -->
	<?php if ( is_search() ) : ?>

		<?php the_excerpt(); ?>

	<?php else : ?>
        
		<?php
			the_content('<span class="meta-nav">&rarr;</span>' );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">Станицы:</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

	<?php endif; ?>
<!-- end content -->
</article>
