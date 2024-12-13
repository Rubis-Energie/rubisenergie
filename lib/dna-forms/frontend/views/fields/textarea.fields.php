<div class="col-12 mylazyload form-group">

<?php if ($data["label"] != ""): ?>
<label for="<?php esc_html_e($data["name"]) ?>">
	<?php esc_html_e($data["label"]); ?>
</label>
<?php endif ?>

<textarea id="<?php esc_html_e($data["name"]) ?>" name="form[<?php esc_html_e($data["name"]); ?>]" placeholder="<?php esc_html_e($data["placeholder"]); ?>" <?php echo ($data["required"]) ? 'required="required"' : ''; ?>></textarea>

</div>