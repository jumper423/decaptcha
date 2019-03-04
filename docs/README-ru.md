DeCaptcha
================
[![Latest Stable Version](https://poser.pugx.org/jumper423/decaptcha/v/stable)](https://packagist.org/packages/jumper423/decaptcha)
[![Total Downloads](https://poser.pugx.org/jumper423/decaptcha/downloads)](https://packagist.org/packages/jumper423/decaptcha)
[![License](https://poser.pugx.org/jumper423/decaptcha/license)](https://packagist.org/packages/jumper423/decaptcha)

[![Build Status](https://travis-ci.org/jumper423/decaptcha.svg?branch=master)](https://travis-ci.org/jumper423/decaptcha)
[![Dependency Status](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/build-status/master)
[![Code Climate](https://codeclimate.com/github/jumper423/decaptcha/badges/gpa.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![Issue Count](https://codeclimate.com/github/jumper423/decaptcha/badges/issue_count.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![codecov](https://codecov.io/gh/jumper423/decaptcha/branch/master/graph/badge.svg)](https://codecov.io/gh/jumper423/decaptcha)
[![HHVM Status](http://hhvm.h4cc.de/badge/jumper423/decaptcha.svg)](http://hhvm.h4cc.de/package/jumper423/decaptcha)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5/mini.png)](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5)
[![StyleCI](https://styleci.io/repos/75013766/shield?branch=master)](https://styleci.io/repos/75013766)

Меню
--------------
+ [Documentation in English language](../docs/README-en.md)
+ [Описание](#Описание)
+ [Особенности](#Особенности)
+ [Сервисы](#Сервисы)
+ [Установка](#Установка)
+ [Примеры](#Примеры)


Описание
--------------
Пакет создан для стандартизации всех сервисов по разгадыванию капч. 
            У каждого сервиса есть свои особенности и теперь Вам надо будет всего лишь взглянуть на документацию конкретного сервиса чтобы правильно всё сделать.
            Так же пакет покрывает всю функциональсть сервисов. Если же Вам будет чего-то нехватать или будут предложения, я буду только рад их услышать.

Особенности
--------------
+ Подходит для всех сервисов по распознаванию капч
+ Можно легко добавить новый сервис, используя уже готовый движок
+ Быстрая и интуительно понятная настройка
+ Распознавание как по пути до файла, так и по ссылки
+ ReCaptcha v2 без браузера
+ Полная документация
+ Покрыт тестами

Сервисы
--------------
Распознавание капч для всех популярных сервисов

+ [RuCaptcha](../docs/RuCaptcha-ru.md)
+ [RuCaptcha ReCaptcha v2 без браузера](../docs/RuCaptchaReCaptcha-ru.md)
+ [RuCaptcha Инструкция](../docs/RuCaptchaInstruction-ru.md)
+ [RuCaptcha Сетка (ReCaptcha v2)](../docs/RuCaptchaGrid-ru.md)
+ [RuCaptcha ClickCaptcha](../docs/RuCaptchaClick-ru.md)
+ [RuCaptcha KeyCaptcha](../docs/RuCaptchaKeyCaptcha-ru.md)
+ [RuCaptcha FunCaptcha](../docs/RuCaptchaFunCaptcha-ru.md)
+ [2Captcha](../docs/TwoCaptcha-ru.md)
+ [2Captcha ReCaptcha v2 без браузера](../docs/TwoCaptchaReCaptcha-ru.md)
+ [2Captcha Инструкция](../docs/TwoCaptchaInstruction-ru.md)
+ [2Captcha Сетка (ReCaptcha v2)](../docs/TwoCaptchaGrid-ru.md)
+ [2Captcha ClickCaptcha](../docs/TwoCaptchaClick-ru.md)
+ [2Captcha KeyCaptcha](../docs/TwoCaptchaKeyCaptcha-ru.md)
+ [2Captcha FunCaptcha](../docs/TwoCaptchaFunCaptcha-ru.md)
+ [Anti Captcha](../docs/Anticaptcha-ru.md)
+ [AntiCaptcha ReCaptcha v2 без браузера (с прокси)](../docs/AnticaptchaReCaptcha-ru.md)
+ [AntiCaptcha ReCaptcha v2 без браузера](../docs/AnticaptchaReCaptchaProxeless-ru.md)
+ [Captcha24](../docs/Captcha24-ru.md)
+ [Pixodrom](../docs/Pixodrom-ru.md)
+ [R.I.P. Captcha ](../docs/Ripcaptcha-ru.md)
+ [SociaLink](../docs/Socialink-ru.md)


Установка
--------------
Предпочтительный способ установить это расширение через [composer](http://getcomposer.org/download/).

Либо запустить
```
composer require --prefer-dist jumper423/decaptcha "*"
```
или добавить
```
"jumper423/decaptcha": "*"
```
в файл `composer.json`.


Примеры
--------------
__Инициализация__
Указываем ключ, обязательные и дополнительные параметры. Старайтесь по максимуму их заполнить это способствует более быстрому распознанию капчи.
```
use jumper423\decaptcha\services\RuCaptcha;

$captcha = new RuCaptcha([
    RuCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize('http://site.com/captcha.jpg')) {
    $code = $captcha->getCode();
} else {
    $error = $captcha->getError();
}
```
__Не верно распознано__
Если Вы сможете понять что ответ которые пришёл не верные. Обязательно добавьте ниже написанный код. Это Вам съекономит деньги.
```
$captcha->notTrue();
```
__Баланс__
```
$balance = $captcha->getBalance();
```
__Язык ошибки__
По умолчанию ошибки на англиском языке, если необходимо переоперелить, сделайте следующее
```
$captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
```
__Перехват ошибки__
При желании Вы можете перехватывать ошибку, но для этого надо вызвать setCauseAnError
```
$captcha->setCauseAnError(true);

try {
    $captcha->recognize('http://site.com/captcha.jpg');
    $code = $captcha->getCode();
} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {
    ...
}
```


