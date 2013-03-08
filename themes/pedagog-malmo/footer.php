<?php
/**
 * The template for displaying the footer.
 */
?>

<div id="footer" class="clearfix" role="contentinfo">
  <div id="social">
    <div id="twitter-follow">
      <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="pedagogmalmo">Twittra</a>
    </div>
    <div class="fb-like">
      <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwebapps2.malmo.se%2Fpedagogmalmo&amp;send=false&amp;layout=button_count&amp;width=76&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21&amp;appId=239676289414904" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
    </div>
    <div id="g-plusone-global"><div class="g-plusone" data-size="medium"></div></div>
  </div>

  <div class="colophon">
    <?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
      <?php dynamic_sidebar( 'footer-widget-area' ); ?>
    <?php endif; ?>
  </div>

</div>

<!-- end the mega-wrapper -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
  log_db_queries();
	wp_footer();
?>
</body>
</html>
