<?php defined('_JEXEC') or die; ?>

<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Menu\MenuHelper;
use Joomla\CMS\Helper\ModuleHelper;

// Get the Joomla menu instance
$menu = Factory::getApplication()->getMenu();

// Convert $extras to an array if it's an object
$extras = is_object($extras) ? (array) $extras : $extras;
$extraCount = is_array($extras) ? count($extras) : 0;

// Ensure at least 1 column if there are no extras
$gridWidth = ($extraCount > 0) ? "uk-child-width-1-{$extraCount}@m" : "uk-child-width-1-1@m";

?>

<div id="signpost_event" class="uk-padding-large uk-padding-remove-left uk-padding-remove-right <?php echo $selected_background_color; ?> mod-signpost_event<?php echo htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8'); ?>">
    <div class="uk-margin-large-left uk-margin-large-right">
        <?php
        // Show the module title only if "Show Title" is enabled
        if ($module->showtitle) :
        ?>
            <h2 class="uk-margin-bottom gardein uk-text-white oneHundred uk-width-1-1@s">
                <?php echo htmlspecialchars($module->title, ENT_QUOTES, 'UTF-8'); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($extras)) : ?>
            <div class="uk-grid <?php echo $gridWidth; ?>" uk-grid uk-height-match="target: > .mod-signpost_event-item">
                <?php foreach ($extras as $extra) : ?>
                    <?php
                    // Get the layout for this item (default to "default")
                    $itemLayout = !empty($extra->layout) ? $extra->layout : 'default';

                    // Load the corresponding item layout from tmpl/extras/
                    $layoutPath = __DIR__ . "/extras/{$itemLayout}.php";

                    if (file_exists($layoutPath)) {
                        include $layoutPath;
                    } else {
                        echo "<p>Missing layout: {$itemLayout}.php</p>";
                    }
                    ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
