<?php

include_once __DIR__.'/../vendor/autoload.php';

$mainWiki = new \jumper423\decaptcha\core\DeCaptchaWikiMain(new \jumper423\decaptcha\services\RuCaptcha([]));
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
                 new \jumper423\decaptcha\services\Ripcaptcha([]),
             ] as $class) {
        $mainWiki->addClass($class);
        $class->getWiki($lang)->save();
    }
    $mainWiki->setLang($lang);
    $mainWiki->save();
}
