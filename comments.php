<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<div class="comments-heading">
			<h3>
				<?php
				$comment_count = get_comments_number();
				printf(
					/* translators: %s: number of comments */
					esc_html( _n( '%s Comment', '%s Comments', $comment_count, 'heartly' ) ),
					sprintf( '%02d', $comment_count )
				);
				?>
			</h3>
		</div>
		<?php the_comments_navigation(); ?>
		<div class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'div',
				'short_ping'  => true,
				'avatar_size' => 70,
				'callback'    => 'heartly_comment_callback',
			) );
			?>
		</div>
		<?php
		the_comments_navigation();
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'heartly' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<div class="comment-form-wrap">
		
		<?php comment_form(); ?>
	</div>
</div>
