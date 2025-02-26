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

<div class="mod_funding_open">
    <div class="uk-child-width-1-2@s uk-child-width-1-1@m" uk-grid>
        <div class="uk-background-contain uk-background-bottom-right uk-background-image@m <?php echo $background_color; ?> uk-height-medium uk-panel uk-flex uk-flex-middle" style="background-image: url(<?php echo htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>); height: 90vh">
            <div class="uk-align-center@s uk-align-left@m uk-margin-large-left uk-margin-large-right">
                <h2 class="uk-margin-top uk-margin-bottom gardein uk-text-white oneHundred uk-width-1-2@m uk-width-1-1@s"><?php echo htmlspecialchars($copy, ENT_QUOTES, 'UTF-8'); ?></h2>
                <a class="uk-button uk-button-default uk-button-yellow gardein forty" href="<?php echo Route::_('index.php?Itemid=' . (int) $link); ?>">
                    <?php echo htmlspecialchars($link_title, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
        </div>
    </div>
</div>