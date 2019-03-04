2Captcha ClickCaptcha
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/TwoCaptchaClick-en.md)
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
  + [2Captcha Сетка (ReCaptcha v2)](../docs/TwoCaptchaGrid-ru.md)
  + [2Captcha ReCaptcha v2 без браузера](../docs/TwoCaptchaReCaptcha-ru.md)
  + [2Captcha KeyCaptcha](../docs/TwoCaptchaKeyCaptcha-ru.md)
  + [2Captcha FunCaptcha](../docs/TwoCaptchaFunCaptcha-ru.md)
  + [2Captcha ReCaptcha v3](../docs/TwoCaptchaReCaptchaV3-ru.md)
  + [2Captcha GeeTest](../docs/TwoCaptchaGeeTest-ru.md)


Ссылка
--------------
[Ссылка на сервис 2Captcha ClickCaptcha](http://infoblog1.ru/goto/2captcha)

Описание сервиса
--------------
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

Цены
--------------
Стоимость 1000 распознаний данной капчи - 70 рублей.

Описание распознания
--------------
Распознание любой ClickCaptcha (в том числе и ReCaptcha 2.0). В ответ приходит массив координат, от верхнего левого угла.

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
use jumper423\decaptcha\services\TwoCaptchaClick;

$captcha = new TwoCaptchaClick([
    TwoCaptchaClick::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize('http://site.com/captcha.jpg', [
       TwoCaptchaClick::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
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
    $captcha->recognize('http://site.com/captcha.jpg', [
       TwoCaptchaClick::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
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
 Картинка | ACTION_FIELD_FILE | MIX | + |  |  | Путь на файл с картинкой или ссылка на него |
 Вопрос | ACTION_FIELD_QUESTION | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работник должен написать ответ | На изображении задан вопрос, работник должен написать ответ |
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Инструкция | ACTION_FIELD_INSTRUCTIONS | STRING | + |  |  | Текстовая капча или инструкция для прохождения капчи. |

