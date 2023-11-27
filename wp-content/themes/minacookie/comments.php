<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<?php //twentyfifteen_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
				) );
			?>
		</ol>

		<?php //twentyfifteen_comment_nav(); ?>

		<div class="c-page c-page-numbers">
		<?php
			the_comments_pagination( array(
				'prev_text' => __("<i class=\"icon iconmoon-back1\"></i>"),
				'next_text' => __("<i class=\"icon iconmoon-next\"></i>")
			));
		?>
		</div>
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
	<?php endif; ?>

	<?php 
		//Declare Vars
		$comment_send = 'Gửi bình luận';
		$comment_title = 'Viết bình luận';
		//$comment_reply = 'Leave a Message';
		//$comment_reply_to = 'Reply';
		 
		$comment_author = 'Tên của bạn';
		$comment_email = 'Mail của bạn';
		$comment_body = 'Nhập nội dung';
		$comment_url = '';
		$comment_cookies_1 = 'Lưu tên, email vào lần bình luận kế tiếp của tôi';
		 
		//Array
		$comments_args = array(
	    //Define Fields
	    'fields' => array(
        //Author field
        'author' => '<div class="c-form1__info form1_info1">
                      <input id="author" name="author" aria-required="true" placeholder="' . $comment_author .'*"></input>
                    </div>',
        //Email Field
        'email' => '<div class="c-form1__info form1_info1">
                      <input id="email" name="email" aria-required="true" placeholder="' . $comment_email .'*"></input>
                    </div>',
        'cookies' => '<p class="comment-form-cookies-consent">
        				<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" checked="checked">
        				<label for="wp-comment-cookies-consent">'. $comment_cookies_1 .'.</label>
        			  </p>'
      ),
	    // Change the title of send button
	    'label_submit' => __( $comment_send ),
	    'comment_field' => '<div class="c-form1__info">
                      			<textarea id="comment" name="comment" rows="10" aria-required="true" placeholder="' . $comment_body .'"></textarea>
                    			</div>',
	    'class_form' => 'comment-form c-form1',
	    'comment_notes_before' => '',
	    'logged_in_as' => '',
	    'title_reply' => $comment_title,
	    'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title c-comment__title1">',
	    'title_reply_after' => '</h3>',
	    'cancel_reply_before' => '',
	    'cancel_reply_after' => '',
	    'cancel_reply_link' => ' ',
		);
		comment_form($comments_args);
	?>

</div><!-- .comments-area -->
