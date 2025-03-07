<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

class RsformViewDirectory extends JViewLegacy
{
	public function display($tpl = null)
	{
		$this->app			= JFactory::getApplication();
		$this->doc			= JFactory::getDocument();
		$this->document		= &$this->doc;
		$this->params		= $this->app->getParams('com_rsform');
		$this->layout		= $this->getLayout();
		$this->directory	= $this->get('Directory');
		$this->tooltipClass = RSFormProHelper::getTooltipClass();
		$this->url          = JUri::getInstance();
		$this->formId       = $this->params->get('formId');

        JHtml::_('script', 'com_rsform/directory.js', array('relative' => true, 'version' => 'auto'));
		
		if ($this->layout == 'view')
		{
            JHtml::_('stylesheet', 'com_rsform/directory.css', array('relative' => true, 'version' => 'auto'));
			
			$this->template  = $this->get('template');
            $this->id		 = $this->app->input->getInt('id',0);
			$this->canEdit	 = RSFormProHelper::canEdit($this->formId, $this->id);
            $this->canDelete = RSFormProHelper::canDelete($this->formId, $this->id);
			
			// Add custom CSS and JS
			if ($this->directory->JS)
			{
				$this->doc->addCustomTag($this->directory->JS);
			}

			if ($this->directory->CSS)
			{
				$this->doc->addCustomTag($this->directory->CSS);
			}
			
			// Add pathway
			$this->app->getPathway()->addItem(JText::_('RSFP_SUBM_DIR_VIEW'), '');
		}
		elseif ($this->layout == 'edit')
		{
			if (RSFormProHelper::canEdit($this->formId, $this->app->input->getInt('id',0)))
			{
                JHtml::_('stylesheet', 'com_rsform/directory.css', array('relative' => true, 'version' => 'auto'));
				$this->fields		= $this->get('EditFields');
			}
			else
			{
				$this->app->enqueueMessage(JText::_('COM_RSFORM_SUBMISSIONS_DIRECTORY_CANNOT_EDIT'), 'error');
				$this->app->redirect(JRoute::_('index.php?option=com_rsform&view=directory', false));
			}
			
			// Add pathway
			$this->app->getPathway()->addItem(JText::_('RSFP_SUBM_DIR_EDIT'), '');
		}
		else
		{
			$this->search              = $this->get('Search');
			$this->items               = $this->get('Items');
			$this->uploadFields        = $this->get('uploadFields');
			$this->multipleFields      = $this->get('multipleFields');
			$this->additionalUnescaped = $this->get('additionalUnescaped');
			$this->unescapedFields     = array_merge($this->uploadFields, $this->multipleFields, $this->additionalUnescaped);
			$this->fields              = $this->get('Fields');
			$this->headers             = RSFormProHelper::getDirectoryStaticHeaders();
			$this->hasDetailFields     = $this->hasDetailFields();
			$this->hasSearchFields     = $this->hasSearchFields();
			$this->viewableFields      = $this->getViewableFields();
			$this->dynamicFilters      = $this->params->get('dynamic_filter_values', array());
			$this->dynamicSearch       = $this->get('dynamicFilters');
			$this->pagination          = $this->get('Pagination');

			$this->filter_search    = $this->get('Search');
			$this->filter_order     = $this->get('ListOrder');
			$this->filter_order_Dir = $this->get('ListDirn');

			if ($this->directory->AllowCSVFullDownload)
			{
				$this->limit = RSFormProHelper::getConfig('export.limit');
				$this->total = $this->get('Total');
			}

			$this->url->delVar('start');
			
			// Add custom CSS and JS
			if ($this->directory->JS)
			{
				$this->doc->addCustomTag($this->directory->JS);
			}

			if ($this->directory->CSS)
			{
				$this->doc->addCustomTag($this->directory->CSS);
			}
		}
		
		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
		
		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		
		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		
		$title = $this->params->get('page_title', '');
		if (empty($title))
		{
			$title = JFactory::getApplication()->get('sitename');
		}
		elseif (JFactory::getApplication()->get('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', JFactory::getApplication()->get('sitename'), $title);
		}
		elseif (JFactory::getApplication()->get('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, JFactory::getApplication()->get('sitename'));
		}
		
		$this->document->setTitle($title);
		
		parent::display($tpl);
	}

	protected function hasDetailFields()
	{
		foreach ($this->fields as $field)
		{
			if ($field->indetails)
			{
				return true;
			}
		}

		return false;
	}
	
	protected function hasSearchFields()
	{
		foreach ($this->fields as $field)
		{
			if ($field->searchable)
			{
				return true;
			}
		}

		return false;
	}
	
	protected function getViewableFields()
	{
		$return = array();
		
		foreach ($this->fields as $field)
		{
			if ($field->viewable)
			{
				$return[] = $field;
			}
		}
		
		return $return;
	}
	
	protected function getFilteredName($name)
	{
		return ucfirst(JFilterOutput::stringURLSafe($name));
	}
	
	protected function getValue($item, $field)
	{
		if (in_array($field->FieldName, $this->unescapedFields))
		{
			return $item->{$field->FieldName};
		}
		else
		{
			// Static header?
			if ($field->componentId < 0 && isset($this->headers[$field->componentId]))
			{
				$header = $this->headers[$field->componentId];
				if ($header == 'DateSubmitted')
				{
					$value = RSFormProHelper::getDate($item->{$header});
				}
				else
				{
					$value = $item->{$header};
				}
			}
			else
			{
				// Dynamic header.
				$value = $item->{$field->FieldName};
			}

			return $this->escape($value);
		}
	}
	
	public function pdfLink($id)
	{
		return JRoute::_('index.php?option=com_rsform&view=directory&layout=view&id=' . $id . '&format=pdf');
	}
}