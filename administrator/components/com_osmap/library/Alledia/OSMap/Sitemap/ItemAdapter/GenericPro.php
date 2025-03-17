<?php
/**
 * @package   OSMap-Pro
 * @contact   www.joomlashack.com, help@joomlashack.com
 * @copyright 2007-2014 XMap - Joomla! Vargas - Guillermo Vargas. All rights reserved.
 * @copyright 2016-2024 Joomlashack.com. All rights reserved
 * @license   https://www.gnu.org/licenses/gpl.html GNU/GPL
 *
 * This file is part of OSMap-Pro.
 *
 * OSMap-Pro is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * OSMap-Pro is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OSMap-Pro.  If not, see <https://www.gnu.org/licenses/>.
 */

namespace Alledia\OSMap\Sitemap\ItemAdapter;

use Alledia\OSMap\Factory;

defined('_JEXEC') or die();

class GenericPro extends Generic
{
    /**
     * @var string
     */
    protected $robots;

    /**
     * Gets the visible state for robots. Each adapter will check specific params. Returns
     * true if the item is visible.
     *
     * @return bool
     */
    public function checkVisibilityForRobots()
    {
        $robots = $this->getRobotsSettings();

        return $robots !== 'noindex, nofollow';
    }

    /**
     * Returns the generic robots settings, grabbing from the global settings
     *
     * @return string
     */
    protected function getRobotsSettings()
    {
        if (isset($this->item->params)) {
            $this->robots = $this->item->params->get('robots');
        }

        if (empty($this->robots)) {
            // Get the global configuration for robots
            $this->robots = Factory::getConfig()->get('robots', '');
        }

        return $this->robots;
    }
}
