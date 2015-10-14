<?php
class WPCOM_JSON_API_Get_Autosave_v1_1_Endpoint extends WPCOM_JSON_API_Post_v1_1_Endpoint {
	function __construct( $args ) {
		parent::__construct( $args );
	}

	// /sites/%s/posts/%d/autosave -> $blog_id, $post_id
	function callback( $path = '', $blog_id = 0, $post_id = 0 ) {

		$blog_id = $this->api->switch_to_blog_and_validate_user( $this->api->get_blog_id( $blog_id ) );
		if ( is_wp_error( $blog_id ) ) {
			return $blog_id;
		}

		$post = get_post( $post_id );

		if ( ! $post || is_wp_error( $post ) ) {
			return new WP_Error( 'unknown_post', 'Unknown post', 404 );
		}

		if ( ! current_user_can( 'edit_post', $post->ID ) ) {
			return new WP_Error( 'unauthorized', 'User cannot edit post', 403 );
		}

		$autosave = wp_get_post_autosave( $post->ID );

		if ( $autosave ) {
			$preview_url = add_query_arg( 'preview', 'true', get_permalink( $post->ID ) );
			$nonce = wp_create_nonce( 'post_preview_' . $post->ID );
			$preview_url = add_query_arg( array( 'preview_id' => $auto_ID, 'preview_nonce' => $nonce ), $preview_url );

			return array(
				'ID'          => $autosave->ID,
				'author_ID'   => $autosave->post_author,
				'post_ID'     => $autosave->post_parent,
				'title'       => $autosave->post_title,
				'content'     => $autosave->post_content,
				'excerpt'     => $autosave->post_excerpt,
				'preview_URL' => $preview_url,
				'modified'    => $this->format_date( $autosave->post_modified )
			);
		} else {
			return new WP_Error( 'not_found', 'No autosaves exist for this post', 404 );
		}
	}
}