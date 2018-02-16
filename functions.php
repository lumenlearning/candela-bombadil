<?php
/**
 * @license GPL 2.0+
 */

/**
 * Bombadil Theme Setup
 */
function bombadil_theme_setup() {
  wp_enqueue_script( 'embedded_audio', get_stylesheet_directory_uri() . '/assets/js/audio-behavior.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'hide_answers', get_stylesheet_directory_uri() . '/assets/js/hide-answer.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'iframe_resizer', get_stylesheet_directory_uri() . '/assets/js/iframe-resizer.js', array( 'jquery' ), '', false );
  wp_enqueue_script( 'lti_buttons', get_stylesheet_directory_uri() . '/assets/js/lti-buttons.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'typekit', '//use.typekit.net/mje6fya.js', array(), '1.0.0' );

  wp_enqueue_script( 'html5shiv', 'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js', array(), '3.7.3', false );
  wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

  add_action( 'wp_head', 'bombadil_typekit_inline' );
  add_action( 'wp_head', 'bombadil_attributions' );
  add_action( 'admin_enqueue_scripts', 'bombadil_color_picker_assets' );
}
add_action( 'after_setup_theme', 'bombadil_theme_setup' );

/**
 * Add TinyMCE Editor Stylesheet (editor-style.css)
 */
add_editor_style('editor-style.css');

/**
 * Enqueue color picker script for Bombadil Theme > Appearance Option menu
 *
 * @param  string $hook appearance_page_pressbooks_theme_options
 * @return string
 */
function bombadil_color_picker_assets( $hook ) {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'color-picker', get_stylesheet_directory_uri() . '/assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
}

/**
 * Enqueue Citations and Attributions dropdown functionality
 */
function bombadil_attributions() {
  wp_enqueue_script( 'attributions', get_stylesheet_directory_uri() . '/assets/js/attributions.js', array( 'jquery' ), '', true );

  // Pass PHP data down to attributions.js
  $dataToBePassed = array(
    'id' => get_the_ID(),
  );
  wp_localize_script( 'attributions', 'thePost', $dataToBePassed );
}

/**
 * Add typekit script inline to the page.
 *
 * @return string
 */
function bombadil_typekit_inline() {
	if ( wp_script_is( 'typekit', 'enqueued' ) ) {
		echo '<script>try{Typekit.load();}catch(e){}</script>';
	}
}

/**
 * Adds sendIframeResize function call to the footer.
 */
function bombadil_iframe_resize_footer() {
	echo '<script>if (typeof sendIframeResize === "function") { sendIframeResize(); }</script>';
}
add_action( 'wp_footer', 'bombadil_iframe_resize_footer', 1000 );


/********************************
 *      APPEARANCE OPTIONS      *
 ********************************/

/**
 * Render the header color (if set).
 *
 * @return html
 */
function bombadil_header_color() {
	$appearance = get_option( 'pressbooks_theme_options_appearance' );

	if ( ( isset( $appearance['header_color'] ) && strlen( $appearance['header_color'] ) !== 0 ) ) {
		echo ' style="background-color: ' . $appearance['header_color'] . '"';
	}
}

/**
 * Render the Table of Contents header logo and link (if set).
 *
 * @return html
 */
function toc_header_logo() {
	$appearance = get_option( 'pressbooks_theme_options_appearance' );
	if ( isset( $appearance['toc_header_logo'] ) && strlen( $appearance['toc_header_logo'] ) !== 0 ) {
		if ( isset( $appearance['toc_header_link'] ) && strlen( $appearance['toc_header_link'] ) !== 0 ) {
			echo '<a href="' . $appearance['toc_header_link'] . '"><img class="toc-header-logo" src="' . $appearance['toc_header_logo'] . '" /></a>';
		} else {
			echo '<img class="toc-header-logo" src="' . $appearance['toc_header_logo'] . '" />';
		}
	}

}

/**
 * Render the header logo and link (if set).
 *
 * @return html
 */
function bombadil_header_logo() {
	$appearance = get_option( 'pressbooks_theme_options_appearance' );

	if ( isset( $appearance['header_logo'] ) && strlen( $appearance['header_logo'] ) !== 0 ) {
		if ( isset( $appearance['header_link'] ) && strlen( $appearance['header_link'] ) !== 0 ) {
			echo '<div class="bombadil-logo"><a href="' . $appearance['header_link'] . '"><img class="header-logo" src="' . $appearance['header_logo'] . '" /><a/></div>';
		} else {
			echo '<div class="bombadil-logo"><a href="' . get_home_url() . '"><img class="header-logo" src="' . $appearance['header_logo'] . '" /><a/></div>';
		}
	} else {
    echo '<div class="bombadil-logo"><a href="' . esc_url( network_home_url() ) . '"><img src="' . get_stylesheet_directory_uri() . '/assets/images/LumenOnDark-150x69.png" alt="Lumen" /></a></div>';
	}
}

/**
 * Show navigation header if true
 *
 * @return bool
 */
function bombadil_show_header() {
	return bombadil_show_nav_options( 'nav_show_header' );
}

/**
 * Show navigation header link if true
 *
 * @return bool
 */
function bombadil_show_header_link() {
	return bombadil_show_nav_options( 'nav_header_link' );
}

/**
 * Show search field in nav bar if true
 *
 * @return bool
 */
function bombadil_show_search() {
	return bombadil_show_nav_options( 'nav_show_search' );
}

/**
 * Show navigation header if true
 *
 * @return bool
 */
function bombadil_show_small_title() {
	return bombadil_show_nav_options( 'nav_show_small_title' );
}

/**
 * Show edit page button if true
 *
 * @return bool
 */
function bombadil_show_edit_button() {
	return bombadil_show_nav_options( 'nav_show_edit_button' );
}

/**
 * Show navigation buttons if true
 *
 * @return bool
 */
function bombadil_show_navigation_buttons() {
	return bombadil_show_nav_options( 'nav_show_navigation_buttons' );
}

/**
 * Show LTI navigation buttons if ?lti_nav is set
 *
 * @return bool
 */
function bombadil_show_lti_buttons() {
	return isset( $_GET['lti_nav'] );
}

/**
 * Show a Logo
 *
 * @return bool
 */
function bombadil_show_footer_logo() {
	return bombadil_choose_footer_logo( 'nav_show_footer_logo' );
}

/**
 * Show the Waymaker Footer Logo
 *
 * @return bool
 */
function bombadil_show_waymaker_footer_logo() {
	return bombadil_choose_footer_logo( 'nav_show_waymaker_logo' );
}

/**
 * Logic for rendering navigation buttons inside LMS
 *
 * @param string $selected_option
 * @return bool
 */
function bombadil_show_nav_options( $selected_option ) {

	$via_LTI_launch = isset( $_GET['content_only'] );

	if ( $via_LTI_launch ) {
		$navigation = get_option( 'pressbooks_theme_options_navigation' );

		if ( 1 == $navigation[ $selected_option ] ) {
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

/**
 * Render pagination on search query pages
 *
 * @return html
 */
function bombadil_get_search_pagination() {
  ?>
    <div class="search-pagination">
      <?php echo paginate_links(); ?>
    </div>
  <?php
}

/**
 * Render Previous and Next Buttons
 *
 * @param bool $echo
 */
function bombadil_get_links( $echo = true ) {

	global $first_chapter, $prev_chapter, $next_chapter;

	$first_chapter = pb_get_first();
	$prev_chapter = pb_get_prev();
	$next_chapter = pb_get_next();

	if ( isset( $_GET['content_only'] ) ) {
		$next_chapter = add_query_arg( 'content_only', 1, $next_chapter );
		$prev_chapter = add_query_arg( 'content_only', 1, $prev_chapter );
	}

	if ( isset( $_GET['lti_context_id'] ) ) {
		$next_chapter = add_query_arg( 'lti_context_id', $_GET['lti_context_id'], $next_chapter );
		$prev_chapter = add_query_arg( 'lti_context_id', $_GET['lti_context_id'], $prev_chapter );
	}

	if ( $echo ) { ?>
		<div class="bottom-nav-buttons">
			<?php if ( $prev_chapter && '/' != $prev_chapter ) { ?>
				<a class="post-nav-button" id="prev" href="<?php echo esc_url( $prev_chapter ); ?>">
					<?php _e( 'Previous', 'pressbooks' ); ?>
				</a>
			<?php }

			if ( $next_chapter && '/' != $next_chapter ) { ?>
				<a class="post-nav-button" id="next" href="<?php echo esc_url( $next_chapter ); ?>">
					<?php _e( 'Next', 'pressbooks' ); ?>
				</a>
			<?php } ?>
		</div>
	<?php }
}

/**
 * Render LTI Previous and Next Buttons, for LMS Integration
 *
 * @param bool $echo
 */
function bombadil_lti_get_links( $echo = true ) {

	if ( $echo ) { ?>
		<div class="lti-bottom-nav-buttons">
			<a class="lti-nav-button" id="lti-prev"><span class="lti-button-arrow">&#10094;</span><span class="lti-button-text">Previous</span></a>
			<a class="lti-nav-button" id="lti-next"><span class="lti-button-text">Next</span><span class="lti-button-arrow">&#10095;</span></a>
			<a class="lti-nav-button" id="study-plan">Study Plan</a>
		</div>
	<?php }
}

/**
 * Show Footer Logo
 *
 * @param  string $chosen_logo
 * @return bool
 */
function bombadil_choose_footer_logo( $chosen_logo ) {
	$navigation = get_option( 'pressbooks_theme_options_navigation' );

	if ( ( isset( $navigation[ $chosen_logo ] ) && ( 1 == $navigation[ $chosen_logo ] ) ) ) {
		return true;
	} else {
		return false;
	}
}
