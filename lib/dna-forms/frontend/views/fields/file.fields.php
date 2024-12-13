<!--<div class="filesForm col-lg-6 col-md-6">

	<?php if ($data["label"] != ""): ?>
	<label for="<?php esc_html_e($data["name"]) ?>">
		<?php esc_html_e($data["label"]); ?>
	</label>
	<?php endif ?>		
	
	<input id="<?php esc_html_e($data["name"]) ?>" type="file" name="file_<?php esc_html_e($data["name"]) ?>" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>>

	


</div>-->
<div class="col-12 mylazyload">
	<div class="filesForm">
		<div class="input-file-container">  

			<input class="input-file" id="<?php esc_html_e($data["name"]) ?>" type="file" id="<?php esc_html_e($data["name"]) ?>" name="file_<?php esc_html_e($data["name"]) ?>" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>>

			<label tabindex="0" for="<?php esc_html_e($data["name"]) ?>" class="input-file-trigger">
				<?php pll_e('Joindre') ?>
			</label>

		</div>

		<p class="file-return">
			<?php esc_html_e($data["label"]); ?><?php echo ($data["required"]) ? '*' : ''; ?>
		</p>

		<!-- <div class="resetfile">X</div> -->
	</div>
</div>