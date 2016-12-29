<?php

include_once __DIR__.'/../src/core/DeCaptchaErrors.php';
include_once __DIR__.'/../src/core/DeCaptchaInterface.php';
include_once __DIR__.'/../src/core/DeCaptchaAbstract.php';
include_once __DIR__.'/../src/core/DeCaptchaBase.php';
include_once __DIR__.'/../src/services/RuCaptcha.php';
include_once __DIR__.'/../src/services/Anticaptcha.php';
include_once __DIR__.'/../src/services/AnticaptchaReCaptchaProxeless.php';
include_once __DIR__.'/../src/services/AnticaptchaReCaptcha.php';
include_once __DIR__.'/../src/core/DeCaptchaWiki.php';

$rr = new \jumper423\decaptcha\services\RuCaptcha([]);
$tt = $rr->getWiki('ru');
echo $tt->view();
