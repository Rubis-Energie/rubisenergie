<?php global $contact_error, $contact_success; ?>

<?php if ($fields) : ?>

	<?php if (isset($_GET["form_success"])): ?>

		<div class="success-msg-page" id="contact_success" >
			<span></span>
			<?php echo $success_message; ?>
		</div>

	<?php else : ?>
	<div id="container_form">
		<form <?php echo (is_singular('product')) ? 'id="prdform"' : ''; ?> class="row" action="#contact_success" method="POST" enctype="multipart/form-data">
			<div class="col-12">
				<div class="required"><?php pll_e('* Champs obligatoires'); ?></div>
			</div>
		    <?php if ($contact_error): ?>

				<div class="error-msg-page">
					<p><?php echo $contact_error ?></p>
				</div>

			<?php endif; ?>

			<input type="hidden" name="form[id]" value="<?php esc_html_e($form_id); ?>">

			<?php foreach ($fields as $field): ?>
				<?php render('field', 'Forms', array('layout' => $field["acf_fc_layout"], 'data' => $field["fields"])) ?>
			<?php endforeach; ?>

	<!-- 	<div class="formSubmit col-12 row mylazyload">
	 -->	<?php if (fo('key_public')): ?>
				<div class="col-lg-12">

				</div>
				<div class='recaptchaContainer'>
					<div class="g-recaptcha col-xl-6 col-12" data-sitekey="<?php esc_html_e(fo('key_public')) ?>" data-callback="recaptchaCallback"></div>
			    	<div class="clear"></div>
					<input type="text" class="form-control hfield" name="f_recaptcha" id="f_recaptcha">
				</div>

			<?php endif ?>

			<div class="col-12 formCta">

				<input class="cta green" type="submit" value="<?php echo ($submit_label != "") ? $submit_label : 'Valider' ?>">

			</div>
	<!-- 	</div>
	 -->


		</form>

		<script src='https://www.google.com/recaptcha/api.js?hl=<?php esc_html_e(pll_current_language()); ?>'></script>
	</div>


	<?php endif; ?>
<?php endif; ?>
