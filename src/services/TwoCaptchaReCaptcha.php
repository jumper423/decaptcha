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
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
    }
}
