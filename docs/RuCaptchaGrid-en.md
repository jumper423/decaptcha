RuCaptcha Grid (ReCaptcha v2)
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/RuCaptchaGrid-ru.md)
+ Anchor
  + [Link](#Link)
  + [The description of the service](#The-description-of-the-service)
  + [Prices](#Prices)
  + [Description recognition](#Description-recognition)
  + [Installation](#Installation)
  + [Examples](#Examples)
  + [A description of the fields](#A-description-of-the-fields)
+ Other functionality from the service
  + [RuCaptcha](../docs/RuCaptcha-en.md)
  + [RuCaptcha Manual](../docs/RuCaptchaInstruction-en.md)
  + [RuCaptcha ClickCaptcha](../docs/RuCaptchaClick-en.md)
  + [RuCaptcha ReCaptcha v2 без браузера](../docs/RuCaptchaReCaptcha-en.md)


###Link
[The link to the service RuCaptcha Grid (ReCaptcha v2)](http://infoblog1.ru/goto/rucaptcha)

###The description of the service
RuCaptcha.com - antikapchu service manual image recognition, there are those who need real-time to recognize text from scanned documents, forms, and captures those who want to earn on entering text from the screen.

The system works the Russian-speaking and English-speaking staff.

Tuning anticaptcha RuCaptcha.com not only supports API standard on par with pixodrom services, antigate, anti-captcha and others, but also provides advanced functional replenishing at each round of combat automation. API RuCaptcha supports the decision ReCaptcha v2 (where you need to click on the pictures), ClickCaptcha (where you need to click on certain points) and Rotatecaptcha (FunCaptcha other CAPTCHA, you need to twist).

###Prices
It costs $1,2 to recognize 1000 CAPTCHAs this way.

###Description recognition
To solve reCAPTCHA, where you need to choose specific squares. The answer will come number of pictures, which you should click.
            
Note that not only are reCAPTCHA 3 by 3 square but there are also 4 by 4 square. To understand what kind of image you shlёte, we look at the size of the image px. If she 300x300px, then we put on this picture 3x3 grid. If the size of the other - impose a 4x4 grid. Therefore, it is not necessary to glue the picture with something.

Please note that you need to send the picture itself reCAPTCHA, instead of doing it the screenshot.

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
use jumper423\decaptcha\services\RuCaptchaGrid;

$captcha = new RuCaptchaGrid([
    RuCaptchaGrid::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize('http://site.com/captcha.jpg', [
    RuCaptchaGrid::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
])) {
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
    $captcha->recognize('http://site.com/captcha.jpg', [
       RuCaptchaGrid::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
    ]);
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
 Language | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - parameter not used; 1 - the captcha only Cyrillic letters; 2 - displayed in a CAPTCHA latin characters only | The symbols of the language posted on the captcha |
 Question | ACTION_FIELD_QUESTION | INTEGER | - | 0 | 0 - parameter not used; 1 - the employee must write the answer | The image asked, the employee must write the answer |
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - the default value; 1 - in.php will transfer Access-Control-Allow-Origin: * parameter in response header | Need for cross-domain AJAX requests in browser-based applications. |
 Manual | ACTION_FIELD_INSTRUCTIONS | STRING | + |  |  | Text captcha or manual to pass the captcha. |

