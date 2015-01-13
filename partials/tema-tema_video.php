<?php
  $video_id = get_sub_field('tema_video_id');
  $video_header = get_sub_field('tema_video_header');
  $video_text = get_sub_field('tema_video_text');
?>
<div class="row border-bottom">
  <div class="col-sm-6">
    <div class="video-wrapper">
      <iframe src="//www.youtube.com/embed/<?php echo $video_id ?>" frameborder="0" showinfo="0" allowfullscreen></iframe>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="video-label">Video</div>
    <div class="content body-copy">
      <h2><?php echo $video_header ?></h2>
      <p><?php echo $video_text ?></p>
    </div>
  </div>
</div>

<!-- <pre>
<?php var_dump($flexpost); ?>
</pre> -->


