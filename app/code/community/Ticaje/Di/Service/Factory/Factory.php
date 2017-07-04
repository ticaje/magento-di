<?php

namespace Ticaje\Di\Service\Factory;

/**
 * Factory Class
 * @category    Ticaje
 * @package     Ticaje_Di_Service
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Container;

class Factory implements ServiceFactory
{
    /**
     * @var array
     */
    private $_service_list;

    /**
     * @var Json Object
     */
    private $_json_object;

    /**
     * @var config json file with the services
     */
    private $_json_config_file;

    /**
     * @param string $configFile
     */
    public function __construct($configFile)
    {
        $this->_json_config_file = $configFile;
        $this->loadServiceList();
    }

    private function loadJsonFile()
    {
        $_string = file_get_contents($this->_json_config_file);
        $this->_json_object = json_decode($_string);
    }

    /**
     * @param \stdClass $serviceData
     * @param Container\Container $container
     * @return array
     */
    private function getArgs(\stdClass $serviceData, Container\Container $container)
    {
        /** @var array $_args */
        $_args = [];
        if (isset($serviceData->arguments)) {
            foreach ($serviceData->arguments as $arg) {
                // Recurse back to the container to find dependencies
                $_args[] = $container->get($arg->id);
            }
        }
        return $_args;
    }

    /**
     * Use reflection to instantiate new objects
     * @param $id
     * @param Container\Container $container
     * @return mixed - any object
     */
    private function instantiateService($id, Container\Container $container)
    {
        /** @var object $_service_data */
        $_service_data = $this->_service_list[$id];
        /** @var \ReflectionClass $_reflector */
        $_reflector = new \ReflectionClass($_service_data->class);
        return $_reflector->newInstanceArgs($this->getArgs($_service_data, $container));
    }

    private function loadServiceList()
    {
        $this->loadJsonFile();
        foreach ($this->_json_object->services as $service) {
            $this->_service_list[$service->id] = $service;
        }
    }

    /**
     * @param string $id - a known id key
     * @param Container\Container $container
     * @return mixed - a registered service
     * @throws \InvalidArgumentException
     */
    public function create($id, Container\Container $container)
    {
        if (!isset($this->_service_list[$id])) {
            throw new \InvalidArgumentException("'$id' is not a registered service");
        }
        return $this->instantiateService($id, $container);
    }
}