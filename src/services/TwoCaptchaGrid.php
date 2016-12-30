<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaGrid.
 */
class TwoCaptchaGrid extends RuCaptchaGrid
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha Сетка (ReCaptcha v2)',
            'en' => '2Captcha Grid (ReCaptcha v2)',
        ]);
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu','from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaClick::class,
            TwoCaptchaReCaptcha::class,
        ]);
    }
}
