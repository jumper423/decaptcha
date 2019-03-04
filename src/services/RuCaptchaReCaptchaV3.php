<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaReCaptchaV3
 */
class RuCaptchaReCaptchaV3 extends RuCaptcha
{
    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_FILE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[static::ACTION_FIELD_LANG],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANG]
        );

        $this->paramsNames[static::ACTION_FIELD_GOOGLEKEY] = 'googlekey';
        $this->paramsNames[static::ACTION_FIELD_PROXY] = 'proxy';
        $this->paramsNames[static::ACTION_FIELD_PROXYTYPE] = 'proxytype';
        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'userrecaptcha';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_VERSION] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
            static::PARAM_SLUG_DEFAULT => 'v3',
            static::PARAM_SLUG_NOTWIKI => true,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_GOOGLEKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_ACTION] = [
            static::PARAM_SLUG_REQUIRE  => false,
            static::PARAM_SLUG_DEFAULT  => 'verify',
            static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MIN_SCORE] = [
            static::PARAM_SLUG_DEFAULT  => 0.4,
            static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_FLOAT,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha ReCaptcha v3',
            'en' => 'RuCaptcha ReCaptcha v3',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => '1000 решений стоят 160 рублей.',
            'en' => '1000 for $2,99',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => '1) В первую очередь нужно убедиться, что на сайте действительно используется ReCaptcha V3.

Основные признаки V3:
не видна пользователю, не требует кликать по картинкам;
скрипт api.js загружается с параметром render=sitekey, например:
https://www.google.com/recaptcha/api.js?render=6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK
в массиве clients конфигурационного объекта ___grecaptcha_cfg используется индекс 100000: ___grecaptcha_cfg.clients[100000]

2) Для решения V3 через наш API необходимо найти значения трех параметров:

sitekey - его можно найти в html в значении параметра render при загрузке api.js, в параметре k в URI iframe, в который подгружается ReCaptcha, либо в javscript, в вызове функции grecaptcha.execute или в конфигурационном объекте ___grecaptcha_cfg.

action - это значение нужно искать в javascript коде сайта в вызове функции grecaptcha.execute. Пример: grecaptcha.execute(\'6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK\', {action: do_something}).
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
',
            'en' => '1) First of all, you need to make sure that the site really uses ReCaptcha V3.

The main features of V3:
not visible to the user, does not require to click on the pictures;
The script api.js is loaded with the parameter render = sitekey, for example:
https://www.google.com/recaptcha/api.js?render=6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK
in the clients array of the ___grecaptcha_cfg configuration object, the index 100000 is used: ___ grecaptcha_cfg.clients [100000]

2) To solve V3 through our API, it is necessary to find the values ​​of three parameters:

sitekey - it can be found in html in the value of the render parameter when api.js is loaded, in the k parameter in the iframe URI into which ReCaptcha is loaded, either in javscript, in the function grecaptcha.execute or in the ___grecaptcha_cfg configuration object.

action - this value should be searched in the javascript code of the site in the function call grecaptcha.execute. Example: grecaptcha.execute (\'6Ld0KL0UABBBBCd2-aa00bbCCddeee1FfF2gHiJK\', {action: do_something}).
Sometimes it is quite difficult to find it and it is required to turn all js-files uploaded by the site upside down. In addition, you can try to find the value of action in the ___grecaptcha_cfg configuration object, but very often it may not be set there, but only transmitted when calling grecaptcha.execute - therefore the most effective method is to view javascript code.
pageurl - the full URL of the page where you want to solve ReCaptcha V3.

In addition, you need to understand what score you need. From the outside, it’s possible to determine at which score the site decides that you are human and miss your request, only experimentally. The lowest reiging 0.1 is a robot, and the highest 0.9 is a human. But, many sites set threshold values ​​from 0.2 to 0.5, because An ordinary person often gets a rather low rating. Most likely, our API can get score 0.3, higher scores for workers are quite rare.

3) Having all the necessary parameters, you can send a request.

4) After receiving the CODE, you need to correctly use it on the site. The best way to understand how to do this is to look at what requests are sent to the site when you work with it as a regular visitor. Most browsers make this easy to do in the developer console, the tab you need is usually called "Network."

The token is usually sent in the parameters of the POST request, it can be g-recaptcha-response like ReCaptcha V2, g-recaptcha-response-100000 or some other parameter. Therefore, you need to carefully review the request parameters and find out how the token is transmitted, and then form a similar request.

5) After you used the token on the site and it became clear whether it worked or not - you can tell us about it. In case the token was not accepted - we will return the money for the captcha to your balance. And if the token was accepted, we will put the employee who received it as a priority for your requests. In addition, it allows us to save and analyze statistics on this type of captchas for the subsequent optimization of algorithms for its solution.

To report whether the token worked or not - send a request to http://rucaptcha.com/res.php with your API key in the key parameter, captcha id in the id parameter of the same name and specifying the action parameter, depending on the result: reportgood - the token worked or reportbad - the token did not work.

```
$captcha->notTrue();
//or
$captcha->true();
```',
        ]);
        $this->wiki->setText(['field', 'main', 'name', self::ACTION_FIELD_ACTION], [
            'ru' => 'Параметр action',
            'en' => 'Action parameter',
        ]);
        $this->wiki->setText(['field', 'main', 'desc', self::ACTION_FIELD_ACTION], [
            'ru' => 'Значение параметра action, которые вы нашли в коде сайта',
            'en' => 'The value of the action parameter that you found in the site code',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
            static::ACTION_FIELD_PAGEURL   => 'http://site.com/recaptcha-ex',
            static::ACTION_FIELD_ACTION    => 'verify',
            static::ACTION_FIELD_MIN_SCORE => 0.3,
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaInstruction::class,
            RuCaptchaGrid::class,
            RuCaptchaFunCaptcha::class,
            RuCaptchaReCaptcha::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
