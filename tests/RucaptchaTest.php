<?php

/**
 * Class RucaptchaTest.
 */
class RucaptchaTest extends PHPUnit_Framework_TestCase
{
    public function testRecognize()
    {
        $re = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_API_KEY => '200a1ed2b6ca001d8171c655658086ed',
        ]);
        if ($re->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $re->getCode());
        } else {
            $this->assertEquals('22222222222222', $re->getError());
        }
    }
}
