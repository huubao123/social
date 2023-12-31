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

get_header(); ?>


<div class="banner-page">
	<img style="width: 100%" src="<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url(); ?>" alt="">
</div>

	<section id="primary"  class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container-fluid">

					<?php ma_blognav();?>

					<div class="row grid-space-80">

						<div class="col-md-12">
						

							<div class="row mb-30 list-posts">
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

							// If no content, include the "No posts found" template.
							else :
								echo '<div class="col-xs-12">';
								get_template_part( 'content', 'none' );
								echo '</div>';

							endif;
							?>
							</div>

							<?php ma_paginate_links($wp_query); ?>

						</div>
				</div>
					

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
