<?php

/**
 * Class RucaptchaTest.
 */
class RucaptchaTest extends PHPUnit_Framework_TestCase
{
    public function testRecognize()
    {
        $re = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_KEY => 'b7e7f1002f0f917ca5a852e1c0312e8f',
        ]);
        if ($re->recognize(__DIR__.'/data/Captcha.jpg')){
            $this->assertEquals('11111111111111', $re->getCode());
        } else {
            $this->assertEquals('22222222222222', $re->getError());
        }
    }
}
