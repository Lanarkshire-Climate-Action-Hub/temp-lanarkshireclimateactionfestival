<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class RSFormProCaptcha
{
	public $Size;
    public $Length;
    public $Type;
    public $CaptchaString;
    public $fontpath;
    public $fonts;
    public $data;
    public $componentId;

    public function __construct($componentId)
	{
		$this->componentId = $componentId;

		$this->data = RSFormProHelper::getComponentProperties($componentId);
		
		if (!isset($this->data['IMAGETYPE']))
		{
			$this->data['IMAGETYPE'] = 'FREETYPE';
		}

		if (!isset($this->data['LENGTH']))
		{
			$this->data['LENGTH'] = 4;
		}
		
		if ($this->data['IMAGETYPE'] == 'INVISIBLE')
		{
            die();
        }
		
	    $this->Length = $this->data['LENGTH'];
		$this->Size = !empty($this->data['SIZE']) && is_numeric($this->data['SIZE']) && $this->data['SIZE'] > 0 ? $this->data['SIZE'] : 15;

	    $this->fontpath = JPATH_SITE.'/components/com_rsform/assets/fonts';
	    $this->fonts    = $this->getFonts();

	    $this->stringGenerate();
    }

    public function getFonts()
	{
		return JFolder::files($this->fontpath, '\.ttf');
	}
	
    public function getRandomFont()
	{
		return $this->fontpath.'/'.$this->fonts[mt_rand(0, count($this->fonts) - 1)];
    }
    
	public function stringGenerate()
	{
		if (!isset($this->data['TYPE']))
		{
			$this->data['TYPE'] = 'ALPHANUMERIC';
		}
			
    	switch ($this->data['TYPE'])
		{
    		case 'ALPHA': $CharPool = range('a','z'); break;
    		case 'NUMERIC': $CharPool = range('0','9'); break;
    		case 'ALPHANUMERIC': default: $CharPool = array_merge(range('0','9'),range('a','z')); break;
    	}

		$PoolLength = count($CharPool) - 1;

		for ($i = 0; $i < $this->Length; $i++)
		{
			$this->CaptchaString .= $CharPool[mt_rand(0, $PoolLength)];
		}

		$this->setSession();
    }

    public function makeCaptcha()
	{
		if (!function_exists('imagecreate'))
		{
			return file_get_contents(JPATH_SITE . '/media/com_rsform/images/nogd.gif');
		}

		if ($this->data['IMAGETYPE'] == 'FREETYPE')
		{
			if (!$this->fonts)
			{
				$error = new RSFormProCaptchaError;
				$error->addError('No fonts available!');
				return $error->displayError();
			}

			if (!function_exists('imagettftext'))
			{
				$error = new RSFormProCaptchaError;
				$error->addError('The function imagettftext does not exist.');
				return $error->displayError();
			}
		}

		if (!isset($this->data['BACKGROUNDCOLOR']))
		{
			$this->data['BACKGROUNDCOLOR'] = '#FFFFFF';
		}

		if (!isset($this->data['TEXTCOLOR']))
		{
			$this->data['TEXTCOLOR'] = '#000000';
		}
			
		$imagelength = $this->Length * $this->Size + 10;
		$imageheight = $this->Size*1.6;
		
		$imagelength = (int) $imagelength;
		$imageheight = (int) $imageheight;
		
		$image       = imagecreate($imagelength, $imageheight);
		$usebgrcolor = sscanf($this->data['BACKGROUNDCOLOR'], '#%2x%2x%2x');
		$usestrcolor = sscanf($this->data['TEXTCOLOR'], '#%2x%2x%2x');

		$bgcolor     = imagecolorallocate($image, $usebgrcolor[0], $usebgrcolor[1], $usebgrcolor[2]);
		$stringcolor = imagecolorallocate($image, $usestrcolor[0], $usestrcolor[1], $usestrcolor[2]);

		if ($this->data['IMAGETYPE'] == 'FREETYPE')
		{
			for ($i = 0; $i < strlen($this->CaptchaString); $i++)
			{
				imagettftext($image,$this->Size, mt_rand(-15,15), $i * $this->Size + 10,
					round($imageheight/100*80),
					$stringcolor,
					$this->getRandomFont(),
					$this->CaptchaString[$i]);
			}
		}
		
		if ($this->data['IMAGETYPE'] == 'NOFREETYPE')
		{
			imagestring($image, mt_rand(3,5), 10, 0,  $this->CaptchaString, $stringcolor);
		}

		ob_start();
		imagepng($image);
		imagedestroy($image);
		$data = ob_get_contents();
		ob_end_clean();

		return $data;
    }

	public function addNoise(&$image, $runs = 30)
	{
		$w = imagesx($image);
		$h = imagesy($image);

		for ($n = 0; $n < $runs; $n++)
		{
			for ($i = 1; $i <= $h; $i++)
			{
				$randcolor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
				imagesetpixel($image, mt_rand(1, $w), mt_rand(1, $h), $randcolor);
			}
		}
    }
	
    public function getCaptcha()
    {
		return $this->CaptchaString;
    }

    public function setSession()
	{
		JFactory::getSession()->set('com_rsform.captcha.captchaId' . $this->componentId, $this->getCaptcha());
	}
}

class RSFormProCaptchaError
{
    public $errors = array();

    public function addError($errormsg = '')
    {
        $this->errors[] = $errormsg;
    }

    public function displayError()
    {
		$iheight     = count($this->errors) * 20 + 10;
		$iheight     = ($iheight < 70) ? 70 : $iheight;
		$image       = imagecreate(600, $iheight);
		$bgcolor     = imagecolorallocate($image, 255, 255, 255);
		$stringcolor = imagecolorallocate($image, 0, 0, 0);
		for ($i = 0; $i < count($this->errors); $i++)
		{
			$imx = ($i == 0) ? $i * 20 + 5 : $i * 20;
			imagestring($image, 5, 5, $imx, $this->errors[$i], $stringcolor);
		}

		ob_start();
		imagepng($image);
		imagedestroy($image);
		$data = ob_get_contents();
		ob_end_clean();

		return $data;
    }
}