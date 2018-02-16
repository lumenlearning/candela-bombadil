<?php
if ( pb_is_public() && have_posts() ) {
	while ( have_posts() ) {
		the_post();
		get_header();

		if ( get_option( 'blog_public' ) == '1' || ( get_option( 'blog_public' ) == '0' && current_user_can_for_blog( $blog_id, 'read' ) ) ) {
			if ( get_post_type( $post->ID ) !== 'part' ) {
				include( 'single-page.php' );
			} else {
				include( 'single-study-plan.php' );
			}
		}
	} // endwhile
} else {
	get_header();
	include( 'private.php' );
} // endif

get_footer();
