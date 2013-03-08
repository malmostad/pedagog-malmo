<ul class="entry-meta">
  <li class="vote-box clearfix" <?php if (GetVotes(get_the_ID())) echo 'data-vote="' . get_the_ID() . '"'; ?>>
    <?php DisplayVotes(get_the_ID()); ?>
  </li>
  <li id="post-on-twitter" class="clearfix">
    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="pedagogmalmo">Twittra</a>
  </li>
  <li id="facebook-like-post" class="clearfix">
    <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode("http://" . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']) ?>&amp;send=false&amp;layout=button_count&amp;width=76&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=trebuchet+ms&amp;height=21&amp;appId=239676289414904" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>
  </li>
  <li id="pinterest" class="clearfix">
    <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.malmo.se%2Fpedagogmalmo&amp;media=http%3A%2F%2Fwww.malmo.se%2Fpedagogmalmo" class="pin-it-button" count-layout="horizontal">Pin It</a>
    <script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script>
  </li>
  <li id="g-plusone" class="clearfix"><div class="g-plusone" data-size="medium"></div></li>
</ul>
