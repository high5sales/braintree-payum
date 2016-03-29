<?php
/**
 * Author: Vladyslav Petrovych <vladykx@gmail.com>
 */

namespace High5Sales\Braintree\Tests;

use High5Sales\Braintree\BraintreeGatewayFactory;

class BraintreeGatewayFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldImplementGatewayFactoryInterface()
    {
        $rc = new \ReflectionClass('High5Sales\Braintree\BraintreeGatewayFactory');
        $this->assertTrue($rc->implementsInterface('Payum\Core\GatewayFactoryInterface'));
    }
    
    /**
     * @test
     */
    public function couldBeConstructedWithoutAnyArguments()
    {
        new BraintreeGatewayFactory();
    }

    /**
     * @test
     */
    public function shouldUseCoreGatewayFactoryPassedAsSecondArgument()
    {
        $coreGatewayFactory = $this->getMock('Payum\Core\GatewayFactoryInterface');
        $factory = new BraintreeGatewayFactory(array(), $coreGatewayFactory);
        $this->assertAttributeSame($coreGatewayFactory, 'coreGatewayFactory', $factory);
    }
    /**
     * @test
     */
    public function shouldAllowCreateGateway()
    {
        $factory = new BraintreeGatewayFactory();
        $gateway = $factory->create(array('publishable_key' => 'aPubKey', 'secret_key' => 'aSecretKey'));
        $this->assertInstanceOf('Payum\Core\Gateway', $gateway);
        $this->assertAttributeNotEmpty('apis', $gateway);
        $this->assertAttributeNotEmpty('actions', $gateway);
        $extensions = $this->readAttribute($gateway, 'extensions');
        $this->assertAttributeNotEmpty('extensions', $extensions);
    }


}