<?php if ( ! is_single() ) :?>
	</div><!-- #content -->
<?php endif; ?>

<?php if ( ! is_front_page() && ! isset( $_GET['content_only'] ) ) :?>
	<?php get_sidebar(); ?>

	</div><!-- #wrap -->
	<div class="push"></div>

	</div><!-- .wrapper for sitting footer at the bottom of the page -->
<?php endif; ?>

<div class="footer">
	<div class="inner">
		<!-- logo options -->
		<?php if ( bombadil_show_footer_logo() ) :?>
			<?php if (bombadil_show_waymaker_footer_logo() ) :?>
				<img class="lumen-footer-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/FooterLumenWaymaker.png" alt="Footer Logo Lumen Waymaker" />
			<?php else :?>
				<img class="lumen-footer-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/FooterLumenCandela.png" alt="Footer Logo Lumen Candela" />
			<?php endif; ?>
		<?php endif; ?>
	</div><!-- #inner -->
</div><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>
