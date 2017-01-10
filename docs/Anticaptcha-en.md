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
  + [AntiCaptcha ReCaptcha v2 without a browser](../docs/AnticaptchaReCaptchaProxeless-en.md)
  + [AntiCaptcha ReCaptcha v2 without a browser (with a proxy)](../docs/AnticaptchaReCaptcha-en.md)


###Link
[The link to the service Anti Captcha](https://anti-captcha.com/)

###The description of the service
The AntiCaptcha service, formerly known as whiter Antigate. 
            
100% of captchas can be recognized by our employees from around the world. That is why using our service you help thousands of people around the world to provide themselves and their families. 

The money our employees earn are considered a good salary in countries such as India, Pakistan or Vietnam. With your help, they now have the choice between working on the dirty production and computer work.

###Prices
From 0.7 USD per 1000 captchas, depending on your volume

###Description recognition
The solution to the normal captcha text.

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
 Language | ACTION_FIELD_LANGUAGE | STRING | - | en | en - English turn; rn - a group of countries Russia, Ukraine, Belarus, Kazakhstan | Determines the language of the queue to which you want to get captcha. |
 Picture | ACTION_FIELD_FILE | STRING | + |  |  | The path to the picture file or link to it |
 A few words | ACTION_FIELD_PHRASE | BOOLEAN | - |  | false - there are no requirements; true - работник должен ввести текст с одним или несколькими пробелами | The worker must enter text with one or more spaces |
 Register | ACTION_FIELD_REGSENSE | BOOLEAN | - |  | false - there are no requirements; true - the employee will see a special signal that the answer should be entered case sensitive | The worker must enter the answer case sensitive |
 Characters | ACTION_FIELD_NUMERIC | INTEGER | - |  | 0 - there are no requirements; 1 - you can enter only numbers; 2 - you can enter any characters except numbers | What are the symbols used in captcha |
 Calculation | ACTION_FIELD_CALC | BOOLEAN | - |  | false - there are no requirements; true - the employee will see a special signal on the captcha depicts a mathematical expression and you need to enter the answer | The captcha shows matematicheskaya expression and must be addressed |
 Length min | ACTION_FIELD_MIN_LEN | INTEGER | - |  |  | The minimum length of captcha |
 Length max | ACTION_FIELD_MAX_LEN | INTEGER | - |  |  | The maximum length of the captcha |

