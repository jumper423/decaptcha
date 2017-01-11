Captcha24
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/Captcha24-ru.md)
+ Anchor
  + [Link](#link)
  + [The description of the service](#the-description-of-the-service)
  + [Prices](#prices)
  + [Description recognition](#description-recognition)
  + [Installation](#installation)
  + [Examples](#examples)
  + [A description of the fields](#a-description-of-the-fields)


###Link
[The link to the service Captcha24](http://captcha24.com/)

###The description of the service
captcha24.com service manual recognition of graphic images, there are those who need in real time to unravel the image ( scans of documents, captcha, etc.) and those who are willing to do it for the money. 
            
99% of employees captcha24 know Russian language, but because the recognition of documents in the Russian language comes to 95%.

###Prices
 ... 

###Description recognition
Decrypt the captcha with image. You must specify a file with a picture or a link to it.

###Installation
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


###Examples
####Initialization
Specify the key mandatory and optional parameters. Try the best to fill this promotes more rapid recognition of captcha.
```
use jumper423\decaptcha\services\Captcha24;

$captcha = new Captcha24([
    Captcha24::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
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
 A few words | ACTION_FIELD_PHRASE | INTEGER | - | 0 | 0 - one word; 1 - captcha has two words | The worker must enter text with one or more spaces |
 Register | ACTION_FIELD_REGSENSE | INTEGER | - | 0 | 0 - the case of the answer is irrelevant; 1 - the register response value | The worker must enter the answer case sensitive |
 Characters | ACTION_FIELD_NUMERIC | INTEGER | - | 0 | 0 - parameter not used; 1 - captcha consists only of digits | What are the symbols used in captcha |
 Length min | ACTION_FIELD_MIN_LEN | INTEGER | - | 0 |  | The minimum length of captcha |
 Length max | ACTION_FIELD_MAX_LEN | INTEGER | - | 0 |  | The maximum length of the captcha |
 Language | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - parameter not used; 1 - the captcha only Cyrillic letters | The symbols of the language posted on the captcha |
 Calculation | ACTION_FIELD_CALC | INTEGER | - | 0 | 0 - parameter not used; 1 - the worker needs to perform a mathematical operation with captcha | The captcha shows matematicheskaya expression and must be addressed |
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - the default value; 1 - in.php will transfer Access-Control-Allow-Origin: * parameter in response header | Need for cross-domain AJAX requests in browser-based applications. |

