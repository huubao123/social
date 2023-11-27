<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header();

?>
	<main class="l-main">
		<div class="container">
			<div id="wrapper" class="content-wrapper clearfix ">
					<div class="row">
							<div class="page-error text-center">
									<span>
											40<span>4</span>
									</span>
									<div class="">
											<div class="error-text text-center">
													<h1>Oops!</h1>
													<h4>Something has gone wrong and the page could not be displayed. <br>  <br> <a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Try the home page.</a>	</h4>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
</main>

<?php get_footer(); ?>
