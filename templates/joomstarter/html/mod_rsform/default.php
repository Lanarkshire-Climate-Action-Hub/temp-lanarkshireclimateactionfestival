<?php

/**
 * @version 3.0.0
 * @package RSForm! Pro
 * @copyright (C) 2007-2021 www.rsjoomla.com
 * @license GPL, https://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

// Get module title
$moduleTitle = $module->title;
$headerTag = $params->get('header_tag', 'h3');

?>

<div class="uk-margin-large-bottom uk-margin-large-top uk-margin-large-right uk-margin-large-left">
	<div uk-grid>
		<div class="uk-width-1-2@m">
			<div class="uk-position-relative">
				<div class="uk-position-absolute">
					<img src="/images/assets/person_on_bike.png" alt="person on bike" />
				</div>
			</div>
		</div>
		<div class="uk-width-1-2@m uk-margin-large-bottom uk-margin-large-top">
			<?php if ($moduleTitle) : ?>
				<<?php echo $headerTag; ?> class="uk-margin-bottom gardein uk-text-primary oneHundred"><span><?php echo $moduleTitle; ?></span></<?php echo $headerTag; ?>>
			<?php endif; ?>
			<div class="rsform" id="get-in-touch">
				<?php echo RSFormProHelper::displayForm($formId, true); ?>
			</div>
		</div>
	</div>
</div>