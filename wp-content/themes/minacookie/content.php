<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>
	
	<?php meta_categories(); ?>
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
					the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			endif;
		?>
	<div class="des"><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></div>
	<div class="meta">
		<?php wp_mango_entry_meta(); ?>
	</div>

	<?php if ( is_single() ) :?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'wp-mango' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wp-mango' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'wp-mango' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif;?>
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<!-- <footer class="entry-footer">
		<?php //edit_post_link( __( 'Edit', 'wp-mango' ), '<span class="edit-link">', '</span>' ); ?>
	</footer> -->
	<!-- .entry-footer -->

</article><!-- #post-## -->
