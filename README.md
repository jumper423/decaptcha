Captcha
================
[![PHP version](https://badge.fury.io/ph/jumper423%2Fcaptcha.svg)](https://badge.fury.io/ph/jumper423%2Fcaptcha)

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