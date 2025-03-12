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
<div class="com-content-category-blog blog" id="news">

    <div class="item-page<?php echo $this->pageclass_sfx; ?> uk-background-default uk-background-contain uk-height-large uk-panel uk-flex uk-flex-middle" uk-grid>
        <div class="uk-width-1-3@m">
            <div class="page-header vertical-center uk-text-left">
                <h1 class="uk-text-primary oneHundred uk-text-center"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        </div>
        <?php if ($this->params->def('show_description_image', 1)) : ?>
            <div class="uk-width-expand">
                <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
                    <?php echo LayoutHelper::render(
                        'joomla.html.news_image',
                        [
                            'src' => $this->category->getParams()->get('image'),
                            'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
                        ]
                    ); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($this->lead_items)) : ?>
        <div class="uk-background-primary uk-padding-large uk-padding-remove-right uk-padding-remove-left" id="lead_items">
            <div class="uk-container-expand">
                <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider="autoplay: true">
                    <div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
                        <?php foreach ($this->lead_items as &$item) : ?>
                            <div class="com-content-category-blog__item blog-item">
                                <?php
                                $this->item = &$item;
                                echo $this->loadTemplate('item');
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($this->intro_items)) : ?>
        <div class="uk-background-default uk-padding-large uk-padding-remove-right uk-padding-remove-left" id="intro_items">
            <div class="uk-container-expand">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="autoplay: true">
                    <div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
                        <?php foreach ($this->intro_items as $key => &$item) : ?>
                            <div class="com-content-category-blog__item blog-item">
                                <?php
                                $this->item = &$item;
                                echo $this->loadTemplate('item');
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>