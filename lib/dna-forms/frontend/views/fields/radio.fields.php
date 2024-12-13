<?php if ($data["options"]): ?>
	<?php $i = 0; ?>
	<div class="custom-radios col-12 form-group">
		<div class="container">
			<div class="row">
				<?php foreach ($data["options"] as $opt): ?>
					<input class="col-md-6 col-12" id="<?php esc_html_e($data["name"]) ?>_<?php esc_html_e($i) ?>" type="radio" name="form[<?php esc_html_e($data["name"]) ?>]" value="<?php esc_html_e($i); ?>" <?php echo ($i == 0) ? 'checked' : ''; ?>>
					<label class="col-md-6 col-12" for="<?php esc_html_e($data["name"]) ?>_<?php esc_html_e($i) ?>"><?php esc_html_e($opt["option"]) ?></label>
					<?php $i++; ?>
				<?php endforeach ?>
			</div>
		</div>	
	</div>
	
<?php endif ?>