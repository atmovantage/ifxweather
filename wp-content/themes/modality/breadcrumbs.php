<?php 
/**
 * @package Modality
 *
 */
global $post; 
if (!is_front_page()) {
	echo '<ul>';
    echo '<li><a href="';
    echo esc_url(home_url());
    echo '">';
    _e('Home','modality');
    echo '</a></li><li class="separator"> / </li>';
    if (is_category() || is_single()) {
        echo '<li>';
        the_category(' </li><li class="separator"> / </li><li> ');
        if (is_single()) {
            echo '</li><li class="separator"> / </li><li>';
            the_title();
            echo '</li>';
        }
    } elseif (is_page()) {
        if($post->post_parent){
            $anc = get_post_ancestors( $post->ID );
                 
            foreach ( $anc as $ancestor ) {
                $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator">/</li>';
            }
			echo $output;
            echo '<li title="'.get_the_title().'"> '.get_the_title().'</li>';
        } else {
            echo '<li> ';
            echo the_title();
            echo '</li>';
        }
    }  
elseif (is_tag()) {
	_e('Tag: ','modality');esc_attr(single_tag_title());
}
elseif (is_day()) {echo"<li> " . __('Archive for ','modality'); the_archive_title(); echo'</li>';}
elseif (is_month()) {echo"<li> " . __('Archive for ','modality'); the_archive_title(); echo'</li>';}
elseif (is_year()) {echo"<li> " . __('Archive for ','modality'); the_archive_title(); echo'</li>';}
elseif (is_author()) {echo"<li> " . __('Author: ','modality'); esc_url(the_author_posts_link()); echo'</li>';}
elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li> " . __('Blog Archives ','modality'); echo'</li>';}
elseif (is_search()) {echo"<li> " . __('Search Results ','modality'); echo'</li>';}
echo '</ul>';
}