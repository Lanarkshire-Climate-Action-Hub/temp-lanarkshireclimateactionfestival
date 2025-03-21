<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Utilities\IpHelper;
use Joomla\CMS\Http\HttpFactory;

require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/field.php';

class RSFormProFieldRecaptchav3 extends RSFormProField
{
	// backend preview
	public function getPreviewInput()
	{
		return HTMLHelper::_('image', 'plg_system_rsfprecaptchav3/recaptcha.png', 'ReCAPTCHA', null, true);
	}
	
	// functions used for rendering in front view
	public function getFormInput()
	{
		$formId		= $this->formId;
		$form 		= RSFormProHelper::getForm($formId);
		$logged		= $form->RemoveCaptchaLogged ? Factory::getUser()->id : false;

		if ($logged)
		{
			return '';
		}

		// If no site key has been setup, just show a warning
		$siteKey = RSFormProHelper::getConfig('recaptchav3.sitekey');
		if (!$siteKey)
		{
			return '<div>'.Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_NO_SITE_KEY').'</div>';
		}

		// Need to load scripts one-time.
		$this->loadScripts();

		$script = 'RSFormProReCAPTCHAv3.add(' . json_encode($siteKey) . ', ' . json_encode($this->getProperty('RECAPTCHAACTION', 'contactform')) . ', ' . $formId . ');';

		$script .= "RSFormProUtils.addEvent(window, 'load', function() {";

		// Need to trigger ReCAPTCHA
		if (!$form->DisableSubmitButton)
		{
			$script .= "RSFormProUtils.addEvent(RSFormPro.getForm({$formId}), 'submit', function(evt){ evt.preventDefault(); 
	RSFormPro.submitForm(RSFormPro.getForm({$formId})); });";
		}
		$script .= "RSFormPro.addFormEvent({$formId}, function(){ RSFormProReCAPTCHAv3.execute({$formId}); });";

		$script .= '});';

		$this->addScriptDeclaration($script);

		return '<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-' . $this->formId . '" value="">';
	}

	public function processValidation($validationType = 'form', $submissionId = 0)
	{
		// Skip directory editing since it makes no sense
		if ($validationType == 'directory')
		{
			return true;
		}

		$formId 	 = $this->formId;
		$form       = RSFormProHelper::getForm($formId);
		$logged		= $form->RemoveCaptchaLogged ? Factory::getUser()->id : false;
		$secretKey 	= RSFormProHelper::getConfig('recaptchav3.secretkey');

		// validation:
		// if there's no session token
		// validate based on challenge & response codes
		// if valid, set the session token

		// session token gets cleared after form processes
		// session token gets cleared on page refresh as well

		if (!$secretKey)
		{
			Factory::getApplication()->enqueueMessage(Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_MISSING_INPUT_SECRET'), 'error');
			return false;
		}

		if (!$logged)
		{
			$input 	  = Factory::getApplication()->input;
			$response = $input->post->get('g-recaptcha-response', '', 'raw');
			$ip		  = IpHelper::getIp();
			$task	  = strtolower($input->get('task', ''));
			$option	  = strtolower($input->get('option', ''));
			$isAjax	  = $option == 'com_rsform' && $task == 'ajaxvalidate';

			// Ajax requests don't validate ReCAPTCHA (we'll validate it when the form is actually submitted)
			if ($isAjax)
			{
				return true;
			}

			try
			{
				$http = HttpFactory::getHttp();
				if ($request = $http->get('https://www.' . RSFormProHelper::getConfig('recaptchav3.domain') . '/recaptcha/api/siteverify?secret='.urlencode($secretKey).'&response='.urlencode($response).'&remoteip='.urlencode($ip)))
				{
					$json = json_decode($request->body);
				}
			}
			catch (Exception $e)
			{
				Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
				return false;
			}

			$action = $this->getProperty('RECAPTCHAACTION', 'contactform');

			if (empty($json->success) || !$json->success)
			{
				if (!empty($json) && isset($json->{'error-codes'}) && is_array($json->{'error-codes'}))
				{
					foreach ($json->{'error-codes'} as $code)
					{
						Factory::getApplication()->enqueueMessage(Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_'.str_replace('-', '_', $code)), 'error');
					}
				}

				return false;
			}
			elseif ($json->action != $action)
			{
				Factory::getApplication()->enqueueMessage(Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_WRONG_ACTION'), 'error');
				return false;
			}
			elseif ((float) $json->score < (float) RSFormProHelper::getConfig('recaptchav3.threshold'))
			{
				Factory::getApplication()->enqueueMessage(Text::_('PLG_SYSTEM_RSFPRECAPTCHAV3_BELOW_THRESHOLD'), 'error');
				return false;
			}

			// Remember the score for debugging purposes
			$post = $input->post->get('form', array(), 'array');
			$post[$this->name] = Text::sprintf('PLG_SYSTEM_RSFPRECAPTCHAV3_SCORE_WAS', $json->score);
			$input->post->set('form', $post);
		}

		return true;
	}

	protected function loadScripts()
	{
		static $loaded;

		if (!$loaded)
		{
			$loaded = true;

			$domain = RSFormProHelper::getConfig('recaptchav3.domain');
			$key = RSFormProHelper::getConfig('recaptchav3.sitekey');

			if (RSFormProHelper::getConfig('recaptchav3.asyncdefer'))
			{
				$this->addCustomTag('<script src="https://www.' . $domain .'/recaptcha/api.js?render=' . urlencode($key). '" async defer></script>');
			}
			else
			{
				$this->addScript('https://www.' . $domain . '/recaptcha/api.js?render=' . urlencode($key));
			}

			$this->addScript(HTMLHelper::_('script', 'plg_system_rsfprecaptchav3/script.js', array('pathOnly' => true, 'relative' => true)));
		}
	}
}