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
$grantApplicationForm = '';
$grantGuidance = '';
$grantApplicationFormText = '';
$grantGuidanceText = '';
$whatTypeOfEventsCanYouHost = '';
$whatTypeOfEventsCanYouHost_title = '';
$whoCanApply = '';
$whenToApply = '';
$whatCanTheClimateFestivalGrantBeUsedFor = '';
$accessibility = '';
$whoCanApply_title = '';
$whenToApply_title = '';
$whatCanTheClimateFestivalGrantBeUsedFor_title = '';
$accessibility_title = '';
$otherGrantsHeading = '';
$otherGrantsButtonText = '';
$otherGrantsWebsiteLink = '';
$applyHeading = '';
$applyCopy = '';
$applyButtonText = '';
$helpUsHeading = '';
$helpUsCopy = '';
$helpUsPoster = '';
$helpUsButtonText = '';
$helpUsPosterLink = '';

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
    if ($field->id == 18) { // ID for "grant-application-form"
        $grantApplicationForm = $field->value;
    }
    if ($field->id == 19) { // ID for "grant-guidance"
        $grantGuidance = $field->value;
    }
    if ($field->id == 36) { // ID for "grant-application-form-text"
        $grantApplicationFormText = $field->value;
    }
    if ($field->id == 37) { // ID for "grant-guidance-text"
        $grantGuidanceText = $field->value;
    }
    if ($field->id == 20) { // ID for "what type of events can you host"
        $whatTypeOfEventsCanYouHost = $field->value;
        $whatTypeOfEventsCanYouHost_title = $field->title;
    }
    if ($field->id == 21) { // ID for "who can apply"
        $whoCanApply = $field->value;
        $whoCanApply_title = $field->title;
    }
    if ($field->id == 22) { // ID for "when to apply"
        $whenToApply = $field->value;
        $whenToApply_title = $field->title;
    }
    if ($field->id == 23) { // ID for "what can the climate festival grant be used for"
        $whatCanTheClimateFestivalGrantBeUsedFor = $field->value;
        $whatCanTheClimateFestivalGrantBeUsedFor_title = $field->title;
    }
    if ($field->id == 24) { // ID for "accessibility"
        $accessibility = $field->value;
        $accessibility_title = $field->title;
    }
    if ($field->id == 25) { // ID for "other grants heading"
        $otherGrantsHeading = $field->value;
    }
    if ($field->id == 26) { // ID for "other grants button text"
        $otherGrantsButtonText = $field->value;
    }
    if ($field->id == 27) { // ID for "other grants website link"
        $otherGrantsWebsiteLink = $field->value;
    }
    if ($field->id == 28) { // ID for "apply heading"
        $applyHeading = $field->value;
    }
    if ($field->id == 29) { // ID for "apply copy"
        $applyCopy = $field->value;
    }
    if ($field->id == 30) { // ID for "apply button text"
        $applyButtonText = $field->value;
    }
    if ($field->id == 31) { // ID for "help us heading"
        $helpUsHeading = $field->value;
    }
    if ($field->id == 32) { // ID for "help us copy"
        $helpUsCopy = $field->value;
    }
    if ($field->id == 33) { // ID for "help us poster"
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $helpUsPoster = $imageData->imagefile;
        }
    }
    if ($field->id == 34) { // ID for "help us button text"
        $helpUsButtonText = $field->value;
    }
    if ($field->id == 35) { // ID for "help us poster link"
        $helpUsPosterLink = $field->value;
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

<div id="funding-page">
    <div class="item-page<?php echo $this->pageclass_sfx; ?> uk-background-primary" uk-grid>
        <div class="uk-width-1-3@m uk-padding-large">
            <?php if ($this->params->get('show_page_heading')) : ?>
                <div class="page-header vertical-center uk-padding">
                    <h1 class="uk-text-white oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
                    <span class="outfit uk-text-bold uk-text-yellow fifty"><?php echo $this->item->text; ?></span>
                </div>
            <?php endif; ?>
        </div>
        <div class="uk-width-2-3@m">
            <?php echo LayoutHelper::render('joomla.content.about_full_image', $this->item); ?>
        </div>
    </div>

    <?php if (!empty($secondTextArea) || !empty($secondAboutImage)) : ?>
        <div class="uk-background-secondary uk-padding-large uk-padding-remove-left uk-padding-remove-right">
            <div class="uk-margin-large-right" uk-grid>
                <?php if (!empty($secondAboutImage)) : ?>
                    <div class="uk-width-2-5@m">
                        <img src="<?php echo htmlspecialchars($secondAboutImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Second About Image" class="uk-width-1-1">
                    </div>
                <?php endif; ?>

                <?php if (!empty($secondTextArea)) : ?>
                    <div class="uk-width-3-5@m">
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

    <div id="downloads" class="uk-background-yellow">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div class="uk-padding-large" uk-grid>
                <div class="uk-width-1-1 uk-width-1-2@m uk-padding-large">
                    <div class="uk-position-relative">
                        <div class="uk-background-primary uk-padding-remove-right download_border uk-text-left sixty gardein uk-margin-large-bottom uk-padding uk-text-white uk-position-absolute">
                            <?php echo $grantApplicationFormText; ?>
                        </div>
                        <div class="circle uk-background-default uk-text-center uk-margin-large-bottom uk-position-absolute download_button_position">
                            <div class="uk-padding">
                                <a class="download" target="_blank" href="<?php echo $grantApplicationForm; ?>">
                                    <img src="/images/icons/download.png" alt="<?php echo $grantApplicationFormText; ?>" class="scroll-down uk-width-1-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-1 uk-width-1-2@m uk-padding-large">
                    <div class="uk-position-relative">
                        <div class="uk-background-primary uk-padding-remove-right download_border uk-text-left sixty gardein uk-margin-large-bottom uk-padding uk-text-white uk-position-absolute">
                            <?php echo $grantGuidanceText; ?>
                        </div>
                        <div class="circle uk-background-default uk-text-center uk-margin-large-bottom uk-position-absolute download_button_position">
                            <div class="uk-padding">
                                <a target="_blank" href="<?php echo $grantGuidance; ?>">
                                    <img src="/images/icons/download.png" alt="<?php echo $grantGuidanceText; ?>" class="uk-width-1-1">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="faqs" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-1-2@m">

                    <h3 class="fifty uk-text-primary uk-text-bold border_bottom_blue"><?php echo $whatTypeOfEventsCanYouHost_title; ?></h3>
                    <?php echo $whatTypeOfEventsCanYouHost; ?>

                    <ul uk-accordion>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $whoCanApply_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whoCanApply; ?></div>
                        </li>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $whenToApply_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whenToApply; ?></div>
                        </li>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $whatCanTheClimateFestivalGrantBeUsedFor_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whatCanTheClimateFestivalGrantBeUsedFor; ?></div>
                        </li>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $accessibility_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $accessibility; ?></div>
                        </li>
                    </ul>
                </div>
                <div class="uk-width-1-2@m uk-margin-xlarge-top">

                    <div class="uk-position-relative uk-padding uk-background-secondary submit-button-border custom-box">
                        <!-- Circular Image -->
                        <div class="uk-position-absolute custom-circle">
                            <img src="/images/logo/lcah_logo.png" alt="Lanarkshire Climate Action Hub" class="uk-border-circle">
                        </div>

                        <!-- Heading Text -->
                        <h3 class="uk-text-white eighty uk-text-bold gardein uk-text-bolder uk-margin-remove">
                            
                            Want to<br>know more<br>about our<br>other grants?
                        </h3>

                        <!-- Button -->
                        <div class="uk-margin-top uk-position-absolute">
                            <a href="<?php echo $otherGrantsWebsiteLink; ?>" class="hub_website_button_position uk-button gardein forty uk-button-orange hub_website_funding submit-button-border uk-text-white uk-text-bold">
                                <?php echo $otherGrantsButtonText; ?>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="ready-to-apply">
        <div class="uk-container-expand">
            <div uk-grid class="uk-background-default uk-margin-large-left uk-margin-large-right">
                <div class="uk-width-1-1">
                    <h2 class="gardein uk-text-bold uk-text-primary"><?php echo $applyHeading; ?></h2>
                </div>
            </div>
            <div uk-grid class="uk-background-primary uk-padding-large uk-margin-remove uk-padding-remove-bottom">
                <div class="uk-width-2-3@m uk-width-1-1">
                    <?php echo $applyCopy; ?>
                </div>
                <div class="uk-width-1-3@m uk-width-1-1 uk-position-relative">
                    <div class="uk-position-relative">
                        <img class="uk-position-absolute fixing_bike_image" src="/images/assets/fixing_bike.png" />
                    </div>
                </div>
                <div class="uk-width-1-1 uk-text-center">
                    <a href="mailto:info@climateactionlanarkshire.net?Subject=Festival Grant Application" class="uk-button gardein forty submit-button-border apply_funding_button_padding uk-button-white"><?php echo $applyButtonText; ?></a>
                </div>
            </div>
        </div>
    </div>

    <div id="help-us" class="uk-background-secondary uk-padding">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-2-3@m uk-width-1-1">
                    <h2 class="sixty_five gardein uk-text-bold uk-text-white"><?php echo $helpUsHeading; ?></h2>
                    <div class="uk-text-white"><?php echo $helpUsCopy; ?></div>
                </div>
                <div class="uk-width-1-3@m uk-width-1-1 uk-position-relative">
                    <div class="poster-container uk-position-relative">
                        <img class="poster_rotate uk-position-absolute uk-padding-large" src="<?php echo $helpUsPoster; ?>" />
                        <a href="<?php echo $helpUsPosterLink; ?>" class="uk-button gardein forty submit-button-border download_poster_button_padding uk-button-orange z_index_one uk-position-relative">
                            <?php echo $helpUsButtonText; ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>