<?php

/**
 * Class TwoCaptchaTest.
 */
class TwoCaptchaTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Нулевой либо отрицательный баланс
     * @expectedExceptionCode 3
     */
    public function testRecognizeBalanceError1()
    {
        $captcha = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_API_KEY => '200a1ed2b6ca001d8171c655658086ed',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
        $captcha->setCauseAnError(true);
        $captcha->recognize(__DIR__.'/data/Captcha.jpg');
    }

    public function testRecognizeBalanceError2()
    {
        $captcha = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_API_KEY => '200a1ed2b6ca001d8171c655658086ed',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
        if ($captcha->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $captcha->getCode());
        } else {
            $this->assertEquals('Нулевой либо отрицательный баланс', $captcha->getError());
        }
    }

    public function testGetBalance()
    {
        $captcha = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_API_KEY => '200a1ed2b6ca001d8171c655658086ed',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
        $this->assertEquals(0, (int)$captcha->getBalance());
    }
}
