<?php

/**
 * Class RucaptchaTest.
 */
class RucaptchaTest extends PHPUnit_Framework_TestCase
{
    public function testRecognize()
    {
        $re = new \jumper423\decaptcha\services\RuCaptcha([
            \jumper423\decaptcha\services\RuCaptcha::PARAM_SPEC_API_KEY => '42eab4119020dbc729f657fef270f521',
        ]);
        if ($re->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $re->getCode());
        } else {
            $this->assertEquals('22222222222222', $re->getError());
        }
    }
}
