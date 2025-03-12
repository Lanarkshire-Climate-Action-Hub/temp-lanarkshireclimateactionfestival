<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2021 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Layout variables
 * -----------------
 * @var   array  $displayData  Array with all the given attributes for the image element.
 *                             Eg: src, class, alt, width, height, loading, decoding, style, data-*
 *                             Note: only the alt and src attributes are escaped by default!
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

$img = HTMLHelper::_('cleanImageURL', $displayData['src']);
$backgroundImage = $this->escape($img->url);

?>

<div class="uk-background-default uk-background-contain uk-height-large uk-panel uk-flex uk-flex-middle uk-grid uk-grid-stack"
    uk-grid style="background-image: url('<?php echo $backgroundImage; ?>');">
</div>
