<?php defined('_JEXEC') or die; ?>

<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Menu\MenuHelper;

// Get the Joomla menu instance
$menu = Factory::getApplication()->getMenu();

?>

<div id="signpost_event" class="uk-padding-large uk-padding-remove-left uk-padding-remove-right <?php echo $selected_background_color; ?> mod-signpost_event<?php echo htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8'); ?>">
    <div class="uk-margin-large-left uk-margin-large-right">
        <?php
        // Only show the module title if "Show Title" is enabled in Joomla
        if ($module->showtitle) :
        ?>
            <h2 class="uk-margin-bottom gardein uk-text-white oneHundred uk-width-1-1@s">
                <?php echo htmlspecialchars($module->title, ENT_QUOTES, 'UTF-8'); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($extras)) : ?>
            <div class="uk-child-width-1-1@s uk-child-width-1-3@m" uk-grid>
                <?php foreach ($extras as $extra) : ?>
                    <div class="mod-signpost_event-item">
                        <div class="uk-background-default signpost_border uk-padding uk-text-center  animate bounce-on-hover">
                            <?php
                            // Check and fetch menu item details
                            $menuTitle = 'Unknown Menu Item';
                            $menuLink = '#';

                            if (!empty($extra->menuitem)) {
                                $menuItem = $menu->getItem((int) $extra->menuitem);
                                if ($menuItem) {
                                    $menuTitle = $menuItem->title ?? 'Unknown Menu Item';
                                    $menuLink  = Route::_('index.php?Itemid=' . (int) $menuItem->id);
                                }
                            }

                            if (!empty($extra->custom_menutitle)) {
                                $menuTitle = $extra->custom_menutitle;
                            }


                            ?>

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
                            <a href="<?php echo htmlspecialchars($menuLink, ENT_QUOTES, 'UTF-8'); ?>" class="mod-signpost_event-link eighty lcaf-text-primary outfit-bold remove-decoration">
                                <?php if (!empty($imagePath)) : ?>
                                    <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                                        alt="<?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?>"
                                        class="mod-signpost_event-image">
                                <?php endif; ?>

                                <div>

                                    <?php echo htmlspecialchars($menuTitle, ENT_QUOTES, 'UTF-8'); ?>

                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>