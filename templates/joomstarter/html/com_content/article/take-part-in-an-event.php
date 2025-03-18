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

$tipsForEnjoyingTheFestivalSustainably = '';
$tipsForEnjoyingTheFestivalSustainably_title = '';
$description1 = '';
$description2 = '';
$description3 = '';
$wasteDescription1 = '';
$wasteDescription2 = '';
$wasteDescription3 = '';
$enableProgrammeSection = '';

foreach ($fields as $field) {
    if ($field->id == 47) {
        $tipsForEnjoyingTheFestivalSustainably = $field->value;
        $tipsForEnjoyingTheFestivalSustainably_title = $field->title;
    }
    if ($field->id == 48) {
        $description1 = $field->value;
    }
    if ($field->id == 49) {
        $description2 = $field->value;
    }
    if ($field->id == 50) {
        $description3 = $field->value;
    }
    if ($field->id == 51) {
        $wasteDescription1 = $field->value;
    }
    if ($field->id == 52) {
        $wasteDescription2 = $field->value;
    }
    if ($field->id == 53) {
        $wasteDescription3 = $field->value;
    }
    if ($field->id == 150) {
        $enableProgrammeSection = $field->value;
    }
}

?>

<div id="take-part-in-an-event">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-secondary uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-1 uk-padding-large mobile-remove-padding-bottom">
            <div class="page-header uk-padding mobile-remove-padding-bottom mobile-remove-padding mobile-remove-padding-top">
                <h1 class="uk-text-white oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
                <span class="outfit uk-text-bold uk-text-yellow fifty"><?php echo $this->item->text; ?></span>
            </div>
        </div>
    </div>
    <?php if ($enableProgrammeSection == 'yes') : ?>
        <div class="uk-background-yellow uk-padding-large">
            <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
                <div class="vertical-center" uk-grid>
                    <div class="uk-width-1-1 uk-text-center">
                        <a class="uk-button uk-button-white uk-text-primary gardein seventy uk-padding submit-button-border uk-button-large" href="<?php echo $festivalProgrammeUrl; ?>">View the Festival Programme</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div id="tips" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-xlarge-right mobile-text-full-width">

            <div uk-grid>
                <div>
                    <h2 class="uk-text-white gardein sixty_five uk-margin-bottom"><span class="uk-padding-small uk-background-secondary submit-button-border"><?php echo $tipsForEnjoyingTheFestivalSustainably_title; ?></span></h2>
                    <?php if ($tipsForEnjoyingTheFestivalSustainably) : ?>
                        <div class="uk-width-2-3@m uk-margin-top uk-margin-bottom uk-padding-small">
                            <div class="forty">
                                <?php echo $tipsForEnjoyingTheFestivalSustainably; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="uk-padding-small">
                        <h2 class="uk-text-primary gardein sixty_five uk-margin-top">How you travel to the festival matters</h2>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-blue">
                                        <img src="/images/icons/bicycle.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $description1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-blue">
                                        <img src="/images/icons/road.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $description2; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-blue">
                                        <img src="/images/icons/bus.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $description3; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                    </div>

                    <div class="uk-padding-small uk-margin-top">
                        <h2 class="uk-text-red gardein sixty_five">Avoid waste</h2>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-large-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-red">
                                        <img src="/images/icons/recycle.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $wasteDescription1; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-red">
                                        <img src="/images/icons/skateboard.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $wasteDescription2; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="uk-width-1-3@m"></div>
                        <div class="uk-width-2-3@m">
                            <div class="mobile-remove-margin uk-card uk-card-default uk-grid-collapse uk-margin uk-margin-xlarge-top uk-margin-large-bottom uk-margin-large-left uk-border-rounded custom-card" uk-grid>
                                <!-- Circular Image Container -->
                                <div class="circle-container">
                                    <div class="circle-border border-red">
                                        <img src="/images/icons/jar.png" alt="" uk-cover>
                                    </div>
                                </div>

                                <!-- Text Content -->
                                <div class="uk-width-expand@s uk-padding-large uk-margin-xlarge-left uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
                                    <div class="uk-card-body uk-padding-large">
                                        <?php echo $wasteDescription3; ?>
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