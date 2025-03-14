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
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

/** @var \Joomla\Component\Content\Site\View\Article\HtmlView $this */
// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = $this->getCurrentUser();
$info    = $params->get('info_block_position', 0);
$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

// Check if associations are implemented. If they are, define the parameter.
$assocParam        = (Associations::isEnabled() && $params->get('show_associations'));
$currentDate       = Factory::getDate()->format('Y-m-d H:i:s');
$isNotPublishedYet = $this->item->publish_up > $currentDate;
$isExpired         = !is_null($this->item->publish_down) && $this->item->publish_down < $currentDate;

// Get custom fields
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);
$secondAboutImage = '';
$secondTextArea = '';
$secondTitle = '';
$menuItemId = null;
$introText = '';
$interestedImage = '';

foreach ($fields as $field) {
    if ($field->id == 8) { // ID for "second-about-image"
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $secondAboutImage = $imageData->imagefile;
        }
    }
    if ($field->id == 9) { // ID for "second-text-area"
        $secondTextArea = $field->value;
    }
    if ($field->id == 10) { // ID for "second-title"
        $secondTitle = $field->value;
    }
    if ($field->id == 11) { // ID for "intro-text"
        $introText = $field->value;
    }
    if ($field->id == 12) { // ID for "menu-item"
        $menuItemId = (int) $field->rawvalue; // Get single menu item ID
    }
    if ($field->id == 13) { // ID for "interested-image"
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $interestedImage = $imageData->imagefile;
        }
    }
}

// Fetch menu item details if a valid menu item ID is selected
$menuItem = null;
if ($menuItemId > 0) {
    $db = Factory::getDbo();
    $query = $db->getQuery(true)
        ->select($db->quoteName(['id', 'title', 'link']))
        ->from($db->quoteName('#__menu'))
        ->where($db->quoteName('id') . ' = ' . $db->quote($menuItemId))
        ->where($db->quoteName('published') . ' = 1')
        ->setLimit(1);
    $db->setQuery($query);
    $menuItem = $db->loadObject();
}
?>

<div class="about-page">
    <div id="intro" class="item-page<?php echo $this->pageclass_sfx; ?> uk-margin-large-left mobile-remove-margin" uk-grid>
        <div class="uk-width-1-2@m uk-padding-remove-left mobile-text-full-width" id="intro-container">
            <?php if ($this->params->get('show_page_heading')) : ?>
                <div class="page-header">
                    <h1 class="uk-text-primary heading-1"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
                </div>
            <?php endif; ?>
            <?php echo $this->item->text; ?>
        </div>
        <div class="uk-width-1-2@m mobile-remove-padding">
            <?php echo LayoutHelper::render('joomla.content.about_full_image', $this->item); ?>
        </div>
    </div>

    <?php if (!empty($secondTextArea) || !empty($secondAboutImage)) : ?>
        <div class="uk-background-secondary">
            <div class="uk-margin-large-right mobile-image-full-width" uk-grid>
                <?php if (!empty($secondAboutImage)) : ?>
                    <div class="uk-width-2-5@m mobile-image-full-width">
                        <img src="<?php echo htmlspecialchars($secondAboutImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Second About Image" class="uk-width-1-1">
                    </div>
                <?php endif; ?>

                <?php if (!empty($secondTextArea)) : ?>
                    <div class="uk-width-3-5@m mobile-text-full-width mobile-margin-bottom">
                        <div class="uk-text-white vertical-center uk-text-left">
                            <h2 class="gardein uk-text-white"><?php echo $secondTitle; ?></h2>
                            <div class="second-text-area-width">
                                <?php echo $secondTextArea; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($introText) || !empty($interestedImage)) : ?>
        <div class="uk-background-default uk-margin-xlarge-top uk-margin-xlarge-bottom mobile-remove-margin-top mobile-remove-margin-bottom">
            <div class="uk-container-expand uk-margin-large-left uk-margin-large-right mobile-remove-margin">
                <div class="uk-flex uk-flex-middle uk-padding-large mobile-remove-padding" uk-grid>
                    <div class="uk-width-1-2@m uk-padding-small uk-text-center">
                        <div id="interested" class="heading-3 uk-text-center uk-margin-large-bottom uk-text-primary">
                            <?php echo $introText; ?>
                        </div>
                        <?php if (!empty($menuItem)) : ?>
                            <a class="uk-button-primary get-involved-border get-involved-padding uk-padding gardein heading-2 uk-text-normal" href="<?php echo Route::_($menuItem->link); ?>">
                                <?php echo htmlspecialchars($menuItem->title, ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="uk-width-1-2@m uk-padding uk-position-relative">
                        <?php if (!empty($interestedImage)) : ?>
                            <img src="<?php echo htmlspecialchars($interestedImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Get Involved" id="getInvolved" class="uk-position-absolute">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>