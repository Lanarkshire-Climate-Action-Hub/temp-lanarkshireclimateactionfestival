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

$socialMedia = '';
$socialMedia_title = '';
$postersFlyers = '';
$postersFlyers_title = '';
$radioStations = '';
$radioStations_title = '';
$newsPapers = '';
$newsPapers_title = '';

$flyerLink = '';
$flyerButtonText = '';
$templateLink = '';
$templateButtonText = '';

$beforeYouStart = '';
$beforeYouStart_title = '';
$promotingYourEvent = '';
$promotingYourEvent_title = '';
$weveMadItEasyForYou = '';
$weveMadItEasyForYou_title = '';
$ifYouHaveReceivedFunding = '';
$ifYouHaveReceivedFunding_title = '';
$downloadTheFestivalLogo = '';
$downloadTheFestivalLogo_title = '';
$downloadTheHubLogo = '';
$downloadTheHubLogo_title = '';

foreach ($fields as $field) {
    if ($field->id == 118) {
        $flyerLink = $field->value;
    }
    if ($field->id == 119) {
        $flyerButtonText = $field->value;
    }
    if ($field->id == 120) {
        $templateLink = $field->value;
    }
    if ($field->id == 121) {
        $templateButtonText = $field->value;
    }
    if ($field->id == 115) {
        $beforeYouStart = $field->value;
        $beforeYouStart_title = $field->title;
    }
    if ($field->id == 116) {
        $promotingYourEvent = $field->value;
        $promotingYourEvent_title = $field->title;
    }
    if ($field->id == 117) {
        $weveMadItEasyForYou = $field->value;
        $weveMadItEasyForYou_title = $field->title;
    }
    if ($field->id == 122) {
        $ifYouHaveReceivedFunding = $field->value;
        $ifYouHaveReceivedFunding_title = $field->title;
    }
    if ($field->id == 123) {
        $downloadTheFestivalLogo = $field->value;
        $downloadTheFestivalLogo_title = $field->title;
    }
    if ($field->id == 124) {
        $downloadTheHubLogo = $field->value;
        $downloadTheHubLogo_title = $field->title;
    }
    if ($field->id == 111) {
        $socialMedia = $field->value;
        $socialMedia_title = $field->title;
    }
    if ($field->id == 112) {
        $postersFlyers = $field->value;
        $postersFlyers_title = $field->title;
    }
    if ($field->id == 113) {
        $radioStations = $field->value;
        $radioStations_title = $field->title;
    }
    if ($field->id == 114) {
        $newsPapers = $field->value;
        $newsPapers_title = $field->title;
    }
}

?>

<div id="marketing-promotion">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-orange uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-2@m uk-padding-large uk-margin-xlarge-top uk-margin-xlarge-bottom mobile-remove-margin mobile-remove-margin-top mobile-remove-margin-bottom mobile-remove-padding">
            <div class="page-header uk-padding vertical-center mobile-text-full-width mobile-remove-padding-top mobile-remove-padding-bottom">
                <h1 class="uk-text-white oneHundred mobile-text-full-width"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        </div>
    </div>

    <div id="before-you-start" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right uk-padding-remove-bottom">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-1-3@m uk-background-center-center uk-background-norepeat uk-background-contain" style="background-image: url(images/assets/daffodils.png);">

                </div>
                <div class="uk-width-2-3@m uk-padding uk-padding-remove-right uk-padding-remove-top uk-padding-remove-left">
                    <h3 class="gardein uk-text-orange eighty uk-text-bold"><?php echo $beforeYouStart_title; ?></h3>
                    <div class="uk-margin-top">
                        <div>
                            <?php echo $beforeYouStart; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="promoting-your-event" class="uk-background-darkGreen uk-padding uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-padding uk-padding-remove-right uk-padding-remove-left uk-margin-large-right">
            <div>
                <div class="uk-width-1-1">
                    <h3 class="gardein uk-text-white eighty uk-text-bold"><?php echo $promotingYourEvent_title; ?></h3>
                    <div class="uk-margin-top">
                        <div class="uk-text-white">
                            <?php echo $promotingYourEvent; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="weve-made-it-easy" class="uk-background-orange uk-padding-large uk-padding-remove-left uk-padding-remove-right mobile-remove-margin">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-3-5@m">
                    <h3 class="gardein uk-text-white eighty uk-text-bold"><?php echo $weveMadItEasyForYou_title; ?></h3>
                    <div class="uk-margin-top">
                        <div class="uk-text-white">
                            <?php echo $weveMadItEasyForYou; ?>
                        </div>
                    </div>
                </div>
                <div class="uk-width-2-5@m uk-padding-large uk-padding-remove-top uk-padding-remove-bottom mobile-remove-padding">
                    <div class="uk-padding uk-padding-remove-top uk-padding-remove-bottom uk-margin-top uk-margin-bottom mobile-remove-padding">
                        <a href="<?php echo $flyerLink; ?>" class="remove-decoration download" target="_blank">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom submit-button-border" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-white">
                                        <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-margin-medium-left download_flyer_button_padding">
                                    <div class="uk-card-body uk-text-orange gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                        <?php echo $flyerButtonText; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="uk-padding uk-padding-remove-top uk-padding-remove-bottom uk-margin-top uk-margin-bottom mobile-remove-padding">
                        <a href="<?php echo $templateLink; ?>" class="remove-decoration download" target="_blank">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom submit-button-border" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-white">
                                        <img class="scroll-down" src="/images/icons/download_small.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-margin-medium-left download_flyer_button_padding">
                                    <div class="uk-card-body uk-text-orange gardein uk-text-bold forty uk-text-center uk-padding-remove-right uk-padding-small uk-padding-remove-top uk-padding-remove-bottom">
                                        <?php echo $templateButtonText; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="faqs" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-4-5@m">

                    <h3 class="fifty uk-text-red uk-text-bold border_bottom_red"><?php echo $socialMedia_title; ?></h3>
                    <?php echo $socialMedia; ?>

                    <ul uk-accordion>
                        <li class="border_bottom_red">
                            <a class="uk-accordion-title fifty uk-text-red uk-text-bold remove-decoration" href><?php echo $postersFlyers_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $postersFlyers; ?></div>
                        </li>
                        <li class="border_bottom_red">
                            <a class="uk-accordion-title fifty uk-text-red uk-text-bold remove-decoration" href><?php echo $radioStations_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $radioStations; ?></div>
                        </li>
                        <li class="border_bottom_red">
                            <a class="uk-accordion-title fifty uk-text-red uk-text-bold remove-decoration" href><?php echo $newsPapers_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $newsPapers; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="receivedFunding" class="uk-background-orange uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right uk-background-center-right uk-background-norepeat uk-background-contain hide-background-mobile" style="background-image: url(images/backgrounds/person_watering.png);">
            <div class="vertical-center" uk-grid>
                <div class="uk-width-2-3@m">
                    <h3 class="gardein eighty uk-text-white uk-margin-large-bottom"><?php echo $ifYouHaveReceivedFunding_title; ?></h3>
                    <div class="uk-margin-top">
                        <div class="uk-text-white">
                            <?php echo $ifYouHaveReceivedFunding; ?>
                        </div>
                        <div class="uk-child-width-1-2@m uk-margin-bottom" uk-grid>
                            <div>
                                <a class="uk-width-1-1 uk-button uk-button-white gardein thirty_five receivedFunding_buttons_padding submit-button-border uk-text-orange uk-margin-medium-top" href="<?php echo $downloadTheFestivalLogo; ?>"><?php echo $downloadTheFestivalLogo_title; ?></a>
                            </div>
                            <div>
                                <a class="uk-width-1-1 uk-button uk-button-white gardein thirty_five receivedFunding_buttons_padding submit-button-border uk-text-orange uk-margin-medium-top" href="<?php echo $downloadTheHubLogo; ?>"><?php echo $downloadTheHubLogo_title; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>