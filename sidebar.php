<aside class="sidebar" role="complementary">
	<div class="sidebar-widget">
    <div class="calendar-widget-header">
      <h3>Kalendarium<span><?php echo get_current_week() ?> </span></h3>
    </div>
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>
	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>
</aside>
