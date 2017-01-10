Pixodrom
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/Pixodrom-ru.md)
+ Anchor
  + [Link](#Link)
  + [The description of the service](#The-description-of-the-service)
  + [Prices](#Prices)
  + [Description recognition](#Description-recognition)
  + [Installation](#Installation)
  + [Examples](#Examples)
  + [A description of the fields](#A-description-of-the-fields)


###Link
[The link to the service Pixodrom](http://pixodrom.com/)

###The description of the service
 ... 

###Prices
 ... 

###Description recognition
Расшифровка капч с картики. Необходимо указать файл с картинкой или ссылку на него.

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
use jumper423\decaptcha\services\Pixodrom;

$captcha = new Pixodrom([
    Pixodrom::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
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
####Not correctly recognized
If You can understand that the answer which did not come true. Be sure to add below written code. It will save You money.
```
$captcha->notTrue();
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
 Picture | ACTION_FIELD_FILE | MIX | + |  |  | The path to the picture file or link to it |
 A few words | ACTION_FIELD_PHRASE | INTEGER | - | 0 | 0 - одно слово; 1 - каптча имеет два слова | The worker must enter text with one or more spaces |
 Register | ACTION_FIELD_REGSENSE | INTEGER | - | 0 | 0 - регистр ответа не имеет значения; 1 - регистр ответа имеет значение | The worker must enter the answer case sensitive |
 Characters | ACTION_FIELD_NUMERIC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - капча состоит только из цифр; 2 - в капче нет цифр | What are the symbols used in captcha |
 Length min | ACTION_FIELD_MIN_LEN | INTEGER | - | 0 |  | The minimum length of captcha |
 Length max | ACTION_FIELD_MAX_LEN | INTEGER | - | 0 |  | The maximum length of the captcha |
 Calculation | ACTION_FIELD_CALC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работнику нужно совершить математическое действие с капчи | The captcha shows matematicheskaya expression and must be addressed |
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Need for cross-domain AJAX requests in browser-based applications. |
 Cyrillic | ACTION_FIELD_IS_RUSSIAN | INTEGER | - | 0 | 0 - параметр не задействован; 1 - на изображении присутствуют русские символы | In the image there are Russian characters |
 From where | ACTION_FIELD_LABEL | STRING | - |  |  | Clarification from where came the captcha ("vk", "google", "recaptcha", "yandex", "Google", "yahoo", etc.). |

