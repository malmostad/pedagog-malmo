<div class="clear"></div>
<div class="comments">
	<?php if (post_password_required()) : ?>
	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'pedagog' ); ?></p>
</div>
<?php return; endif; ?>
<?php if (have_comments()) : ?>
<h3><?php comments_number(); ?></h3>
	<ul>
		<?php wp_list_comments('type=comment&callback=pedagogcomments'); // Custom callback in functions.php ?>
	</ul>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<div class="comments-closed">
    <h3>Kommentering är stängd</h3>
  </div>

<?php endif; ?>
  <?php pm_comment_form(); ?>
</div>
