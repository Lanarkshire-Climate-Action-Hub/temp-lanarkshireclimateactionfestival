<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

/** @var \Joomla\Component\Content\Site\View\Category\HtmlView $this */
$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

?>

<div id="resources">
    <div class="com-content-category-blog" uk-grid>
        <div class="uk-width-1-1 uk-margin-large-left uk-margin-large-right">
            <<?php echo $htag; ?> class="oneHundred uk-text-primary gardein">
                <?php echo $this->category->title; ?>
            </<?php echo $htag; ?>>
            <?php echo $afterDisplayTitle; ?>
        </div>
    </div>

    <div class="uk-margin-large uk-margin-large-left uk-margin-large-right uk-background-white uk-text-center">
        <?php if (!empty($this->intro_items)) : ?>
            <?php $blogClass = $this->params->get('blog_class', ''); ?>
            <?php if ((int) $this->params->get('num_columns') > 1) : ?>
                <?php $blogClass .= (int) $this->params->get('multi_column_order', 0) === 0 ? ' masonry-' : ' columns-'; ?>
                <?php $blogClass .= (int) $this->params->get('num_columns'); ?>
            <?php endif; ?>
            <div class="com-content-category-blog__items blog-items <?php echo $blogClass; ?>" uk-height-match="target: .item-content h2">
                <?php foreach ($this->intro_items as $key => &$item) : ?>
                    <div class="com-content-category-blog__item uk-padding blog-item">
                        <?php
                        $item->index = $key; // Pass index to item template
                        $this->item = &$item;
                        echo $this->loadTemplate('item');
                        ?>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    </div>
</div>