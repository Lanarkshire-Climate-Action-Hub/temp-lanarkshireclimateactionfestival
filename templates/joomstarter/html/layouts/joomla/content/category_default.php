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
        ->where($db->quoteName('fv.field_id') . ' IN (1, 7, 5, 2)'); // Time, Location, Event Options, About this Event

    $db->setQuery($query);
    $fieldValues = $db->loadAssocList();

    foreach ($fieldValues as $field) {
        $customFields[$field['item_id']][$field['field_id']] = $field['value'];
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
    $date = isset($customFields[$article->article_id][1]) ? date('Y-m-d', strtotime($customFields[$article->article_id][1])) : 'No Date';
    $categoryClass = $categoryColors[$article->category_id] ?? 'theme-color-default';

    $groupedArticles[$date][] = [
        'title' => $article->title,
        'category_id' => $article->category_id,
        'category_class' => $categoryClass, // Assign the category-based class
        'image' => json_decode($article->images)->image_intro ?? '',
        'location' => $customFields[$article->article_id][7] ?? '',
        'time' => isset($customFields[$article->article_id][1]) ? date('H:i', strtotime($customFields[$article->article_id][1])) : '',
        'event_options' => isset($customFields[$article->article_id][5]) ? explode(',', $customFields[$article->article_id][5]) : [],
        'about' => isset($customFields[$article->article_id][2]) ? implode(' ', array_slice(explode(' ', strip_tags($customFields[$article->article_id][2])), 0, 50)) . '...' : ''
    ];
}

// Sort articles by date
ksort($groupedArticles);


?>

<div id="festival-programme" class="<?php echo $className . '-category' . $displayData->pageclass_sfx; ?>">
    <?php if ($params->get('show_page_heading')) : ?>
        <h1>
            <?php echo $displayData->escape($params->get('page_heading')); ?>
        </h1>
    <?php endif; ?>

    <div id="map"></div>
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
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <h2 class="gardein eighty uk-text-white">Browse the full <span class="uk-text-bold">programme</span></h2>
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
                                    <div class="uk-panel">
                                        <?php if (!empty($article['image'])) : ?>
                                            <img src="<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>" class="signpost_border box-shadow" uk-cover>
                                            <canvas width="488" height="623"></canvas>
                                            <div class="uk-position-center uk-panel">
                                            <?php endif; ?>
                                            <div class="uk-position-relative">
                                                <div class="">
                                                    <div id="info" class="uk-background-default uk-padding signpost_border uk-text-muted <?php echo htmlspecialchars($article['category_class'], ENT_QUOTES, 'UTF-8'); ?>-original-background">

                                                        <h4 class="forty gardein uk-text-white"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                                        <p><strong>Category ID:</strong> <?php echo $article['category_id']; ?></p>
                                                        <div uk-grid class="uk-width-child-auto uk-text-white">
                                                            <div><?php echo htmlspecialchars($article['time'], ENT_QUOTES, 'UTF-8'); ?></div>
                                                            <div><?php echo htmlspecialchars($article['location'], ENT_QUOTES, 'UTF-8'); ?></div>
                                                        </div>
                                                        <p>
                                                            <?php echo !empty($article['event_options']) ? implode(', ', array_map('htmlspecialchars', $article['event_options'])) : 'N/A'; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div id="description" class="uk-background-default uk-padding signpost_border uk-text-muted uk-margin-bottom twenty_four">
                                                        <?php echo htmlspecialchars($article['about'], ENT_QUOTES, 'UTF-8'); ?>
                                                    </div>
                                                    <a href="#" class="uk-position-bottom-right uk-button uk-button-primary download_border twenty_six event_details_button_padding uk-margin-small-top">Details</a>
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