<?php
/**
 * Output a complete commenting form for use within a template.
 *
 * Most strings and form fields may be controlled through the $args array passed
 * into the function, while you may also choose to use the comment_form_default_fields
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the form comment_form_field_$name where $name is the key used
 * in the array of fields.
 *
 * @since 3.0.0
 *
 * @param array       $args {
 *     Optional. Default arguments and form fields to override.
 *
 *     @type array $fields {
 *         Default comment fields, filterable by default via the 'comment_form_default_fields' hook.
 *
 *         @type string $author Comment author field HTML.
 *         @type string $email  Comment author email field HTML.
 *         @type string $url    Comment author URL field HTML.
 *     }
 *     @type string $comment_field        The comment textarea field HTML.
 *     @type string $must_log_in          HTML element for a 'must be logged in to comment' message.
 *     @type string $logged_in_as         HTML element for a 'logged in as <user>' message.
 *     @type string $comment_notes_before HTML element for a message displayed before the comment form.
 *                                        Default 'Your email address will not be published.'.
 *     @type string $comment_notes_after  HTML element for a message displayed after the comment form.
 *                                        Default 'You may use these HTML tags and attributes ...'.
 *     @type string $id_form              The comment form element id attribute. Default 'commentform'.
 *     @type string $id_submit            The comment submit element id attribute. Default 'submit'.
 *     @type string $title_reply          The translatable 'reply' button label. Default 'Leave a Reply'.
 *     @type string $title_reply_to       The translatable 'reply-to' button label. Default 'Leave a Reply to %s',
 *                                        where %s is the author of the comment being replied to.
 *     @type string $cancel_reply_link    The translatable 'cancel reply' button label. Default 'Cancel reply'.
 *     @type string $label_submit         The translatable 'submit' button label. Default 'Post a comment'.
 *     @type string $format               The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
 * }
 * @param int|WP_Post $post_id Post ID or WP_Post object to generate the form for. Default current post.
 */
function pm_comment_form( $args = array(), $post_id = null ) {
  if ( null === $post_id )
    $post_id = get_the_ID();
  else
    $id = $post_id;

  $commenter = wp_get_current_commenter();
  $user = wp_get_current_user();
  $user_identity = $user->exists() ? $user->display_name : '';

  $args = wp_parse_args( $args );
  if ( ! isset( $args['format'] ) )
    $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

  $req      = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $html5    = 'html5' === $args['format'];
  $fields   =  array(
    'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
    'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                '<input id="email" class="form-control" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
    'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                '<input id="url" class="form-control" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
  );

  $required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

  /**
   * Filter the default comment form fields.
   *
   * @since 3.0.0
   *
   * @param array $fields The default comment fields.
   */
  $fields = apply_filters( 'comment_form_default_fields', $fields );
  $defaults = array(
    'fields'               => $fields,
    'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
    /** This filter is documented in wp-includes/link-template.php */
    'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
    /** This filter is documented in wp-includes/link-template.php */
    'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
    'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
    'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit',
    'title_reply'          => __( 'Leave a Reply' ),
    'title_reply_to'       => __( 'Leave a Reply to %s' ),
    'cancel_reply_link'    => __( 'Cancel reply' ),
    'label_submit'         => __( 'Post Comment' ),
    'format'               => 'xhtml',
  );

  /**
   * Filter the comment form default arguments.
   *
   * Use 'comment_form_default_fields' to filter the comment fields.
   *
   * @since 3.0.0
   *
   * @param array $defaults The default comment form arguments.
   */
  $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

  ?>
    <?php if ( comments_open( $post_id ) ) : ?>
      <?php
      /**
       * Fires before the comment form.
       *
       * @since 3.0.0
       */
      do_action( 'comment_form_before' );
      ?>
      <div id="respond" class="comment-respond">
        <h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
        <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
          <?php echo $args['must_log_in']; ?>
          <?php
          /**
           * Fires after the HTML-formatted 'must log in after' message in the comment form.
           *
           * @since 3.0.0
           */
          do_action( 'comment_form_must_log_in_after' );
          ?>
        <?php else : ?>
          <form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form basic mf-v4"<?php echo $html5 ? ' novalidate' : ''; ?>>
            <?php
            /**
             * Fires at the top of the comment form, inside the <form> tag.
             *
             * @since 3.0.0
             */
            do_action( 'comment_form_top' );
            ?>
            <?php if ( is_user_logged_in() ) : ?>
              <?php
              /**
               * Filter the 'logged in' message for the comment form for display.
               *
               * @since 3.0.0
               *
               * @param string $args_logged_in The logged-in-as HTML-formatted message.
               * @param array  $commenter      An array containing the comment author's
               *                               username, email, and URL.
               * @param string $user_identity  If the commenter is a registered user,
               *                               the display name, blank otherwise.
               */
              echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
              ?>
              <?php
              /**
               * Fires after the is_user_logged_in() check in the comment form.
               *
               * @since 3.0.0
               *
               * @param array  $commenter     An array containing the comment author's
               *                              username, email, and URL.
               * @param string $user_identity If the commenter is a registered user,
               *                              the display name, blank otherwise.
               */
              do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
              ?>
            <?php else : ?>
              <?php echo $args['comment_notes_before']; ?>
              <?php
              /**
               * Fires before the comment fields in the comment form.
               *
               * @since 3.0.0
               */
              do_action( 'comment_form_before_fields' );
              foreach ( (array) $args['fields'] as $name => $field ) {
                /**
                 * Filter a comment form field for display.
                 *
                 * The dynamic portion of the filter hook, $name, refers to the name
                 * of the comment form field. Such as 'author', 'email', or 'url'.
                 *
                 * @since 3.0.0
                 *
                 * @param string $field The HTML-formatted output of the comment form field.
                 */
                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
              }
              /**
               * Fires after the comment fields in the comment form.
               *
               * @since 3.0.0
               */
              do_action( 'comment_form_after_fields' );
              ?>
            <?php endif; ?>
            <?php
            /**
             * Filter the content of the comment textarea field for display.
             *
             * @since 3.0.0
             *
             * @param string $args_comment_field The content of the comment textarea field.
             */
            echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
            ?>
            <?php echo $args['comment_notes_after']; ?>
            <div class="form-group">
              <div class="controls">
                <p class="form-submit">
                  <input name="submit" type="submit" class="btn btn-primary" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
                  <?php comment_id_fields( $post_id ); ?>
                </p>
              </div>
            </div>
            <?php
            /**
             * Fires at the bottom of the comment form, inside the closing </form> tag.
             *
             * @since 1.5.0
             *
             * @param int $post_id The post ID.
             */
            do_action( 'comment_form', $post_id );
            ?>
          </form>
        <?php endif; ?>
      </div><!-- #respond -->
      <?php
      /**
       * Fires after the comment form.
       *
       * @since 3.0.0
       */
      do_action( 'comment_form_after' );
    else :
      /**
       * Fires after the comment form if comments are closed.
       *
       * @since 3.0.0
       */
      do_action( 'comment_form_comments_closed' );
    endif;
}?>