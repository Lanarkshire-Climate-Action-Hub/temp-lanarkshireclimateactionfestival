<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_festival_map
 *
 * @copyright   (C) 2025 Your Name
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseInterface;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''));

// Retrieve map markers
$db = Factory::getContainer()->get(DatabaseInterface::class);
$categories = [12, 13, 14, 15, 16];
$fieldIds = [144, 145]; // Latitude and Longitude custom field IDs

$query = $db->getQuery(true)
    ->select(['c.id', 'c.title', 'c.catid', 'fv.field_id', 'fv.value'])
    ->from($db->quoteName('#__content', 'c'))
    ->join('LEFT', $db->quoteName('#__fields_values', 'fv') . ' ON c.id = fv.item_id')
    ->where($db->quoteName('c.catid') . ' IN (' . implode(',', $categories) . ')')
    ->where($db->quoteName('fv.field_id') . ' IN (' . implode(',', $fieldIds) . ')')
    ->where($db->quoteName('c.state') . ' = 1')
    ->order($db->quoteName('c.title') . ' ASC');

$db->setQuery($query);
$results = $db->loadObjectList();

$articles = [];
foreach ($results as $result) {
    if (!isset($articles[$result->id])) {
        $articles[$result->id] = [
            'title' => $result->title,
            'category_id' => $result->catid,
            'latitude' => null,
            'longitude' => null
        ];
    }

    if ($result->field_id == 144) {
        $articles[$result->id]['latitude'] = $result->value;
    }

    if ($result->field_id == 145) {
        $articles[$result->id]['longitude'] = $result->value;
    }
}

// Convert data to JSON
$mapData = json_encode(array_values($articles));

require ModuleHelper::getLayoutPath('mod_festival_map', 'default');
