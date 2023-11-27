<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); 

?>
 <?php
  $header = get_field('info', 'option');
  ?>
<div class="banner-page">
	<img style="width: 100%" src="<?php echo $header['banner']['url']?>" alt="">
</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container-fluid">
				
			<?php ma_blognav();?>

				<div class="row grid-space-80">

					<div class="col-md-12 ">
						<?php
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

							$sticky = get_option( 'sticky_posts' );
							$args_nonsticky = array(
									'post__not_in' => $sticky,
									'paged' => $paged
							);
							$args_sticky = array(
									'posts_per_page' => 1,
									'post__in'  => $sticky
							);

							$the_query_sticky = new WP_Query($args_sticky); 
							$the_query_nonsticky = new WP_Query($args_nonsticky);

							if(!$the_query_sticky->have_posts() && !$the_query_nonsticky->have_posts()){
									echo '<h2>NO POSTS FOUND</h2>';
							}
							else{              

								if ( $sticky[0] &&  $paged == 1) {
									while ($the_query_sticky->have_posts()) : $the_query_sticky->the_post(); 
										//sticky if so...
										echo '<div class="row"><div class="col-xs-12 col-md-12 featured">';
											get_template_part( 'content', get_post_format() );
										echo '</div></div>';
									endwhile;
								}
								echo '<div class="row mb-30 list-posts">';
								while ($the_query_nonsticky->have_posts()) : $the_query_nonsticky->the_post(); 
										// non sticky
										echo '<div class="col-xs-12 col-md-3">';
											get_template_part( 'content', get_post_format() );
										echo '</div>';
								endwhile;
								echo '</div>';


								ma_paginate_links($wp_query);

							}
						?>

			
					</div>
					
				</div>

			</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
