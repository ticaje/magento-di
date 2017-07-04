<?php

namespace Ticaje\Di\Service\Repository\InMemory;

/**
 * InMemoryRepository Class
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Repository\ServiceRepository;

class Repository implements ServiceRepository
{
    /** @var array $_services */
    private $_services = [];

    /**
     * @param $id
     * @return mixed|null
     */
    public function get($id)
    {
        if (!isset($this->_services[$id])) {
            return null;
        }
        return $this->_services[$id];
    }

    /**
     * @param $id
     * @param $service
     */
    public function add($id, $service)
    {
        $this->_services[$id] = $service;
    }
}