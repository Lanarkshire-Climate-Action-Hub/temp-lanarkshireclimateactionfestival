<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** @var \Joomla\Component\Finder\Site\View\Search\HtmlView $this */
$this->getDocument()->getWebAssetManager()
    ->useStyle('com_finder.finder')
    ->useScript('com_finder.finder');
?>
<div class="com-finder finder uk-margin-large-left uk-margin-large-right">
    <?php if ($this->params->get('show_page_heading')) : ?>
        <h1>
            <?php if ($this->escape($this->params->get('page_heading'))) : ?>
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            <?php else : ?>
                <?php echo $this->escape($this->params->get('page_title')); ?>
            <?php endif; ?>
        </h1>
    <?php endif; ?>
    <div id="search-form" class="com-finder__form">
        <?php echo $this->loadTemplate('form'); ?>
    </div>
    <?php // Load the search results layout if we are performing a search. ?>
    <?php if ($this->query->search === true) : ?>
        <div id="search-results" class="com-finder__results uk-margin-bottom">
            <?php echo $this->loadTemplate('results'); ?>
        </div>
    <?php endif; ?>
</div>
