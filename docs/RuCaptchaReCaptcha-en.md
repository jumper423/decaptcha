RuCaptcha ReCaptcha v2 без браузера
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/RuCaptchaReCaptcha-ru.md)
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
  + [RuCaptcha ClickCaptcha](../docs/RuCaptchaClick-en.md)
  + [RuCaptcha Инструкция](../docs/RuCaptchaInstruction-en.md)
  + [RuCaptcha Grid (ReCaptcha v2)](../docs/RuCaptchaGrid-en.md)


###Link
[The link to the service RuCaptcha ReCaptcha v2 без браузера](http://infoblog1.ru/goto/rucaptcha)

###The description of the service
RuCaptcha.com - antikapchu service manual image recognition, there are those who need real-time to recognize text from scanned documents, forms, and captures those who want to earn on entering text from the screen.

The system works the Russian-speaking and English-speaking staff.

Tuning anticaptcha RuCaptcha.com not only supports API standard on par with pixodrom services, antigate, anti-captcha and others, but also provides advanced functional replenishing at each round of combat automation. API RuCaptcha supports the decision ReCaptcha v2 (where you need to click on the pictures), ClickCaptcha (where you need to click on certain points) and Rotatecaptcha (FunCaptcha other CAPTCHA, you need to twist).

###Prices
1000 решений стоят 160 рублей.

###Description recognition
Данный способ позволяет пройти рекапчу без эмуляции браузера и отправки нам картинок, так же этот способ даёт 100%  прохождение капчи.
            
Где какие данные брать и куда вставлять? 
Посмотрите HTML-код страницы, где Вы встретили капчу: 

1. найдите параметр
data-sitekey=
Это ключ сайта, он постоянен и уникален для каждого сайта (если администратор сайта не поменяет его вручную)

2.найдите форму для текста
```<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none; "></textarea>```
Сюда вам нужно будет вставить ответ от нас.

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
use jumper423\decaptcha\services\RuCaptchaReCaptcha;

$captcha = new RuCaptchaReCaptcha([
    RuCaptchaReCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
    RuCaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
    RuCaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
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
    $captcha->recognize([
       RuCaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       RuCaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
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
 Language | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - parameter not used; 1 - the captcha only Cyrillic letters; 2 - displayed in a CAPTCHA latin characters only | The symbols of the language posted on the captcha |
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - the default value; 1 - in.php will transfer Access-Control-Allow-Origin: * parameter in response header | Need for cross-domain AJAX requests in browser-based applications. |
 Manual | ACTION_FIELD_INSTRUCTIONS | STRING | - |  |  | Text captcha or manual to pass the captcha. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Key-the identifier of the recaptcha on the landing page. <div class="g-recaptcha" data-sitekey="THIS"></div> |
 The proxy address | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP address of the proxy ipv4/ipv6. |
 The proxy type | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | The proxy type (http, socks4, ...) |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |

