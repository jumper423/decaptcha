AntiCaptcha ReCaptcha v2 without a browser
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/AnticaptchaReCaptchaProxeless-ru.md)
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
  + [AntiCaptcha ReCaptcha v2 without a browser (with a proxy)](../docs/AnticaptchaReCaptcha-en.md)


###Link
[The link to the service AntiCaptcha ReCaptcha v2 without a browser](https://anti-captcha.com/)

###The description of the service
The AntiCaptcha service, formerly known as whiter Antigate. 
            
100% of captchas can be recognized by our employees from around the world. That is why using our service you help thousands of people around the world to provide themselves and their families. 

The money our employees earn are considered a good salary in countries such as India, Pakistan or Vietnam. With your help, they now have the choice between working on the dirty production and computer work.

###Prices
The cost Recaptcha: 2 USD per 1000 solutions.

###Description recognition
You do not need to emulate a browser and run JavaScript.
            
You send us the meaning of "sitekey".

We give you the "g-recaptcha-response" and you just do Submitting the form with this parameter.

The object contains information about the problem to solve Google's reCAPTCHA in the browser on the employee's computer.
This task will be performed by our service using our own proxy servers and / or IP addresses of employees.
The cost of solving this problem is 10% higher than the AnticaptchaReCaptcha, as it falls on us to circumvent the problem of limits on the number of reCAPTCHA solutions with 1 IP address.

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
use jumper423\decaptcha\services\AnticaptchaReCaptchaProxeless;

$captcha = new AnticaptchaReCaptchaProxeless([
    AnticaptchaReCaptchaProxeless::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize([
    AnticaptchaReCaptchaProxeless::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
    AnticaptchaReCaptchaProxeless::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
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
       AnticaptchaReCaptchaProxeless::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       AnticaptchaReCaptchaProxeless::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
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

