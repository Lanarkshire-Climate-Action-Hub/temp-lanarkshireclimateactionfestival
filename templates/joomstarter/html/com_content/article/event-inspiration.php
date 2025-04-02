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

$leadIntroduction = '';
$introduction = '';
$weFindMostEventsHeading = '';
$energy = '';
$energy_title = '';
$communityEngagement = '';
$communityEngagement_title = '';
$circularity = '';
$circularity_title = '';
$foodNature = '';
$foodNature_title = '';
$travel = '';
$travel_title = '';
$someEventsCover = '';
$someEventsCover_title = '';
$letsLookAtHeading = '';
$exampleOneTitle = '';
$exampleOneImage = '';
$exampleOneListTitle = '';
$exampleOneListItems = '';
$exampleOneBackground = '';
$exampleTwoTitle = '';
$exampleTwoImage = '';
$exampleTwoListTitle = '';
$exampleTwoListItems = '';
$exampleTwoBackground = '';
$exampleThreeTitle = '';
$exampleThreeImage = '';
$exampleThreeListTitle = '';
$exampleThreeListItems = '';
$exampleThreeBackground = '';
$exampleFourTitle = '';
$exampleFourImage = '';
$exampleFourListTitle = '';
$exampleFourListItems = '';
$exampleFourBackground = '';
$exampleFiveTitle = '';
$exampleFiveImage = '';
$exampleFiveListTitle = '';
$exampleFiveListItems = '';
$exampleFiveBackground = '';
$gotAnIdeaTitle = '';
$gotAnIdeaDescription = '';

foreach ($fields as $field) {
    if ($field->id == 73) {
        $leadIntroduction = $field->value;
    }
    if ($field->id == 74) {
        $introduction = $field->value;
    }
    if ($field->id == 109) {
        $weFindMostEventsHeading = $field->value;
    }
    if ($field->id == 76) {
        $energy = $field->value;
        $energy_title = $field->title;
    }
    if ($field->id == 77) {
        $communityEngagement = $field->value;
        $communityEngagement_title = $field->title;
    }
    if ($field->id == 78) {
        $circularity = $field->value;
        $circularity_title = $field->title;
    }
    if ($field->id == 79) {
        $foodNature = $field->value;
        $foodNature_title = $field->title;
    }
    if ($field->id == 80) {
        $travel = $field->value;
        $travel_title = $field->title;
    }
    if ($field->id == 81) {
        $someEventsCover = $field->value;
        $someEventsCover_title = $field->title;
    }
    if ($field->id == 110) {
        $letsLookAtHeading = $field->value;
    }
    if ($field->id == 82) {
        $exampleOneTitle = $field->value;
    }
    if ($field->id == 87) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $exampleOneImage = $imageData->imagefile;
        }
    }
    if ($field->id == 92) {
        $exampleOneListTitle = $field->value;
    }
    if ($field->id == 97) {
        $exampleOneListItems = $field->value;
    }
    if ($field->id == 102) {
        $exampleOneBackground = is_array($field->rawvalue) ? implode(',', $field->rawvalue) : $field->rawvalue;
    }
    if ($field->id == 83) {
        $exampleTwoTitle = $field->value;
    }
    if ($field->id == 88) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $exampleTwoImage = $imageData->imagefile;
        }
    }
    if ($field->id == 93) {
        $exampleTwoListTitle = $field->value;
    }
    if ($field->id == 98) {
        $exampleTwoListItems = $field->value;
    }
    if ($field->id == 103) {
        $exampleTwoBackground = is_array($field->rawvalue) ? implode(',', $field->rawvalue) : $field->rawvalue;
    }
    if ($field->id == 84) {
        $exampleThreeTitle = $field->value;
    }
    if ($field->id == 89) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $exampleThreeImage = $imageData->imagefile;
        }
    }
    if ($field->id == 94) {
        $exampleThreeListTitle = $field->value;
    }
    if ($field->id == 99) {
        $exampleThreeListItems = $field->value;
    }
    if ($field->id == 104) {
        $exampleThreeBackground = is_array($field->rawvalue) ? implode(',', $field->rawvalue) : $field->rawvalue;
    }
    if ($field->id == 85) {
        $exampleFourTitle = $field->value;
    }
    if ($field->id == 90) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $exampleFourImage = $imageData->imagefile;
        }
    }
    if ($field->id == 95) {
        $exampleFourListTitle = $field->value;
    }
    if ($field->id == 100) {
        $exampleFourListItems = $field->value;
    }
    if ($field->id == 105) {
        $exampleFourBackground = is_array($field->rawvalue) ? implode(',', $field->rawvalue) : $field->rawvalue;
    }
    if ($field->id == 86) {
        $exampleFiveTitle = $field->value;
    }
    if ($field->id == 91) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $exampleFiveImage = $imageData->imagefile;
        }
    }
    if ($field->id == 96) {
        $exampleFiveListTitle = $field->value;
    }
    if ($field->id == 101) {
        $exampleFiveListItems = $field->value;
    }
    if ($field->id == 106) {
        $exampleFiveBackground = is_array($field->rawvalue) ? implode(',', $field->rawvalue) : $field->rawvalue;
    }
    if ($field->id == 107) {
        $gotAnIdeaTitle = $field->value;
    }
    if ($field->id == 108) {
        $gotAnIdeaDescription = $field->value;
    }
}

?>

<div id="event-inspiration">
    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-primary uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-1-2@m uk-padding-large mobile-text-full-width mobile-remove-padding-bottom mobile-remove-padding-top">
            <div class="page-header uk-padding vertical-center">
                <h1 class="uk-text-white oneHundred"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </div>
        </div>
    </div>
    <div class="uk-background-primary">
        <div class="uk-text-white uk-padding-large uk-padding-remove-top mobile-text-full-width" uk-grid>
            <div class="uk-width-1-2@m uk-text-bold mobile-remove-padding mobile-margin-top">
                <?php echo $leadIntroduction; ?>
            </div>
            <div class="uk-width-2-3@m mobile-remove-padding">
                <?php echo $introduction; ?>
            </div>
        </div>
    </div>

    <div class="uk-background-default uk-padding-large">
        <div class="uk-container-expand">
            <div cuk-grid>
                <div class="uk-width-1-1">
                    <h2 class="uk-text-primary fifty"><?php echo $weFindMostEventsHeading; ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div id="eventCategories" class="uk-background-default">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right uk-margin-xlarge-top uk-margin-bottom">
            <div uk-grid class="uk-text-center uk-padding-large uk-padding-remove-right uk-padding-remove-left mobile-remove-padding-bottom">
                <!-- energy -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute mobile-padding-medium" src="/images/assets/energy.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-yellow forty gardein uk-margin-medium-top mobile-margin-top"><?php echo $energy_title; ?></div>
                                <div class="twenty_three"><?php echo $energy; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Community Engagement -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute mobile-padding-medium" src="/images/assets/community.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold forty gardein uk-margin-medium-top mobile-margin-top"><?php echo $communityEngagement_title; ?></div>
                                <div class="twenty_three"><?php echo $communityEngagement; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- circularity -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute mobile-padding-medium" src="/images/assets/circularity.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-orange forty gardein uk-margin-medium-top mobile-margin-top"><?php echo $circularity_title; ?></div>
                                <div class="twenty_three"><?php echo $circularity; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div uk-grid class="uk-padding-large uk-padding-remove-right uk-padding-remove-left uk-margin-xlarge-top mobile-remove-padding-top mobile-remove-padding-top mobile-margin-top">
                <div class="uk-width-1-6@m"></div>
                <!-- Food and Nature -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute mobile-padding-medium" src="/images/assets/food-nature.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-secondary forty gardein uk-margin-medium-top mobile-margin-top"><?php echo $foodNature_title; ?></div>
                                <div class="twenty_three"><?php echo $foodNature; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Travel -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute mobile-padding-medium" src="/images/assets/travel.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-primary forty gardein uk-margin-medium-top mobile-margin-top"><?php echo $travel_title; ?></div>
                                <div class="twenty_three"><?php echo $travel; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="multipleCategories" class="uk-background-primary">
        <div class="uk-container-expand uk-margin-large-left uk-margin-xlarge-right mobile-remove-margin">
            <div uk-grid>
                <div class="uk-width-4-5@m">
                    <div class="uk-flex-middle mobile-remove-margin" uk-grid>
                        <div class="gardein uk-text-center one_sixty uk-text-bold mobile-hide">!</div>
                        <div class="uk-padding uk-width-5-6@m mobile-text-full-width">
                            <div class="uk-text-bold forty outfit"><?php echo $someEventsCover_title; ?></div>
                            <div class="uk-flex-wrap"><?php echo $someEventsCover; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="examples">
        <div class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
            <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
                <h2 class="uk-text-bold uk-text-primary gardein eighty"><?php echo $letsLookAtHeading; ?></h2>
            </div>
        </div>
        <!-- Circular Container -->
        <div class="<?php echo $exampleOneBackground; ?>">
            <div class="uk-container-expand">
                <div uk-grid>
                    <div class="uk-width-1-2@m uk-position-relative">
                        <div class="uk-position-absolute uk-padding uk-text-white gardein uk-text-bold sixty"><?php echo $exampleOneTitle; ?></div>
                        <img src="<?php echo htmlspecialchars($exampleOneImage, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                    </div>
                    <div class="uk-width-1-2@m mobile-remove-margin-top">
                        <div class="uk-card-body uk-text-white uk-padding-large">
                            <div class="uk-text-bold sixty"><?php echo $exampleOneListTitle; ?></div>
                            <div class="uk-flex-wrap"><?php echo $exampleOneListItems; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Community Engagement Container -->
        <div class="<?php echo $exampleTwoBackground; ?>">
            <div class="uk-container-expand">
                <div uk-grid>
                    <div class="uk-width-1-2@m mobile-remove-margin-top">
                        <div class="uk-card-body uk-text-white uk-padding-large uk-flex-last uk-flex-first@s">
                            <div class="uk-text-bold sixty"><?php echo $exampleTwoListTitle; ?></div>
                            <div class="uk-flex-wrap"><?php echo $exampleTwoListItems; ?></div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@m uk-position-relative uk-flex-first uk-flex-last@s">
                        <div class="uk-position-absolute uk-padding uk-text-mute gardein uk-text-bold sixty text-shadow"><?php echo $exampleTwoTitle; ?></div>
                        <img src="<?php echo htmlspecialchars($exampleTwoImage, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Energy Container -->
        <div class="<?php echo $exampleThreeBackground; ?>">
            <div class="uk-container-expand">
                <div uk-grid>
                    <div class="uk-width-1-2@m uk-position-relative">
                        <div class="uk-position-absolute uk-padding uk-text-yellow gardein uk-text-bold sixty text-shadow"><?php echo $exampleThreeTitle; ?></div>
                        <img src="<?php echo htmlspecialchars($exampleThreeImage, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                    </div>
                    <div class="uk-width-1-2@m mobile-remove-margin-top">
                        <div class="uk-card-body uk-text-orange uk-padding-large">
                            <div class="uk-text-bold sixty"><?php echo $exampleThreeListTitle; ?></div>
                            <div class="uk-flex-wrap"><?php echo $exampleThreeListItems; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Food Container -->
        <div class="<?php echo $exampleFourBackground; ?>">
            <div class="uk-container-expand">
                <div uk-grid>
                    <div class="uk-width-1-2@m mobile-remove-margin-top">
                        <div class="uk-card-body uk-text-white uk-padding-large uk-flex-last uk-flex-first@s">
                            <div class="uk-text-bold sixty"><?php echo $exampleFourListTitle; ?></div>
                            <div class="uk-flex-wrap"><?php echo $exampleFourListItems; ?></div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@m uk-position-relative uk-flex-first uk-flex-last@s">
                        <div class="uk-position-absolute uk-padding uk-text-secondary gardein uk-text-bold sixty text-shadow"><?php echo $exampleFourTitle; ?></div>
                        <img src="<?php echo htmlspecialchars($exampleFourImage, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>

        <!-- Travel Container -->
        <div class="<?php echo $exampleFiveBackground; ?>">
            <div class="uk-container-expand">
                <div uk-grid>
                    <div class="uk-width-1-2@m uk-position-relative">
                        <div class="uk-position-absolute uk-padding uk-text-white gardein uk-text-bold sixty"><?php echo $exampleFiveTitle; ?></div>
                        <img src="<?php echo htmlspecialchars($exampleFiveImage, ENT_QUOTES, 'UTF-8'); ?>" alt="">
                    </div>
                    <div class="uk-width-1-2@m mobile-remove-margin-top">
                        <div class="uk-card-body uk-text-white uk-padding-large">
                            <div class="uk-text-bold sixty"><?php echo $exampleFiveListTitle; ?></div>
                            <div class="uk-flex-wrap"><?php echo $exampleFiveListItems; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="idea" class="uk-background-default uk-padding uk-padding-remove-left uk-padding-remove-right uk-position-relative">
        <div class="uk-container-expand uk-margin-xlarge-left uk-margin-xlarge-right mobile-remove-margin">
            <div class="uk-text-center vertical-align uk-padding-large uk-padding-remove-top uk-padding-remove-bottom uk-margin-xlarge-left uk-margin-xlarge-right mobile-remove-margin">
                <div class="uk-text-primary uk-padding-large uk-margin-xlarge-left uk-margin-xlarge-right mobile-remove-margin mobile-remove-padding"><?php echo $gotAnIdeaTitle; ?></div>
                <a href="mailto:info@climateactionlanarkshire.net?Subject=Lanarkshire Climate Action Festival" style="z-index:1;" class="uk-button uk-position-relative uk-button-primary gardein uk-button-large seventy uk-padding submit-button-border">Get in touch</a>
                <div class="uk-text-primary uk-padding-large uk-margin-xlarge-left uk-margin-xlarge-right uk-position-relative mobile-remove-margin mobile-remove-padding" style="z-index:1;" ><?php echo $gotAnIdeaDescription; ?></div>
            </div>
        </div>
    </div>
</div>