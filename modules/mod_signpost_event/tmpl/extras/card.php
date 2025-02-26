<?php defined('_JEXEC') or die; ?>

<?php

use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

// Get menu item details
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
    $menuTitle = htmlspecialchars($extra->custom_menutitle, ENT_QUOTES, 'UTF-8');
}

?>

<div class="mod-signpost_event-item card-layout">
    <div class="uk-card uk-text-center animate bounce-on-hover">
        <a href="<?php echo htmlspecialchars($menuLink, ENT_QUOTES, 'UTF-8'); ?>" class="mod-signpost_event-link remove-decoration">
            <div class="uk-card-header uk-background-primary signpost_border_top_left signpost_border_top_right">
                <h3 class="uk-card-title uk-padding"></h3>
            </div>
            <div class="uk-card-body uk-padding-large eighty lcaf-text-primary outfit-bold uk-background-default signpost_border_bottom_left signpost_border_bottom_right"><?php echo htmlspecialchars($menuTitle, ENT_QUOTES, 'UTF-8'); ?></div>
        </a>
    </div>
</div>