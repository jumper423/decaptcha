AntiCaptcha ReCaptcha v2 без браузера
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
  + [AntiCaptcha ReCaptcha v2 без браузера (с прокси)](../docs/AnticaptchaReCaptcha-en.md)


###Link
[The link to the service AntiCaptcha ReCaptcha v2 без браузера](https://anti-captcha.com/)

###The description of the service
Сервис AntiCaptcha, ранее белее известный как Antigate.

100% капч распознаются нашими работниками со всего мира. Именно поэтому используя наш сервис вы одновременно помогаете тысячам людей по всему миру обеспечивать себя и своих близких.

Деньги, которые наши работники зарабатывают у нас считаются хорошей зарплатой в таких странах как Индия, Пакистан или Вьетнам. С вашей помощью теперь у них есть выбор между работой на грязном производстве и работой за компьютером.

###Prices
Стоимость Рекапчи: от 2 USD за 1000 решений.

###Description recognition
Вам не нужно эмулировать браузер и запускать яваскрипты.
            
Вы присылаете нам значение "sitekey".

Мы передаем вам "g-recaptcha-response" и вы просто делаете сабмит формы с этим параметром.

Объект содержит данные о задаче на решение рекапчи гугла в браузере на компьютере работника. 
Такая задача будет выполняться нашим сервисом с использованием наших собственных прокси-серверов и/или с IP адресов работников. 
Стоимость решения такой задачи на 10% выше, чем у AnticaptchaReCaptcha, так как на нас ложится проблема обхода лимитов на количество решений рекапч с 1 IP адреса.

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
 Language | ACTION_FIELD_LANGUAGE | STRING | - | en | en - англоязычная очередь; rn - группа стран Россия, Украина, Беларусь, Казахстан | Определяет язык очереди, в которую должна попасть капча. |
 Link | ACTION_FIELD_PAGEURL | STRING | + |  |  | The address of the page where the captcha is solved. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Key-the identifier of the recaptcha on the landing page. <div class="g-recaptcha" data-sitekey="THIS"></div> |
 Google token | ACTION_FIELD_GOOGLETOKEN | STRING | - |  |  | The secret token for the previous version of recaptcha. In most cases, sites use the new version and this token is not required. The secret token is generated on a Google server and inserted into the page in the attribute data-stoken. It looks like this: <script type="text/javascript" src="...." data-type="normal" data-ray="..." async data-sitekey="..." data-stoken="THIS"></script> the Token is valid a few minutes after generation, then you need to go back to the page and get it. |

