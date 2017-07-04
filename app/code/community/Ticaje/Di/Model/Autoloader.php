<?php

/**
 * Auto-loading Observer Class
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

class Ticaje_Di_Model_Autoloader
{
	/** @var bool $_registered */
	protected static $_registered = false;

    /**
     * @param Varien_Event_Observer $observer
     */
	public function addAutoloader(Varien_Event_Observer $observer)
	{
		if (self::$_registered) {
			return;
		}
		spl_autoload_register(array($this, 'autoload'), false, true);
		self::$_registered = true;
	}

    /**
     * @param string $class
     */
	public function autoload($class)
	{
        /** @var string $_class_file */
		$_class_file = str_replace('\\', '/', $class) . '.php';
		// Include name-spaced classes, apart from Magento auto-loader.
		if (strpos($_class_file, '/') !== false) {
			include $_class_file;
		}
	}
	
}
