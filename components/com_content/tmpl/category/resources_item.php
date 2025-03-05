<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

?>

<div class="item-content uk-text-center uk-padding uk-padding-remove-left uk-padding-remove-right">
    <?php echo LayoutHelper::render('joomla.content.blog_style_resources_default_item_title', ['item' => $this->item, 'index' => $this->item->index]); ?>
</div>
