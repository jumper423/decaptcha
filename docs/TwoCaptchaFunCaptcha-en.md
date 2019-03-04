2Captcha FunCaptcha
==============
Menu
--------------
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/TwoCaptchaFunCaptcha-ru.md)
+ Anchor
  + [Link](#link)
  + [The description of the service](#the-description-of-the-service)
  + [Prices](#prices)
  + [Description recognition](#description-recognition)
  + [Installation](#installation)
  + [Examples](#examples)
  + [A description of the fields](#a-description-of-the-fields)
+ Other functionality from the service
  + [2Captcha](../docs/TwoCaptcha-en.md)
  + [2Captcha Manual](../docs/TwoCaptchaInstruction-en.md)
  + [2Captcha ClickCaptcha](../docs/TwoCaptchaClick-en.md)
  + [2Captcha Grid (ReCaptcha v2)](../docs/TwoCaptchaGrid-en.md)
  + [2Captcha ReCaptcha v2 without a browser](../docs/TwoCaptchaReCaptcha-en.md)
  + [2Captcha FunCaptcha](../docs/TwoCaptchaFunCaptcha-en.md)
  + [2Captcha ReCaptcha v3](../docs/TwoCaptchaReCaptchaV3-en.md)
  + [2Captcha GeeTest](../docs/TwoCaptchaGeeTest-en.md)


Link
--------------
[The link to the service 2Captcha FunCaptcha](http://infoblog1.ru/goto/2captcha)

The description of the service
--------------
RuCaptcha.com - antikapchu service manual image recognition, there are those who need real-time to recognize text from scanned documents, forms, and captures those who want to earn on entering text from the screen.

The system works the Russian-speaking and English-speaking staff.

Tuning anticaptcha RuCaptcha.com not only supports API standard on par with pixodrom services, antigate, anti-captcha and others, but also provides advanced functional replenishing at each round of combat automation. API RuCaptcha supports the decision ReCaptcha v2 (where you need to click on the pictures), ClickCaptcha (where you need to click on certain points) and Rotatecaptcha (FunCaptcha other CAPTCHA, you need to twist).

Prices
--------------
1000 for $0,7

Description recognition
--------------
1) You need to find the public key FunCaptcha. There are two ways to do this: you can find a div with FunCaptcha and look at the value of the data-pkey parameter, or find an element with the name (name) fc-token, and from its value cut the key that is specified after pk.

2) See these parameters in the method recognize

3) Find the element with the id fc-token and change its value to the resulting CODE.

Important: if you use the nojs = 1 parameter, the API will return only a part of the token in this form: 3084f4a302b176cd7.96368058 | r = ap-southeast-1 and you need to collect the entire token entirely by yourself, using the original fc-token value.

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
use jumper423\decaptcha\services\TwoCaptchaFunCaptcha;

$captcha = new TwoCaptchaFunCaptcha([
    TwoCaptchaFunCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Recognition__
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
       TwoCaptchaFunCaptcha::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/funcaptcha/',
       TwoCaptchaFunCaptcha::ACTION_FIELD_PUBLICKEY => '12AB34CD-56F7-AB8C-9D01-2EF3456789A0',
    ])) {
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
    $captcha->recognize([
       TwoCaptchaFunCaptcha::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/funcaptcha/',
       TwoCaptchaFunCaptcha::ACTION_FIELD_PUBLICKEY => '12AB34CD-56F7-AB8C-9D01-2EF3456789A0',
    ]);
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
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - the default value; 1 - in.php will transfer Access-Control-Allow-Origin: * parameter in response header | Need for cross-domain AJAX requests in browser-based applications. |
 Response to | ACTION_FIELD_PINGBACK | STRING | - |  |  | Note to server, after recognizing the image, you need to send a reply to the specified address. |
 Parameter data-pkey | ACTION_FIELD_PUBLICKEY | STRING | + |  |  | Find a div with FunCaptcha and look at the value of the data-pkey parameter, or find an element with the name (name) fc-token, and cut the key from its value after the pk |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 Истользовать JS | ACTION_FIELD_NOJS | INTEGER | - | 0 | 0 - use javascript; 1 - do not use javascript | Tells us to solve FunCaptcha with javascript turned off. It can be used in case the normal method for some reason does not work. Important: keep in mind that in this case we will return only part of the token. The above is what to do in this case. |
 User-Agent browser | ACTION_FIELD_USERAGENT | STRING | - |  |  | User-Agent browser used in emulation. You must use the signature modern browser, otherwise Google will return an error requiring you to upgrade your browser. |
 The proxy address | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP address of the proxy ipv4/ipv6. |
 The proxy type | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | The proxy type (http, socks4, ...) |

