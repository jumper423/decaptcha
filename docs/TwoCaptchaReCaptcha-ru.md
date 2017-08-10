2Captcha ReCaptcha v2 без браузера
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/TwoCaptchaReCaptcha-en.md)
+ Якоря
  + [Ссылка](#Ссылка)
  + [Описание сервиса](#Описание-сервиса)
  + [Цены](#Цены)
  + [Описание распознания](#Описание-распознания)
  + [Установка](#Установка)
  + [Примеры](#Примеры)
  + [Описание полей](#Описание-полей)
+ Другой функционал от сервиса
  + [2Captcha](../docs/TwoCaptcha-ru.md)
  + [2Captcha Инструкция](../docs/TwoCaptchaInstruction-ru.md)
  + [2Captcha ClickCaptcha](../docs/TwoCaptchaClick-ru.md)
  + [2Captcha Сетка (ReCaptcha v2)](../docs/TwoCaptchaGrid-ru.md)


Ссылка
--------------
[Ссылка на сервис 2Captcha ReCaptcha v2 без браузера](http://infoblog1.ru/goto/2captcha)

Описание сервиса
--------------
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

Цены
--------------
1000 решений стоят 160 рублей.

Описание распознания
--------------
Данный способ позволяет пройти рекапчу без эмуляции браузера и отправки нам картинок, так же этот способ даёт 100%  прохождение капчи.
            
Где какие данные брать и куда вставлять? 
Посмотрите HTML-код страницы, где Вы встретили капчу: 

1. найдите параметр
data-sitekey=
Это ключ сайта, он постоянен и уникален для каждого сайта (если администратор сайта не поменяет его вручную)

2.найдите форму для текста
```<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none; "></textarea>```
Сюда вам нужно будет вставить ответ от нас.

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
use jumper423\decaptcha\services\TwoCaptchaReCaptcha;

$captcha = new TwoCaptchaReCaptcha([
    TwoCaptchaReCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize([
       TwoCaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       TwoCaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
    ])) {
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
    $captcha->recognize([
       TwoCaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       TwoCaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
    ]);
    $code = $captcha->getCode();
} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {
    ...
}
```


Описание полей
--------------
 Название | Код | Тип | Обяз. | По ум. | Возможные значения | Описание 
 --- | --- | --- | --- | --- | --- | --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  |  | Ключ от учетной записи |
 Язык | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - параметр не задействован; 1 - на капче только кириллические буквы; 2 - на капче только латинские буквы | Символы какого языка размещенны на капче |
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Инструкция | ACTION_FIELD_INSTRUCTIONS | STRING | - |  |  | Текстовая капча или инструкция для прохождения капчи. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div> |
 Адрес прокси | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP адрес прокси ipv4/ipv6. |
 Тип прокси | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | Тип прокси (http, socks4, ...) |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |

