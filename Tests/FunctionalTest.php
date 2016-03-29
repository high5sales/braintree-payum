<?php
/**
 * Author: Vladyslav Petrovych <vladykx@gmail.com>
 */

namespace High5Sales\Braintree\Tests;


use High5Sales\Braintree\BraintreeGatewayFactory;
use Payum\Core\PayumBuilder;
use Payum\Core\Request\Capture;

class FunctionalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldImplementBasicFunctionality()
    {
        $_SERVER['SERVER_ADDR'] = '127.0.0.1';

        $defaultConfig = [];

        $payum = (new PayumBuilder)
            ->addGatewayFactory('braintree', new BraintreeGatewayFactory($defaultConfig))

            ->addGateway('braintree', [
                'factory' => 'braintree',
                'sandbox' => true,
            ])

            ->addDefaultStorages()

            ->getPayum()
        ;

        $paypal = $payum->getGateway('braintree');

        $model = new \ArrayObject([
            // ...
        ]);

        $paypal->execute(new Capture($model));
    }
}