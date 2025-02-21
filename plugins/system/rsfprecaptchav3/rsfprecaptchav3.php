<?php
/**
* @package RSform!Pro
* @copyright (C) 2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\Form;

define('RSFORM_FIELD_RECAPTCHAV3', 2423);

class plgSystemRsfprecaptchav3 extends CMSPlugin
{
	protected $autoloadLanguage = true;

    public function __construct($dispatcher, $config)
	{
		parent::__construct($dispatcher, $config);

		if (!class_exists('RSFormProHelper'))
		{
			if (!file_exists(JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php'))
			{
				return;
			}

			require_once JPATH_ADMINISTRATOR . '/components/com_rsform/helpers/rsform.php';
		}

        if (class_exists('RSFormProHelper'))
		{
			RSFormProHelper::$captchaFields[] = RSFORM_FIELD_RECAPTCHAV3;
        }
	}

	public function onRsformBackendAfterCreateFieldGroups(&$fieldGroups, $self)
	{
		$formId = Factory::getApplication()->input->getInt('formId');
		$exists = RSFormProHelper::componentExists($formId, RSFORM_FIELD_RECAPTCHAV3);

		$fieldGroups['captcha']->fields[] = (object) array(
			'id' 	=> RSFORM_FIELD_RECAPTCHAV3,
			'name' 	=> Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_LABEL'),
			'icon'  => 'rsficon rsficon-spinner9',
			'exists' => $exists ? $exists[0] : false
		);
	}

	// Show the Configuration tab
	public function onRsformBackendAfterShowConfigurationTabs($tabs) {
		$tabs->addTitle(Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_LABEL'), 'page-recaptchav3');
		$tabs->addContent($this->showConfigurationScreen());
	}

	private function loadFormData()
	{
		$data 	= array();
		$db 	= Factory::getDbo();

		$query = $db->getQuery(true)
			->select('*')
			->from($db->qn('#__rsform_config'))
			->where($db->qn('SettingName') . ' LIKE ' . $db->q('recaptchav3.%', false));
		if ($results = $db->setQuery($query)->loadObjectList())
		{
			foreach ($results as $result)
			{
				$data[$result->SettingName] = $result->SettingValue;
			}
		}

		return $data;
	}

	protected function showConfigurationScreen()
	{
		ob_start();

		Form::addFormPath(__DIR__ . '/forms');

		$form = Form::getInstance( 'plg_system_rsfprecaptchav3.configuration', 'configuration', array('control' => 'rsformConfig'), false, false );
		$form->bind($this->loadFormData());

		?>
		<div id="page-recaptchav3" class="form-horizontal">
			<?php
			foreach ($form->getFieldsets() as $fieldset)
			{
				if ($fields = $form->getFieldset($fieldset->name))
				{
					foreach ($fields as $field)
					{
						// This is a workaround because our fields are named "recaptchav3." and Joomla! uses the dot as a separator and transforms the JSON into [recaptchav3][language] instead of [recaptchav3.language].
						echo str_replace('"rsformConfig[recaptchav3][', '"rsformConfig[recaptchav3.', $form->renderField($field->fieldname));
					}
				}
			}
			?>
		</div>
		<?php

		$contents = ob_get_contents();
		ob_end_clean();

		return $contents;
	}

	public function onRsformFrontendInitFormDisplay($args)
	{
		if ($componentIds = RSFormProHelper::componentExists($args['formId'], RSFORM_FIELD_RECAPTCHAV3))
		{
			$all_data = RSFormProHelper::getComponentProperties($componentIds);

			if ($all_data)
			{
				foreach ($all_data as $componentId => $data)
				{
					$args['formLayout'] = preg_replace('/<label (.*?) for="' . preg_quote($data['NAME'], '/') .'"/', '<label $1', $args['formLayout']);
				}
			}
		}
	}

	public function onRsformDefineHiddenComponents(&$hiddenComponents)
	{
		$hiddenComponents[] = RSFORM_FIELD_RECAPTCHAV3;
	}

    public function onRsformBackendGetSkippedFields(&$skippedFields)
    {
        $position = array_search(RSFORM_FIELD_RECAPTCHAV3, $skippedFields);
        if ($position !== false)
        {
            unset($skippedFields[$position]);
        }
    }

	public function onBeforeRender()
	{
		// we do not have to run in the administrator section
		if (Factory::getApplication()->isClient('administrator'))
		{
			return true;
		}

		if (Factory::getDocument()->getType() !== 'html')
		{
			return true;
		}

		// No RSForm! Pro installed
		if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php'))
		{
			return true;
		}

		if (!class_exists('RSFormProHelper'))
		{
			require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php';
		}

		RSFormProHelper::readConfig();

		if (!RSFormProHelper::getConfig('recaptchav3.allpages'))
		{
			return true;
		}

		$key = RSFormProHelper::getConfig('recaptchav3.sitekey');

		if (!$key)
		{
			return true;
		}

		$domain = RSFormProHelper::getConfig('recaptchav3.domain');
		if (RSFormProHelper::getConfig('recaptchav3.asyncdefer'))
		{
			RSFormProAssets::addCustomTag('<script src="https://www.' . $domain .'/recaptcha/api.js?render=' . urlencode($key). '" async defer></script>');
		}
		else
		{
			RSFormProAssets::addScript('https://www.' . $domain . '/recaptcha/api.js?render=' . urlencode($key));
		}

		RSFormProAssets::addScriptDeclaration('if (typeof window.grecaptcha !== \'undefined\') { grecaptcha.ready(function() { grecaptcha.execute(' . json_encode($key) . ', {action:\'homepage\'});}); }');
	}
}