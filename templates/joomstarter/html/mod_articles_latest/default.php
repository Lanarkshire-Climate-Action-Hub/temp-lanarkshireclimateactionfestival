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
?>

<?php if ($moduleTitle) : ?>
    <h3 class="uk-heading-line"><span><?php echo $moduleTitle; ?></span></h3>
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
                    <a href="<?php echo $item->link; ?>" class="article-card uk-display-block uk-card uk-card-default uk-box-shadow-hover-large uk-text-center uk-padding-small" itemscope itemtype="https://schema.org/Article">
                        <?php if ($introImage) : ?>
                            <div class="uk-card-media-top">
                                <img src="<?php echo htmlspecialchars($introImage, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>" itemprop="image" class="uk-border-rounded">
                            </div>
                        <?php endif; ?>
                        <div class="uk-card-body">
                            <h4 class="uk-card-title" itemprop="name"><?php echo $item->title; ?></h4>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slider-item="previous" uk-slidenav-previous></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slider-item="next" uk-slidenav-next></a>
</div>
