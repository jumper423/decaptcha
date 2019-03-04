<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaKeyCaptcha.
 */
class TwoCaptchaKeyCaptcha extends RuCaptchaKeyCaptcha
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha KeyCaptcha',
            'en' => '2Captcha KeyCaptcha',
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu', 'from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaGrid::class,
            TwoCaptchaReCaptcha::class,
        ]);
    }
}
