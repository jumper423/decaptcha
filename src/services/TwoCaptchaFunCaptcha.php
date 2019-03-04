<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaFunCaptcha.
 */
class TwoCaptchaFunCaptcha extends RuCaptchaFunCaptcha
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha FunCaptcha',
            'en' => '2Captcha FunCaptcha',
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu', 'from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaGrid::class,
            TwoCaptchaReCaptcha::class,
            TwoCaptchaFunCaptcha::class,
            TwoCaptchaReCaptchaV3::class,
            TwoCaptchaGeeTest::class,
        ]);
    }
}
