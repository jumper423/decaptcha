R.I.P. Captcha 
==============
Menu
--------------
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/Ripcaptcha-ru.md)
+ Anchor
  + [Link](#link)
  + [The description of the service](#the-description-of-the-service)
  + [Prices](#prices)
  + [Description recognition](#description-recognition)
  + [Installation](#installation)
  + [Examples](#examples)
  + [A description of the fields](#a-description-of-the-fields)


Link
--------------
[The link to the service R.I.P. Captcha ](https://ripcaptcha.com/?loc=en)

The description of the service
--------------
We solve captchas.

Prices
--------------
You will have to pay $0.70 for 1000 captchas

Description recognition
--------------
Decrypt the captcha with image. You must specify a file with a picture or a link to it.

Installation
--------------
The preferred way to install this extension via [composer](http://getcomposer.org/download/).

Or you can run
```
composer require --prefer-dist jumper423/decaptcha "*"
```
or add
```
"jumper423/decaptcha": "*"
```
in file `composer.json`.


Examples
--------------
__Initialization__
Specify the key mandatory and optional parameters. Try the best to fill this promotes more rapid recognition of captcha.
```
use jumper423\decaptcha\services\Ripcaptcha;

$captcha = new Ripcaptcha([
    Ripcaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Recognition__
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize('http://site.com/captcha.jpg')) {
    $code = $captcha->getCode();
} else {
    $error = $captcha->getError();
}
```
__Not correctly recognized__
If You can understand that the answer which did not come true. Be sure to add below written code. It will save You money.
```
$captcha->notTrue();
```
__Balance__
```
$balance = $captcha->getBalance();
```
__Intercept errors__
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


A description of the fields
--------------
 Name | Code | Type | Req. | By def. | Possible values | Description 
 --- | --- | --- | --- | --- | --- | --- 
 Key | ACTION_FIELD_KEY | STRING | + |  |  | Key account |
 Picture | ACTION_FIELD_FILE | MIX | + |  |  | The path to the picture file or link to it |
 A few words | ACTION_FIELD_PHRASE | INTEGER | - | 0 | 0 - one word; 1 - captcha has two words | The worker must enter text with one or more spaces |
 Register | ACTION_FIELD_REGSENSE | INTEGER | - | 0 | 0 - the case of the answer is irrelevant; 1 - the register response value | The worker must enter the answer case sensitive |
 Characters | ACTION_FIELD_NUMERIC | INTEGER | - | 0 | 0 - parameter not used; 1 - captcha consists only of digits | What are the symbols used in captcha |
 Length min | ACTION_FIELD_MIN_LEN | INTEGER | - | 0 |  | The minimum length of captcha |
 Length max | ACTION_FIELD_MAX_LEN | INTEGER | - | 0 |  | The maximum length of the captcha |

