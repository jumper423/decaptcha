RuCaptcha ReCaptcha v3
==============
Menu
--------------
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/RuCaptchaReCaptchaV3-ru.md)
+ Anchor
  + [Link](#link)
  + [The description of the service](#the-description-of-the-service)
  + [Prices](#prices)
  + [Description recognition](#description-recognition)
  + [Installation](#installation)
  + [Examples](#examples)
  + [A description of the fields](#a-description-of-the-fields)
+ Other functionality from the service
  + [RuCaptcha](../docs/RuCaptcha-en.md)
  + [RuCaptcha ClickCaptcha](../docs/RuCaptchaClick-en.md)
  + [RuCaptcha Manual](../docs/RuCaptchaInstruction-en.md)
  + [RuCaptcha Grid (ReCaptcha v2)](../docs/RuCaptchaGrid-en.md)
  + [RuCaptcha FunCaptcha](../docs/RuCaptchaFunCaptcha-en.md)
  + [RuCaptcha ReCaptcha v2 without a browser](../docs/RuCaptchaReCaptcha-en.md)
  + [RuCaptcha GeeTest](../docs/RuCaptchaGeeTest-en.md)


Link
--------------
[The link to the service RuCaptcha ReCaptcha v3](http://infoblog1.ru/goto/rucaptcha)

The description of the service
--------------
RuCaptcha.com - antikapchu service manual image recognition, there are those who need real-time to recognize text from scanned documents, forms, and captures those who want to earn on entering text from the screen.

The system works the Russian-speaking and English-speaking staff.

Tuning anticaptcha RuCaptcha.com not only supports API standard on par with pixodrom services, antigate, anti-captcha and others, but also provides advanced functional replenishing at each round of combat automation. API RuCaptcha supports the decision ReCaptcha v2 (where you need to click on the pictures), ClickCaptcha (where you need to click on certain points) and Rotatecaptcha (FunCaptcha other CAPTCHA, you need to twist).

Prices
--------------
1000 for $2,99

Description recognition
--------------
1) First of all, you need to make sure that the site really uses ReCaptcha V3.

The main features of V3:
not visible to the user, does not require to click on the pictures;
The script api.js is loaded with the parameter render = sitekey, for example:
https://www.google.com/recaptcha/api.js?render=6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK
in the clients array of the ___grecaptcha_cfg configuration object, the index 100000 is used: ___ grecaptcha_cfg.clients [100000]

2) To solve V3 through our API, it is necessary to find the values ​​of three parameters:

sitekey - it can be found in html in the value of the render parameter when api.js is loaded, in the k parameter in the iframe URI into which ReCaptcha is loaded, either in javscript, in the function grecaptcha.execute or in the ___grecaptcha_cfg configuration object.

action - this value should be searched in the javascript code of the site in the function call grecaptcha.execute. Example: grecaptcha.execute ('6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK', {action: do_something}).
Sometimes it is quite difficult to find it and it is required to turn all js-files uploaded by the site upside down. In addition, you can try to find the value of action in the ___grecaptcha_cfg configuration object, but very often it may not be set there, but only transmitted when calling grecaptcha.execute - therefore the most effective method is to view javascript code.
pageurl - the full URL of the page where you want to solve ReCaptcha V3.

In addition, you need to understand what score you need. From the outside, it’s possible to determine at which score the site decides that you are human and miss your request, only experimentally. The lowest reiging 0.1 is a robot, and the highest 0.9 is a human. But, many sites set threshold values ​​from 0.2 to 0.5, because An ordinary person often gets a rather low rating. Most likely, our API can get score 0.3, higher scores for workers are quite rare.

3) Having all the necessary parameters, you can send a request.

4) After receiving the CODE, you need to correctly use it on the site. The best way to understand how to do this is to look at what requests are sent to the site when you work with it as a regular visitor. Most browsers make this easy to do in the developer console, the tab you need is usually called "Network."

The token is usually sent in the parameters of the POST request, it can be g-recaptcha-response like ReCaptcha V2, g-recaptcha-response-100000 or some other parameter. Therefore, you need to carefully review the request parameters and find out how the token is transmitted, and then form a similar request.

5) After you used the token on the site and it became clear whether it worked or not - you can tell us about it. In case the token was not accepted - we will return the money for the captcha to your balance. And if the token was accepted, we will put the employee who received it as a priority for your requests. In addition, it allows us to save and analyze statistics on this type of captchas for the subsequent optimization of algorithms for its solution.

To report whether the token worked or not - send a request to http://rucaptcha.com/res.php with your API key in the key parameter, captcha id in the id parameter of the same name and specifying the action parameter, depending on the result: reportgood - the token worked or reportbad - the token did not work.

```
$captcha->notTrue();
//or
$captcha->true();
```

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
use jumper423\decaptcha\services\RuCaptchaReCaptchaV3;

$captcha = new RuCaptchaReCaptchaV3([
    RuCaptchaReCaptchaV3::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Recognition__
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
       RuCaptchaReCaptchaV3::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       RuCaptchaReCaptchaV3::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
       RuCaptchaReCaptchaV3::ACTION_FIELD_ACTION => 'verify',
       RuCaptchaReCaptchaV3::ACTION_FIELD_MIN_SCORE => 0.3,
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
       RuCaptchaReCaptchaV3::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       RuCaptchaReCaptchaV3::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
       RuCaptchaReCaptchaV3::ACTION_FIELD_ACTION => 'verify',
       RuCaptchaReCaptchaV3::ACTION_FIELD_MIN_SCORE => 0.3,
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
 Manual | ACTION_FIELD_INSTRUCTIONS | STRING | - |  |  | Text captcha or manual to pass the captcha. |
 Response to | ACTION_FIELD_PINGBACK | STRING | - |  |  | Note to server, after recognizing the image, you need to send a reply to the specified address. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Key-the identifier of the recaptcha on the landing page. <div class="g-recaptcha" data-sitekey="THIS"></div> |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 Action parameter | ACTION_FIELD_ACTION | STRING | + | verify |  | The value of the action parameter that you found in the site code |
 Min rating | ACTION_FIELD_MIN_SCORE | FLOAT | - | 0.4 |  | Required rating value (score). Currently it is difficult to get a token with a score above 0.3 |
 The proxy address | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP address of the proxy ipv4/ipv6. |
 The proxy type | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | The proxy type (http, socks4, ...) |

