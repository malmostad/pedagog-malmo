<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Malmo_Theme
 *
 */
?>
<div id="primary" class="widget-area" role="complementary">
  <ul>
    <?php
      if ( is_active_sidebar( 'primary-widget-area' ) ) {
        dynamic_sidebar( 'primary-widget-area' );
      }
    ?>
  </ul>
</div>

