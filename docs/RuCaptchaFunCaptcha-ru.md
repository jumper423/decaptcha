RuCaptcha FunCaptcha
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/RuCaptchaFunCaptcha-en.md)
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


Ссылка
--------------
[Ссылка на сервис RuCaptcha FunCaptcha](http://infoblog1.ru/goto/rucaptcha)

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
1) Вам нужно найти публичный ключ FunCaptcha. Есть два способа это сделать: вы можете найти div с FunCaptcha и посмотреть на значение параметра data-pkey или же найти элемент с именем (name) fc-token, а из его значения вырезать ключ, который указан после pk.

2) Узакать эти параметры в методе recognize

3) Найдите элемент с id fc-token и измените его значение (value) на полученый CODE.

Важно: если вы используете параметр nojs=1, то API вернёт лишь часть токена в таком виде: 3084f4a302b176cd7.96368058|r=ap-southeast-1 и вам нужно собрать весь токен целиком самостоятельно, используя оригинальное значение fc-token.

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
use jumper423\decaptcha\services\RuCaptchaFunCaptcha;

$captcha = new RuCaptchaFunCaptcha([
    RuCaptchaFunCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize([
       RuCaptchaFunCaptcha::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/funcaptcha/',
       RuCaptchaFunCaptcha::ACTION_FIELD_PUBLICKEY => '12AB34CD-56F7-AB8C-9D01-2EF3456789A0',
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
       RuCaptchaFunCaptcha::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/funcaptcha/',
       RuCaptchaFunCaptcha::ACTION_FIELD_PUBLICKEY => '12AB34CD-56F7-AB8C-9D01-2EF3456789A0',
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
 Параметра data-pkey | ACTION_FIELD_PUBLICKEY | STRING | + |  |  | Найти div с FunCaptcha и посмотреть на значение параметра data-pkey или же найти элемент с именем (name) fc-token, а из его значения вырезать ключ, который указан после pk |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |
 Истользовать JS | ACTION_FIELD_NOJS | INTEGER | - | 0 |  | Говорит нам решать FunCaptcha с выключенным javascript. Может быть использован в случае, если нормальный метод по какой-то причине не срабатывает. Важно: имейте в виду, что в этом случае мы вернём только часть токена. Выше описано, что делать в этом случае. |
 User-Agent браузера | ACTION_FIELD_USERAGENT | STRING | - |  |  | User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер. |

