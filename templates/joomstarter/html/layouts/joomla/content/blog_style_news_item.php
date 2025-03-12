<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

// Create a shortcut for params.
$params  = $displayData->params;
$canEdit = $displayData->params->get('access-edit');

$currentDate = Factory::getDate()->format('Y-m-d H:i:s');
$link = RouteHelper::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language);
?>

<div class="uk-background-default uk-padding news_border_bottom_left news_border_bottom_right" id="news">
    <h2 class="seventy uk-text-primary uk-text-normal">
        <?php if ($params->get('link_titles') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
            <a class="remove-decoration" href="<?php echo Route::_($link); ?>">
                <?php echo $this->escape($displayData->title); ?>
            </a>
        <?php else : ?>
            <?php echo $this->escape($displayData->title); ?>
        <?php endif; ?>
    </h2>
</div>