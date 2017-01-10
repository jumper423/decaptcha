Anti Captcha
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/Anticaptcha-ru.md)
+ Anchor
  + [Link](#Link)
  + [The description of the service](#The-description-of-the-service)
  + [Prices](#Prices)
  + [Description recognition](#Description-recognition)
  + [Installation](#Installation)
  + [Examples](#Examples)
  + [A description of the fields](#A-description-of-the-fields)
+ Other functionality from the service
  + [AntiCaptcha ReCaptcha v2 без браузера](../docs/AnticaptchaReCaptchaProxeless-en.md)
  + [AntiCaptcha ReCaptcha v2 без браузера (с прокси)](../docs/AnticaptchaReCaptcha-en.md)


###Link
[The link to the service Anti Captcha](https://anti-captcha.com/)

###The description of the service
Сервис AntiCaptcha, ранее белее известный как Antigate.

100% капч распознаются нашими работниками со всего мира. Именно поэтому используя наш сервис вы одновременно помогаете тысячам людей по всему миру обеспечивать себя и своих близких.

Деньги, которые наши работники зарабатывают у нас считаются хорошей зарплатой в таких странах как Индия, Пакистан или Вьетнам. С вашей помощью теперь у них есть выбор между работой на грязном производстве и работой за компьютером.

###Prices
От 0.7 USD за каждые 1000 капч, в зависимости от ваших объемов

###Description recognition
Решение обычной капчи с текстом.

###Installation
The preferred way to install this extension via [composer](http://getcomposer.org/download/).

Or you can run
```
php composer.phar require --prefer-dist jumper423/decaptcha "*"
```
or add
```
"jumper423/decaptcha": "*"
```
in file `composer.json`.


###Examples
####Initialization
Specify the key mandatory and optional parameters. Try the best to fill this promotes more rapid recognition of captcha.
```
use jumper423\decaptcha\services\Anticaptcha;

$captcha = new Anticaptcha([
    Anticaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize('http://site.com/captcha.jpg')) {
    $code = $captcha->getCode();
} else {
    $error = $captcha->getError();
}
```
####Balance
```
$balance = $captcha->getBalance();
```
####Intercept errors
If you wish, You can catch the error, but you need to call setCauseAnError
```
$captcha->setCauseAnError(true);

try {
    $captcha->recognize('http://site.com/captcha.jpg');
    $code = $captcha->getCode();
} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {
    ...
}
```


###A description of the fields
 Name | Code | Type | Req. | By def. | Possible values | Description 
 --- | --- | --- | --- | --- | --- | --- 
 Key | ACTION_FIELD_KEY | STRING | + |  |  | Key account |
 Language | ACTION_FIELD_LANGUAGE | STRING | - | en | en - англоязычная очередь; rn - группа стран Россия, Украина, Беларусь, Казахстан | Определяет язык очереди, в которую должна попасть капча. |
 Picture | ACTION_FIELD_FILE | STRING | + |  |  | The path to the picture file or link to it |
 A few words | ACTION_FIELD_PHRASE | BOOLEAN | - |  | false - нет требований; true - работник должен ввести текст с одним или несколькими пробелами | The worker must enter text with one or more spaces |
 Register | ACTION_FIELD_REGSENSE | BOOLEAN | - |  | false - нет требований; true - работник увидит специальный сигнал что ответ необходимо вводить с учетом регистра | The worker must enter the answer case sensitive |
 Characters | ACTION_FIELD_NUMERIC | INTEGER | - |  | 0 - нет требований; 1 - можно вводить только цифры; 2 - вводить можно любые символы кроме цифр | What are the symbols used in captcha |
 Calculation | ACTION_FIELD_CALC | BOOLEAN | - |  | false - нет требований; true - работник увидит специальный сигнал что на капче изображено математическое выражение и необходимо ввести на него ответ | The captcha shows matematicheskaya expression and must be addressed |
 Length min | ACTION_FIELD_MIN_LEN | INTEGER | - |  |  | The minimum length of captcha |
 Length max | ACTION_FIELD_MAX_LEN | INTEGER | - |  |  | The maximum length of the captcha |

