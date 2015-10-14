<?php 
/**
 * @package Modality
 */
?>
<div class="post-info">
	<span><i class="fa fa-user"></i><?php _e('by ','modality'); printf(esc_url(the_author_posts_link())); ?> </span>
	<span class="separator"> / </span>
	<span><i class="fa fa-calendar"></i><?php printf(esc_attr( get_the_date())); ?> </span>
</div>