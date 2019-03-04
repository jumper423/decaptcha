<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaReCaptchaV3
 */
class TwoCaptchaReCaptchaV3 extends RuCaptchaReCaptchaV3
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], [
            'ru' => '2Captcha ReCaptcha v3',
            'en' => '2Captcha ReCaptcha v3',
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
        ]);
    }
}
