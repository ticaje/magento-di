<?php

namespace Ticaje\Di\Service\Repository;

/**
 * Repository Interface
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

interface ServiceRepository
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param $id
     * @param $service
     * @return mixed
     */
    public function add($id, $service);
}