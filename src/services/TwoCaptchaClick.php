<?php

namespace jumper423\decaptcha\services;

/**
 * Class TwoCaptchaClick.
 */
class TwoCaptchaClick extends RuCaptchaClick
{
    protected $host = '2captcha.com';

    public function init()
    {
        parent::init();

        $this->wiki->setText(['service', 'name'], '2Captcha ClickCaptcha');
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/2captcha');
        $this->wiki->setText(['menu', 'from_service'], [
            TwoCaptcha::class,
            TwoCaptchaInstruction::class,
            TwoCaptchaGrid::class,
            TwoCaptchaReCaptcha::class,
            TwoCaptchaKeyCaptcha::class,
            TwoCaptchaFunCaptcha::class,
            TwoCaptchaReCaptchaV3::class,
            TwoCaptchaGeeTest::class,
        ]);
    }
}
