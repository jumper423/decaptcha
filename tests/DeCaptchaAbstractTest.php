<?php

class DeCaptchaAbstractTest extends PHPUnit_Framework_TestCase
{
    public function testGetBaseUrl()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
//        $foo->expects($this->any())
//            ->method("baz")
//            ->will($this->returnValue("You called baz!"));
        $getBaseUrlCaller = function () {
            return $this->getBaseUrl();
        };
        $abstract->domain = 'domain';
        $bound = $getBaseUrlCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/', $bound());
    }

    public function testGetActionUrl()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $getBaseUrlCaller = function () {
            $this->captchaId = 123;
            return $this->getActionUrl('get_code');
        };
        $abstract->domain = 'domain';
        $abstract->setApiKey('123456');
        $bound = $getBaseUrlCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/res.php?key=123456&action=get_code&id=123', $bound());
    }
}