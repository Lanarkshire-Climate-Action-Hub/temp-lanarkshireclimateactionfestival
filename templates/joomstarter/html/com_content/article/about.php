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
$secondAboutImage = '';
$secondTextArea = '';
$secondTitle = '';

foreach ($fields as $field) {
    if ($field->id == 8) { // ID for "second-about-image"
        $imageData = json_decode($field->rawvalue); // Decode JSON
        if (!empty($imageData->imagefile)) {
            $secondAboutImage = $imageData->imagefile; // Extract image file path
        }
    }
    if ($field->id == 9) { // ID for "second-text-area"
        $secondTextArea = $field->value; // Processed value for editor content
    }
    if ($field->id == 10) { // ID for "second-title"
        $secondTitle = $field->value; // Processed value for editor content
    }
}
?>
<div class="about-page">
    <div class="item-page<?php echo $this->pageclass_sfx; ?> uk-margin-large-left" uk-grid>
        <div class="uk-width-1-2@m">
            <?php if ($this->params->get('show_page_heading')) : ?>
                <div class="page-header">
                    <h1 class="uk-text-primary heading-1"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
                </div>
            <?php endif; ?>
            <?php echo $this->item->text; ?>
        </div>
        <div class="uk-width-1-2@m">
            <?php echo LayoutHelper::render('joomla.content.about_full_image', $this->item); ?>
        </div>
    </div>
    <?php if (!empty($secondTextArea) || !empty($secondAboutImage)) : ?>
        <div class="uk-background-secondary">
            <div class="uk-margin-large-right" uk-grid>
                <?php if (!empty($secondAboutImage)) : ?>
                    <div class="uk-width-2-5@m">
                        <img src="<?php echo htmlspecialchars($secondAboutImage, ENT_QUOTES, 'UTF-8'); ?>" alt="Second About Image" class="uk-width-1-1">
                    </div>
                <?php endif; ?>

                <?php if (!empty($secondTextArea)) : ?>
                    <div class="uk-width-3-5@m">
                        <div class="uk-text-white vertical-center uk-text-left">
                            <h2 class="gardein uk-text-white"><?php echo $secondTitle; ?></h2>
                            <div class="second-text-area-width">
                            <?php echo $secondTextArea; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>