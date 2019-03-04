RuCaptcha KeyCaptcha
==============
Menu
--------------
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/RuCaptchaKeyCaptcha-ru.md)
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
  + [RuCaptcha ReCaptcha v2 without a browser](../docs/RuCaptchaReCaptcha-en.md)
  + [RuCaptcha FunCaptcha](../docs/RuCaptchaFunCaptcha-en.md)
  + [RuCaptcha ReCaptcha v3](../docs/RuCaptchaReCaptchaV3-en.md)


Link
--------------
[The link to the service RuCaptcha KeyCaptcha](http://infoblog1.ru/goto/rucaptcha)

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
KeyCaptcha is a kind of captcha, for the solution of which you need to assemble a small puzzle.

To solve KeyCaptcha using our service, you need:

1) Find the following KeyCaptcha parameters in the page source code:

```
s_s_c_user_id
s_s_c_session_id
s_s_c_web_server_sign
s_s_c_web_server_sign2
```

2) See these parameters in the method recognize

3) Find and delete the following block that connects the javascript file:

```
<script language = "JavaScript" src = "http://backs.keycaptcha.com/swfs/cap.js"> </ script>
```

Find and delete the div element with id = "div_for_keycaptcha":

```
<div id = "div_for_keycaptcha" ...> ... </ div>
```

```
Attention: sometimes the page content is dynamically generated and you may not find the elements you need or they may differ slightly.
In this case, you need to thoroughly understand the code of the page and the scripts used on it.
```

4) Find the element with id = "capcode" and change its value to the response received from our server.

```
<input name = "capcode" id = "capcode" value = "-> CODE <-" type = "hidden">
```

5) Submit the form.

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
use jumper423\decaptcha\services\RuCaptchaKeyCaptcha;

$captcha = new RuCaptchaKeyCaptcha([
    RuCaptchaKeyCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Recognition__
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
       RuCaptchaKeyCaptcha::ACTION_FIELD_PAGEURL => 'https://www.keycaptcha.com/signup/',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_USER_ID => '15',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_SESSION_ID => 'd49b0eb43165997c786bdb62a75aa12c',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN => 'dbf758481b1371aa641364276b5ff0c4-pz-',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => '1117c0251c885edd1ce16dff799e5310',
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
       RuCaptchaKeyCaptcha::ACTION_FIELD_PAGEURL => 'https://www.keycaptcha.com/signup/',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_USER_ID => '15',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_SESSION_ID => 'd49b0eb43165997c786bdb62a75aa12c',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN => 'dbf758481b1371aa641364276b5ff0c4-pz-',
       RuCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => '1117c0251c885edd1ce16dff799e5310',
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
 Parameter s_s_c_user_id | ACTION_FIELD_SSC_USER_ID | STRING | + |  |  | The value of the s_s_c_user_id parameter found on the page |
 Parameter s_s_c_session_id | ACTION_FIELD_SSC_SESSION_ID | STRING | + |  |  | The value of the s_s_c_session_id parameter found on the page |
 Parameter s_s_c_web_server_sign | ACTION_FIELD_SSC_WEB_SERVER_SIGN | STRING | + |  |  | The value of the s_s_c_web_server_sign parameter found on the page |
 Parameter s_s_c_web_server_sign2 | ACTION_FIELD_SSC_WEB_SERVER_SIGN2 | STRING | + |  |  | The value of the s_s_c_web_server_sign2 parameter found on the page |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 The proxy address | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP address of the proxy ipv4/ipv6. |
 The proxy type | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | The proxy type (http, socks4, ...) |

