<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sun-auto-mitsuke
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__site-info">
			<div class="site-footer__heading">
				<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_theme_file_uri('images/logo.png'); ?>" class="site-footer__logo"></a>
				<h2 class="heading-footer">サンオート株式会社</h2>
			</div>
			<ul class="site-footer__list">
				<div class="site-footer__left">
					<li class="site-footer__item">
						<a href="https://www.google.com/maps/search/?api=1&query=新潟県見附市本所町370-1" target="_blank" class="site-footer__footer-link">
							<i class="fa-solid fa-location-dot site-footer__icon"></i>新潟県見附市本所町370-1
						</a>
					</li>
					<li class="site-footer__item">
						<a href="tel:0258611212" class="site-footer__footer-link">
							<i class="fa-solid fa-phone site-footer__icon"></i>0258-61-1212
						</a>
					</li>
					<li class="site-footer__item">
						<a href="tel:0258634122" class="site-footer__footer-link">
        			<i class="fa-solid fa-fax site-footer__icon"></i>0258-63-4122
    				</a>
					</li>
				</div>
				<div class="site-footer__right">
					<li class="site-footer__item"><i class="fa-solid fa-clock site-footer__icon"></i>月～金曜日　8:30~19:00</li>
					<li class="site-footer__item"><i class="fa-solid fa-clock site-footer__icon"></i>土曜日　8:30~18:00</li>
					<li class="site-footer__item"><i class="fa-solid fa-building-lock site-footer__icon"></i>定休日　日/祝日</li>
				</div>
			</ul>
			<p class="site-footer__paragraph">&copy; 2024 | Created by <a src="https://">NinoWeb</a></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
