<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaFunCaptcha.
 */
class RuCaptchaFunCaptcha extends RuCaptcha
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
            $this->paramsNames[static::ACTION_FIELD_LANG],
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
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANG],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CALC]
        );

        $this->paramsNames[static::ACTION_FIELD_PUBLICKEY] = 'publickey';
        $this->paramsNames[static::ACTION_FIELD_NOJS] = 'nojs';
        $this->paramsNames[static::ACTION_FIELD_USERAGENT] = 'userAgent';
        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'funcaptcha';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PUBLICKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NOJS] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
            static::PARAM_SLUG_DEFAULT => 0,
            static::PARAM_SLUG_ENUM    => [
                0,
                1,
            ],
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_USERAGENT] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha FunCaptcha',
            'en' => 'RuCaptcha FunCaptcha',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => '1000 решений стоят 39 рублей.',
            'en' => '1000 for $0,7',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => '1) Вам нужно найти публичный ключ FunCaptcha. Есть два способа это сделать: вы можете найти div с FunCaptcha и посмотреть на значение параметра data-pkey или же найти элемент с именем (name) fc-token, а из его значения вырезать ключ, который указан после pk.

2) Узакать эти параметры в методе recognize

3) Найдите элемент с id fc-token и измените его значение (value) на полученый CODE.

Важно: если вы используете параметр nojs=1, то API вернёт лишь часть токена в таком виде: 3084f4a302b176cd7.96368058|r=ap-southeast-1 и вам нужно собрать весь токен целиком самостоятельно, используя оригинальное значение fc-token.',
            'en' => '1) You need to find the public key FunCaptcha. There are two ways to do this: you can find a div with FunCaptcha and look at the value of the data-pkey parameter, or find an element with the name (name) fc-token, and from its value cut the key that is specified after pk.

2) See these parameters in the method recognize

3) Find the element with the id fc-token and change its value to the resulting CODE.

Important: if you use the nojs = 1 parameter, the API will return only a part of the token in this form: 3084f4a302b176cd7.96368058 | r = ap-southeast-1 and you need to collect the entire token entirely by yourself, using the original fc-token value.',
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_NOJS], [
            'ru' => [
                '0 - использовать JavaScript',
                '1 - не использовать JavaScript',
            ],
            'en' => [
                '0 - use javascript',
                '1 - do not use javascript',
            ],
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_PAGEURL   => 'http://mysite.com/page/with/funcaptcha/',
            static::ACTION_FIELD_PUBLICKEY => '12AB34CD-56F7-AB8C-9D01-2EF3456789A0',
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaInstruction::class,
            RuCaptchaGrid::class,
            RuCaptchaReCaptcha::class,
            RuCaptchaFunCaptcha::class,
            RuCaptchaReCaptchaV3::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
