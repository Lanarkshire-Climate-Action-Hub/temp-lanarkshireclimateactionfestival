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

// Load gallery module
$document = Factory::getApplication()->getDocument();
$renderer = $document->loadRenderer('modules');
$options  = array('style' => 'raw');
$sponsorshipGallery = $renderer->render('sponsorship-gallery', $options, null);

// Get custom fields
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);

$becomeASponsor = '';
$becomeASponsor_title = '';
$enquireAboutSponsorship = '';
$enquireAboutSponsorship_title = '';
$whySponsorLCAF = '';
$whySponsorLCAF_title = '';
$whoSponsorLCAF = '';
$whoSponsorLCAF_title = '';
$whatSponsorLCAF = '';
$whatSponsorLCAF_title = '';

foreach ($fields as $field) {
    if ($field->id == 54) {
        $becomeASponsor = $field->value;
        $becomeASponsor_title = $field->title;
    }
    if ($field->id == 55) {
        $enquireAboutSponsorship = $field->value;
        $enquireAboutSponsorship_title = $field->title;
    }
    if ($field->id == 57) {
        $whySponsorLCAF = $field->value;
        $whySponsorLCAF_title = $field->title;
    }
    if ($field->id == 58) {
        $whoSponsorLCAF = $field->value;
        $whoSponsorLCAF_title = $field->title;
    }
    if ($field->id == 59) {
        $whatSponsorLCAF = $field->value;
        $whatSponsorLCAF_title = $field->title;
    }
}

?>

<div id="take-part-in-an-event">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-orange uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-1 uk-padding-large">
            <div class="page-header vertical-center uk-padding">
                <h1 class="uk-text-white oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>

            </div>
        </div>
    </div>

    <div class="uk-background-white uk-padding-large mobile-remove-padding">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div class="vertical-center" uk-grid>
                <div class="uk-width-2-3@m">
                    <h3 class="gardein uk-text-bold uk-text-orange sixty_five"><?php echo $becomeASponsor_title; ?></h3>
                    <div class="uk-margin-top">
                        <div>
                            <?php echo $becomeASponsor; ?>
                        </div>
                        <a class="uk-button uk-button-orange gardein forty sponsorship_buttons_padding submit-button-border" href="<?php echo $enquireAboutSponsorship; ?>"><?php echo $enquireAboutSponsorship_title; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($sponsorshipGallery)) { ?>
        <div id="photoSlider">
            <div class="uk-container-expand">
                <?php echo $sponsorshipGallery; ?>
            </div>
        </div>
    <?php } ?>

    <div id="faqs" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-4-5@m">

                    <h3 class="fifty uk-text-red uk-text-bold border_bottom_red"><?php echo $whySponsorLCAF_title; ?></h3>
                    <?php echo $whySponsorLCAF; ?>

                    <ul uk-accordion>
                        <li class="border_bottom_red">
                            <a class="uk-accordion-title fifty uk-text-red uk-text-bold remove-decoration" href><?php echo $whoSponsorLCAF_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whoSponsorLCAF; ?></div>
                        </li>
                        <li class="border_bottom_red">
                            <a class="uk-accordion-title fifty uk-text-red uk-text-bold remove-decoration" href><?php echo $whatSponsorLCAF_title; ?></a>
                            <div class="uk-accordion-content"><?php echo $whatSponsorLCAF; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>