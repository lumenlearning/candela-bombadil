<?php get_header();
if ( pb_is_public() ) :
	if ( have_posts() ) : ?>
			<div>
				<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'pressbooks-book' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				<ul class="search-results">
				<?php while ( have_posts() ) : the_post();
					get_template_part( 'content', 'search' );
					endwhile; ?>
					</ul>
						<?php
							bombadil_get_search_pagination();

							if ( bombadil_show_lti_buttons() ) {
								bombadil_lti_get_links();
							} elseif ( bombadil_show_navigation_buttons() ) {
								bombadil_get_links();
							}
						 ?>
						</div>
						<?php else :
					get_template_part( 'content', 'none' );
				endif; ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
