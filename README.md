DeCaptcha
================
[![Latest Stable Version](https://poser.pugx.org/jumper423/decaptcha/v/stable)](https://packagist.org/packages/jumper423/decaptcha)
[![Total Downloads](https://poser.pugx.org/jumper423/decaptcha/downloads)](https://packagist.org/packages/jumper423/decaptcha)
[![License](https://poser.pugx.org/jumper423/decaptcha/license)](https://packagist.org/packages/jumper423/decaptcha)

[![Build Status](https://travis-ci.org/jumper423/decaptcha.svg?branch=master)](https://travis-ci.org/jumper423/decaptcha)
[![Dependency Status](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/5849f365a662a5004c110a29)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/jumper423/decaptcha/badges/build.png?b=master)](https://scrutinizer-ci.com/g/jumper423/decaptcha/build-status/master)
[![Code Climate](https://codeclimate.com/github/jumper423/decaptcha/badges/gpa.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![Issue Count](https://codeclimate.com/github/jumper423/decaptcha/badges/issue_count.svg)](https://codeclimate.com/github/jumper423/decaptcha)
[![codecov](https://codecov.io/gh/jumper423/decaptcha/branch/master/graph/badge.svg)](https://codecov.io/gh/jumper423/decaptcha)
[![HHVM Status](http://hhvm.h4cc.de/badge/jumper423/decaptcha.svg)](http://hhvm.h4cc.de/package/jumper423/decaptcha)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5/mini.png)](https://insight.sensiolabs.com/projects/d485629c-1830-440d-82ab-a567bfa5ddc5)
[![StyleCI](https://styleci.io/repos/75013766/shield?branch=master)](https://styleci.io/repos/75013766)

Распознавание капч для всех популярных сервисов [rucaptcha.com](http://infoblog1.ru/goto/rucaptcha), 2captcha.com, pixodrom.com, captcha24.com, [socialink.ru](http://www.socialink.ru/?key=84333), anti-captcha.com

Особенности
------------
* Подходит для всех сервисов по распознаванию капч работающие по общим стандартам
* Лёгкость настроки
* Распозвание как по пути до файла, так и по ссылки

Установка
------------
Предпочтительный способ установить это расширение через [composer](http://getcomposer.org/download/).

Либо запустить

```
php composer.phar require --prefer-dist jumper423/captcha "*"
```

или добавить

```
"jumper423/captchar": "*"
```

в файл `composer.json`.

Использование
------------
Простой пример использования:

```php
$path = 'path/to/captcha.png';

$captcha = new \jumper423\Rucaptcha();
$captcha->setApiKey('42eab4119020dbc729f657fef');
if ($captcha->run($path)) {
    $code = $captcha->result(); 
    ...
    //оказалось что капча была введена не верно. чтобы вернуть деньги вызовем
    $captcha->notTrue();
} else {
    throw new Exception($captcha->error());
}


Так же можно применять если у Вас есть только ссылка на капчу, но для этого метода Вам следует прописать путь в конфигурации для сохранения капч (pathTmp):

```php
$url = 'https://vk.com/captcha.php?sid=698254154192&s=1';
if ($captcha->run($url)) {
    $code = $captcha->result(); 
} else {
    throw new Exception($captcha->error());
}
```


vendor/bin/phpunit 


 Название | Код | Тип | Обязательное | По умолчания | Возможные значения | Описание 
 --- | --- | --- | --- | --- | ---| --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  |  | Ключ от учетной записи |
 Картинка | ACTION_FIELD_FILE | MIX | + |  |  | Путь на файл с картинкой или ссылка на него |
 Несколько слов | ACTION_FIELD_PHRASE | INTEGER | - | 0 | 0 - регистр ответа не имеет значения; 1 - регистр ответа имеет значение | Работник должен ввести текст с одним или несколькими пробелами |
 Регистр | ACTION_FIELD_REGSENSE | INTEGER | - | 0 | 0 - регистр ответа не имеет значения; 1 - регистр ответа имеет значение | Работник должен ввсести ответ с учетом регистра |
 Символы | ACTION_FIELD_NUMERIC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - капча состоит только из цифр; 2 - капча состоит только из букв; 3 - капча состоит либо только из цифр, либо только из букв | Какие символы используется в капче |
 Длина min | ACTION_FIELD_MIN_LEN | INTEGER | - | 0 |  | Минимальная длина капчи |
 Длина max | ACTION_FIELD_MAX_LEN | INTEGER | - | 0 |  | Максимальная длина капчи |
 Язык | ACTION_FIELD_LANGUAGE | INTEGER | - | 0 | 0 - параметр не задействован; 1 - на капче только кириллические буквы; 2 - на капче только латинские буквы | Символы какого языка размещенны на капче |
 Вопрос | ACTION_FIELD_QUESTION | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работник должен написать ответ | На изображении задан вопрос, работник должен написать ответ |
 Вычисление | ACTION_FIELD_CALC | INTEGER | - | 0 | 0 - параметр не задействован; 1 - работнику нужно совершить математическое действие с капчи | На капче изображенно математичекая выражение и её необходимо решить |
 Кросс-доменный | ACTION_FIELD_HEADER_ACAO | INTEGER | - | 0 | 0 - значение по умолчанию; 1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа | Необходимо для кросс-доменных AJAX запросов в браузерных приложениях. |
 Инструкция | ACTION_FIELD_INSTRUCTIONS | STRING | - |  |  | Текстовая капча или инструкция для прохождения капчи. |
 Ответ на | ACTION_FIELD_PINGBACK | STRING | - |  |  | Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес. |
 


Название | Код | Тип | Обязательное | По умолчания | Возможные значения | Описание 
 --- | --- | --- | --- | --- | ---| --- 
 Ключ | ACTION_FIELD_KEY | STRING | + |  | | Ключ от учетной записи 
 Язык | ACTION_FIELD_LANGUAGE | STRING | - | en | | Символы какого языка размещенны на капче 
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  | | Адрес страницы на которой решается капча. 
 Google key | ACTION_FIELD_GOOGLEKEY | STRING | + |  | | Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div> 
 Google token | ACTION_FIELD_GOOGLETOKEN | STRING | - |  | | Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его. 
 Тип прокси | ACTION_FIELD_PROXYTYPE | STRING | + |  | | Тип прокси (http, socks4, ...) 
 Адрес прокси | ACTION_FIELD_RECAPTCHA | STRING | + |  | | IP адрес прокси ipv4/ipv6. 
 Порт прокси | ACTION_FIELD_PROXYPORT | INTEGER | + |  | | Порт прокси. 
 Логин прокси | ACTION_FIELD_PROXYLOGIN | STRING | - |  | | Логин от прокси-сервера. 
 Пароль прокси | ACTION_FIELD_PROXYPASS | STRING | - |  | | Пароль от прокси-сервера. 
 User-Agent браузера | ACTION_FIELD_USERAGENT | STRING | + |  | | User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер. 
 Куки | ACTION_FIELD_COOKIES | STRING | - |  | | Дополнительные cookies которые мы должны использовать во время взаимодействия с целевой страницей. 
