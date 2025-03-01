<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\WebAsset\WebAssetManager;

// Get the document instance
$document = Factory::getDocument();
$wa = $document->getWebAssetManager();

// Register and add the CSS and JS files
$wa->registerStyle('mod_image_carousel.styles', 'media/modules/mod_image_carousel/css/mod_image_carousel.min.css', [], ['version' => 'auto']);
$wa->registerScript('mod_image_carousel.scripts', 'media/modules/mod_image_carousel/js/mod_image_carousel.min.js', [], ['version' => 'auto']);

$wa->useStyle('mod_image_carousel.styles');
$wa->useScript('mod_image_carousel.scripts');

$extras = $params->get('extras', []);
$layout = $params->get('layout', 'default'); // Default to "default" layout

// Load the corresponding layout file from the tmpl/ folder
require ModuleHelper::getLayoutPath('mod_image_carousel', $layout);
