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

// Generate the SEF-friendly URL
$festivalProgrammeUrl = Route::_('index.php?option=com_content&view=category&layout=blog&id=11&Itemid=110');

// Check if associations are implemented. If they are, define the parameter.
$assocParam        = (Associations::isEnabled() && $params->get('show_associations'));
$currentDate       = Factory::getDate()->format('Y-m-d H:i:s');
$isNotPublishedYet = $this->item->publish_up > $currentDate;
$isExpired         = !is_null($this->item->publish_down) && $this->item->publish_down < $currentDate;

// Get custom fields
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);

$startTheConversations = '';
$startTheConversations_title = '';

$climateActions = '';
$climateActions_title = '';
$climateActionsLink = '';
$climateActionsLink_title = '';

$wwfFootprint = '';
$wwfFootprint_title = '';
$wwfFootprintLink = '';
$wwfFootprintLink_title = '';

$visitHubHeading = '';
$visitHubWebsiteLink = '';
$visitHubWebsite_title = '';

$startClimateConversationsWithKids = '';
$startClimateConversationsWithKids_title = '';

$description1 = '';
$description2 = '';
$description3 = '';
$description4 = '';
$description5 = '';
$heading1 = '';
$heading2 = '';
$heading3 = '';
$heading4 = '';
$heading5 = '';

foreach ($fields as $field) {
    if ($field->id == 125) {
        $startTheConversations = $field->value;
        $startTheConversations_title = $field->title;
    }
    if ($field->id == 126) {
        $visitHubHeading = $field->value;
    }
    if ($field->id == 128) {
        $visitHubWebsiteLink = $field->value;
        $visitHubWebsite_title = $field->title;
    }
    if ($field->id == 129) {
        $climateActions = $field->value;
        $climateActions_title = $field->title;
    }
    if ($field->id == 130) {
        $wwfFootprint = $field->value;
        $wwfFootprint_title = $field->title;
    }
    if ($field->id == 131) {
        $climateActionsLink = $field->value;
        $climateActionsLink_title = $field->title;
    }
    if ($field->id == 132) {
        $wwfFootprintLink = $field->value;
        $wwfFootprintLink_title = $field->title;
    }
    if ($field->id == 133) {
        $startClimateConversationsWithKids = $field->value;
        $startClimateConversationsWithKids_title = $field->title;
    }
    if ($field->id == 134) {
        $description1 = $field->value;
    }
    if ($field->id == 135) {
        $description2 = $field->value;
    }
    if ($field->id == 136) {
        $description3 = $field->value;
    }
    if ($field->id == 137) {
        $description4 = $field->value;
    }
    if ($field->id == 138) {
        $description5 = $field->value;
    }
    if ($field->id == 139) {
        $heading1 = $field->value;
    }
    if ($field->id == 140) {
        $heading2 = $field->value;
    }
    if ($field->id == 141) {
        $heading3 = $field->value;
    }
    if ($field->id == 142) {
        $heading4 = $field->value;
    }
    if ($field->id == 143) {
        $heading5 = $field->value;
    }
}

?>

<div id="talking-climate">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-yellow uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-3@m uk-padding-large">
            <div class="page-header uk-padding vertical-center">
                <h1 class="uk-text-primary uk-text-center oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        </div>
    </div>

    <div class="uk-background-default uk-margin-xlarge-bottom uk-margin-top uk-padding-large uk-background-center-right uk-background-norepeat uk-background-contain" style="background-image: url(images/backgrounds/cloud.png);">
        <div class="uk-container-expand">
            <div uk-grid>
                <div class="uk-width-2-3@m">
                    <h2 class="uk-text-primary gardein eighty uk-text-bold"><?php echo $startTheConversations_title; ?></h2>
                    <?php echo $startTheConversations; ?>
                </div>
            </div>
        </div>
    </div>



    <div id="engaging-adults" class="uk-background-default uk-margin-xlarge-top uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand">
            <div class="yellow-strip">
                <div class="vertical-center uk-margin-large-top uk-margin-large-bottom">

                    <div class="uk-margin-large-left uk-margin-large-right">
                        <h2 class="gardein uk-text-primary uk-text-bold sixty_five uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-top">Starting climate conversations with adults</h3>
                            <div uk-grid class="uk-margin-xlarge-top">
                                <div class="uk-width-1-3@m" id="climateActions">
                                    <div class="uk-position-relative signpost_border uk-background-primary uk-padding-large">
                                        <h3 class="uk-text-white uk-text-center sixty uk-text-bold uk-text-bolder uk-margin-remove">
                                            <?php echo $climateActions_title; ?>
                                        </h3>
                                        <div class="uk-margin-top uk-text-center">
                                            <?php echo $climateActions; ?>
                                        </div>
                                        <div class="uk-margin-top uk-position-absolute">
                                            <a href="<?php echo $climateActionsLink; ?>" class="uk-button gardein forty hub_website_funding uk-button-yellow submit-button-border uk-text-bold">
                                                <?php echo $climateActionsLink_title; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-3@m" id="wwfFootprint">
                                    <div class="uk-position-relative signpost_border uk-background-primary uk-padding">
                                        <h3 class="uk-text-white uk-text-center sixty uk-text-bold uk-text-bolder uk-margin-remove">
                                            <?php echo $wwfFootprint_title; ?>
                                        </h3>
                                        <div class="uk-margin-top uk-text-center">
                                            <?php echo $wwfFootprint; ?>
                                        </div>
                                        <div class="uk-margin-top uk-position-absolute">
                                            <a href="<?php echo $wwfFootprintLink; ?>" class="uk-button gardein forty hub_website_funding uk-button-yellow submit-button-border uk-text-bold">
                                                <?php echo $wwfFootprintLink_title; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-3@m" id="visitHub">
                                    <div class="uk-position-relative uk-padding-large uk-background-secondary signpost_border">
                                        <!-- Circular Image -->
                                        <div class="uk-position-absolute custom-circle">
                                            <img src="/images/logo/lcah_logo.png" alt="Lanarkshire Climate Action Hub" class="uk-border-circle">
                                        </div>

                                        <!-- Heading Text -->
                                        <h3 class="uk-text-white sixty uk-text-bold uk-text-bolder uk-margin-remove">
                                            <?php echo $visitHubHeading; ?>
                                        </h3>

                                        <!-- Button -->
                                        <div class="uk-margin-top uk-position-absolute">
                                            <a href="<?php echo $visitHubWebsiteLink; ?>" class="uk-position-relative uk-button gardein forty uk-button-orange hub_website_funding submit-button-border uk-text-white uk-text-bold">
                                                <?php echo $visitHubWebsite_title; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="engaging-kids" class="uk-background-default uk-margin-xlarge-top uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-xlarge-right">
            <div uk-grid>
                <div class="uk-width-1-1">
                    <h2 class="uk-text-primary gardein eighty uk-text-bold"><?php echo $startClimateConversationsWithKids_title; ?></h2>
                </div>
                <div class="uk-width-4-5@m">
                    <?php echo $startClimateConversationsWithKids; ?>
                </div>
            </div>
        </div>

        <div id="tips">
            <div class="uk-container-expand uk-margin-large-left uk-margin-xlarge-right">
                <div uk-grid class="uk-padding">
                    <!--<?php echo $heading1; ?>-->
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-default uk-position-relative uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-xlarge-left uk-border-rounded custom-card" uk-grid>
                            <!-- Circular Image Container -->
                            <div class="circle-container uk-position-absolute" id="icon">
                                <div class="circle-border border-blue uk-background-primary">
                                    <img src="/images/icons/colouring_sheet_strawberry.png" alt="" uk-cover>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="uk-width-expand@s uk-padding uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                <div class="uk-card-body uk-padding">
                                    <h3 class="uk-text-bold fifty uk-text-primary"><?php echo $heading1; ?></h3>
                                    <?php echo $description1; ?>
                                </div>
                            </div>
                            <div id="downloadButton" class="uk-margin-top uk-position-absolute uk-position-bottom-right">
                                <div class="">
                                    <a href="https://drive.google.com/file/d/1bxtChDl6slj5xpVnaGkWCyG-Hl-8tlhi/view?usp=drive_link" class="remove-decoration download" target="_blank">
                                        <div class="uk-card uk-card-default submit-button-border" uk-grid>
                                            <!-- Text Content -->
                                            <div class="uk-width-expand@s kids_download_sheets_button_padding uk-button-primary submit-button-border">
                                                <div class="uk-card-body uk-text-default gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                                    Download Colouring Sheet </div>
                                            </div>
                                            <!-- Circular Image Container -->
                                            <div class="circle-container">
                                                <div class="circle-border border-white">
                                                    <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<?php echo $heading2; ?>-->
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-default uk-position-relative uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-xlarge-left uk-border-rounded custom-card" uk-grid>
                            <!-- Circular Image Container -->
                            <div class="circle-container uk-position-absolute" id="icon">
                                <div class="circle-border border-blue uk-background-primary">
                                    <img src="/images/icons/apple_core_flipped.png" alt="" uk-cover>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="uk-width-expand@s uk-padding uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                <div class="uk-card-body uk-padding">
                                    <h3 class="uk-text-bold fifty uk-text-primary"><?php echo $heading2; ?></h3>
                                    <?php echo $description2; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<?php echo $heading3; ?>-->
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-default uk-position-relative uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-xlarge-left uk-border-rounded custom-card" uk-grid>
                            <!-- Circular Image Container -->
                            <div class="circle-container uk-position-absolute" id="icon">
                                <div class="circle-border border-blue uk-background-primary">
                                    <img src="/images/icons/recycle_white.png" alt="" uk-cover>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="uk-width-expand@s uk-padding uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                <div class="uk-card-body uk-padding">
                                    <h3 class="uk-text-bold fifty uk-text-primary"><?php echo $heading3; ?></h3>
                                    <?php echo $description3; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<?php echo $heading4; ?>-->
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-default uk-position-relative uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-xlarge-left uk-border-rounded custom-card" uk-grid>
                            <!-- Circular Image Container -->
                            <div class="circle-container uk-position-absolute" id="icon">
                                <div class="circle-border border-blue uk-background-primary">
                                    <img src="/images/icons/carrot.png" alt="" uk-cover>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="uk-width-expand@s uk-padding uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                <div class="uk-card-body uk-padding">
                                    <h3 class="uk-text-bold fifty uk-text-primary"><?php echo $heading4; ?></h3>
                                    <?php echo $description4; ?>
                                </div>
                            </div>
                            <div id="downloadButton" class="uk-margin-top uk-position-absolute uk-position-bottom-right">
                                <div class="">
                                    <a href="https://drive.google.com/file/d/1QXFevSVGan2KyheBCFTjIt7Ynr2OjYO2/view?usp=drive_link" class="remove-decoration download" target="_blank">
                                        <div class="uk-card uk-card-default submit-button-border" uk-grid>
                                            <!-- Text Content -->
                                            <div class="uk-width-expand@s kids_download_sheets_button_padding uk-button-primary submit-button-border">
                                                <div class="uk-card-body uk-text-default gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                                    Download Colouring Sheet </div>
                                            </div>
                                            <!-- Circular Image Container -->
                                            <div class="circle-container">
                                                <div class="circle-border border-white">
                                                    <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<?php echo $heading5; ?>-->
                    <div class="uk-width-1-1">
                        <div class="uk-card uk-card-default uk-position-relative uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-xlarge-left uk-border-rounded custom-card" uk-grid>
                            <!-- Circular Image Container -->
                            <div class="circle-container uk-position-absolute" id="icon">
                                <div class="circle-border border-blue uk-background-primary">
                                    <img src="/images/icons/clover.png" alt="" uk-cover>
                                </div>
                            </div>
                            <!-- Text Content -->
                            <div class="uk-width-expand@s uk-padding uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                <div class="uk-card-body uk-padding uk-margin-xlarge-bottom">
                                    <h3 class="uk-text-bold fifty uk-text-primary"><?php echo $heading5; ?></h3>
                                    <?php echo $description5; ?>
                                </div>
                            </div>

                            <div uk-grid>

                                <div class="uk-width-1-2@m">
                                    <div id="downloadButton" class="uk-margin-top uk-position-absolute bottom_left">
                                        <div class="">
                                            <a href="https://drive.google.com/file/d/1UFc5vJULT5KDmbae7SkA7MvABYXx4f8t/view?usp=drive_link" class="remove-decoration download" target="_blank">
                                                <div class="uk-card uk-card-default submit-button-border" uk-grid>
                                                    <!-- Text Content -->
                                                    <div class="uk-width-expand@s kids_download_bingo_sheets_button_padding uk-button-primary submit-button-border">
                                                        <div class="uk-card-body uk-text-default gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                                        Download Bingo Sheet<br>for primary school kids </div>
                                                    </div>
                                                    <!-- Circular Image Container -->
                                                    <div class="circle-container">
                                                        <div class="circle-border border-white">
                                                            <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="uk-width-1-2@m">
                                    <div id="downloadButton" class="uk-margin-top uk-position-absolute uk-position-bottom-right">
                                        <div class="">
                                            <a href="https://drive.google.com/file/d/1pSJi4hN2qTA5by2Rl6VIPb9E2aOyyo6P/view?usp=drive_link" class="remove-decoration download" target="_blank">
                                                <div class="uk-card uk-card-default submit-button-border" uk-grid>
                                                    <!-- Text Content -->
                                                    <div class="uk-width-expand@s kids_download_bingo_sheets_button_padding uk-button-primary submit-button-border">
                                                        <div class="uk-card-body uk-text-default gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                                        Download Bingo Sheet<br>for high school kids </div>
                                                    </div>
                                                    <!-- Circular Image Container -->
                                                    <div class="circle-container">
                                                        <div class="circle-border border-white">
                                                            <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>