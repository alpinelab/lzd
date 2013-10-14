<div class="comment_holder" id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'qode' ); ?></p>
			</div><!-- #comments -->
<?php
		
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>

	<ul class="comment-list">
		<?php wp_list_comments(array( 'callback' => 'qode_comment')); ?>
	</ul>


<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php _e('Sorry, the comment form is closed at this time.', 'qode'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit',
	'class_submit' => 'button small black',
	'title_reply'=>'<h5>'. __( 'Post a comment','qode' ) .'</h5>',
	'title_reply_to' => __( 'Leave a Reply to %s','qode' ),
	'cancel_reply_link' => __( 'Cancel Reply','qode' ),
	'label_submit' => __( 'Post Comment','qode' ),
	'comment_field' => '<textarea id="comment" placeholder="'.__( 'comment','qode' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="three_columns clearfix"><div class="column1"><div class="column_inner"><input id="author" name="author" placeholder="'. __( 'name','qode' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="column2"><div class="column_inner"><input id="url" name="url" type="text" placeholder="'. __( 'website','qode' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',
		'email' => '<div class="column3"><div class="column_inner"><input id="email" name="email" placeholder="'. __( 'email','qode' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div></div>'
		 ) ) );
 ?>
 <div class="comment_pager">
	<p><?php paginate_comments_links(); ?></p>
 </div>
 <div class="comment_form">
	<?php comment_form($args); ?>
</div>
						
								
							


