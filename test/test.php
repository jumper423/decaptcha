<?php

include_once '../src/CaptchaErrors.php';
include_once '../src/CaptchaInterface.php';
include_once '../src/CaptchaAbstract.php';
include_once '../src/CaptchaBase.php';
include_once '../src/Rucaptcha.php';

$captcha = new \jumper423\Rucaptcha();
$captcha->setApiKey('42eab4119020dbc729f657fef');
$result = $captcha->run('http://moneyoninternet.ru/wp-content/uploads/2015/02/images.jpg');
echo $result . PHP_EOL;
echo $captcha->result() . PHP_EOL;