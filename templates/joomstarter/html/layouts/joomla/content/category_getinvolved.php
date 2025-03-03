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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

/**
 * Note that this layout opens a div with the page class suffix. If you do not use the category children
 * layout you need to close this div either by overriding this file or in your main layout.
 */
$params    = $displayData->params;
$category  = $displayData->get('category');
$extension = $category->extension;
$canEdit   = $params->get('access-edit');
$className = substr($extension, 4);
$htag      = $params->get('show_page_heading') ? 'h2' : 'h1';

$app = Factory::getApplication();

$category->text = $category->description;
$app->triggerEvent('onContentPrepare', [$extension . '.categories', &$category, &$params, 0]);
$category->description = $category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$extension . '.categories', &$category, &$params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$extension . '.categories', &$category, &$params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$extension . '.categories', &$category, &$params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

/**
 * This will work for the core components but not necessarily for other components
 * that may have different pluralisation rules.
 */
if (substr($className, -1) === 's') {
    $className = rtrim($className, 's');
}

$tagsData = $category->tags->itemTags;
?>
<div class="<?php echo $className . '-category' . $displayData->pageclass_sfx; ?>" uk-grid>
    <div>
        <h1>
            <?php echo $displayData->escape($params->get('page_heading')); ?>
        </h1>
    </div>

        <div class="category-desc">
            <?php if ($params->get('show_description_image') && $category->getParams()->get('image')) : ?>
                    <?php echo LayoutHelper::render(
                        'joomla.html.image',
                        [
                            'src' => $category->getParams()->get('image'),
                            'alt' => empty($category->getParams()->get('image_alt')) && empty($category->getParams()->get('image_alt_empty')) ? false : $category->getParams()->get('image_alt'),
                        ]
                    ); ?>
            <?php endif; ?>
            <?php echo $beforeDisplayContent; ?>
            <?php if ($params->get('show_description') && $category->description) : ?>
                <?php echo HTMLHelper::_('content.prepare', $category->description, '', $extension . '.category.description'); ?>
            <?php endif; ?>
            <?php echo $afterDisplayContent; ?>
        </div>

</div>
