<?php

namespace Ticaje\Di\Service\Container;

/**
 * ContainerBuilder Class
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Factory;

class ContainerBuilder
{
    /**
     * @param string $file
     * @return Container $_container
     * Create/Fetch an instance out of a config file where the dependencies are defined
     */
    public static function buildContainer($file)
    {
        /** @var Container $_container */
        $_container = Container::getInstance(new Factory\Factory($file));
        return $_container;
    }
}