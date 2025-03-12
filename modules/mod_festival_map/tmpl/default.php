<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_festival_map
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$document = Factory::getApplication()->getDocument();

// Load Leaflet.js and Leaflet CSS
$document->addScript('https://unpkg.com/leaflet@1.9.3/dist/leaflet.js', ['defer' => true]);
$document->addStyleSheet('https://unpkg.com/leaflet@1.9.3/dist/leaflet.css');

// Load module-specific JS & CSS from media folder
$document->addScript('media/mod_festival_map/media/js/festival-map.js', ['defer' => true]);
$document->addStyleSheet('media/mod_festival_map/media/css/festival-map.css');

$mapWidth = $params->get('map_width', '100%');
$mapHeight = $params->get('map_height', '500px');
$defaultLat = $params->get('default_latitude', '55.608314');
$defaultLon = $params->get('default_longitude', '-3.787285');
$defaultZoom = (int) $params->get('default_zoom', 7);
?>

<div id="festival-map-container" class="<?php echo htmlspecialchars($params->get('moduleclass_sfx', '')); ?>" style="width: <?php echo $mapWidth; ?>; height: <?php echo $mapHeight; ?>;">
    <div id="map" style="width: 100%; height: 100%;"></div>
</div>

<script>
    var festivalMapData = <?php echo $mapData; ?>;
    var defaultLat = <?php echo $defaultLat; ?>;
    var defaultLon = <?php echo $defaultLon; ?>;
    var defaultZoom = <?php echo $defaultZoom; ?>;
</script>
