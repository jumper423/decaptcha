Pixodrom
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/Pixodrom-en.md)
+ Якоря
  + [Ссылка](#Ссылка)
  + [Описание сервиса](#Описание-сервиса)
  + [Цены](#Цены)
  + [Описание распознания](#Описание-распознания)
  + [Установка](#Установка)
  + [Примеры](#Примеры)
  + [Описание полей](#Описание-полей)


Ссылка
--------------
[Ссылка на сервис Pixodrom](http://pixodrom.com/)

Описание сервиса
--------------
 ... 

Цены
--------------
 ... 

Описание распознания
--------------
Расшифровка капч с картики. Необходимо указать файл с картинкой или ссылку на него.

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
use jumper423\decaptcha\services\Pixodrom;

$captcha = new Pixodrom([
    Pixodrom::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
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


Описание полей
--------------
 Название | Код | Тип | Обяз. | По ум. | Возможные значения | Описание 
 --- | --- | --- | --- | --- | --- | --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  |  | Ключ от учетной записи |
 Картинка | ACTION_FIELD_FILE | MIX | + |  |  | Путь на файл с картинкой или ссылка на него |
 Несколько слов | ACTION_FIELD_PHRASE | INTEGER | - | 0 | 0 - одно слово; 1 - каптча имеет два слова | Работник должен ввести текст с одним или несколькими пробелами |
 Регистр | ACTION_FIELD_REGSENSE | INTEGER | - | 0 | 0 - регистр ответа не имеет значения; 1 - регистр ответа имеет значение | Работник должен ввести ответ с учетом регистра |
 Символы | ACTION_FIELD_NUMERIC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - капча состоит только из цифр; 2 - в капче нет цифр | Какие символы используется в капче |
 Длина min | ACTION_FIELD_MIN_LEN | INTEGER | - | 0 |  | Минимальная длина капчи |
 Длина max | ACTION_FIELD_MAX_LEN | INTEGER | - | 0 |  | Максимальная длина капчи |
 Вычисление | ACTION_FIELD_CALC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работнику нужно совершить математическое действие с капчи | На капче изображенно математичекая выражение и её необходимо решить |
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Кириллица | ACTION_FIELD_IS_RUSSIAN | INTEGER | - | 0 | 0 - параметр не задействован; 1 - на изображении присутствуют русские символы | На изображении присутствуют русские символы |
 От куда | ACTION_FIELD_LABEL | STRING | - |  |  | Пояснение от куда пришла капча ("vk", "google", "recaptcha", "yandex", "mailru", "yahoo" и т.д.). |

