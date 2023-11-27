<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Không tìm thấy', 'wp-mango' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( '.', '' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		
		<?php else : ?>

			<p><?php _e( 'xin lỗi !, Bạn có thể thử lại với tìm kiếm khác', 'wp-mango' ); ?></p>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
