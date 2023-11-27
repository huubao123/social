<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div id="secondary" class="secondary">

		<?php global $detect; ?>

		<?php ///dynamic_sidebar( 'sidebar-1' ); ?>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php 
					get_search_form();
				?>
				
				<?php if ( $detect->isMobile() ): ?>
				<div class="accodion accodion-w-2">
					<div class="accodion-tab ">
						<input type="checkbox" id="chck_accodion-w-2">
						<label class="accodion-title" for="chck_accodion-w-2"><span><i class="icon-t11"></i> <?php echo __('Bài viết liên quan', 'wp-mango');?> </span> <span class="triangle"><i class="icon-plus"></i></span> </label>
						<div class="accodion-content"> 
						<?php endif;?>

						<?php if(is_archive()):?>
							<?php 	
								// archive
								$categories = get_the_category();
								$category_id = null;
								if(isset($categories) && count($categories) > 1){
									$category_id = $categories[0]->cat_ID;
								}
								
								?>
							<div class="widget-area">
									<div class="widget">
										<h5 class="widget-title"><?php echo __('Bài viết liên quan', 'wp-mango');?> </h5>
										<ul class="recent-post">
												<?php if($category_id != null):?>
													<?php
													$recent_posts = wp_get_recent_posts(
														array(
															'category'    => $category_id,
															'numberposts' => 10, 
															'post_status' => 'publish',
															'offset'      => 10
															// 'orderby' 	  => 'rand' 
													));
													foreach($recent_posts as $post) : ?>
															<li>
																	<a href="<?php echo get_permalink($post['ID']) ?>">
																		<?php echo $post['post_title'] ?>
																	</a>
															</li>
													<?php endforeach; wp_reset_query(); ?>
												<?php endif;?>
										</ul>
									</div>
							</div>
						<?php elseif(is_single()):?>
							<!-- single -->
							<?php 
							
							$categories = get_the_category(get_the_ID());
							$category_id = $categories[0]->cat_ID;
							?>
							<div class="widget-area">
									<div class="widget">
										<h5 class="widget-title"><?php echo __('Bài viết liên quan', 'wp-mango');?> </h5>
										<ul class="recent-post">
												<?php
												$recent_posts = 	wp_get_recent_posts(
													array(
														'category'         => $category_id,
														'numberposts' => 10, 
														'post_status' => 'publish' ,
														'exclude' => get_the_ID()
												));
												foreach($recent_posts as $post) : ?>
														<li>
																<a href="<?php echo get_permalink($post['ID']) ?>">
																	<?php echo $post['post_title'] ?>
																</a>
														</li>
												<?php endforeach; wp_reset_query(); ?>
										</ul>
									</div>
							</div>

						<?php else:?>

							<?php dynamic_sidebar( 'sidebar-2' ); ?>

						<?php endif;?>



						<?php if ( $detect->isMobile() ): ?>
						</div>
					</div>
				</div>
				<?php endif;?>


			
				
				
			</div><!-- .widget-area -->
		<?php endif; ?>

	</div><!-- .secondary -->

<?php endif; ?>
