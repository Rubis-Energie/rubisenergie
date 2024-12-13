<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

if (!defined('DNA_THEME_VERSION')) exit;
?>
<div class="g-recaptcha" data-sitekey="<?php echo $key ?>"<?php echo $callback ? ' data-callback="'.$callback.'"' : ''; ?>></div>