<?php if(!isset($role)): die('Pas de triche !'); endif; ?>
<style type="text/css">
	.taxonomy-experience_category #col-left {
		display: none;
	}
	.taxonomy-experience_category #col-right {
		width: 100%;
	}
	.taxonomy-experience_category tr.term-description-wrap th {
		display: none;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.taxonomy-experience_category #col-left').remove();

		$('.taxonomy-experience_category tr.term-description-wrap th').remove();
		$('.taxonomy-experience_category tr.term-description-wrap td').attr('colspan', 2);
		<?php if ($role == 'administrator'): ?>
			$('.taxonomy-experience_category #slug').attr('readonly', 'readonly');
		<?php endif; ?>

	});
</script>