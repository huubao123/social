<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

// get_header(); ?>
<?php
	get_header();
?>

<!-- <section class="section background-lowlight color-white section--tight blog__home-header blog__header--blog lazy-hidden" 
	data-lazy-type="bg" data-lazy-src="<?php	//he_post_thumbnail_url('full'); ?>" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-9">
				<h1 class="section-heading__heading heading--jumbo"> <?php //echo __('Khám phá kho tàng kiến thức','wp-mango');?></h1>
				<p class="section-heading__subhead heading--3 blog__subhead--blog" tag="p">
					<?php //echo __('Trung tâm kiến thức MangoAds sẽ mang đến cho bạn những kiến thức hữu ích, có thể ứng dụng vào thực tế công việc.','wp-mango');?>
				</p>
			</div>
		</div>
	</div>
</section> -->

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<div class="container-fluid">

		<div class="row grid-space-80">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
		
				<div class="the_breadcrumb" style="margin-top: 30px;"><?php the_breadcrumb();?></div>

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						/*
						* Include the post format-specific template for the content. If you want to
						* use this in a child theme, then include a file called content-___.php
						* (where ___ is the post format) and that will be used instead.
						*/
						get_template_part( 'content', 'single' );

						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

					endwhile;
					?>
				</div>
			
			</div><!-- .row -->

		</div><!-- .container-fluid -->

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
