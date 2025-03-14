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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

$app = Factory::getApplication();

/** @var \Joomla\Component\Content\Site\View\Category\HtmlView $this */
$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

?>

<div id="resources">
    <div class="com-content-category-blog" uk-grid>
        <div class="uk-width-1-1 uk-margin-large-left uk-margin-large-right">
            <<?php echo $htag; ?> class="oneHundred uk-text-primary gardein">
                <?php echo $this->category->title; ?>
            </<?php echo $htag; ?>>
            <?php echo $afterDisplayTitle; ?>
        </div>
    </div>



    <div class="uk-margin-large uk-margin-large-left uk-margin-large-right uk-background-white uk-text-center">

        <div class="com-content-category-blog__items" uk-height-match="target: .item-content h2" uk-grid>

            <div class="uk-width-1-4@m">
                <div class="item-content uk-text-center">
                    <h2 class="uk-padding sixty signpost_border uk-background-primary bounce-on-hover vertical-center uk-text-center height160">
                        <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=19:event-inspiration&catid=9&Itemid=122'); ?>">
                            Event Inspiration
                        </a>
                    </h2>
                </div>
            </div>

            <div class="uk-width-1-4@m">
                <div class="item-content uk-text-center">
                    <h2 class="uk-padding sixty signpost_border uk-background-secondary bounce-on-hover vertical-center uk-text-center height160">
                        <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=4:sustainable-event-planning&catid=9&Itemid=123'); ?>">
                            Sustainable Event Planning
                        </a>
                    </h2>
                </div>
            </div>

            <div class="uk-width-1-4@m">
                <div class="item-content uk-text-center">
                    <h2 class="uk-padding sixty signpost_border uk-background-orange bounce-on-hover vertical-center uk-text-center height160">
                        <a class="remove-decoration uk-text-white" href="<?php echo Route::_('index.php?option=com_content&view=article&id=8:marketing-promotion&catid=9&Itemid=124'); ?>">
                            Marketing &amp; Promotion
                        </a>
                    </h2>
                </div>
            </div>

            <div class="uk-width-1-4@m">
                <div class="item-content uk-text-center">
                    <h2 class="uk-padding sixty signpost_border uk-background-yellow bounce-on-hover vertical-center uk-text-center height160">
                        <a class="remove-decoration uk-text-primary" href="<?php echo Route::_('index.php?option=com_content&view=article&id=9:talking-climate&catid=9&Itemid=125'); ?>">
                            Talking Climate
                        </a>
                    </h2>
                </div>
            </div>

        </div>

    </div>
</div>