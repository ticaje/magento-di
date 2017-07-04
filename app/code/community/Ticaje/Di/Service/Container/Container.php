<?php

namespace Ticaje\Di\Service\Container;

/**
 * Container Class, DI Container
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Factory\ServiceFactory;
use Ticaje\Di\Service\Repository\InMemory;
use Ticaje\Di\Service\Repository\ServiceRepository;
use Ticaje\Di\Service\Exception;

class Container
{

    /** @var  object $_instance */
    private static $_instance;
    /** @var ServiceRepository $_repository */
    private $_repository;
    /** @var ServiceFactory $_factory */
    private $_factory;
    /** @var array $_services_creating */
    private $_services_creating = [];

    /**
     * Container constructor.
     * @param ServiceFactory $factory
     * @param ServiceRepository|null $repository
     */
    public function __construct(ServiceFactory $factory, ServiceRepository $repository = null)
    {
        // If no other repository is provided use the in-memory one
        $this->_repository = $repository ?: new InMemory\Repository();
        $this->_factory    = $factory;
    }

    /**
     * Gets the instance via lazy initialization (created on first usage)
     * @param $id
     * @throws Exception\RedundantDependencyException
     * @return a registered service
     */
    public function get($id)
    {
        /** @var Object $_service */
        $_service = $this->_repository->get($id);

        if (is_null($_service)) {
            if (isset($this->_services_creating[$id])) {
                $_message = 'Redundant dependency detected: ' . implode(' => ', array_keys($this->_services_creating)) . " => {$id}";
                throw new Exception\RedundantDependencyException($_message);
            }
            // Remember ids called
            $this->_services_creating[$id] = true;
            // Pass the container to force only one instantiation per class
            $_service = $this->_factory->create($id, $this);

            unset($this->_services_creating[$id]);

            $this->_repository->add($id, $_service);
        }

        return $_service;
    }

    public static function getInstance(ServiceFactory $factory)
    {
        if (  !self::$_instance instanceof self)
        {
            self::$_instance = new self($factory);
        }
        return self::$_instance;
    }
}