<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$params  = $displayData->params;
$images  = json_decode($displayData->images);

if (empty($images->image_intro)) {
    return;
}

$imgclass   = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro;
$layoutAttr = [
    'src' => $images->image_intro,
    'alt' => empty($images->image_intro_alt) && empty($images->image_intro_alt_empty) ? false : $images->image_intro_alt,
    'class' => 'news_border_top_left news_border_top_right',
];
?>
        <a href="<?php echo Route::_(RouteHelper::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>" title="<?php echo $this->escape($displayData->title); ?>">
            <?php echo LayoutHelper::render('joomla.html.image', $layoutAttr); ?>
        </a>


    <?php if (isset($images->image_intro_caption) && $images->image_intro_caption !== '') : ?>
        <figcaption class="caption"><?php echo $this->escape($images->image_intro_caption); ?></figcaption>
    <?php endif; ?>
