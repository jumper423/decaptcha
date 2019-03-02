<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaKeyCaptcha.
 */
class RuCaptchaKeyCaptcha extends RuCaptcha
{
    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_FILE],
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->paramsNames[static::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_INSTRUCTIONS],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CALC]
        );

        $this->paramsNames[static::ACTION_FIELD_SSC_USER_ID] = 's_s_c_user_id';
        $this->paramsNames[static::ACTION_FIELD_SSC_SESSION_ID] = 's_s_c_session_id';
        $this->paramsNames[static::ACTION_FIELD_SSC_WEB_SERVER_SIGN] = 's_s_c_web_server_sign';
        $this->paramsNames[static::ACTION_FIELD_SSC_WEB_SERVER_SIGN2] = 's_s_c_web_server_sign2';
        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'keycaptcha';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SSC_USER_ID] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SSC_SESSION_ID] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SSC_WEB_SERVER_SIGN] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SSC_WEB_SERVER_SIGN2] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha KeyCaptcha',
            'en' => 'RuCaptcha KeyCaptcha',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => '1000 решений стоят 39 рублей.',
            'en' => '1000 for $0,7',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'KeyCaptcha — это такой вид капчи, для решения которой нужно собрать небольшой пазл.

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

5) Отправить форму.',
            'en' => 'KeyCaptcha is a kind of captcha, for the solution of which you need to assemble a small puzzle.

To solve KeyCaptcha using our service, you need:

1) Find the following KeyCaptcha parameters in the page source code:

```
s_s_c_user_id
s_s_c_session_id
s_s_c_web_server_sign
s_s_c_web_server_sign2
```

2) See these parameters in the method recognize

3) Find and delete the following block that connects the javascript file:

```
<script language = "JavaScript" src = "http://backs.keycaptcha.com/swfs/cap.js"> </ script>
```

Find and delete the div element with id = "div_for_keycaptcha":

```
<div id = "div_for_keycaptcha" ...> ... </ div>
```

```
Attention: sometimes the page content is dynamically generated and you may not find the elements you need or they may differ slightly.
In this case, you need to thoroughly understand the code of the page and the scripts used on it.
```

4) Find the element with id = "capcode" and change its value to the response received from our server.

```
<input name = "capcode" id = "capcode" value = "-> CODE <-" type = "hidden">
```

5) Submit the form.',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_PAGEURL              => 'https://www.keycaptcha.com/signup/',
            static::ACTION_FIELD_SSC_USER_ID          => '15',
            static::ACTION_FIELD_SSC_SESSION_ID       => 'd49b0eb43165997c786bdb62a75aa12c',
            static::ACTION_FIELD_SSC_WEB_SERVER_SIGN  => 'dbf758481b1371aa641364276b5ff0c4-pz-',
            static::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => '1117c0251c885edd1ce16dff799e5310',
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaInstruction::class,
            RuCaptchaGrid::class,
            RuCaptchaReCaptcha::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
