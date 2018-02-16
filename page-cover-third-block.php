<section class="third-block-wrap">

	<div class="third-block clearfix">
		<div class="description-book-info">
			<?php $metadata = \Candela\Utility\Book\candela_get_book_info_meta(); ?>
			<h2>
				<?php _e( 'Copyright', 'pressbooks' ); ?>
			</h2>

			<p class="copyright-text">
				This courseware includes resources copyrighted and openly licensed by
				multiple individuals and organizations. Click the words "Licenses and
				Attributions" at the bottom of each page for copyright and licensing
				information specific to the material on that page. If you believe that
				this courseware violates your copyright,
				please <a target="_blank" href="http://lumenlearning.com/copyright/">contact us</a>.
			</p>

			<?php if ( ! empty( $metadata['attribution-type'] ) ) { ?>
				<p class="copyright-text">
					<?php $license = \Candela\Utility\Book\the_attribution_license( $metadata['attribution-licensing'] ); ?>

					Cover Image:

					<?php if ( ! empty( $metadata['attribution-description'] ) ) { ?>
						"<?php echo $metadata['attribution-description']; ?>."
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-author'] ) ) { ?>
						Authored by: <?php echo $metadata['attribution-author']; ?>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-organization'] ) ) { ?>
						Provided by: <?php echo $metadata['attribution-organization']; ?>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-url'] ) ) { ?>
						Located at: <a target="_blank" href=<?php echo esc_url( $metadata['attribution-url'] ); ?>><?php echo $metadata['attribution-url']; ?></a>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-project'] ) ) { ?>
						Project: <?php echo $metadata['attribution-project']; ?>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-type'] ) ) { ?>
						Content Type: <?php echo \Candela\Utility\Book\the_attribution_type( $metadata['attribution-type'] ); ?>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-licensing'] ) ) { ?>
						License: <a target="_blank" href=<?php echo esc_url( $license['link'] ); ?>><?php echo $license['label']; ?></a>.
					<?php } ?>

					<?php if ( ! empty( $metadata['attribution-license-terms'] ) ) { ?>
						License Terms: <?php echo $metadata['attribution-license-terms']; ?>.
					<?php } ?>
				</p>
			<?php } ?>

			<h2>
				<?php _e( 'Lumen Learning', 'pressbooks' ); ?>
			</h2>

			<p class="about-text">
				Lumen Learning provides a simple, supported path for faculty members to
				adopt and teach effectively with open educational resources (OER).
				<a target="_blank" href="http://lumenlearning.com/open-courses-overview/">Read more</a> about what we do.
			</p>

		</div>

		<?php
		$args = $args = array(
			'post_type' => 'back-matter',
			'tax_query' => array(
				array(
					'taxonomy' => 'back-matter-type',
					'field' => 'slug',
					'terms' => 'about-the-author',
				),
			),
		);
		?>

		<div class="author-book-info">

			<?php
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) {
				$loop->the_post();
			?>
			<h4>
				<a href="<?php the_permalink(); ?>">
					<?php the_title();?>
				</a>
			</h4>
			<?php
				echo '<div class="entry-content">';
				the_excerpt();
				echo '</div>';
			}
			?>
		</div>
	</div><!-- end .secondary-block -->
</section> <!-- end .secondary-block -->
