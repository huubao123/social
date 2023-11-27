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
<?php
$fields = get_fields(get_the_ID());
// var_dump($fields);die;
?>

<style>
	.article__image--featured img  { display: block ; width: 100%; height: auto; }
</style>

<article  id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-single'); ?>>
	<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title b">', '</h1>' );
		endif;
	?>
	<?php meta_categories(); ?>
	<div class="meta">
		<?php wp_mango_entry_meta(); ?>
	</div>

	<div class="article__image--featured " >
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</div>

	

	<?php if($fields['yt']){ ?>
	<div class="tRes tRes_16_9" >
		<iframe width="560" height="315" src="<?php echo $fields['yt']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<br><br>
	<?php } ?>

	<?php if ( is_single() ) :?>
		<div class="entry-content article__content long-form-content" itemprop="articleBody">
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

		<?php $text = get_field('block_quote');
			if($text):?>
		<div style="margin: 30px 0 50px;font-size: 28px; color: green; 
			font-weight: 700; text-align: justify;">
			<?php echo $text;?>
		</div>
	<?php endif; endif;?>
	<?php if($fields['user'] != false || $fields['sdt'] != false || $fields['email'] != false): ?>
	<div class="info-reservations">
		<h3>Thông tin liên hệ</h3>
		<div class="reservations">
			<div class="lh"><b>Liên hệ:</b> <?php echo $fields['user']?></div>
			<div class="sdt"><b>Số điện thoại:</b> <?php echo $fields['sdt']?></div>
			<div class="emai"><b>Email:</b> <?php echo $fields['email']?></div>
		</div>
	</div>
	<?php endif; ?>
	<?php if ( is_single()):?>
	<div class="author-bio hide--mobile">
		<div class="img">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
		</div>
		<div class="txt">
			
			<div><?php esc_html_e( 'Về tác giả', 'wp_mango' ); ?></div>
			<h3 itemprop="name"><?php the_author_meta('display_name'); ?></h3>
			<?php if(the_author_meta('description')):?>
				<p class="description" itemprop="description"><?php the_author_meta('description'); ?></p>
			<?php endif;?>

		</div>
	
	</div>
	<?php endif;?>


	<!-- <footer class="entry-footer">
		<?php //edit_post_link( __( 'Edit', 'wp-mango' ), '<span class="edit-link">', '</span>' ); ?>
	</footer> -->
	<!-- .entry-footer -->

</article><!-- #post-## -->
