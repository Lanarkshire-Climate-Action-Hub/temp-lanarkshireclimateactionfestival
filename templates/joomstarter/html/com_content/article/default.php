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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
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

$document = Factory::getDocument();
$renderer = $document->loadRenderer('modules');
$moduleOptions  = array('style' => 'html5');
$shareModule = $renderer->render('event-share-module', $moduleOptions, null);

// Get custom fields
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);

$titleSize = '';

foreach ($fields as $field) {
    if ($field->id == 147) {
        $titleSize = $field->value;
    }
}

?>

<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? Factory::getApplication()->get('language') : $this->item->language; ?>">

<div class="com-content-article item-page<?php echo $this->pageclass_sfx; ?>" id="individual-news-page">

    <div class="hero<?php echo $this->pageclass_sfx; ?> uk-background-primary uk-background-contain uk-background-center-right" uk-grid>
        <div class="uk-width-2-5@m uk-width-1-1">
            <div class="page-header uk-margin-large-left uk-margin-large-right vertical-center">
                <h1 class="uk-text-left <?php echo $titleSize; ?> outfit-bold">
                    <?php echo $this->item->title; ?>
                </h1>
            </div>
        </div>
        <div class="uk-width-expand@m uk-width-1-1">
            <?php echo LayoutHelper::render('joomla.content.news_full_image', $this->item); ?>
        </div>
    </div>
    <div uk-grid class="uk-margin-remove-top">
        <div class="uk-width-5-6@m">
            <div class="uk-padding-large uk-padding-remove-right uk-padding-remove-left uk-margin-large-left uk-margin-large-right">
                <?php echo $this->item->text; ?>
            </div>
        </div>
        <?php if (!empty($shareModule)) { ?>
            <div class="uk-width-1-6@m" id="share">
                <div class="uk-text-center uk-text-white uk-background-secondary uk-padding">
                    <?php echo $shareModule; ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>