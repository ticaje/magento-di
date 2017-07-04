<?php

/**
 * Test Bootstrap File
 * @category    Ticaje
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

// Add the path to "lib" directory to the include path
set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/lib');

// Make sure the composer autoloader is used
require_once 'vendor/autoload.php';

// Make sure the EcomDev bootstrap is ran
require_once 'app/code/community/EcomDev/PHPUnit/bootstrap.php';