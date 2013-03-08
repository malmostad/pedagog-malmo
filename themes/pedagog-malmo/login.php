<form name="loginform" id="loginform" action="<?php echo site_url('wp-login.php', 'login_post') ?>" method="post">
<h3 class="widget-title">Logga in för att blogga</h3>
  <p>
    <label><?php _e('Username') ?>:<br />
      <input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr($user_login); ?>" size="20" tabindex="10" />
    </label>
  </p>
  <p>
    <label><?php _e('Password') ?>:<br />
      <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20" />
    </label>
  </p>
  <?php do_action('login_form'); ?>
  <p class="forgetmenot">
    <input name="rememberme" type="checkbox" id="rememberme" value="forever" checked="checked" tabindex="90" />
    <label for="rememberme"><?php esc_attr_e('Remember Me'); ?></label><br/>
    <span>(använd inte på delade datorer)</span>
  </p>
  <p class="submit">
    <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Log In'); ?>" tabindex="100" />
      <?php  if ( $interim_login ) { ?>
      <input type="hidden" name="interim-login" value="1" />
    <?php  } else { ?>
      <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>" />
    <?php   } ?>
    <input type="hidden" name="testcookie" value="1" />
  </p>
</form>
