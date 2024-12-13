<div class="wrap">
	<h2><?php _e('Polylang String Translation Generator', 'pls') ?></h2>
	<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
		<div class="updated notice" id="setting-polylang_updated"> 
		<p><strong><?php echo sprintf(__('Translation file generated. Go to <a href="%s">Translation managment</a> to view all your string', 'pls'), admin_url('options-general.php?page=mlang&tab=strings')) ?></strong></p></div>
	<?php elseif (isset($_GET['success']) && $_GET['success'] == -1): ?>
		<div class="error notice" id="setting-polylang_updated"> 
		<p><strong><?php _e('An error has occurred during the creation of item. Please check your configuration and files', 'pls') ?></strong></p></div>
	<?php endif ?>
	<h3><?php echo sprintf(__('Find strings in the theme : "%s"', 'pls'), wp_get_theme()) ?></h3>
	
	<table cellspacing="0" class="widefat">
		<tbody>
			<tr>
				<td>
					<?php _e('This plugin automatically generate the PHP file with all your string translation inside your theme', 'pls') ?>.<br />
					<?php _e('The generated file contain all of your theme string using Polylang function "pll_register_string". Just use the WordPress API functions', 'pls') ?>.
				</td>
			</tr>
		</tbody>
	</table>
	<br />
	<form action="options-general.php?page=polylang_translate_string&amp;noheader=true" class="validate" method="post">
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="polylang_method"><?php _e('Method', 'pls') ?></label>
						&nbsp;
						<select name="polylang_trans_form[method]" id="polylang_method">
							<option value="install"><?php _e('Generation', 'pls') ?></option>
							<option value="download"><?php _e('File download', 'pls') ?></option>
						</select>
						<br /><br />
						<?php $plugin_list = get_plugins(); ?>
						<table class="form-table">
							<tbody>
								<tr>
									<?php $i = 0; foreach ($plugin_list as $kplugin => $_plugin): ?>
										<?php if (preg_match('/\//', $kplugin)): ?>
											<?php $i++; ?>
											<td style="font-weight:400">
												<?php $kplugin = explode('/', $kplugin) ?>
												<input id="pl_<?php echo $kplugin[0] ?>" type="checkbox" value="1" name="polylang_plugins[<?php echo $kplugin[0] ?>]">
												<label for="pl_<?php echo $kplugin[0] ?>"><?php echo $_plugin['Name'] ?></label>
											</td style="font-weight:400">
											<?php if ($i%3 == 0): ?>
												</tr><tr>		
											<?php endif ?>
										<?php endif ?>
									<?php endforeach ?>
								</tr>
							</tbody>
						</table>
						<br /><br />
						<?php wp_nonce_field( 'polylang_trans_k', 'polylang_trans_form_post' ); ?>
						<input type="submit" value="<?php _e('Scan the theme for strings & launch', 'pls') ?>" class="button-primary" />
					</th>
				</tr>
			</tbody>
		</table>
	</form>
</div>


