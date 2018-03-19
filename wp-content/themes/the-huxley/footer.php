			<footer class="footer" role="contentinfo">
				<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
				<div class="footer-widgets wrap">

						<div class="footer-item"><?php dynamic_sidebar( 'footer-1' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-2' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-3' ); ?></div>
						<div class="footer-item"><?php dynamic_sidebar( 'footer-4' ); ?></div>
					
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<div id="inner-footer" class="wrap cf">

					<p class="source-org copyright">
						 &#169; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> 
						<span><?php if(is_home()): ?>
							- <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'the-huxley' ) ); ?>"><?php printf( __( 'Powered by %s', 'the-huxley' ), 'WordPress' ); ?></a> and <a href="<?php echo esc_url( __( 'http://deucethemes.com', 'the-huxley' ) ); ?>"><?php printf( __( '%s', 'the-huxley' ), 'Deuce Themes' ); ?></a>
						<?php endif; ?>
						</span>
					</p>

				</div>

			</footer>
			<a href="#" class="scrollToTop"><span class="fa fa-chevron-circle-up"></span></a>
		</div>

		<?php wp_footer(); ?>
	</body>

</html> <!-- end of site. what a ride! -->