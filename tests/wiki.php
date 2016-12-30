<?php

include_once __DIR__.'/../src/core/DeCaptchaErrors.php';
include_once __DIR__.'/../src/core/DeCaptchaInterface.php';
include_once __DIR__.'/../src/core/DeCaptchaAbstract.php';
include_once __DIR__.'/../src/core/DeCaptchaBase.php';
include_once __DIR__.'/../src/services/RuCaptcha.php';
include_once __DIR__.'/../src/services/RuCaptchaReCaptcha.php';
include_once __DIR__.'/../src/services/RuCaptchaInstruction.php';
include_once __DIR__.'/../src/services/RuCaptchaGrid.php';
include_once __DIR__.'/../src/services/RuCaptchaClick.php';
include_once __DIR__.'/../src/services/TwoCaptcha.php';
include_once __DIR__.'/../src/services/TwoCaptchaReCaptcha.php';
include_once __DIR__.'/../src/services/TwoCaptchaInstruction.php';
include_once __DIR__.'/../src/services/TwoCaptchaGrid.php';
include_once __DIR__.'/../src/services/TwoCaptchaClick.php';
include_once __DIR__.'/../src/services/Anticaptcha.php';
include_once __DIR__.'/../src/services/AnticaptchaReCaptchaProxeless.php';
include_once __DIR__.'/../src/services/AnticaptchaReCaptcha.php';
include_once __DIR__.'/../src/services/Captcha24.php';
include_once __DIR__.'/../src/services/Pixodrom.php';
include_once __DIR__.'/../src/core/DeCaptchaWiki.php';

foreach (['ru', 'en'] as $lang) {
    foreach ([
                 new \jumper423\decaptcha\services\RuCaptcha([]),
                 new \jumper423\decaptcha\services\RuCaptchaReCaptcha([]),
                 new \jumper423\decaptcha\services\RuCaptchaInstruction([]),
                 new \jumper423\decaptcha\services\RuCaptchaGrid([]),
                 new \jumper423\decaptcha\services\RuCaptchaClick([]),
                 new \jumper423\decaptcha\services\TwoCaptcha([]),
                 new \jumper423\decaptcha\services\TwoCaptchaReCaptcha([]),
                 new \jumper423\decaptcha\services\TwoCaptchaInstruction([]),
                 new \jumper423\decaptcha\services\TwoCaptchaGrid([]),
                 new \jumper423\decaptcha\services\TwoCaptchaClick([]),
                 new \jumper423\decaptcha\services\Anticaptcha([]),
                 new \jumper423\decaptcha\services\AnticaptchaReCaptcha([]),
                 new \jumper423\decaptcha\services\AnticaptchaReCaptchaProxeless([]),
                 new \jumper423\decaptcha\services\Captcha24([]),
                 new \jumper423\decaptcha\services\Pixodrom([]),
             ] as $class) {
        $tt = $class->getWiki($lang);
        $tt->save();
    }
}
