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

$whoCanHostAnEvent = '';
$whoCanHostAnEvent_title = '';
$whoCanAccessFunding = '';
$whoCanAccessFunding_title = '';
$whatTypeOfEventsCanYouHost = '';
$whatTypeOfEventsCanYouHost_title = '';
$submitAnEvent = '';
$submitAnEvent_title = '';
$submitEventLink = '';
$fundingLink = '';
$funding = '';
$funding_title = '';
$benefitsOfHostingAnEvent = '';
$benefitsOfHostingAnEvent_title = '';
$benefitsButtonText = '';
$enableSubmitEvent = '';
$enableFundingSection = '';

foreach ($fields as $field) {
    if ($field->id == 38) {
        $whoCanHostAnEvent = $field->value;
        $whoCanHostAnEvent_title = $field->title;
    }
    if ($field->id == 39) {
        $whoCanAccessFunding = $field->value;
        $whoCanAccessFunding_title = $field->title;
    }
    if ($field->id == 40) {
        $whatTypeOfEventsCanYouHost = $field->value;
        $whatTypeOfEventsCanYouHost_title = $field->title;
    }
    if ($field->id == 41) {
        $submitAnEvent = $field->value;
        $submitAnEvent_title = $field->title;
    }
    if ($field->id == 42) {
        $submitEventLink = $field->value;
    }
    if ($field->id == 43) {
        $fundingLink = $field->value;
    }
    if ($field->id == 44) {
        $funding = $field->value;
        $funding_title = $field->title;
    }
    if ($field->id == 45) {
        $benefitsOfHostingAnEvent = $field->value;
        $benefitsOfHostingAnEvent_title = $field->title;
    }
    if ($field->id == 46) {
        $benefitsButtonText = $field->value;
    }
    if ($field->id == 148) {
        $enableSubmitEvent = $field->value;
    }
    if ($field->id == 149) {
        $enableFundingSection = $field->value;
    }
}

?>

<div id="host-an-event">
    <div class="item-page<?php echo $this->pageclass_sfx; ?> uk-background-primary" uk-grid>
        <div class="uk-width-1-3@m uk-padding-large">
            <div class="page-header vertical-center uk-padding">
                <h1 class="uk-text-white oneHundred uk-text-center"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
                <span class="outfit uk-text-bold uk-text-yellow fifty"><?php echo $this->item->text; ?></span>
            </div>
        </div>
        <div class="uk-width-2-3@m">
            <?php echo LayoutHelper::render('joomla.content.about_full_image', $this->item); ?>
        </div>
    </div>

    <div id="faqs" class="uk-background-default uk-padding-large uk-padding-remove-bottom uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-1-2@m">

                    <h3 class="fifty uk-text-primary uk-text-bold border_bottom_blue"><?php echo $whoCanHostAnEvent_title; ?></h3>
                    <?php echo $whoCanHostAnEvent; ?>

                    <ul uk-accordion>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $whoCanAccessFunding_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whoCanAccessFunding; ?></div>
                        </li>
                        <li class="border_bottom_blue">
                            <a class="uk-accordion-title fifty uk-text-primary uk-text-bold remove-decoration" href><?php echo $whatTypeOfEventsCanYouHost_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whatTypeOfEventsCanYouHost; ?></div>
                        </li>
                    </ul>
                </div>
                <div class="uk-width-1-2@m uk-text-center">
                    <img src="/images/assets/flowers_1.png" alt="Lanarkshire Climate Action Hub - Flowers">
                </div>
            </div>
        </div>
    </div>

    <?php if (($enableSubmitEvent == 'yes') || ($enableFundingSection == 'yes')) : ?>

        <div class="uk-background-primary uk-padding-large uk-padding-remove-left uk-padding-remove-right mobile-remove-margin">
            <div class="uk-margin-large-right uk-margin-large-left mobile-remove-margin" uk-grid>
                <?php if ($enableSubmitEvent == 'yes') : ?>
                    <div class="uk-width-1-2@m uk-margin-large-bottom mobile-remove-padding">
                        <div class="uk-background-peach submit-button-border uk-padding uk-margin-large-right uk-margin-large-left">
                            <h3 class="eighty uk-text-white uk-text-bold border_bottom_white gardein"><?php echo $submitAnEvent_title; ?></h3>
                            <div class="uk-text-white"><?php echo $submitAnEvent; ?></div>
                            <div class="uk-position-absolute">
                                <a href="<?php echo $submitEventLink; ?>" class="uk-button gardein forty submit-button-border hostEvent_buttons_padding submit-button-border uk-button-white"><?php echo $submitAnEvent_title; ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($enableFundingSection == 'yes') : ?>
                    <div class="uk-width-1-2@m mobile-remove-padding">
                        <div class="uk-background-default submit-button-border uk-padding uk-margin-large-right uk-margin-large-left">
                            <h3 class="eighty uk-text-primary uk-text-bold border_bottom_white gardein"><?php echo $funding_title; ?></h3>
                            <div class="uk-text-primary"><?php echo $funding; ?></div>
                            <div class="uk-position-absolute">
                                <a href="<?php echo $fundingLink; ?>" class="uk-button gardein forty submit-button-border hostEvent_buttons_padding submit-button-border uk-button-peach">Apply for funding</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    <?php endif; ?>


    <div lass="uk-background-default">
        <div class="uk-container-expand">
            <div uk-grid class="mobile-remove-margin">
                <div class="uk-width-1-3@m uk-text-left mobile-hide">
                    <img src="/images/assets/thistle.png" alt="Lanarkshire Climate Action Hub - Flowers">
                </div>
                <div class="uk-width-2-3@m uk-padding-large mobile-remove-padding">
                    <div class="uk-margin-right mobile-text-full-width mobile-margin-bottom">
                        <h3 class="fifty gardein uk-text-primary uk-text-bold"><?php echo $benefitsOfHostingAnEvent_title; ?></h3>
                        <div class="uk-margin-bottom"><?php echo $benefitsOfHostingAnEvent; ?></div>
                        <div>
                            <a href="mailto:info@climateactionlanarkshire.net?Subject=Enquiry – Lanarkshire Climate Action Festival" class="uk-button gardein forty submit-button-border hostEvent_buttons_padding submit-button-border uk-button-primary"><?php echo $benefitsButtonText; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>