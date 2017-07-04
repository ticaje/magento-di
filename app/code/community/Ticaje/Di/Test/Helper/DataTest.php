<?php

/**
 * Test Class
 * @category    Ticaje
 * @package     Ticaje_Di
 * @author      Hector Luis Barrientos <ticaje@filetea.me>
 */

use Ticaje\Di\Service\Container\ContainerBuilder as CB;

class Ticaje_Di_Test_Helper_DataTest extends PHPUnit_Framework_TestCase
{

    private $container;

    protected function setUp()
    {
        $this->container = CB::buildContainer('import');
    }

    public function testCorrectInstantiation()
    {
        $this->assertInstanceOf('Classes\Dummy', $this->container->get('class-dummy'));
    }

    public function testCorrectInstantiationWithArgs()
    {
        $this->assertInstanceOf('Classes\Fancy', $this->container->get('class-fancy'));
    }

    /**
     * @expectedException Ticaje\Di\Service\Exception\RedundantDependencyException
     */
    public function testDetectCircularDependencies()
    {
        $this->container->get('class-any');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNotExistingService()
    {
        $this->container->get('class-x');
    }

}