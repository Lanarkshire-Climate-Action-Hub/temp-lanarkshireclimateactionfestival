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

$tipsForPlanningSustainableEvent = '';
$tipsForPlanningSustainableEvent_title = '';
$travelDescription1 = '';
$travelDescription2 = '';
$travelDescription3 = '';
$materialsDescription1 = '';
$materialsDescription2 = '';
$materialsDescription3 = '';
$materialsDescription4 = '';
$materialsDescription5 = '';
$energyDescription1 = '';

foreach ($fields as $field) {
    if ($field->id == 60) {
        $tipsForPlanningSustainableEvent = $field->value;
        $tipsForPlanningSustainableEvent_title = $field->title;
    }
    if ($field->id == 61) {
        $travelDescription1 = $field->value;
    }
    if ($field->id == 62) {
        $travelDescription2 = $field->value;
    }
    if ($field->id == 63) {
        $travelDescription3 = $field->value;
    }
    if ($field->id == 64) {
        $materialsDescription1 = $field->value;
    }
    if ($field->id == 65) {
        $materialsDescription2 = $field->value;
    }
    if ($field->id == 66) {
        $materialsDescription3 = $field->value;
    }
    if ($field->id == 67) {
        $materialsDescription4 = $field->value;
    }
    if ($field->id == 68) {
        $materialsDescription5 = $field->value;
    }
    if ($field->id == 69) {
        $energyDescription1 = $field->value;
    }
}

?>

<div id="sustainable-event-planning">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-secondary uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-2@m uk-padding-large">
            <div class="page-header uk-padding vertical-center">
                <h1 class="uk-text-white oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        </div>
    </div>

    <div id="tips" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-xlarge-right mobile-text-full-width">

            <div uk-grid>
                <div>
                    <h2 class="uk-text-white gardein sixty_five uk-margin-bottom mobile-tips-background"><span class="uk-padding-small uk-background-secondary submit-button-border"><?php echo $tipsForPlanningSustainableEvent_title; ?></span></h2>
                    <?php if ($tipsForPlanningSustainableEvent) : ?>
                        <div class="uk-width-2-3@m uk-margin-top uk-margin-bottom uk-padding-small">
                            <div class="forty">
                                <?php echo $tipsForPlanningSustainableEvent; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="uk-padding-small">
                        <h2 class="uk-text-secondary gardein sixty_five uk-margin-top">How will people travel to your event?</h2>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-secondary border-green">
                                        <img src="/images/icons/skateboard_person.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $travelDescription1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-secondary border-green">
                                        <img src="/images/icons/bus_stop.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $travelDescription2; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-secondary border-green">
                                        <img src="/images/icons/bus.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $travelDescription3; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                    </div>

                    <div class="uk-padding-small uk-margin-top">
                        <h2 class="uk-text-red gardein sixty_five">What materials will you need?</h2>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-red border-red">
                                        <img src="/images/icons/spanner.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $materialsDescription1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-red border-red">
                                        <img src="/images/icons/apple_core.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $materialsDescription2; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-red border-red">
                                        <img src="/images/icons/apple.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $materialsDescription3; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-red border-red">
                                        <img src="/images/icons/seeds.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $materialsDescription4; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <?php if($materialsDescription5) : ?>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-red border-red">
                                        <img src="/images/icons/tree.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $materialsDescription5; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <?php endif; ?>
                    </div>

                    <div class="uk-padding-small uk-margin-top">
                        <h2 class="uk-text-yellow gardein sixty_five">How much energy will you use?</h2>
                        <div class="uk-width-2-3@m">
                            <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border uk-background-yellow border-yellow">
                                        <img src="/images/icons/lightswitch.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $energyDescription1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                    </div>
                </div>
                <div class="uk-width-auto"></div>
            </div>

        </div>
    </div>

</div>