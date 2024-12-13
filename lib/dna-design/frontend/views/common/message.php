<?php if ($msgs): ?>
	<div id="msg_<?php echo $msgs['type']; ?>"><strong><?php esc_html_e($msgs['title']); ?></strong>&nbsp;: <?php esc_html_e($msgs['message']); ?><br></div>
<?php endif ?>