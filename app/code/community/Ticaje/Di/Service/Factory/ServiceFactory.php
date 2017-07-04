<?php

namespace Ticaje\Di\Service\Factory;

/**
 * Factory Interface
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Container;

interface ServiceFactory
{
    /**
     * @param string $id - a known id key
     * @param Container\Container $container
     * @return mixed - a registered service
     * @throws \InvalidArgumentException
     */
    public function create($id, Container\Container $container);
}