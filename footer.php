<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package K2
 */

?>

	<footer id="colophon" class="site-footer">
		<nav id="footer-navigation" class="footer-navigation">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
		?>
		</nav>
		<div class="site-branding">
			<?php if(has_custom_logo()): ?>
			<h2 class="site-title"><?php the_custom_logo(); ?></h2>
			<?php else: ?>
			<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<div class="site-info">
			<small>©︎<?php bloginfo( 'name' ); ?></small>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div>
	<?php wp_footer(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
	<script>
		$(function () {
			var scrollTop = $(window).scrollTop();
			var bgPosition = scrollTop / 15;
			if(bgPosition){
				$('#mainVisual').css('background-position', 'center bottom -'+ bgPosition + 'px');
			}
		});

		$(function () {
			var siteBody = document.getElementById('siteBody');
			var btn = document.getElementById('disp-btn');
			btn.onclick = function toggleStyle() {
				siteBody.classList.toggle('block');
			}
		});

		$(function(){
			var ua = navigator.userAgent;
			if(ua.indexOf('iPhone') > 0 || ua.indexOf('Android') > 0){
				$('.tel-link').each(function(){
					if($(this).is('img')) {
						var str = $(this).attr('alt');
						$(this).wrap('<a class="tel-link" href="tel:'+str.replace(/-/g,'')+'"></a>');
					} else {
						var str = $(this).text();
						$(this).replaceWith('<a class="tel-link" href="tel:'+str.replace(/-/g,'')+'">' + str + '</a>');
					}
				});
			}
		});
	</script>

</body>
</html>
