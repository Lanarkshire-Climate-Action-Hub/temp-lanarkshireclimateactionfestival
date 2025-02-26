<?php

defined('_JEXEC') or die;

// Import necessary Joomla classes
use Joomla\CMS\Helper\ModuleHelper;

// Fetch the greeting from parameters
$image = $params->get('image');
$copy = $params->get('copy');
$link_title = $params->get('link_title');
$link = $params->get('link');
$background_color = $params->get('background_color');

if ($background_color = '0') {
    $background_color = 'uk-background-primary';
} elseif ($background_color = '1') {
    $background_color = 'uk-background-secondary';
} elseif ($background_color = '2') {
    $background_color = 'uk-background-yellow';
} elseif ($background_color = '3') {
    $background_color = 'uk-background-orange';
}

// Load the module layout
require ModuleHelper::getLayoutPath('mod_funding_open', 'default');
