	</div>
	<footer class="footer" role="contentinfo">
		<div class="footer__wrapper">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="social-buttons">
	    				<div class="twitter-follow">
	      				<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="pedagogmalmo">Twittra</a>
	    				</div>
	    				<div class="fb-like">
	      				<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwebapps2.malmo.se%2Fpedagogmalmo&amp;send=false&amp;layout=button_count&amp;width=76&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21&amp;appId=239676289414904" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
	    				</div>
	    				<div class="google-plus-one" id="g-plusone-global"><div class="g-plusone" data-size="medium"></div></div>
	  				</div>
						<?php global $wp_query; ?>
						<?php if ( is_singular( 'post' ) || is_author() || $wp_query->query['post_type'] == 'post' || $wp_query->query['pagename'] == 'temabloggar' || $wp_query->query['pagename'] == 'bloggare' || isset($wp_query->query['category_name']) || is_singular('post') || isset($wp_query->query['theme_blog'])) : ?>
							<?php get_template_part('partials/subscribe', 'blog');  ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-6">
						<div class="footer-contact">
							<p>Pedagogisk Inspiration, Malmö stad. <a class="footer-mail" href="mailto:pedagogmalmo@malmo.se">pedagogmalmo@malmo.se</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
	</body>
</html>