<?php if ($data["multiple_choice"]) : ?>
	<?php $i = 0; ?>
	<?php if ($data["title_field"] != ""): ?>
		<div class="col-12 mylazyload">
			<h4><?php esc_html_e($data["title_field"]) ?></h4>	
		</div>
	<?php endif ?>
		
		<div class="container">
		<div class="multipleCheck row">
			
		
		<?php foreach ($data["labels"] as $label): ?>
			<div class="col-6 mylazyload form-group <?php echo (is_singular('accommodation')) ? "col-12" : ""; ?>">
				<input id="<?php esc_html_e($data["name"]) ?>_<?php esc_html_e($i); ?>" type="checkbox" name="form[<?php esc_html_e($data["name"]) ?>][]" value="<?php esc_html_e($label["label"]) ?>">
				<label class="checkbox-label-multiple" for="<?php esc_html_e($data["name"]) ?>_<?php esc_html_e($i); ?>"><?php esc_html_e($label["label"]) ?></label>			
			</div>
			<?php $i++; ?>
		<?php endforeach ?>

		</div></div>
<?php else : ?>
	<div class="col-12 mylazyload form-group">
		<input id="<?php esc_html_e($data["name"]) ?>" type="checkbox" name="form[<?php esc_html_e($data["name"]) ?>]" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>>

		<label for="<?php esc_html_e($data["name"]) ?>"><?php esc_html_e($data["label"]) ?></label>
	</div>
<?php endif ?>
