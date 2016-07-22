<?php
/**
 * Modality functions and definitions
 *
 * @package Modality
 */

function modality_ideal_slider() {
	global $post;
	$modality_theme_options = modality_get_options( 'modality_theme_options' );
	$slider_cat = $modality_theme_options['image_slider_cat'];
	$num_of_slides = $modality_theme_options['slider_num'];
	
	$modality_slider_query = new WP_Query(
		array(
			'posts_per_page' => $num_of_slides,
			'cat' 	=> $slider_cat
		)
	);?>
	<div class="clear"></div>
	<div id="slider">
		<?php while ( $modality_slider_query->have_posts() ): $modality_slider_query->the_post(); ?>
			<?php if ($slider_cat !='') { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
						<img src="<?php echo esc_url($image[0]); ?>" title="<?php the_title(); ?>" alt="<?php the_excerpt(); ?>" link="<?php the_permalink(); ?>" />
					<?php } else { ?>
						<img class="attachment-full wp-post-image rs-slide-image" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide.jpg">
					<?php } ?>
			<?php } else { ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail('full'); ?>
				<?php } else { ?>
					<?php if ($slider_cat !='') { ?>
						<img class="attachment-full wp-post-image rs-slide-image" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide.jpg">
					<?php } else { ?>
						<img class="attachment-full wp-post-image rs-slide-image" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide1.jpg">
					<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php }

function modality_unslider_slider() {
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
			<li style="background: url(<?php echo esc_url($image[0]); ?>) 50% 0 no-repeat;">
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

function modality_localize_scripts_ideal(){
	$modality_theme_options = modality_get_options( 'modality_theme_options' );
	$animation_speed = $modality_theme_options['animation_speed'];
	$slideshow_speed = $modality_theme_options['slideshow_speed'];
	$slider_height = $modality_theme_options['slider_height'];
	$slider_effect = $modality_theme_options['image_slider_effect'];
		$datatoBePassed = array(
        	'slideshowSpeed' => $slideshow_speed,
        	'animationSpeed' => $animation_speed,
			'sliderHeight' => $slider_height,
			'sliderEffect' => $slider_effect,
    	);
	if ($modality_theme_options['captions_on'] == '1') {
		if (is_home() && ! is_paged()) {
			wp_enqueue_script( 'slides-captions', get_template_directory_uri() .'/js/slides-captions.js' , array( 'jquery' ), '', true );
			wp_localize_script( 'slides-captions', 'php_vars', $datatoBePassed );
		}
	}else{
		wp_enqueue_script( 'ideal-slides', get_template_directory_uri() .'/js/ideal-slides.js' , array( 'jquery' ), '', true );
		wp_localize_script( 'ideal-slides', 'php_vars', $datatoBePassed );
	}

	
}

function modality_localize_scripts_unslider(){
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

add_action( 'wp_enqueue_scripts', 'modality_localize_scripts_unslider' );
add_action( 'wp_enqueue_scripts', 'modality_localize_scripts_ideal' );