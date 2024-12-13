<?php if ($blocks) : ?>
	<?php foreach ($blocks as $block): ?>
		<?php render('block', 'Cms', array('layout' => $block["acf_fc_layout"], 'fields' => $block["fields"])) ?>
	<?php endforeach; ?>
<?php endif; ?>
