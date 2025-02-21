<?php

defined('_JEXEC') or die;

// Import Joomla classes
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

// Get the document instance
$document = Factory::getDocument();
$wa = $document->getWebAssetManager();

// Get the module parameters
$holding_image = $params->get('holding_image');
$video = $params->get('video');
$use_videojs = $params->get('use_videojs', 0);
$autoplay = $params->get('autoplay', 0) ? 'autoplay' : '';
$loop = $params->get('loop', 0) ? 'loop' : '';
$muted = $params->get('muted', 0) ? 'muted' : '';
$controls = $params->get('controls', 1) ? 'controls' : '';

// Register and add module-specific CSS and JS
$wa->registerStyle('mod_videoplayer.styles', 'modules/mod_videoplayer/media/css/mod_videoplayer.min.css', [], ['version' => 'auto']);
$wa->registerScript('mod_videoplayer.scripts', 'modules/mod_videoplayer/media/js/mod_videoplayer.min.js', [], ['version' => 'auto']);

$wa->useStyle('mod_videoplayer.styles');
$wa->useScript('mod_videoplayer.scripts');

// Add VideoJS assets if enabled
if ($use_videojs) {
    $wa->registerStyle('videojs.css', 'https://vjs.zencdn.net/8.16.1/video-js.css');
    $wa->registerScript('videojs.js', 'https://vjs.zencdn.net/8.16.1/video.min.js');
    $wa->useStyle('videojs.css');
    $wa->useScript('videojs.js');
}

// Load the module layout
require ModuleHelper::getLayoutPath('mod_videoplayer', 'default');
