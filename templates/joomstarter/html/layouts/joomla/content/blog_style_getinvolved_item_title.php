<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

// Extract index and item data
$item = $displayData['item'];
$index = isset($displayData['index']) ? $displayData['index'] : 0;

// Background classes based on position
$classes = ['uk-background-primary', 'uk-background-secondary', 'uk-background-orange'];
$backgroundClass = $classes[$index % count($classes)]; // Loop through classes if more than 3 items

$link = RouteHelper::getArticleRoute($item->slug, $item->catid, $item->language);

?>
<h2 class="uk-padding-large sixty signpost_border <?php echo $backgroundClass; ?> bounce-on-hover uk-flex uk-flex-middle uk-text-center">
    <a class="remove-decoration uk-text-white" href="<?php echo Route::_($link); ?>">
        <?php echo $this->escape($item->title); ?>
    </a>
</h2>
