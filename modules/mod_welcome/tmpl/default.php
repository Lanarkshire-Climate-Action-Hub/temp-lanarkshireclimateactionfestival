<?php defined('_JEXEC') or die; ?>

<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

// Ensure $image is an object and extract the image path correctly
if (is_object($image) && isset($image->imagefile)) {
    $rawImagePath = $image->imagefile;

    // Extract the correct part of the path before the Joomla URL format
    $imagePath = explode('#', $rawImagePath)[0]; // Removes everything after '#'
    $imagePath = Uri::root() . ltrim($imagePath, '/'); // Ensure full URL
} else {
    $imagePath = ''; // No image selected
}

// Extract the alt text if available
$altText = is_object($image) && isset($image->alt_text) ? $image->alt_text : '';

?>
<div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
    <div class="mod-welcome text-center uk-margin-large-top uk-margin-large-bottom">
        <?php if (!empty($imagePath)) : ?>
            <img src="<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>"
                alt="<?php echo htmlspecialchars($altText, ENT_QUOTES, 'UTF-8'); ?>"
                class="uk-margin-bottom" id="mod-welcome-image">
        <?php endif; ?>

        <h2 class="uk-margin-top uk-margin-bottom"><?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?></h2>

        <a class="uk-button uk-button-default uk-button-yellow" href="<?php echo Route::_('index.php?Itemid=' . (int) $link); ?>">
            <?php echo htmlspecialchars($link_title, ENT_QUOTES, 'UTF-8'); ?>
        </a>
    </div>
</div>