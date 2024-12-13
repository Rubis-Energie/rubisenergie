<div class="col-md-6 col-12 mylazyload form-group <?php echo (is_singular('accommodation')) ? "col-lg-12 col-md-12" : ""; ?>">
	<?php if ($data["label"]) : ?>
	<label for="<?php esc_html_e($data["name"]) ?>">
	<?php esc_html_e($data["label"]); ?>
	</label>
	<?php endif ?>
	<input id="<?php esc_html_e($data["name"]) ?>" type="text" name="form[<?php esc_html_e($data["name"]) ?>]" placeholder="<?php esc_html_e($data["placeholder"]) ?>" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>>
</div>
