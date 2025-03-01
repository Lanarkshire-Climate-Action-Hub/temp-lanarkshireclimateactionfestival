<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (!$list) {
    return;
}

// Get module title
$moduleTitle = $module->title;
$headerTag = $params->get('header_tag', 'h3');

?>
<div class="uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-background-primary">
    <?php if ($moduleTitle) : ?>
        <div class="uk-margin-large-left uk-margin-large-right">
            <<?php echo $headerTag; ?> class="uk-margin-bottom gardein uk-text-white oneHundred uk-width-1-1@s"><span><?php echo $moduleTitle; ?></span></<?php echo $headerTag; ?>>
        </div>
    <?php endif; ?>
    <div class="mod-articleslatest uk-position-relative" uk-slider="finite: false; autoplay: true; pause-on-hover: true">
        <div class="uk-slider-container">
            <ul class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-grid-small" uk-grid>
                <?php foreach ($list as $item) :
                    // Get article image
                    $images = json_decode($item->images);
                    $introImage = isset($images->image_intro) ? $images->image_intro : '';
                ?>
                    <li>
                        <a href="<?php echo $item->link; ?>" class="animate bounce-on-hover remove-decoration article-card uk-display-block uk-card uk-text-center uk-padding-small" itemscope itemtype="https://schema.org/Article">
                            <?php if ($introImage) : ?>
                                <div class="uk-card-media-top">
                                    <img src="<?php echo htmlspecialchars($introImage, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>" itemprop="image" class="news_border_top_left news_border_top_right">
                                </div>
                            <?php endif; ?>
                            <div class="uk-card-body uk-background-default news_border_bottom_left news_border_bottom_right uk-padding-small">
                                <h2 class="outfit uk-text-primary" itemprop="name"><?php echo $item->title; ?></h2>
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slider-item="previous" uk-slidenav-previous></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slider-item="next" uk-slidenav-next></a>
    </div>
</div>