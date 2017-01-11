AntiCaptcha ReCaptcha v2 без браузера
==============
###Меню
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/AnticaptchaReCaptchaProxeless-en.md)
+ Якоря
  + [Ссылка](#Ссылка)
  + [Описание сервиса](#Описание-сервиса)
  + [Цены](#Цены)
  + [Описание распознания](#Описание-распознания)
  + [Установка](#Установка)
  + [Примеры](#Примеры)
  + [Описание полей](#Описание-полей)
+ Другой функционал от сервиса
  + [Anti Captcha](../docs/Anticaptcha-ru.md)
  + [AntiCaptcha ReCaptcha v2 без браузера (с прокси)](../docs/AnticaptchaReCaptcha-ru.md)


###Ссылка
[Ссылка на сервис AntiCaptcha ReCaptcha v2 без браузера](http://infoblog1.ru/goto/anti-captcha)

###Описание сервиса
Сервис AntiCaptcha, ранее белее известный как Antigate.

100% капч распознаются нашими работниками со всего мира. Именно поэтому используя наш сервис вы одновременно помогаете тысячам людей по всему миру обеспечивать себя и своих близких.

Деньги, которые наши работники зарабатывают у нас считаются хорошей зарплатой в таких странах как Индия, Пакистан или Вьетнам. С вашей помощью теперь у них есть выбор между работой на грязном производстве и работой за компьютером.

###Цены
Стоимость Рекапчи: от 2 USD за 1000 решений.

###Описание распознания
Вам не нужно эмулировать браузер и запускать яваскрипты.
            
Вы присылаете нам значение "sitekey".

Мы передаем вам "g-recaptcha-response" и вы просто делаете сабмит формы с этим параметром.

Объект содержит данные о задаче на решение рекапчи гугла в браузере на компьютере работника. 
Такая задача будет выполняться нашим сервисом с использованием наших собственных прокси-серверов и/или с IP адресов работников. 
Стоимость решения такой задачи на 10% выше, чем у AnticaptchaReCaptcha, так как на нас ложится проблема обхода лимитов на количество решений рекапч с 1 IP адреса.

###Установка
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


###Примеры
####Инициализация
Указываем ключ, обязательные и дополнительные параметры. Старайтесь по максимуму их заполнить это способствует более быстрому распознанию капчи.
```
use jumper423\decaptcha\services\AnticaptchaReCaptchaProxeless;

$captcha = new AnticaptchaReCaptchaProxeless([
    AnticaptchaReCaptchaProxeless::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
####Распознавание
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
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
####Баланс
```
$balance = $captcha->getBalance();
```
####Язык ошибки
По умолчанию ошибки на англиском языке, если необходимо переоперелить, сделайте следующее
```
$captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
```
####Перехват ошибки
При желании Вы можете перехватывать ошибку, но для этого надо вызвать setCauseAnError
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


###Описание полей
 Название | Код | Тип | Обяз. | По ум. | Возможные значения | Описание 
 --- | --- | --- | --- | --- | --- | --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  |  | Ключ от учетной записи |
 Язык | ACTION_FIELD_LANGUAGE | STRING | - | en | en - англоязычная очередь; rn - группа стран Россия, Украина, Беларусь, Казахстан | Определяет язык очереди, в которую должна попасть капча. |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  |  | Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div> |
 Google token | ACTION_FIELD_GOOGLETOKEN | STRING | - |  |  | Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его. |

