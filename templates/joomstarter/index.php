<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.JoomStarter
 *
 * @copyright   (C) YEAR Your Name
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * This is a heavily stripped down/modified version of the default Cassiopeia template, designed to build new templates off of.
 */

defined('_JEXEC') or die;  //required for basically ALL php files in Joomla, for security. Prevents direct access to this file by url.

//Imports ("use" statements) - objects from Joomla that we want to use in this file
use Joomla\CMS\Factory; // Factory class: Contains static methods to get global objects from the Joomla framework. Very important!
use Joomla\CMS\HTML\HTMLHelper; // HTMLHelper class: Contains static methods to generate HTML tags.
use Joomla\CMS\Language\Text; // Text class: Contains static methods to get text from language files
use Joomla\CMS\Uri\Uri; // Uri class: Contains static methods to manipulate URIs.

/** @var Joomla\CMS\Document\HtmlDocument $this */

$config = Factory::getConfig(); // Get the Joomla configuration object
$fromEmail = $config->get('mailfrom'); // Get the email address that system emails will be sent from
$app = Factory::getApplication();
$templateParams = $app->getTemplate(true)->params;
$wa  = $this->getWebAssetManager();  // Get the Web Asset Manager - used to load our CSS and JS files

// Add Favicon from images folder
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'icon', 'rel', ['type' => 'image/x-icon']);

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

// Check which framework is selected and load accordingly
$useUIKit = $templateParams->get('use_uikit', 0);
$useBootstrap = $templateParams->get('use_bootstrap', 0);
$useFontAwesome = $templateParams->get('use_fontawesome', 0);
$facebook = $templateParams->get('facebook');
$instagram = $templateParams->get('instagram');
$linkedin = $templateParams->get('linkedin');
$bluesky = $templateParams->get('bluesky');
$netzeroLogo = $templateParams->get('netzero-logo');
$footerLogo = $templateParams->get('footer-logo');
$logo = $templateParams->get('logo');

//Get params from template styling
//If you want to add your own parameters you may do so in templateDetails.xml
$testparam =  $this->params->get('testparam');

//uncomment to see how this works on site... it just shows 1 or 0 depending on option selected in style config.
//You can use this style to get/set any param according to instructions at https://kevinsguides.com/guides/webdev/joomla4/joomla-4-templates/adding-config
//echo('the value of testparam is: '.$testparam);

// Get this template's path
$templatePath = 'templates/' . $this->template;

//load bootstrap collapse js (required for mobile menu to work)
//this loads collapse.min.js from media/vendor/bootstrap/js - you can check out that folder to see what other bootstrap js files are available if you need them
HTMLHelper::_('bootstrap.collapse');
//dropdown needed for 2nd level menu items
HTMLHelper::_('bootstrap.dropdown');
//You could also load all of bootstrap js with this line, but it's not recommended because it's a lot of extra code that you probably don't need
//HTMLHelper::_('bootstrap.framework');

// Load UIKit if enabled
if ($templateParams->get('use_uikit', 0)) {
    $wa->useStyle('template.uikit.css');
    $wa->useScript('template.uikit.js');
}

// Load Bootstrap if enabled
if ($templateParams->get('use_bootstrap', 0)) {
    $wa->useStyle('template.bootstrap.css');
    $wa->useScript('template.bootstrap.js');
}

// Load Bootstrap if enabled
if ($templateParams->get('use_fontawesome', 0)) {
    $wa->useScript('template.fontawesome.js');
}

//Register our web assets (Css/JS) with the Web Asset Manager
$wa->useStyle('template.joomstarter.mainstyles');
$wa->useStyle('template.joomstarter.user');
$wa->useScript('template.joomstarter.scripts');

//Set viewport meta tag for mobile responsiveness -- very important for scaling on mobile devices
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
    <link rel="stylesheet" href="https://use.typekit.net/pem0kto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap" rel="stylesheet">
</head>

<?php // you can change data-bs-theme to dark for dark mode  // 
?>

<body class="site uk-background-default <?php echo $pageclass; ?>" data-bs-theme="light">
    <!-- <header uk-sticky> -->
    <header>
        <?php // Load Header Module if Module Exists 
        ?>
        <div class="uk-background-primary">
            <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
                <div uk-grid class="uk-flex uk-flex-middle uk-flex-right">
                    <div id="top-search" class="uk-width-1-6@m uk-margin uk-margin-remove-top uk-margin-remove-bottom">
                        <jdoc:include type="modules" name="top-search" style="none" />
                    </div>
                    <div id="top-menu" class="uk-width-1-6@m uk-margin uk-margin-remove-top uk-margin-remove-bottom">
                        <jdoc:include type="modules" name="top-menu" style="none" />
                    </div>
                </div>
            </div>
        </div>


        <?php // Generate a Bootstrap Navbar for the top of our website and put the site title on it 
        ?>
        <nav class="navbar uk-background-default navbar-expand-lg">
            <div class="uk-container-expand uk-margin-large-left uk-margin-large-right uk-margin-medium-top uk-margin-medium-bottom uk-padding-top uk-padding-bottom">
                <div uk-grid>
                    <div class="uk-width-1-6@m">
                        <a href="" class="navbar-brand"><img src="<?php echo '/images/logo/' . $logo; ?>" alt="logo" /></a>
                        <?php // Update 1.14 - Added support for mobile menu with bootstrap 
                        ?>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="uk-width-5-6@m">
                        <?php // Put menu links in the navbar - main menu must be in the "menu" position!!! Only supports top level and 1 down, so no more than 1 level of child items 
                        ?>
                        <?php if ($this->countModules('menu')): ?>
                            <div class="collapse navbar-collapse" id="mainmenu">
                                <jdoc:include type="modules" name="menu" style="none" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
        <?php // Load Header Module if Module Exists 
        ?>
        <?php if ($this->countModules('header')) : ?>
            <div class="headerClasses">
                <jdoc:include type="modules" name="header" style="none" />
            </div>
        <?php endif; ?>
    </header>

    <?php // Generate the main content area of the website 
    ?>
    <div class="siteBody">
        <?php if ($this->countModules('hero')) : ?>
            <div class="uk-container-expand">
                <div id="hero">
                    <jdoc:include type="modules" name="hero" style="none" />
                </div>
            </div>
        <?php endif; ?>

        <?php if ($this->countModules('topa')) : ?>
            <div id="topa">
                <jdoc:include type="modules" name="topa" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('topb')) : ?>
            <div id="topb">
                <jdoc:include type="modules" name="topb" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('topc')) : ?>
            <div id="topc">
                <jdoc:include type="modules" name="topc" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('topd')) : ?>
            <div id="topd">
                <jdoc:include type="modules" name="topd" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('tope')) : ?>
            <div id="tope">
                <jdoc:include type="modules" name="tope" style="none" />
            </div>
        <?php endif; ?>
        <main>
            <?php // Load important Joomla system messages 
            ?>
            <jdoc:include type="message" />
            <?php // Load the main component of the webpage 
            ?><div class="uk-container-expand">
                <jdoc:include type="component" />
            </div>
        </main>

        <?php if ($this->countModules('bottoma')) : ?>
            <div id="bottoma">
                <jdoc:include type="modules" name="bottoma" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('bottomb')) : ?>
            <div id="bottomb">
                <jdoc:include type="modules" name="bottomb" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('bottomc')) : ?>
            <div id="bottomc">
                <jdoc:include type="modules" name="bottomc" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('bottomd')) : ?>
            <div id="bottomd">
                <jdoc:include type="modules" name="bottomd" style="none" />
            </div>
        <?php endif; ?>
        <?php if ($this->countModules('bottome')) : ?>
            <div id="bottome">
                <jdoc:include type="modules" name="bottome" style="none" />
            </div>
        <?php endif; ?>
    </div>

    <?php // Load Footer 
    ?>
    <div id="festivalFooter" class="uk-background-primary">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid class="uk-flex uk-flex-middle">
                <div class="uk-width-1-3@m uk-padding text-white" id="socials">
                    <div id="contact">
                        <a href="mailto:<?php echo htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8'); ?>"
                            class="uk-text-decoration-none uk-text-large uk-text-white">
                            <?php echo htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </div>
                    <div id="social-links">
                        <?php if ($facebook) : ?>
                            <a href="<?php echo $facebook; ?>" target="_blank" class="uk-margin-small-right">
                                <i class="fa-brands fa-square-facebook fa-4xl"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($instagram) : ?>
                            <a href="<?php echo $instagram; ?>" target="_blank" class="uk-margin-small-right">
                                <i class="fa-brands fa-square-instagram fa-4xl"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($linkedin) : ?>
                            <a href="<?php echo $linkedin; ?>" target="_blank" class="uk-margin-small-right">
                                <i class="fa-brands fa-linkedin fa-4xl"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($bluesky) : ?>
                            <a href="<?php echo $bluesky; ?>" target="_blank" class="uk-margin-small-right">
                                <i class="fa-brands fa-square-bluesky fa-4xl"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="uk-width-1-3@m uk-padding">
                    <img src="<?php echo '/images/logo/' . $footerLogo; ?>" alt="logo" />
                </div>

                <?php if ($this->countModules('policy-menu')) : ?>
                    <div class="uk-width-1-3@m uk-padding uk-padding-remove-right uk-flex uk-flex-right">
                        <jdoc:include type="modules" name="policy-menu" style="none" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer id="copyrightFooter" class="footer mt-auto py-3 uk-background-default ">
        <div class="uk-container-expand uk-margin-large-left uk-margin-large-right">
            <div uk-grid>
                <div class="uk-width-1-2@m uk-padding">
                    <img src="<?php echo '/images/logo/' . $netzeroLogo; ?>" alt="logo" />
                </div>
                <?php if ($this->countModules('copyright-footer-copyright')) : ?>
                    <div class="uk-width-1-2@m uk-padding uk-padding-remove-right">
                        <jdoc:include type="modules" name="copyright-footer-copyright" style="none" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <?php // Include any debugging info 
    ?>
    <jdoc:include type="modules" name="debug" style="none" />
</body>

</html>