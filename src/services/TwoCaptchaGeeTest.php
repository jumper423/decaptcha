<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaGeeTest.
 */
class TwoCaptchaGeeTest extends RuCaptchaGeeTest
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha GeeTest',
            'en' => '2Captcha GeeTest',
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu', 'from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaGrid::class,
            TwoCaptchaKeyCaptcha::class,
            TwoCaptchaFunCaptcha::class,
            TwoCaptchaReCaptcha::class,
            TwoCaptchaReCaptchaV3::class,
        ]);
    }
}
