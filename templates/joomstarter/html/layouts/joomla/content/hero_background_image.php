<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$params  = $displayData->params;
$images  = json_decode($displayData->images);

if (empty($images->image_fulltext)) {
    return;
}

$backgroundImage = 'background-image: url(' . $images->image_fulltext . ');';
?>

<style>
    .hero {
        <?php echo $backgroundImage; ?>
    }
</style>
