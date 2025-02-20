<?php

defined ( '_JEXEC' ) or die;

//the class name must match the "element" property in the extensions table of the database, or the field "name" in the xml file EXACTLY or the script will not run
class joomstarterInstallerScript
{

    public function install($parent) 
    {
        echo '<p>Good choice, you\'ve installed a great template!</p>';
    }

    public function uninstall($parent) 
    {
        echo '<p>I\'ve come to regard you as someone that I, met.</p>';
    }

    public function update($parent) 
    {
        echo '<p>Good work! You\'ve updated the template to the latest version!</p>';

    }


}