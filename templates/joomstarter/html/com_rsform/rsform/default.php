<?php

/**
 * @package RSForm! Pro
 * @copyright (C) 2007-2019 www.rsjoomla.com
 * @license GPL, http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die('Restricted access');
?>

<div class="uk-container-expand uk-margin-large-left uk-margin-large-right" uk-grid>
	<div class="uk-width-1-1">
		<h1 class="uk-text-primary gardein uk-text-bold oneHundred">Get in touch</h1>
	</div>
</div>

<div class="uk-background-cover" style="background-image: url(images/backgrounds/contact_road.png);" uk-grid uk-height-viewport="offset-bottom: 20">
	<div class="uk-width-1-2@m uk-margin-large-left uk-margin-large-right">
		<div class="rsform" id="get-in-touch">
			<?php echo RSFormProHelper::displayForm($this->formId); ?>
		</div>
	</div>
</div>