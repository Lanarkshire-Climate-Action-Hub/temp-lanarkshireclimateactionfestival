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
use Joomla\CMS\Router\Route;

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


<div class="com-content-category-blog getinvolved uk-background-yellow uk-height-match" uk-grid>
    <div class="uk-width-1-3@m uk-width-1-1 uk-flex uk-flex-middle uk-text-center">
        <?php if ($this->params->get('show_category_title', 1)) : ?>
            <<?php echo $htag; ?> class="oneHundred uk-text-primary">
                <?php echo $this->category->title; ?>
            </<?php echo $htag; ?>>
        <?php endif; ?>
        <?php echo $afterDisplayTitle; ?>
    </div>
    <?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
        <?php $this->category->tagLayout = new FileLayout('joomla.content.tags'); ?>
        <?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
    <?php endif; ?>

    <?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
        <div class="uk-width-2-3@m uk-width-1-1">
            <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
                <?php echo LayoutHelper::render(
                    'joomla.html.image',
                    [
                        'src' => $this->category->getParams()->get('image'),
                        'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
                    ]
                ); ?>
            <?php endif; ?>
            <?php echo $beforeDisplayContent; ?>
            <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                <?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
            <?php endif; ?>
            <?php echo $afterDisplayContent; ?>
        </div>
    <?php endif; ?>
</div>




<div class="uk-margin-large uk-margin-large-left uk-margin-large-right uk-background-white uk-text-center">

    <div class="com-content-category-blog__items" uk-height-match="target: .item-content h2" uk-grid>

        <div class="uk-width-1-3@m">
            <div class="item-content uk-text-center uk-padding mobile-remove-padding-bottom mobile-remove-padding-top mobile-remove-padding">
                <h2 class="uk-padding-large sixty signpost_border uk-background-primary bounce-on-hover vertical-center uk-text-center height160">
                    <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=2&Itemid=119'); ?>">
                        Host an event </a>
                </h2>
            </div>
        </div>

        <div class="uk-width-1-3@m">
            <div class="item-content uk-text-center uk-padding mobile-remove-padding-bottom mobile-remove-padding-top mobile-remove-padding">
                <h2 class="uk-padding-large sixty signpost_border uk-background-secondary bounce-on-hover vertical-center uk-text-center height160">
                    <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=6&Itemid=120'); ?>">
                        Take part in an event </a>
                </h2>
            </div>
        </div>

        <div class="uk-width-1-3@m">
            <div class="item-content uk-text-center uk-padding mobile-remove-padding-bottom mobile-remove-padding-top mobile-remove-padding">
                <h2 class="uk-padding-large sixty signpost_border uk-background-orange bounce-on-hover vertical-center uk-text-center height160">
                    <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=7&Itemid=121'); ?>">
                        Sponsorship </a>
                </h2>
            </div>
        </div>

    </div>

</div>