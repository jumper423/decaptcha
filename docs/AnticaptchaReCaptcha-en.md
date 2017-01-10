ReCaptcha AntiCaptcha v2 without a browser (with a proxy)
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/AnticaptchaReCaptcha-ru.md)
+ Anchor
  + [Link](#Link)
  + [The description of the service](#The-description-of-the-service)
  + [Prices](#Prices)
  + [Description recognition](#Description-recognition)
  + [Installation](#Installation)
  + [Examples](#Examples)
  + [A description of the fields](#A-description-of-the-fields)
+ Other functionality from the service
  + [Anti Captcha](../docs/Anticaptcha-en.md)
  + [AntiCaptcha ReCaptcha v2 без браузера](../docs/AnticaptchaReCaptchaProxeless-en.md)


###Link
[The link to the service ReCaptcha AntiCaptcha v2 without a browser (with a proxy)](https://anti-captcha.com/)

###The description of the service
The AntiCaptcha service, formerly known as whiter Antigate. 
            
100% of captchas can be recognized by our employees from around the world. That is why using our service you help thousands of people around the world to provide themselves and their families. 

The money our employees earn are considered a good salary in countries such as India, Pakistan or Vietnam. With your help, they now have the choice between working on the dirty production and computer work.

###Prices
Стоимость Рекапчи: от 2 USD за 1000 решений.

###Description recognition
You don't need to emulate a browser and run the Java-scripts. 
            
You send us the value "sitekey". We give you "g-recaptcha-response" and you just make a submit form with this option. 

The object contains information about a task on the solution of the recaptcha of Google in the browser on the computer of the employee. To ensure the universality of solutions of this type of captcha, we need to use all the data you use automation to fill out a form on the trust website, including a proxy, the user-agent of browser and cookies. This will avoid any problems if you change the Google code to your captcha. 

Our system solutions are designed in such a way that the browser of the employee does not receive information about your proxy servers, cookies, and other data. All this data is stored on our server and are erased after the job. Machine employee does not have access to this data and communicates only with our servers. 

Before performing the task, the system checks the performance of your proxy server, and only then passes the task to the worker. Proxies must be sure to handle the probe request within 5 seconds, otherwise the problem of litter bug ERROR_PROXY_TIMEOUT and will be canceled.

Captcha can be solved for a long time compared with the usual CAPTCHA, but this is offset by the fact that the resulting g-captcha-response effect another 120 seconds after an employee has decided captcha.

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
use jumper423\decaptcha\services\AnticaptchaReCaptcha;

$captcha = new AnticaptchaReCaptcha([
    AnticaptchaReCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
    AnticaptchaReCaptcha::ACTION_FIELD_PROXYTYPE => 'http',
    AnticaptchaReCaptcha::ACTION_FIELD_RECAPTCHA => '88.45.12.43',
    AnticaptchaReCaptcha::ACTION_FIELD_PROXYPORT => '8080',
    AnticaptchaReCaptcha::ACTION_FIELD_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
    AnticaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
    AnticaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
])) {
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
    $captcha->recognize([
       AnticaptchaReCaptcha::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       AnticaptchaReCaptcha::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
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
 Language | ACTION_FIELD_LANGUAGE | STRING | - | en | en - English turn; rn - a group of countries Russia, Ukraine, Belarus, Kazakhstan | Determines the language of the queue to which you want to get captcha. |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Key-the identifier of the recaptcha on the landing page. <div class="g-recaptcha" data-sitekey="THIS"></div> |
 Google token | ACTION_FIELD_GOOGLETOKEN | STRING | - |  |  | The secret token for the previous version of recaptcha. In most cases, sites use the new version and this token is not required. The secret token is generated on a Google server and inserted into the page in the attribute data-stoken. It looks like this: <script type="text/javascript" src="...." data-type="normal" data-ray="..." async data-sitekey="..." data-stoken="THIS"></script> the Token is valid a few minutes after generation, then you need to go back to the page and get it. |
 The proxy type | ACTION_FIELD_PROXYTYPE | STRING | + |  |  | The proxy type (http, socks4, ...) |
 The proxy address | ACTION_FIELD_RECAPTCHA | STRING | + |  |  | IP address of the proxy ipv4/ipv6. |
 Proxy port | ACTION_FIELD_PROXYPORT | INTEGER | + |  |  | Proxy port. |
 Login proxy | ACTION_FIELD_PROXYLOGIN | STRING | - |  |  | Login from proxy server. |
 Password proxy | ACTION_FIELD_PROXYPASS | STRING | - |  |  | The password for the proxy server. |
 User-Agent browser | ACTION_FIELD_USERAGENT | STRING | + |  |  | User-Agent browser used in emulation. You must use the signature modern browser, otherwise Google will return an error requiring you to upgrade your browser. |
 Cookies | ACTION_FIELD_COOKIES | STRING | - |  |  | Additional cookies which we should use during the interaction with the target page. |

