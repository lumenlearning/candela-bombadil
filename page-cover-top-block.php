<section id="post-<?php the_ID(); ?>" <?php post_class( array( 'top-block', 'clearfix', 'home-post' ) ); ?>>

	<?php pb_get_links( false ); ?>
	<?php $metadata = \Candela\Utility\Book\candela_get_book_info_meta(); ?>
	<div class="log-wrap">	<!-- Login/Logout -->
		<?php if ( ! is_single() ) : ?>
			<?php if ( ! is_user_logged_in() ) : ?>
				<a href="<?php echo wp_login_url( get_permalink() ); ?>" class=""><?php _e( 'login', 'pressbooks-book' ); ?></a>
				<?php else : ?>
					<?php if ( is_super_admin() || is_user_member_of_blog() ) : ?>
					<a href="<?php echo get_option( 'home' ); ?>/wp-admin"><?php _e( 'Admin', 'pressbooks-book' ); ?></a>
					<?php endif; ?>
					<a href="<?php echo  wp_logout_url(); ?>" class=""><?php _e( 'logout', 'pressbooks-book' ); ?></a>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<div class="book-info">
		<!-- Book Title -->
		<h1 class="entry-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php if ( ! empty( $metadata['pb_subtitle'] ) ) : ?>
			<span class="stroke"></span>
			<p class="sub-title"><?php echo $metadata['pb_subtitle']; ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $metadata['pb_about_50'] ) ) : ?>
			<p><?php echo pb_decode( $metadata['pb_about_50'] ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $metadata['candela-credit-statement'] ) ) : ?>
			<p id="credit-statement"><?php echo $metadata['candela-credit-statement']; ?></p>
		<?php endif; ?>
	</div> <!-- end .book-info -->

	<?php if ( ! empty( $metadata['pb_cover_image'] ) ) : ?>
		<div class="book-cover">

			<img src="<?php echo $metadata['pb_cover_image']; ?>" alt="book-cover" title="<?php bloginfo( 'name' ); ?> book cover" />

		</div>
	<?php endif; ?>

</section> <!-- end .top-block -->
</div><!-- end .book-info-container -->
