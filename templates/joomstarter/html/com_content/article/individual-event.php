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
use Joomla\CMS\Date\Date;

$document = Factory::getDocument();
$renderer = $document->loadRenderer('modules');
$moduleOptions  = array('style' => 'html5');
$shareModule = $renderer->render('event-share-module', $moduleOptions, null);


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

// Get the category ID
$categoryId = $this->item->catid;

// Festival Programme menu item ID
$menuItemId = 110;

// Generate the SEF-friendly URL using the menu item ID
$categoryUrl = Route::_('index.php?Itemid=' . $menuItemId);

// Define category-to-class mapping
$categoryColors = [
    12 => 'theme-color-energy',
    13 => 'theme-color-community-engagement',
    14 => 'theme-color-circularity',
    15 => 'theme-color-food-nature',
    16 => 'theme-color-travel',
];

// Determine the color class based on the category ID
$categoryClass = $categoryColors[$categoryId] ?? 'theme-color-default';

// Get custom fields
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);

$titleSize = '';
$eventImage = '';
$location = '';
$dayTime = '';
$eventOptions = '';
$aboutThisEvent = '';
$aboutThisEvent_title = '';
$aboutTheOrganiser = '';
$aboutTheOrganiser_title = '';
$bookingLink = '';
$latitude = '';
$longitude = '';

foreach ($fields as $field) {
    if ($field->id == 147) {
        $titleSize = $field->value;
    }
    if ($field->id == 1) {
        $dayTime = $field->value;
    }
    if ($field->id == 2) {
        $aboutThisEvent = $field->value;
        $aboutThisEvent_title = $field->title;
    }
    if ($field->id == 3) {
        $aboutTheOrganiser = $field->value;
        $aboutTheOrganiser_title = $field->title;
    }
    if ($field->id == 4) {
        $bookingLink = $field->value;

        // Modify the existing anchor tag to add classes
        $doc = new DOMDocument();
        @$doc->loadHTML($bookingLink, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $link = $doc->getElementsByTagName('a')->item(0);

        if ($link) {
            // Get existing classes
            $existingClasses = $link->getAttribute('class');

            // Append custom classes
            $newClasses = trim($existingClasses . ' uk-button uk-button-default book_now_button_padding thirty uk-text-bold');
            $link->setAttribute('class', $newClasses);

            // Set new button text
            $link->nodeValue = 'Book here';

            // Store modified link back into $bookingLink
            $bookingLink = $doc->saveHTML($link);
        }
    }
    if ($field->id == 5) {
        $eventOptions = $field->value;
    }
    if ($field->id == 6) {
        $imageData = json_decode($field->rawvalue);
        if (!empty($imageData->imagefile)) {
            $eventImage = $imageData->imagefile;
        }
    }
    if ($field->id == 7) {
        $location = $field->value;
    }
    if ($field->id == 144) {
        $latitude = $field->value;
    }
    if ($field->id == 145) {
        $longitude = $field->value;
    }
    // Set default coordinates to location if none are provided
    if (empty($latitude) || empty($longitude)) {
        // Format the location string for URL encoding
        $formattedLocation = urlencode($location);

        // OpenStreetMap's Nominatim API URL
        $nominatimUrl = "https://nominatim.openstreetmap.org/search?format=json&q={$formattedLocation}";

        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $nominatimUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Joomla-Site-LanarkshireClimateActionFestival'); // Required User-Agent
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the response
        $data = json_decode($response, true);

        // Check if valid response received
        if (!empty($data) && isset($data[0]['lat']) && isset($data[0]['lon'])) {
            $latitude = $data[0]['lat'];
            $longitude = $data[0]['lon'];
        } else {
            // Default fallback coordinates (Lanark)
            $latitude = '55.60831400856377';
            $longitude = '-3.7872852852123886';
        }
    }
}

// Ensure $dayTime has a valid value before formatting
if (!empty($dayTime)) {
    $dateObject = Factory::getDate($dayTime);
    $formattedDayTime = $dateObject->format('d/m/Y H:i'); // UK format
} else {
    $formattedDayTime = 'No date entered'; // Fallback text
}

// Ensure Joomla's WebAssetManager is loaded
use Joomla\CMS\WebAsset\WebAssetManager;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerScript('open-street-map', '//unpkg.com/leaflet/dist/leaflet.js', [], ['defer' => true]);
$wa->useScript('open-street-map');
$wa->registerScript('individual-event-map', 'media/templates/site/joomstarter/js/individual-event-map.min.js', [], ['defer' => true]);
$wa->useScript('individual-event-map');
$wa->registerStyle('individual-event-style', '//unpkg.com/leaflet/dist/leaflet.css', [], ['defer' => false]);
$wa->useStyle('individual-event-style');

?>

<script>
    var eventLatitude = <?php echo json_encode($latitude); ?>;
    var eventLongitude = <?php echo json_encode($longitude); ?>;
</script>

<

    <div id="<?php echo $this->item->alias; ?>" class="individual-event-page">
    <div class="hero<?php echo $this->pageclass_sfx; ?> <?php echo $categoryClass; ?>-original-background uk-background-contain uk-background-center-right" uk-grid>
        <?php echo LayoutHelper::render('joomla.content.hero_background_image', $this->item); ?>
        <div class="uk-width-2-5@m uk-width-1-1">
            <div class="page-header uk-margin-large-left uk-margin-large-right vertical-center">
                <h1 class="uk-text-left <?php echo $titleSize; ?> outfit-bold">
                    <?php echo $this->item->title; ?>
                </h1>

            </div>
        </div>
        <?php if (!empty($eventImage)) : ?>
            <div class="uk-width-expand@m uk-width-1-1">
                <img src="<?php echo htmlspecialchars($eventImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Image for <?php echo $this->item->title; ?>" class="uk-width-1-1">
            </div>
        <?php endif; ?>
    </div>

    <div id="event-details" class="<?php echo $categoryClass; ?>-original-background uk-background-contain uk-background-center-right uk-margin-remove-top" uk-grid>
        <div class="uk-width-1-3@m uk-margin-large-left uk-margin-large-right uk-width-1-1 ">
            <div uk-grid class="uk-padding uk-padding-remove-left uk-padding-remove-right">
                <div class="uk-width-1-2">
                    <div class="date-container uk-flex uk-flex-middle">
                        <span id="icon" class="date_time"></span>
                        <span class="twenty_six uk-margin-small-left"><?php echo $formattedDayTime; ?></span>
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <div class="friendly-container uk-flex uk-flex-middle">
                        <?php if (strpos($eventOptions, 'Wheelchair Friendly') !== false) : ?>
                            <span id="icon" class="wheelchair_friendly" title="Wheelchair Friendly"></span>
                        <?php endif; ?>

                        <?php if (strpos($eventOptions, 'Family Friendly') !== false) : ?>
                            <span id="icon" class="family_friendly uk-margin-small-left" title="Family Friendly"></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="uk-width-1-2">
                    <div class="location-container uk-flex uk-flex-middle">
                        <span id="icon" class="location"></span>
                        <span class="twenty_six uk-margin-small-left"><?php echo $location; ?></span>
                    </div>
                    <div class="twenty_six uk-margin-top">
                        <a class="remove-decoration uk-text-primary" href="#map">View on map ></a>
                    </div>
                </div>
                <div class="uk-width-1-2">
                    <?php echo $bookingLink; ?>
                </div>
            </div>
        </div>
        <div class="uk-width-expand"></div><?php if (!empty($shareModule)) { ?>
            <div class="uk-width-1-6@m" id="share">
                <div class="uk-text-center vertical-center uk-background-secondary">
                    <?php echo $shareModule; ?>
                </div>
            </div>
        <?php } ?>





    </div>

    <div class="uk-background-default uk-margin-xlarge-bottom uk-margin-top uk-padding-large uk-background-center-right uk-background-norepeat uk-background-contain">
        <div class="uk-container-expand">
            <div uk-grid>
                <div class="uk-width-2-3@m">
                    <h2 class="uk-text-muted forty uk-text-bold"><?php echo $aboutThisEvent_title; ?></h2>
                    <?php echo $aboutThisEvent; ?>
                </div>
                <div class="uk-width-2-3@m">
                    <h2 class="uk-text-muted forty uk-text-bold"><?php echo $aboutTheOrganiser_title; ?></h2>
                    <?php echo $aboutTheOrganiser; ?>
                </div>
                <div class="uk-width-2-3@m">
                    <a href="<?php echo $categoryUrl; ?>" class="uk-button uk-button-primary download_border book_now_button_padding thirty uk-text-bold">
                        Back to full programme
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="map" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right <?php echo $categoryClass; ?>">
        <div class="uk-container-expand">
        </div>
    </div>

    </div>