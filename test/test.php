<?php

include_once '../src/DeCaptchaErrors.php';
include_once '../src/DeCaptchaInterface.php';
include_once '../src/DeCaptchaAbstract.php';
include_once '../src/DeCaptchaBase.php';
include_once '../src/Rucaptcha.php';

$captcha = new \jumper423\Rucaptcha();
$captcha->setApiKey('42eab4119020dbc729f657fef');
$result = $captcha->run('http://moneyoninternet.ru/wp-content/uploads/2015/02/images.jpg');
echo $result . PHP_EOL;
echo $captcha->result() . PHP_EOL;