<?php if ($data["options"]): ?>

	<!-- <?php //if ($data["label"] != ""): ?>
		<label for="<?php //esc_html_e($data["name"]) ?>"><?php //esc_html_e($data["label"]) ?></label>

	<?php //endif ?> -->
	<div class="custom-select2 col-12 form-group">
		<select id="<?php esc_html_e($data["name"]) ?>" name="form[<?php esc_html_e($data["name"]) ?>]" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>>

			<option value="false"><?php esc_html_e($data["placeholder"]); ?></option>

			<?php $i = 0; ?>

			<?php foreach ($data["options"] as $opt): ?>
				<option value="<?php esc_html_e($i) ?>"><?php esc_html_e($opt["option"]) ?></option>
				<?php $i++; ?>
			<?php endforeach ?>

		</select>
	</div>


<?php endif ?>
