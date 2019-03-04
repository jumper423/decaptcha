<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaReCaptcha.
 */
class TwoCaptchaReCaptcha extends RuCaptchaReCaptcha
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha ReCaptcha v2 без браузера',
            'en' => '2Captcha ReCaptcha v2 without a browser',
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu', 'from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaGrid::class,
            TwoCaptchaKeyCaptcha::class,
            TwoCaptchaFunCaptcha::class,
            TwoCaptchaReCaptchaV3::class,
            TwoCaptchaGeeTest::class,
        ]);
    }
}
