<!--templates\joomstarter\html\layouts\joomla\content\category_default.php-->
<?php

/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2013 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Router\Route;
use Joomla\CMS\WebAsset\WebAssetManager;

// Register and use Leaflet scripts/styles
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->registerScript('open-street-map', '//unpkg.com/leaflet/dist/leaflet.js', [], ['defer' => true]);
$wa->useScript('open-street-map');
$wa->registerScript('festival-programme-map', 'media/templates/site/joomstarter/js/festival-programme-map.min.js', [], ['defer' => true]);
$wa->useScript('festival-programme-map');
$wa->registerStyle('leaflet-css', '//unpkg.com/leaflet/dist/leaflet.css', [], ['defer' => false]);
$wa->useStyle('leaflet-css');

$wa->registerScript('festival-programme-filter', 'media/templates/site/joomstarter/js/festival-programme-filter.min.js', [], ['defer' => true]);
$wa->useScript('festival-programme-filter');

/**
 * Note that this layout opens a div with the page class suffix. If you do not use the category children
 * layout you need to close this div either by overriding this file or in your main layout.
 */
$params    = $displayData->params;
$category  = $displayData->get('category');
$extension = $category->extension;
$canEdit   = $params->get('access-edit');
$className = substr($extension, 4);
$htag      = $params->get('show_page_heading') ? 'h2' : 'h1';

//Set character limit for the description
$maxLength = 160;

$app = Factory::getApplication();

$category->text = $category->description;
$app->triggerEvent('onContentPrepare', [$extension . '.categories', &$category, &$params, 0]);
$category->description = $category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$extension . '.categories', &$category, &$params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$extension . '.categories', &$category, &$params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$extension . '.categories', &$category, &$params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

/**
 * This will work for the core components but not necessarily for other components
 * that may have different pluralisation rules.
 */
if (substr($className, -1) === 's') {
    $className = rtrim($className, 's');
}

$tagsData = $category->tags->itemTags;


// Get the database connection
$db = Factory::getContainer()->get(DatabaseInterface::class);

// The article ID
$articleId = 19;

// Custom field IDs to fetch
$fieldIds = [76, 77, 78, 79, 80];

$query = $db->getQuery(true)
    ->select(['field_id', 'value'])
    ->from($db->quoteName('#__fields_values'))
    ->where($db->quoteName('item_id') . ' = ' . (int) $articleId)
    ->where($db->quoteName('field_id') . ' IN (' . implode(',', $fieldIds) . ')');

$db->setQuery($query);
$fieldValues = $db->loadAssocList();

// Initialize variables
$energy = $communityEngagement = $circularity = $foodNature = $travel = '';

foreach ($fieldValues as $field) {
    switch ($field['field_id']) {
        case 76:
            $energy = $field['value'];
            break;
        case 77:
            $communityEngagement = $field['value'];
            break;
        case 78:
            $circularity = $field['value'];
            break;
        case 79:
            $foodNature = $field['value'];
            break;
        case 80:
            $travel = $field['value'];
            break;
    }
}

// Get the database connection
$db = Factory::getContainer()->get(DatabaseInterface::class);

// Get the current category ID
$currentCategoryId = (int) $category->id;

// Get subcategory IDs
$query = $db->getQuery(true)
    ->select($db->quoteName('id'))
    ->from($db->quoteName('#__categories'))
    ->where($db->quoteName('parent_id') . ' = ' . $currentCategoryId)
    ->where($db->quoteName('published') . ' = 1');

$db->setQuery($query);
$subcategories = $db->loadColumn();

if (empty($subcategories)) {
    return;
}

// Convert array to SQL-friendly format
$subcategoriesList = implode(',', array_map('intval', $subcategories));

// Get articles from subcategories with additional details
$query = $db->getQuery(true)
    ->select([
        'c.id AS article_id',
        'c.title',
        'c.catid AS category_id',
        'c.images'
    ])
    ->from($db->quoteName('#__content', 'c'))
    ->where($db->quoteName('c.catid') . ' IN (' . $subcategoriesList . ')')
    ->where($db->quoteName('c.state') . ' = 1') // Only published articles
    ->order($db->quoteName('c.title') . ' ASC');

$db->setQuery($query);
$articles = $db->loadObjectList();

// Fetch custom field values
$articleIds = array_column($articles, 'article_id');

$customFields = [];
if (!empty($articleIds)) {
    $query = $db->getQuery(true)
        ->select(['fv.item_id', 'fv.field_id', 'fv.value'])
        ->from($db->quoteName('#__fields_values', 'fv'))
        ->where($db->quoteName('fv.item_id') . ' IN (' . implode(',', $articleIds) . ')')
        ->where($db->quoteName('fv.field_id') . ' IN (1, 146, 7, 5, 2, 145, 144)'); // Time, End Time, Location, Event Options, About this Event, Longitude, Latitude

    $db->setQuery($query);
    $fieldValues = $db->loadAssocList();

    foreach ($fieldValues as $field) {
        if (!isset($customFields[$field['item_id']][$field['field_id']])) {
            $customFields[$field['item_id']][$field['field_id']] = [];
        }
        $customFields[$field['item_id']][$field['field_id']][] = $field['value'];
    }
}

// Define category-to-class mapping
$categoryColors = [
    12 => 'theme-color-energy',
    13 => 'theme-color-community-engagement',
    14 => 'theme-color-circularity',
    15 => 'theme-color-food-nature',
    16 => 'theme-color-travel',
];

// Process and group articles by date
$groupedArticles = [];
foreach ($articles as $article) {
    // $date = isset($customFields[$article->article_id][1]) ? date('Y-m-d', strtotime($customFields[$article->article_id][1])) : 'No Date';
    $dateValue = $customFields[$article->article_id][1] ?? null;
    $dateString = is_array($dateValue) ? reset($dateValue) : $dateValue; // Get the first value if it's an array
    $date = !empty($dateString) ? date('Y-m-d', strtotime($dateString)) : 'No Date';
    $categoryClass = $categoryColors[$article->category_id] ?? 'theme-color-default';
    $articleUrl = Route::_('index.php?option=com_content&view=article&id=' . (int) $article->article_id);
    $timeValue = $customFields[$article->article_id][1] ?? null;
    $timeString = is_array($timeValue) ? reset($timeValue) : $timeValue; // Get the first value if it's an array
    $aboutValue = $customFields[$article->article_id][2] ?? null;
    $aboutString = is_array($aboutValue) ? reset($aboutValue) : $aboutValue; // Get first value if array

    $groupedArticles[$date][] = [
        'title' => $article->title,
        'article_id' => $article->article_id,
        'category_id' => $article->category_id,
        'category_class' => $categoryClass, // Assign the category-based class
        'image' => json_decode($article->images)->image_intro ?? '',
        'location' => $customFields[$article->article_id][7] ?? '',
        // 'longitude' => $customFields[$article->article_id][145] ?? '',
        // 'latitude' => $customFields[$article->article_id][144] ?? '',
        'longitude' => !empty($customFields[$article->article_id][145]) ? (is_array($customFields[$article->article_id][145]) ? reset($customFields[$article->article_id][145]) : $customFields[$article->article_id][145]) : null,
        'latitude' => !empty($customFields[$article->article_id][144]) ? (is_array($customFields[$article->article_id][144]) ? reset($customFields[$article->article_id][144]) : $customFields[$article->article_id][144]) : null,
        // 'time' => isset($customFields[$article->article_id][1]) ? date('H:i', strtotime($customFields[$article->article_id][1])) : '',
        'time' => !empty($timeString) ? date('H:i', strtotime($timeString)) : '',
        // 'event_options' => isset($customFields[$article->article_id][5]) ? explode(',', $customFields[$article->article_id][5]) : [],
        // 'event_options' => isset($customFields[$article->article_id][5]) ? json_decode($customFields[$article->article_id][5], true) : [],
        'event_options' => isset($customFields[$article->article_id][5]) ? $customFields[$article->article_id][5] : [],
        // 'about' => isset($customFields[$article->article_id][2]) ? implode(' ', array_slice(explode(' ', strip_tags($customFields[$article->article_id][2])), 0, 50)) . '...' : '',
        'about' => !empty($aboutString) ? implode(' ', array_slice(explode(' ', strip_tags($aboutString)), 0, 50)) . '...' : '',
        'article_url' => $articleUrl // Add the URL here
    ];
}

// Sort articles by date
ksort($groupedArticles);

//store all article locations in a JavaScript-readable format
$mapLocations = [];

foreach ($groupedArticles as $date => $articles) {
    foreach ($articles as $article) {
        if (!empty($article['longitude']) && !empty($article['latitude'])) {
            $mapLocations[] = [
                'title' => $article['title'],
                'longitude' => $article['longitude'],
                'latitude' => $article['latitude'],
                'categoryClass' => $article['category_class'],
                'location' => $article['location'],
                'markerHtml' => '<div class="circle-pin"></div>', // This will ensure proper reuse of SCSS
                'article_url' => $article['article_url'] // Pass the correct article URL
            ];
        } elseif (!empty($article['location'])) {
            $mapLocations[] = [
                'title' => $article['title'],
                'longitude' => null,
                'latitude' => null,
                'categoryClass' => $article['category_class'],
                'location' => $article['location'],
                'markerHtml' => '<div class="circle-pin"></div>', // This will ensure proper reuse of SCSS            
                'article_url' => $article['article_url'] // Pass the correct article URL
            ];
        }
    }
}

// Convert PHP array to JSON
$mapLocationsJson = json_encode($mapLocations);

// Define category-to-Itemid mapping for menus
$categoryItemIds = [
    16 => 136, // Travel
    15 => 135, // Food and Nature
    13 => 134, // Community Engagement
    12 => 133, // Energy
    14 => 132, // Circularity
];


?>

<script>
    var mapLocations = <?php echo json_encode($mapLocations, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
</script>

<div id="festival-programme" class="<?php echo $className . '-category' . $displayData->pageclass_sfx; ?>">
    <h1 style="display: none;">
        Lanarkshire Climate Action Festival Programme
    </h1>

    <div id="map" class="uk-background-default uk-padding-large uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand">
        </div>
    </div>

    <div id="eventCategories" class="uk-background-default">

        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right uk-margin-top uk-margin-xlarge-bottom uk-padding-large uk-padding-remove-left uk-padding-remove-right">
            <div uk-grid class="uk-magin-bottom">
                <div class="uk-width-1-1">
                    <h2 class="gardein eighty uk-text-muted uk-text-bolder uk-text-center">Find an event near you!<span class="triangle"></span></h2>
                </div>
            </div>
        </div>

        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right uk-margin-xlarge-top uk-margin-bottom">
            <div uk-grid class="uk-text-center uk-padding-large uk-padding-remove-right uk-padding-remove-left">
                <!-- energy -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute uk-padding" src="/images/assets/energy.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-yellow forty gardein uk-margin-medium-top">Energy</div>
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
                            <img class="uk-position-absolute uk-padding" src="/images/assets/community.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold forty gardein uk-margin-medium-top">Community Engagement</div>
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
                            <img class="uk-position-absolute uk-padding" src="/images/assets/circularity.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-orange forty gardein uk-margin-medium-top">Circularity</div>
                                <div class="twenty_three"><?php echo $circularity; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div uk-grid class="uk-padding-large uk-padding-remove-right uk-padding-remove-left uk-margin-xlarge-top">
                <div class="uk-width-1-6@m"></div>
                <!-- Food and Nature -->
                <div class="uk-width-1-3@m">
                    <div class="shape-container">
                        <div class="circle">
                            <div class="rectangle"></div>
                            <img class="uk-position-absolute uk-padding" src="/images/assets/food-nature.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-secondary forty gardein uk-margin-medium-top">Food & Nature</div>
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
                            <img class="uk-position-absolute uk-padding" src="/images/assets/travel.png" alt="">
                        </div>
                        <div class="shape submit-button-border">
                            <div class="uk-padding uk-text-center">
                                <div class="uk-text-bold uk-text-primary forty gardein uk-margin-medium-top">Travel</div>
                                <div class="twenty_three"><?php echo $travel; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="browse-full-programme" class="uk-background-secondary uk-padding uk-padding-remove-left uk-padding-remove-right">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right" uk-grid>
            <h2 class="gardein_regular eighty uk-text-white uk-width-expand">Browse the full <span class="uk-text-bold">programme</span></h2>

            <div class="uk-width-auto">
                <a id="filter-toggle" class="uk-button uk-button-primary download_border twenty_six event_details_button_padding uk-margin-small-top" href="javascript:void(0);">
                    Open Filter
                </a>
            </div>

        </div>
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <!-- Accordion for Filters -->
            <div id="filter-container" class="uk-margin-top" hidden>
                <ul uk-accordion>
                    <li class="uk-open">
                        <div class="uk-accordion-content">
                            <form id="event-filters" class="" uk-grid>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                    <!-- Category Filter -->
                                    <select id="filter-category" class="uk-select">
                                        <option value="">All Categories</option>
                                        <option value="theme-color-energy">Energy</option>
                                        <option value="theme-color-community-engagement">Community Engagement</option>
                                        <option value="theme-color-circularity">Circularity</option>
                                        <option value="theme-color-food-nature">Food & Nature</option>
                                        <option value="theme-color-travel">Travel</option>
                                    </select>
                                </div>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                    <!-- Location Filter -->
                                    <select id="filter-location" class="uk-select">
                                        <option value="">All Locations</option>
                                        <!-- Locations will be dynamically populated -->
                                    </select>
                                </div>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                    <!-- Accessibility Filter -->
                                    <div class="uk-grid-small" uk-grid>
                                        <label class="uk-text-white"><input class="uk-checkbox" type="checkbox" name="filter-option" value="wheelchair"> Wheelchair Friendly</label>
                                        <label><input class="uk-checkbox" type="checkbox" name="filter-option" value="family"> Family Friendly</label>
                                    </div>
                                </div>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                    <!-- Date Filter -->
                                    <input type="date" id="filter-date" class="uk-input">
                                </div>
                                <div class="uk-width-1-2@m uk-width-1-1">
                                    <!-- Apply Filter Button -->
                                    <button id="apply-filter" type="button" class="uk-button uk-button-primary download_border twenty_six event_details_button_padding uk-margin-small-top">Apply Filters</button>

                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <?php if (!empty($groupedArticles)) : ?>
        <div id="events" class="uk-background-default uk-padding">
            <div class="uk-container-expand">
                <?php foreach ($groupedArticles as $date => $articles) : ?>
                    <?php $formattedDate = HTMLHelper::_('date', $date, 'l j F'); ?>
                    <h3 class="gardein uk-text-bold eighty uk-text-muted uk-text-left uk-margin-left uk-margin-right uk-padding-large uk-padding-remove-left uk-padding-remove-right"><?php echo htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8'); ?></h3>


                    <div class="uk-position-relative uk-visible-toggle" tabindex="-1" uk-slider>
                        <div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@m uk-grid">
                            <?php foreach ($articles as $article) : ?>
                                <div>
                                    <div class="uk-panel uk-padding-small event-item"
                                        data-category="<?php echo htmlspecialchars($article['category_class'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-location="<?php echo htmlspecialchars(is_array($article['location']) ? implode(', ', $article['location']) : $article['location'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-date="<?php echo htmlspecialchars($date, ENT_QUOTES, 'UTF-8'); ?>"
                                        data-options="<?php echo htmlspecialchars(implode(',', $article['event_options']), ENT_QUOTES, 'UTF-8'); ?>"
                                        data-title="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-latitude="<?php echo htmlspecialchars($article['latitude'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-longitude="<?php echo htmlspecialchars($article['longitude'], ENT_QUOTES, 'UTF-8'); ?>"
                                        data-wheelchair="<?php echo in_array('wheelchair', $article['event_options']) ? 'true' : 'false'; ?>"
                                        data-family="<?php echo in_array('family', $article['event_options']) ? 'true' : 'false'; ?>">

                                        <?php if (!empty($article['image'])) : ?>

                                            <div class="uk-position-relative">
                                                <!-- Circle Pin with Category Class -->
                                                <div id="marker">
                                                    <div class="uk-position-z-index uk-position-absolute circle <?php echo htmlspecialchars($article['category_class'], ENT_QUOTES, 'UTF-8'); ?>-original-background" style="top: 10px; left: 10px;">
                                                        <div class="circle-pin"></div>
                                                    </div>
                                                </div>
                                                <img
                                                    src="<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                                    alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>"
                                                    class="signpost_border box-shadow" uk-cover>
                                                <canvas width="458" height="800"></canvas>

                                                <!-- Event Icons Overlay -->
                                                <?php if (!empty($article['event_options'])) : ?>
                                                    <div class="uk-position-absolute uk-padding-small uk-flex uk-flex-left uk-flex-middle" style="top: 10px; right: 10px; gap: 8px;">
                                                        <?php foreach ($article['event_options'] as $option) : ?>
                                                            <?php
                                                            $iconMap = [
                                                                'wheelchair' => 'images/icons/wheelchair_friendly.png',
                                                                'family' => 'images/icons/family_friendly.png'
                                                            ];
                                                            if (isset($iconMap[$option])) :
                                                            ?>
                                                                <img src="<?php echo $iconMap[$option]; ?>"
                                                                    alt="<?php echo htmlspecialchars($option, ENT_QUOTES, 'UTF-8'); ?>"
                                                                    class="event-option-icon"
                                                                    width="53" height="53" loading="lazy">
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <div class="uk-position-bottom uk-panel">
                                                <?php endif; ?>
                                                <div class="uk-position-relative">
                                                    <div class="uk-position-relative" style="bottom:-75px;">
                                                        <div id="info" style="padding-bottom:75px;" class="uk-background-default uk-padding uk-margin-bottom signpost_border_top_left signpost_border_top_right <?php echo htmlspecialchars($article['category_class'], ENT_QUOTES, 'UTF-8'); ?>-original-background">

                                                            <h4 class="forty gardein"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                                            <div uk-grid class="uk-width-child-auto">
                                                                <div><?php echo htmlspecialchars($article['time'], ENT_QUOTES, 'UTF-8'); ?></div>
                                                                <?php
                                                                $locationString = is_array($article['location']) ? implode(', ', $article['location']) : $article['location'];
                                                                ?>
                                                                <div><?php echo htmlspecialchars($locationString, ENT_QUOTES, 'UTF-8'); ?></div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="uk-position-relative" style="bottom:-0;">
                                                        <div id="description" class="uk-background-default uk-padding signpost_border uk-text-muted twenty_four">
                                                            <div class="uk-margin-large-bottom uk-text-muted twenty_four">
                                                                <?php
                                                                $text = strip_tags($article['about']); // Remove HTML
                                                                echo htmlspecialchars(mb_substr($text, 0, $maxLength) . (mb_strlen($text) > $maxLength ? '...' : ''), ENT_QUOTES, 'UTF-8');
                                                                ?>
                                                            </div>

                                                        </div>
                                                        <?php
                                                        $menuItemId = isset($categoryItemIds[$article['category_id']]) ? '&Itemid=' . $categoryItemIds[$article['category_id']] : '';
                                                        $articleUrl = Route::_('index.php?option=com_content&view=article&id=' . (int) $article['article_id'] . $menuItemId);
                                                        ?>
                                                        <div class="uk-position-bottom-right uk-padding">
                                                            <a href="<?php echo $articleUrl; ?>"
                                                                class="uk-button uk-button-primary download_border twenty_six event_details_button_padding uk-margin-small-top">
                                                                Details
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href uk-slidenav-next uk-slider-item="next"></a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

</div>

</div>

<script>
    console.log("Debug - mapLocations:", <?php echo json_encode($mapLocations); ?>);
</script>