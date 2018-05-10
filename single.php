<?php if ( have_posts() ) { while ( have_posts() ) : the_post(); ?>
<?php get_header(); ?>
<?php if ( pb_is_public() ) : ?>

				<h2 class="entry-title"><?php
				$chapter_number = pb_get_chapter_number( $post->post_name );
				if ( $chapter_number ) {
					echo "<span>$chapter_number</span>  ";
				}
					the_title();
					?></h2>

				<div id="post-<?php the_ID(); ?>" <?php post_class( pb_get_section_type( $post ) ); ?>>

					<div class="entry-content">
						<?php $subtitle = get_post_meta( $post->ID, 'pb_subtitle', true );
						if ( $subtitle ) : ?>
						<h2 class="chapter_subtitle"><?php echo $subtitle; ?></h2>
					<?php endif;?>
					<?php $chap_author = get_post_meta( $post->ID, 'pb_section_author', true );
					if ( $chap_author ) : ?>
						 <h2 class="chapter_author"><?php echo $chap_author; ?></h2>
					<?php endif; ?>

					<?php if ( get_post_type( $post->ID ) !== 'part' ) {
						if ( pb_should_parse_subsections() ) {
							$content = pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->ID );
							echo $content;
						} else {
							$content = apply_filters( 'the_content', get_the_content() );
							echo $content;
						}
						global $multipage;
						if ( $multipage ) {
							$args = [ 'before' => '<p class="pb-nextpage">' . __( 'Continue reading:', 'pressbooks' ) ];
							wp_link_pages( $args );
						}
} else {
	echo apply_filters( 'the_content', $post->post_content );
} ?>

					</div><!-- .entry-content -->
				</div><!-- #post-## -->

        <?php if ( $citation = Candela\Citation::renderCitation( $post->ID ) ) { ?>
          <!-- CITATIONS AND ATTRIBUTIONS -->
          <section class="citations-section" role="contentinfo">
            <div class="post-citations sidebar">
              <div role="button" aria-pressed="false" id="citation-header-<?php print $post->ID; ?>" class="collapsed license-attribution-dropdown"><?php _e( 'Licenses and Attributions' ); ?></div>
              <div id="citation-list-<?php print $post->ID; ?>" style="display:none;">
                <?php print $citation ?>
              </div>
            </div>
          </section>
        <?php } ?>


				<?php if ( bombadil_show_edit_button() ) { ?>
					<!-- edit page button -->
					<?php edit_post_link( __( 'Edit This Page', 'lumen' ), '<div class="post-edit-button" role="button">', '</div>' ); ?>
				<?php } ?>

				<!-- page nav buttons -->
				<?php
				if ( bombadil_show_lti_buttons() ) {
					bombadil_lti_get_links();
				} elseif ( bombadil_show_navigation_buttons() ) {
					bombadil_get_links();
				}
				?>

			</div><!-- #content -->

			<?php comments_template( '', true ); ?>
<?php else : ?>
<?php pb_private(); ?>
<?php endif; ?>
<?php get_footer(); ?>
<?php endwhile;
};?>
