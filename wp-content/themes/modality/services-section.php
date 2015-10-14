<?php
/**
 * @package Modality
 */
$modality_theme_options = modality_get_options( 'modality_theme_options' );
$services_bg_image = $modality_theme_options['services_bg_image'];

if ($services_bg_image !='') { ?>
	<div id="services" style="background: url(<?php echo esc_url($services_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
	<div id="services">
<?php } ?>
	<div id="services-wrap">
		<div class="services-left">
			<h2 class="wow bounceInLeft" data-wow-delay="0.1s"><?php echo esc_attr($modality_theme_options['services_section_title']); ?></h2>
			<p class="wow bounceInRight" data-wow-delay="0.2s"><?php echo esc_attr($modality_theme_options['services_section_desc']); ?></p>
			<div class="row">
				<div class="row-item">
					<div class="service wow bounceIn" data-wow-delay="0.2s">
						<i class="fa <?php echo esc_attr($modality_theme_options['service_one_icon']); ?>"></i>
						<h3><?php echo esc_attr($modality_theme_options['service_one']); ?></h3>
						<p><?php echo esc_attr($modality_theme_options['service_one_desc']); ?></p>		
					</div><!--service-->
				</div><!--row-item-->
				<div class="row-item">
					<div class="service wow bounceIn" data-wow-delay="0.5s">
						<i class="fa <?php echo esc_attr($modality_theme_options['service_two_icon']); ?>"></i>
						<h3><?php echo esc_attr($modality_theme_options['service_two']); ?></h3>
						<p><?php echo esc_attr($modality_theme_options['service_two_desc']); ?></p>			
					</div><!--service-->
				</div><!--row-item-->
			</div><!--row-->
			<div class="row">
				<div class="row-item">
					<div class="service wow bounceIn" data-wow-delay="0.8s">
						<i class="fa <?php echo esc_attr($modality_theme_options['service_three_icon']); ?>"></i>
						<h3><?php echo esc_attr($modality_theme_options['service_three']); ?></h3>
						<p><?php echo esc_attr($modality_theme_options['service_three_desc']); ?></p>		
					</div><!--service-->
				</div><!--row-item-->
				<div class="row-item">
					<div class="service wow bounceIn" data-wow-delay="1.1s">
						<i class="fa <?php echo esc_attr($modality_theme_options['service_four_icon']); ?>"></i>
						<h3><?php echo esc_attr($modality_theme_options['service_four']); ?></h3>
						<p><?php echo esc_attr($modality_theme_options['service_four_desc']); ?></p>		
					</div><!--service-->
				</div><!--row-item-->
			</div><!--row-->
		</div><!--services-left-->
		<div class="services-right">
			<img class="wow bounceIn" data-wow-delay="1.4s" src="<?php echo esc_url($modality_theme_options['services_image']); ?>" alt="Services"/>
		</div><!--services-right-->
	</div><!--services-wrap-->
</div><!--services-->