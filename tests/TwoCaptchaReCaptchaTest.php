<?php

/**
 * Class TwoCaptchaReCaptchaTest.
 */
class TwoCaptchaReCaptchaTest extends PHPUnit_Framework_TestCase
{

    public function testRecaptcha()
    {
        $captcha = new \jumper423\decaptcha\services\RuCaptchaReCaptcha([
            \jumper423\decaptcha\services\RuCaptchaReCaptcha::PARAM_SPEC_API_KEY => '200a1ed2b6ca001d8171c655658086ed',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
//        if ($captcha->recognize([
//            \jumper423\decaptcha\services\RuCaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '6Ld2sf4SAAAAAKSgzs0Q13IZhY02Pyo31S2jgOB5',
//            \jumper423\decaptcha\services\RuCaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'https://patrickhlauke.github.io/recaptcha/',
//        ])) {
//            $this->assertEquals('111', $captcha->getCode());
//        } else {
//            $this->assertEquals('222', $captcha->getError());
//        }
    }
}
