2Captcha ReCaptcha v3
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/TwoCaptchaReCaptchaV3-en.md)
+ Якоря
  + [Ссылка](#Ссылка)
  + [Описание сервиса](#Описание-сервиса)
  + [Цены](#Цены)
  + [Описание распознания](#Описание-распознания)
  + [Установка](#Установка)
  + [Примеры](#Примеры)
  + [Описание полей](#Описание-полей)
+ Другой функционал от сервиса
  + [2Captcha](../docs/TwoCaptcha-ru.md)
  + [2Captcha Инструкция](../docs/TwoCaptchaInstruction-ru.md)
  + [2Captcha ClickCaptcha](../docs/TwoCaptchaClick-ru.md)
  + [2Captcha Сетка (ReCaptcha v2)](../docs/TwoCaptchaGrid-ru.md)
  + [2Captcha KeyCaptcha](../docs/TwoCaptchaKeyCaptcha-ru.md)
  + [2Captcha FunCaptcha](../docs/TwoCaptchaFunCaptcha-ru.md)
  + [2Captcha ReCaptcha v2 без браузера](../docs/TwoCaptchaReCaptcha-ru.md)


Ссылка
--------------
[Ссылка на сервис 2Captcha ReCaptcha v3](http://infoblog1.ru/goto/2captcha)

Описание сервиса
--------------
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

Цены
--------------
1000 решений стоят 160 рублей.

Описание распознания
--------------
1) В первую очередь нужно убедиться, что на сайте действительно используется ReCaptcha V3.

Основные признаки V3:
не видна пользователю, не требует кликать по картинкам;
скрипт api.js загружается с параметром render=sitekey, например:
https://www.google.com/recaptcha/api.js?render=6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK
в массиве clients конфигурационного объекта ___grecaptcha_cfg используется индекс 100000: ___grecaptcha_cfg.clients[100000]

2) Для решения V3 через наш API необходимо найти значения трех параметров:

sitekey - его можно найти в html в значении параметра render при загрузке api.js, в параметре k в URI iframe, в который подгружается ReCaptcha, либо в javscript, в вызове функции grecaptcha.execute или в конфигурационном объекте ___grecaptcha_cfg.

action - это значение нужно искать в javascript коде сайта в вызове функции grecaptcha.execute. Пример: grecaptcha.execute('6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK', {action: do_something}).
Иногда найти его достаточно сложно и требуется перевернуть вверх дном все js-файлы, подгружаемые сайтом. Кроме того, можно попробовать найти значение action в конфигурационном объекте ___grecaptcha_cfg, но очень часто оно может быть не задано там, а передаваться только при вызове grecaptcha.execute - поэтому наиболее эффективный метод - просмотр javascript кода.
pageurl - полный URL страницы, где вы хотите решить ReCaptcha V3.

Кроме того, нужно понять, какое значение score вам требуется. Определить извне, при каком score сайт решит, что вы человек и пропустит ваш запрос, можно только экспериментально. Самый низкий рейгинг 0.1 - робот, а самый высокий 0.9 - человек. Но, многие сайты ставят пороговые значения от 0.2 до 0.5, т.к. обычный человек зачастую получает довольно низкий рейтинг. С наибольшей вероятностью от нашего API можно получить score 0.3, более высокие значения score у работников встречаются довольно редко.

3) Имея все необходимые параметры, можно отправлять запрос.

4) После получения CODE, нужно корректно использовать его на сайте. Лучший метод понять, как это сделать - посмотреть на то, какие запросы отправляются на сайт, когда вы работаете с ним как обычный посетитель. Большинство браузеров позволяют легко это сделать в консоли разработчика, нужная вкладка обычно называется "Network".

Токен обычно отправляется в параметрах POST-запроса, это может быть g-recaptcha-response как у ReCaptcha V2, g-recaptcha-response-100000 или какой-либо другой параметр. Поэтому нужно внимательно просмотреть параметры запроса и найти, как именно передается токен, а затем сформировать аналогичный запрос.

5) После того, как вы использовали токен на сайте и стало понятно, сработал он или нет - вы можете сообщить нам об этом. В случае, если токен не был принят - мы вернем деньги за капчу на ваш баланс. А в случае, если токен был принят - мы поставим работника, который его получил в приоритет для ваших запросов. Кроме того, это позволяет нам копить и анализировать статистику по этому виду капч для последующей оптимизации алгоритмов ее решения.

Чтобы сообщить о том, сработал токен или нет 

```
$captcha->notTrue();
//или
$captcha->true();
```


Установка
--------------
Предпочтительный способ установить это расширение через [composer](http://getcomposer.org/download/).

Либо запустить
```
composer require --prefer-dist jumper423/decaptcha "*"
```
или добавить
```
"jumper423/decaptcha": "*"
```
в файл `composer.json`.


Примеры
--------------
__Инициализация__
Указываем ключ, обязательные и дополнительные параметры. Старайтесь по максимуму их заполнить это способствует более быстрому распознанию капчи.
```
use jumper423\decaptcha\services\TwoCaptchaReCaptchaV3;

$captcha = new TwoCaptchaReCaptchaV3([
    TwoCaptchaReCaptchaV3::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize([
       TwoCaptchaReCaptchaV3::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_ACTION => 'verify',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_MIN_SCORE => 0.3,
    ])) {
    $code = $captcha->getCode();
} else {
    $error = $captcha->getError();
}
```
__Не верно распознано__
Если Вы сможете понять что ответ которые пришёл не верные. Обязательно добавьте ниже написанный код. Это Вам съекономит деньги.
```
$captcha->notTrue();
```
__Баланс__
```
$balance = $captcha->getBalance();
```
__Язык ошибки__
По умолчанию ошибки на англиском языке, если необходимо переоперелить, сделайте следующее
```
$captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
```
__Перехват ошибки__
При желании Вы можете перехватывать ошибку, но для этого надо вызвать setCauseAnError
```
$captcha->setCauseAnError(true);

try {
    $captcha->recognize([
       TwoCaptchaReCaptchaV3::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_PAGEURL => 'http://site.com/recaptcha-ex',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_ACTION => 'verify',
       TwoCaptchaReCaptchaV3::ACTION_FIELD_MIN_SCORE => 0.3,
    ]);
    $code = $captcha->getCode();
} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {
    ...
}
```


Описание полей
--------------
 Название | Код | Тип | Обяз. | По ум. | Возможные значения | Описание 
 --- | --- | --- | --- | --- | --- | --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  |  | Ключ от учетной записи |
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Инструкция | ACTION_FIELD_INSTRUCTIONS | STRING | - |  |  | Текстовая капча или инструкция для прохождения капчи. |
 Ответ на | ACTION_FIELD_PINGBACK | STRING | - |  |  | Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div> |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |
 Параметр action | ACTION_FIELD_ACTION | STRING | + | verify |  | Значение параметра action, которые вы нашли в коде сайта |
 Минимальный рейтинг | ACTION_FIELD_MIN_SCORE | FLOAT | - | 0.4 |  | Требуемое значение рейтинга (score). На текущий момент сложно получить токен со score выше 0.3 |
 Адрес прокси | ACTION_FIELD_RECAPTCHA | STRING | - |  |  | IP адрес прокси ipv4/ipv6. |
 Тип прокси | ACTION_FIELD_PROXYTYPE | STRING | - |  |  | Тип прокси (http, socks4, ...) |

