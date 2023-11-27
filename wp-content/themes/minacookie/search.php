<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();
?>

<style>
	.p-search1 .page-title { margin-top: -17px; }
</style>


<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1 class="page-title section-heading__heading heading--jumbo" style="text-align: center;margin-top: 20px;">
				<?php

				$custom_seo = get_option('wporg_options');
				if ($custom_seo) {
					global $wp_query;
				  	if ( isset($custom_seo['wporg_field_show']) && $custom_seo['wporg_field_show'] != '' ) {
				  		$title = str_replace('[number]', $wp_query->found_posts, $custom_seo['wporg_field_show']);
				  		$title = str_replace('[keyword]', get_search_query(), $title);
				  	}

				  	echo $title;
				  } else {
				  	printf( __( 'Danh sách tìm kiếm %s', 'wp-mango' ), get_search_query() );
				  }
				/* translators: %s: Search query. */
				// printf( __( 'Kết quả tìm kiếm:', 'wp-mango' ) );

				
				?>


				</h1>

			</div>
		</div>
	</div>
</section>



	<section id="primary"  class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container-fluid">

					<?php ma_blognav();?>

					<div class="row grid-space-80">
						
						<div class="col-md-12">
							<div class="row mb-30">
							<?php if ( have_posts() ) : ?>
								
								<?php
								// Start the Loop.
								while ( have_posts() ) : the_post();

									/*
									* Include the Post-Format-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Format name) and that will be used instead.
									*/
									echo '<div class="col-xs-12 col-md-3">';
									get_template_part( 'content', get_post_format() );
									echo '</div>';

									
								// End the loop.
								endwhile;



								// Previous/next page navigation.
								/*the_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
									'next_text'          => __( 'Next page', 'twentyfifteen' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
								) );
								*/

							// If no content, include the "No posts found" template.
							else :
								get_template_part( 'content', 'none' );

							endif;
							?>
							</div>

							<?php 	
						
								ma_paginate_links($wp_query); ?>

						</div>
				</div>
					

		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php get_footer(); ?>
