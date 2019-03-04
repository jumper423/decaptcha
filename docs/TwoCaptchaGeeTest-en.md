2Captcha GeeTest
==============
Menu
--------------
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/TwoCaptchaGeeTest-ru.md)
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
  + [2Captcha KeyCaptcha](../docs/TwoCaptchaKeyCaptcha-en.md)
  + [2Captcha FunCaptcha](../docs/TwoCaptchaFunCaptcha-en.md)
  + [2Captcha ReCaptcha v2 without a browser](../docs/TwoCaptchaReCaptcha-en.md)
  + [2Captcha ReCaptcha v3](../docs/TwoCaptchaReCaptchaV3-en.md)


Link
--------------
[The link to the service 2Captcha GeeTest](http://infoblog1.ru/goto/2captcha)

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
1) Find the following parameters on the site page with captcha (they can usually be found inside the initGeetest function):

gt - site public key (static)
challenge - dynamic task key
api_server - API domain (required for some sites)

2) Submit a request

3) Use the values received in the response in the request to the site, passing them in the corresponding request fields:

geetest_challenge
geetest_validate
geetest_seccode

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
use jumper423\decaptcha\services\TwoCaptchaGeeTest;

$captcha = new TwoCaptchaGeeTest([
    TwoCaptchaGeeTest::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Recognition__
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
       TwoCaptchaGeeTest::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/gettest/',
       TwoCaptchaGeeTest::ACTION_FIELD_GT => 'f1ab2cdefa3456789012345b6c78d90e',
       TwoCaptchaGeeTest::ACTION_FIELD_CHALLENGE => '12345678abc90123d45678ef90123a456b',
       TwoCaptchaGeeTest::ACTION_FIELD_API_SERVER => 'api-na.geetest.com',
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
       TwoCaptchaGeeTest::ACTION_FIELD_PAGEURL => 'http://mysite.com/page/with/gettest/',
       TwoCaptchaGeeTest::ACTION_FIELD_GT => 'f1ab2cdefa3456789012345b6c78d90e',
       TwoCaptchaGeeTest::ACTION_FIELD_CHALLENGE => '12345678abc90123d45678ef90123a456b',
       TwoCaptchaGeeTest::ACTION_FIELD_API_SERVER => 'api-na.geetest.com',
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
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 gt parameter | ACTION_FIELD_GT | STRING | + |  |  | The value of the api_server parameter found on the site |
 challenge parameter | ACTION_FIELD_CHALLENGE | STRING | + |  |  | The value of the api_server parameter found on the site |
 api_server parameter | ACTION_FIELD_API_SERVER | STRING | + |  |  | The value of the api_server parameter found on the site |

