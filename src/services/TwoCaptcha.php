<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptcha.
 */
class TwoCaptcha extends RuCaptcha
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], '2Captcha');
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu','from_service'], [
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaGrid::class,
            TwoCaptchaReCaptcha::class,
        ]);
    }
}
