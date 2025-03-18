<?php

defined('_JEXEC') or die;

// Import necessary Joomla classes
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Registry\Registry;

// Fetch the greeting from parameters
$image = $params->get('image');
$date = $params->get('date');
$link_title = $params->get('link_title');
$link = $params->get('link');
$show_programme = $params->get('show_programme');
// Load the module layout
require ModuleHelper::getLayoutPath('mod_welcome', 'default');
