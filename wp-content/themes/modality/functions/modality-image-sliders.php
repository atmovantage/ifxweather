<?php
/**
 * Modality functions and definitions
 *
 * @package Modality
 */

function modality_slider() {
global $post;
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$slider_cat = $modality_theme_options['image_slider_cat'];
$num_of_slides = $modality_theme_options['slider_num'];
$button_text = $modality_theme_options['caption_button_text'];

$modality_slider_query = new WP_Query(
	array(
		'posts_per_page' => $num_of_slides,
		'cat' 	=> $slider_cat
	)
);?>
<div class="clear"></div>
<div class="banner">
	<ul>
	<?php while ( $modality_slider_query->have_posts() ): $modality_slider_query->the_post(); ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php if ($slider_cat !='') { ?>
			<li style="background: url(<?php echo esc_url($image[0]); ?>) 50% 0 no-repeat;">
		<?php } else { ?>
			<li style="background: url(<?php echo get_template_directory_uri() ?>/images/assets/slide1.jpg) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
		<?php } ?>
		<?php if ($modality_theme_options['captions_on'] == '1') { ?>	
			<div class="inner">
				<a class="post-title" href="<?php the_permalink() ?>"><h1><?php the_title(); ?></h1></a>
				<?php the_excerpt(); ?>
			</div>
			<?php if ($modality_theme_options['captions_button'] == '1') { ?>
				<a href="<?php the_permalink() ?>" class="btn"><?php echo $button_text ?></a>
			<?php }; ?>
		<?php }; ?>			
		</li>
	<?php endwhile; wp_reset_query(); ?>
	</ul>
</div>
<div class="clear"></div>

<?php 
}

function modality_localize_scripts(){
	wp_enqueue_script( 'slides', get_template_directory_uri() .'/js/slides.js' , array( 'jquery' ), '', true );
	$modality_theme_options = modality_get_options( 'modality_theme_options' );
	$animation_speed = $modality_theme_options['animation_speed'];
	$slideshow_speed = $modality_theme_options['slideshow_speed'];
		$datatoBePassed = array(
        	'slideshowSpeed' => $slideshow_speed,
        	'animationSpeed' => $animation_speed,
    	);
	wp_localize_script( 'slides', 'php_vars', $datatoBePassed );
}

add_action( 'wp_enqueue_scripts', 'modality_localize_scripts' );