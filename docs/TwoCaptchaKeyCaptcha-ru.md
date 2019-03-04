2Captcha KeyCaptcha
==============
Меню
--------------
+ [Главная](../docs/README-ru.md)
+ [Documentation in English language](../docs/TwoCaptchaKeyCaptcha-en.md)
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
  + [2Captcha ReCaptcha v2 без браузера](../docs/TwoCaptchaReCaptcha-ru.md)


Ссылка
--------------
[Ссылка на сервис 2Captcha KeyCaptcha](http://infoblog1.ru/goto/2captcha)

Описание сервиса
--------------
RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).

Цены
--------------
1000 решений стоят 39 рублей.

Описание распознания
--------------
KeyCaptcha — это такой вид капчи, для решения которой нужно собрать небольшой пазл.

Чтобы решить KeyCaptcha с помощью нашего сервиса, нужно:

1) Найти следующие параметры KeyCaptcha в исходном коде страницы:

```
s_s_c_user_id
s_s_c_session_id
s_s_c_web_server_sign
s_s_c_web_server_sign2
```

2) Узакать эти параметры в методе recognize

3) Найдите и удалите следующий блок, который подключает javascript-файл:

```
<script language="JavaScript" src="http://backs.keycaptcha.com/swfs/cap.js"></script>
```

Найдите и удалите элемент div с id="div_for_keycaptcha":

```
<div id="div_for_keycaptcha"...>...</div>
```

```
Внимание: иногда содержимое страницы генерируется динамически и вы можете не найти нужные элементы или они могут немного отличаться.
В таком случае вам нужно хорошенько разобраться в коде страницы и используемых на ней скриптов.
```

4) Найдите элемент с id="capcode" и измените его значение на ответ, полученный от нашего сервера.

```
<input name="capcode" id="capcode" value="-->CODE<--" type="hidden">
```

5) Отправить форму.

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
use jumper423\decaptcha\services\TwoCaptchaKeyCaptcha;

$captcha = new TwoCaptchaKeyCaptcha([
    TwoCaptchaKeyCaptcha::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
]);
```
__Распознавание__
В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.
```
if ($captcha->recognize([
       TwoCaptchaKeyCaptcha::ACTION_FIELD_PAGEURL => 'https://www.keycaptcha.com/signup/',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_USER_ID => '15',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_SESSION_ID => 'd49b0eb43165997c786bdb62a75aa12c',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN => 'dbf758481b1371aa641364276b5ff0c4-pz-',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => '1117c0251c885edd1ce16dff799e5310',
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
       TwoCaptchaKeyCaptcha::ACTION_FIELD_PAGEURL => 'https://www.keycaptcha.com/signup/',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_USER_ID => '15',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_SESSION_ID => 'd49b0eb43165997c786bdb62a75aa12c',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN => 'dbf758481b1371aa641364276b5ff0c4-pz-',
       TwoCaptchaKeyCaptcha::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => '1117c0251c885edd1ce16dff799e5310',
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
 Ответ на | ACTION_FIELD_PINGBACK | STRING | - |  |  | Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес. |
 Параметра s_s_c_user_id | ACTION_FIELD_SSC_USER_ID | STRING | + |  |  | Значение параметра s_s_c_user_id, найденное на странице |
 Параметра s_s_c_session_id | ACTION_FIELD_SSC_SESSION_ID | STRING | + |  |  | Значение параметра s_s_c_session_id, найденное на странице |
 Параметра s_s_c_web_server_sign | ACTION_FIELD_SSC_WEB_SERVER_SIGN | STRING | + |  |  | Значение параметра s_s_c_web_server_sign, найденное на странице |
 Параметра s_s_c_web_server_sign2 | ACTION_FIELD_SSC_WEB_SERVER_SIGN2 | STRING | + |  |  | Значение параметра s_s_c_web_server_sign2, найденное на странице |
 Адрес | ACTION_FIELD_PAGEURL | STRING | + |  |  | Адрес страницы на которой решается капча. |

