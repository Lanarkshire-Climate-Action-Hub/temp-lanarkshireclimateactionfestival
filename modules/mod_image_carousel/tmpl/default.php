<?php defined('_JEXEC') or die; ?>

<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

// Get the Joomla menu instance
$menu = Factory::getApplication()->getMenu();

?>

<div id="mod_image_carousel" class="<?php echo htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8'); ?>">
    <?php if (!empty($extras)) : ?>
        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>
            <div class="uk-slideshow-items">
                <?php foreach ($extras as $extra) : ?>
                    <div class="mod-mod_image_carousel-item">
                        <?php
                        // Ensure image object exists and extract the correct image path
                        $imagePath = '';
                        $altText = '';

                        if (isset($extra->image) && is_object($extra->image)) {
                            if (!empty($extra->image->imagefile)) {
                                $rawImagePath = $extra->image->imagefile;
                                $imagePath = explode('#', $rawImagePath)[0]; // Remove metadata
                                $imagePath = Uri::root() . ltrim($imagePath, '/');
                            }
                            // Extract alt text if available
                            $altText = $extra->image->alt_text ?? '';
                        }
                        ?>
                        <?php if (!empty($imagePath)) : ?>
                            <img uk-cover src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?>"
                                class="mod-signpost_event-image">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="uk-position-center-left uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover uk-slidenav-large" href uk-slidenav-next uk-slideshow-item="next"></a>
        </div>
    <?php endif; ?>
</div>