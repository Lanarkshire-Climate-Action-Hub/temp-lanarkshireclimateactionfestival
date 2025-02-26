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

// Ensure image object exists and extract the correct image path
$imagePath = '';
$altText = '';

if (isset($extra->image) && is_object($extra->image)) {
    if (!empty($extra->image->imagefile)) {
        $rawImagePath = $extra->image->imagefile;
        $imagePath = explode('#', $rawImagePath)[0]; // Remove metadata
        $imagePath = Uri::root() . ltrim($imagePath, '/');
    }

    $altText = $extra->image->alt_text ?? '';
}
?>

<div class="mod-signpost_event-item">
    <div class="uk-background-default signpost_border uk-padding uk-text-center animate bounce-on-hover">
        <a href="<?php echo htmlspecialchars($menuLink, ENT_QUOTES, 'UTF-8'); ?>" class="mod-signpost_event-link eighty lcaf-text-primary outfit-bold remove-decoration">
            <?php if (!empty($imagePath)) : ?>
                <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                     alt="<?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?>"
                     class="mod-signpost_event-image">
            <?php endif; ?>

            <div><?php echo htmlspecialchars($menuTitle, ENT_QUOTES, 'UTF-8'); ?></div>
        </a>
    </div>
</div>
