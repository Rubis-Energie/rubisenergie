<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */
?>
	</div>
	<footer>
		<div class="container">
			<div class="row">
				<?php if (fol('footer_logo')): ?>
					<div class="col-lg-2 logo">
						<?php $logo = fol('footer_logo'); ?>
						<a href="<?php esc_html_e(pll_home_url()); ?>">
							<img src="<?php esc_html_e($logo["url"]); ?>">
						</a>
					</div>
				<?php endif; ?>

				<div class="col-lg-5 offset-lg-1 text">
					<?php if (fol('footer_text_presentation')): ?>
						<?php echo fol('footer_text_presentation'); ?>
					<?php endif ?>

					<div class="addressMedia">
						<div class="address">
							<?php if (fol('footer_adress')): ?>
								<?php echo fol('footer_adress'); ?>
							<?php endif ?>
						</div>

						<?php if (fo('social_media')): ?>
							<div class="socialMedia">
								<?php foreach (fo('social_media') as $social): ?>

									<a target="_blank" href="<?php esc_html_e($social["url"]); ?>">
										<img src="<?php esc_html_e($social["img"]["url"]); ?>">
									</a>

								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-lg-4">


					<?php if (fol('footer_logos')): ?>
						<div class="logos">
							<?php foreach (fol('footer_logos') as $logos): ?>
								<a target="<?php echo $logos["link"]["target"]; ?>" href="<?php esc_html_e($logos["link"]["url"]); ?>">
									<img src="<?php esc_html_e($logos["img"]["url"]); ?>">
								</a>
							<?php endforeach ?>
						</div>
					<?php endif ?>

					<?php if (fol('footer_menu')): ?>
						<div class="footerMenu">
							<?php foreach (fol('footer_menu') as $f_menu): ?>
								<a target="<?php esc_html_e($f_menu["link"]["target"]); ?>" href="<?php esc_html_e($f_menu["link"]["url"]); ?>">
									<?php esc_html_e($f_menu["link"]["title"]); ?>
								</a>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/lib.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/app.min.js"></script>

</body>
</html>
