<?php

namespace Ticaje\Di\Service\Repository;

/**
 * Repository Class
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

class Repository implements ServiceRepository
{
    /** @var array $_objects */
    private $_objects = [];

    /**
     * @param $id
     * @param $object
     */
    public function add($id, $object)
    {
        $this->_objects[$id] = $object;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->_objects[$id];
    }

}