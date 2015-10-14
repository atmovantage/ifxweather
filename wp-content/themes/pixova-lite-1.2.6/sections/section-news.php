<?php

$pixova_lite_section_title = get_theme_mod('pixova_lite_news_section_title', __('Latest news', 'pixova-lite') );
$pixova_lite_section_sub_title = get_theme_mod('pixova_lite_news_section_sub_title', __('Straight from our blog', 'pixova-lite') );

// section args
$pixova_lite_limit = get_option('posts_per_page', 4);

// Logic used to dynamically create the layout, based on how many charts are active
$pixova_lite_cols = '';
$pixova_lite_news_size = '';


if($pixova_lite_limit == 1) {
    $pixova_lite_cols = 'col-md-offset-4 col-sm-offset-3';
    $pixova_lite_news_size = 'col-md-4 col-sm-6 col-xs-12';
} else if($pixova_lite_limit == 2) {
    $pixova_lite_cols = 'col-md-offset-2 col-sm-offset-1';
    $pixova_lite_news_size = 'col-md-4 col-sm-5 col-xs-12';
} else if($pixova_lite_limit == 3) {
    $pixova_lite_cols = 'col-md-offset-1 col-xs-12';
    $pixova_lite_news_size = 'col-md-3 col-sm-4 col-xs-12';
} else if($pixova_lite_limit >= 4 ){
    $pixova_lite_cols = 'col-xs-12';
    $pixova_lite_news_size = 'col-md-3 col-sm-6 col-xs-12';
}

echo '<section class="has-padding" id="news">';
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="text-center">';
				echo '<h2 class="section-heading light-section-heading">';
					echo esc_html( $pixova_lite_section_title );
					echo '<span>'.esc_html( $pixova_lite_section_sub_title ).'</span>';
				echo '</h2>';
			echo '</div><!--/.text-center-->';
		echo '</div><!--/.row-->';

		echo '<div class="row">';

		// query args
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $pixova_lite_limit,
            'orderby' => 'date',
            'order' => 'DESC'

        );

        $pixova_lite_q = new WP_Query($args);

        if( $pixova_lite_q->have_posts() ) {

            // $i is used as counter for clearing blog posts
           $i = 0;

           echo '<div class="mt-blog-posts text-center">';
                echo '<div class="row">';
                    echo '<div class="mt-blogpost-wrapper '.$pixova_lite_cols.'">';

                    while($pixova_lite_q->have_posts() ) {

                        $pixova_lite_q->the_post();


                        echo '<div class="'.$pixova_lite_news_size.'">';
                                echo '<div class="thumbnail">';

                                    if(has_post_thumbnail($pixova_lite_q->post->ID )) {
                                        echo get_the_post_thumbnail($pixova_lite_q->post->ID,'pixova-lite-homepage-blog-posts');
                                    }

                                    echo '<div class="caption">';
                                        echo '<div class="mt-date">'.get_the_date(get_option('date-format'), $pixova_lite_q->post->ID).'</div>';

                                        echo '<a class="mt-blogpost-title" href="'.esc_url( get_the_permalink() ).'">'.esc_html( get_the_title() ).'</a>';
                                        echo '<p>'.apply_filters('the_content', substr(get_the_content(), 0, 150) ).'</p>';
                                        echo '<div class="text-center">';
                                            echo '<a href="'.esc_url( get_the_permalink() ).'" class="btn btn-read-more" role="button">'.__('Read more','pixova-lite').'</a>';
                                        echo '</div><!--/.text-center-->';
                                    echo '</div><!--/.caption-->';


                                echo '</div><!--/.thumbnail-->';
                        echo '</div> <!--/.col-sm-6.col-md-4-->';
                        $i++;
                        if($i == 4) {

                            echo '<div class="clearfix"></div>';
                            $i = 0;
                        }
                    }

                    echo '</div> <!--/.mt-blogpost-wrapper-->';
                echo '</div><!--/.row-->';

                echo '<a class="btn btn-cta-light" href="'.esc_url( get_permalink( get_option('page_for_posts') ) ).'">'.__('Visit our blog', 'pixova-lite').'</a>';
            echo '</div><!--/.mt-blog-posts-->';
        }

		echo '</div><!--/.row-->';
	echo '</div><!--/.container-->';
echo '</section>';