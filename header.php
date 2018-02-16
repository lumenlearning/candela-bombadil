<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]> <html <?php language_attributes(); ?> class="no-js"> <![endif]-->
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="https://html5shim.googlecode.com/svn/trunk/html5.js">
	  </script>
	<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/favicon.ico" />
<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) ) {
	echo " | $site_description";
}

	// Add a page number if necessary:
if ( $paged >= 2 || $page >= 2 ) {
	echo ' | ' . sprintf( __( 'Page %s', 'pressbooks-book' ), max( $paged, $page ) );
}

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>
<?php if ( is_front_page() ) {
	$schema = 'itemscope itemtype="http://schema.org/Book" itemref="about alternativeHeadline author copyrightHolder copyrightYear datePublished description editor image inLanguage keywords publisher" ';
} else {
	$schema = 'itemscope itemtype="http://schema.org/WebPage" itemref="about copyrightHolder copyrightYear inLanguage publisher" ';
} ?>
<body <?php body_class();
if ( wp_title( '', false ) !== '' ) { print ' id="' . str_replace( ' ', '', strtolower( wp_title( '', false ) ) ) . '"'; } ?> <?php echo $schema; ?>>

		<?php
		/**
		 * Disabling accessibility-toolbar for now, because it interferes w/
		 * skip-to-content accessibility feature.
		 */
		// get_template_part( 'content', 'accessibility-toolbar' );
		?>

		<!-- table of contents -->
		<?php if ( is_front_page() ) :?>

			<!-- header logo -->
			<?php toc_header_logo(); ?>

			<!-- home page wrap -->
			<div class="book-info-container" <?php bombadil_header_color(); ?>>

		<!-- content page -->
		<?php else :?>

			<div class="nav-container">

				<!-- skip to content -->
				<div class="skip-to-content">
					<a href="#main-content">Skip to main content</a>
				</div>

				<?php if ( bombadil_show_header() ) :?>
					<!-- nav bar -->
					<nav role="navigation" <?php bombadil_header_color(); ?>>
						<!-- logo / branding -->
						<div class="book-title-wrapper">
							<?php bombadil_header_logo(); ?>

						<!-- Book Title -->
							<h1 class="book-title">
								<?php if ( bombadil_show_header_link() ) :?>
									<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								<?php else :?>
									<span><?php bloginfo( 'name' ); ?></span>
								<?php endif; ?>
							</h1>
						</div>
					</nav>

					<?php if ( bombadil_show_search() || bombadil_show_small_title() ) :?>
						<div class="sub-nav">
							<div class="sub-nav-wrapper">
								<!-- page title -->
								<?php if ( bombadil_show_small_title() ) :?>
									<div class="author-wrap">
										<h3><?php echo get_the_title( $post->post_parent ); ?></h3>
									</div> <!-- end .author-name -->
								<?php endif; ?>

								<!-- search bar -->
								<?php if ( bombadil_show_search() ) get_search_form(); ?>
							</div>
						</div><!-- end sub-nav -->
					<?php endif; ?>

				<?php endif; ?>
			</div> <!-- end .nav-container -->

	<div class="wrapper"><!-- for sitting footer at the bottom of the page -->
			<div id="wrap">
				<div id="content" role="main">

		<?php endif; ?>
