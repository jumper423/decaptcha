RuCaptcha GeeTest
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/RuCaptchaGeeTest-en.md)
+ Якоря
  + [Ссылка](#Ссылка)
  + [Описание сервиса](#Описание-сервиса)
  + [Цены](#Цены)
  + [Описание распознания](#Описание-распознания)
  + [Установка](#Установка)
  + [Примеры](#Примеры)
  + [Описание полей](#Описание-полей)
+ Другой функционал от сервиса
  + [RuCaptcha](../docs/RuCaptcha-ru.md)
  + [RuCaptcha ClickCaptcha](../docs/RuCaptchaClick-ru.md)
  + [RuCaptcha Инструкция](../docs/RuCaptchaInstruction-ru.md)
  + [RuCaptcha Сетка (ReCaptcha v2)](../docs/RuCaptchaGrid-ru.md)
  + [RuCaptcha ReCaptcha v2 без браузера](../docs/RuCaptchaReCaptcha-ru.md)
  + [RuCaptcha FunCaptcha](../docs/RuCaptchaFunCaptcha-ru.md)
  + [RuCaptcha ReCaptcha v3](../docs/RuCaptchaReCaptchaV3-ru.md)
  + [RuCaptcha KeyCaptcha](../docs/RuCaptchaKeyCaptcha-ru.md)


Ссылка
--------------
[Ссылка на сервис RuCaptcha GeeTest](http://infoblog1.ru/goto/rucaptcha)

Описание сервиса
--------------
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

Цены
--------------
1000 решений стоят 39 рублей.

Описание распознания
--------------
1) Найти следующие параметры на странице сайта с капчей (обычно их можно найти внутри функции initGeetest):

gt - публичный ключ сайта (статический)
challenge - динамический ключ задания
api_server - домен API (обязателен для некоторых сайтов)

2) Отправьте запрос 

3) Используйте значения, полученные в ответе в запросе к сайту, передавая их в соотстветствующих полях запроса:

geetest_challenge
geetest_validate
geetest_seccode

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
use jumper423\decaptcha\services\RuCaptchaGeeTest;

$captcha = new RuCaptchaGeeTest([
    RuCaptchaGeeTest::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize([
       RuCaptchaGeeTest::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/gettest/',
       RuCaptchaGeeTest::ACTION_FIELD_GT => 'f1ab2cdefa3456789012345b6c78d90e',
       RuCaptchaGeeTest::ACTION_FIELD_CHALLENGE => '12345678abc90123d45678ef90123a456b',
       RuCaptchaGeeTest::ACTION_FIELD_API_SERVER => 'api-na.geetest.com',
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
       RuCaptchaGeeTest::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/gettest/',
       RuCaptchaGeeTest::ACTION_FIELD_GT => 'f1ab2cdefa3456789012345b6c78d90e',
       RuCaptchaGeeTest::ACTION_FIELD_CHALLENGE => '12345678abc90123d45678ef90123a456b',
       RuCaptchaGeeTest::ACTION_FIELD_API_SERVER => 'api-na.geetest.com',
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
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Ответ на | ACTION_FIELD_PINGBACK | STRING | - |  |  | Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес. |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |
 Параметр gt | ACTION_FIELD_GT | STRING | + |  |  | Значение параметра gt найденное на сайте |
 Параметр challenge | ACTION_FIELD_CHALLENGE | STRING | + |  |  | Значение параметра challenge найденное на сайте |
 Параметр api_server | ACTION_FIELD_API_SERVER | STRING | + |  |  | Значение параметра api_server найденное на сайте |

