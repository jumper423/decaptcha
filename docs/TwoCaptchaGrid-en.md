2Captcha Grid (ReCaptcha v2)
==============
###Menu
+ [Main](../docs/README-en.md)
+ [Документация на русском языке](../docs/TwoCaptchaGrid-ru.md)
+ Anchor
  + [Link](#Link)
  + [The description of the service](#The-description-of-the-service)
  + [Prices](#Prices)
  + [Description recognition](#Description-recognition)
  + [Installation](#Installation)
  + [Examples](#Examples)
  + [A description of the fields](#A-description-of-the-fields)
+ Other functionality from the service
  + [2Captcha](../docs/TwoCaptcha-en.md)
  + [2Captcha Инструкция](../docs/TwoCaptchaInstruction-en.md)
  + [2Captcha ClickCaptcha](../docs/TwoCaptchaClick-en.md)
  + [2Captcha ReCaptcha v2 без браузера](../docs/TwoCaptchaReCaptcha-en.md)


###Link
[The link to the service 2Captcha Grid (ReCaptcha v2)](http://infoblog1.ru/goto/2captcha)

###The description of the service
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

###Prices
Стоимость 1000 распознаний данной капчи - 70 рублей.

###Description recognition
Для решения рекапчи, где нужно выбирать определённые квадраты. В ответ придут номера картинок, на которые надо нажать.
            
Обратите внимание, что рекапчи бывают не только 3 на 3 квадрата, но попадаются и 4 на 4 квадрата. Что бы понять какую именно картинку Вы шлёте, мы смотрим размер в px картинки. Если она 300x300px, то мы накладываем на эту картинку сетку 3х3. Если размер другой - накладываем сетку 4х4. Поэтому не надо склеивать изображение с чем-либо.

Обратите внимание, что необходимо засылать саму картинку рекапчи, а не делать её скриншот.

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
use jumper423\decaptcha\services\TwoCaptchaGrid;

$captcha = new TwoCaptchaGrid([
    TwoCaptchaGrid::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Recognition
In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.
```
if ($captcha->recognize('http://site.com/captcha.jpg', [
    TwoCaptchaGrid::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
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
       TwoCaptchaGrid::ACTION_FIELD_INSTRUCTIONS => 'Where's the cat?',
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
 Language | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - параметр не задействован; 1 - на капче только кириллические буквы; 2 - на капче только латинские буквы | The symbols of the language posted on the captcha |
 Question | ACTION_FIELD_QUESTION | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работник должен написать ответ | The image asked, the employee must write the answer |
 Cross-domain | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Need for cross-domain AJAX requests in browser-based applications. |
 Manual | ACTION_FIELD_INSTRUCTIONS | STRING | + |  |  | Text captcha or manual to pass the captcha. |

