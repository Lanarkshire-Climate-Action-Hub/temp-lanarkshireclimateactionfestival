<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\WebAsset\WebAssetManager;

// Get the document instance
$document = Factory::getDocument();
$wa = $document->getWebAssetManager();

// Register and add the CSS and JS files
$wa->registerStyle('mod_signpost_event.styles', 'media/modules/mod_signpost_event/css/mod_signpost_event.min.css', [], ['version' => 'auto']);
$wa->registerScript('mod_signpost_event.scripts', 'media/modules/mod_signpost_event/js/mod_signpost_event.min.js', [], ['version' => 'auto']);

$wa->useStyle('mod_signpost_event.styles');
$wa->useScript('mod_signpost_event.scripts');

// Get module parameters
$layout = $params->get('layout', 'default');
$background_color = $params->get('background_color');
if ($background_color == '0') {
    $selected_background_color = 'uk-background-primary';
} elseif ($background_color == '1') {
    $selected_background_color = 'uk-background-secondary';
} elseif ($background_color == '2') {
    $selected_background_color = 'uk-background-yellow';
} elseif ($background_color == '3') {
    $selected_background_color = 'uk-background-orange';
}
$extras = $params->get('extras', []);
$layout = $params->get('layout', 'default'); // Default to "default" layout

// Load the corresponding layout file from the tmpl/ folder
require ModuleHelper::getLayoutPath('mod_signpost_event', $layout);
