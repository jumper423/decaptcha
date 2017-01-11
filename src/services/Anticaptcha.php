<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;
use jumper423\decaptcha\core\DeCaptchaErrors;

/**
 * Class Anticaptcha.
 */
class Anticaptcha extends DeCaptchaBase
{
    protected $host = 'api.anti-captcha.com';
    protected $scheme = 'https';

    const RESPONSE_RECOGNIZE_OK = 0;
    const RESPONSE_RECOGNIZE_REPEAT = 2;
    const RESPONSE_GET_OK = 'ready';
    const RESPONSE_GET_REPEAT = 'processing';

    const DECODE_PARAM_ERROR = 4;
    const DECODE_PARAM_BALANCE = 5;

    const ACTION_BALANCE = 4;
    const DECODE_ACTION_BALANCE = 4;

    protected $paramsNames = [
        self::ACTION_FIELD_KEY        => 'clientKey',
        self::ACTION_FIELD_SOFT_ID    => 'softId',
        self::ACTION_FIELD_LANGUAGE   => 'languagePool',
        self::ACTION_FIELD_TASK       => 'task',
        self::ACTION_FIELD_METHOD     => 'type',
        self::ACTION_FIELD_FILE       => 'body',
        self::ACTION_FIELD_PHRASE     => 'phrase',
        self::ACTION_FIELD_REGSENSE   => 'case',
        self::ACTION_FIELD_NUMERIC    => 'numeric',
        self::ACTION_FIELD_CALC       => 'math',
        self::ACTION_FIELD_MIN_LEN    => 'minLength',
        self::ACTION_FIELD_MAX_LEN    => 'maxLength',
        self::ACTION_FIELD_CAPTCHA_ID => 'taskId',
    ];

    public function init()
    {
        parent::init();

        $this->actions[static::ACTION_RECOGNIZE] = [
            static::ACTION_URI    => 'createTask',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_JSON   => true,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_SOFT_ID => [
                    static::PARAM_SLUG_VARIABLE => false,
                    static::PARAM_SLUG_DEFAULT  => 882,
                    static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_NOTWIKI  => true,
                ],
                static::ACTION_FIELD_LANGUAGE => [
                    static::PARAM_SLUG_DEFAULT => 'en',
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                    static::PARAM_SLUG_ENUM    => [
                        'en',
                        'rn',
                    ],
                ],
                static::ACTION_FIELD_TASK => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_DEFAULT => [],
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_OBJECT,
                    static::PARAM_SLUG_NOTWIKI => true,
                    static::ACTION_FIELDS      => [
                        static::ACTION_FIELD_METHOD => [
                            static::PARAM_SLUG_DEFAULT => 'ImageToTextTask',
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                            static::PARAM_SLUG_NOTWIKI => true,
                        ],
                        static::ACTION_FIELD_FILE => [
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_FILE,
                            static::PARAM_SLUG_CODING  => static::PARAM_SLUG_CODING_BASE64,
                            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                        ],
                        static::ACTION_FIELD_PHRASE => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                            static::PARAM_SLUG_ENUM => [
                                true,
                                false,
                            ],
                        ],
                        static::ACTION_FIELD_REGSENSE => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                            static::PARAM_SLUG_ENUM => [
                                true,
                                false,
                            ],
                        ],
                        static::ACTION_FIELD_NUMERIC => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                            static::PARAM_SLUG_ENUM => [
                                0,
                                1,
                                2,
                            ],
                        ],
                        static::ACTION_FIELD_CALC => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                            static::PARAM_SLUG_ENUM => [
                                true,
                                false,
                            ],
                        ],
                        static::ACTION_FIELD_MIN_LEN => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                        ],
                        static::ACTION_FIELD_MAX_LEN => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                        ],
                    ],
                ],
            ],
        ];
        $this->actions[static::ACTION_UNIVERSAL_WITH_CAPTCHA] = [
            static::ACTION_URI    => 'getTaskResult',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_JSON   => true,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_CAPTCHA_ID => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_CAPTCHA,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
            ],
        ];
        $this->actions[static::ACTION_BALANCE] = [
            static::ACTION_URI    => 'getBalance',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_JSON   => true,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
            ],
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_RECOGNIZE] = [
            static::DECODE_FORMAT => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 'errorId',
                ],
                static::DECODE_PARAM_CAPTCHA => [
                    static::DECODE_PARAM_SETTING_MARKER => 'taskId',
                ],
                static::DECODE_PARAM_ERROR => [
                    static::DECODE_PARAM_SETTING_MARKER => 'errorCode',
                ],
            ],
        ];
        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_GET] = [
            static::DECODE_FORMAT => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 'status',
                ],
                static::DECODE_PARAM_CODE => [
                    static::DECODE_PARAM_SETTING_MARKER => 'solution.text',
                ],
                static::DECODE_PARAM_ERROR => [
                    static::DECODE_PARAM_SETTING_MARKER => 'errorCode',
                ],
            ],
        ];
        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_BALANCE] = [
            static::DECODE_FORMAT => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 'errorId',
                ],
                static::DECODE_PARAM_BALANCE => [
                    static::DECODE_PARAM_SETTING_MARKER => 'balance',
                ],
                static::DECODE_PARAM_ERROR => [
                    static::DECODE_PARAM_SETTING_MARKER => 'errorCode',
                ],
            ],
        ];

        $this->wiki->setText(['service', 'name'], 'Anti Captcha');
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/anti-captcha');
        $this->wiki->setText(['service', 'desc'], [
            'ru' => 'Сервис AntiCaptcha, ранее белее известный как Antigate.

100% капч распознаются нашими работниками со всего мира. Именно поэтому используя наш сервис вы одновременно помогаете тысячам людей по всему миру обеспечивать себя и своих близких.

Деньги, которые наши работники зарабатывают у нас считаются хорошей зарплатой в таких странах как Индия, Пакистан или Вьетнам. С вашей помощью теперь у них есть выбор между работой на грязном производстве и работой за компьютером.',
            'en' => 'The AntiCaptcha service, formerly known as whiter Antigate. 
            
100% of captchas can be recognized by our employees from around the world. That is why using our service you help thousands of people around the world to provide themselves and their families. 

The money our employees earn are considered a good salary in countries such as India, Pakistan or Vietnam. With your help, they now have the choice between working on the dirty production and computer work.',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'От 0.7 USD за каждые 1000 капч, в зависимости от ваших объемов',
            'en' => 'From 0.7 USD per 1000 captchas, depending on your volume',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Решение обычной капчи с текстом.',
            'en' => 'The solution to the normal captcha text.',
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_PHRASE], [
            'ru' => [
                'false - нет требований',
                'true - работник должен ввести текст с одним или несколькими пробелами',
            ],
            'en' => [
                'false - there are no requirements',
                'true - работник должен ввести текст с одним или несколькими пробелами',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_REGSENSE], [
            'ru' => [
                'false - нет требований',
                'true - работник увидит специальный сигнал что ответ необходимо вводить с учетом регистра',
            ],
            'en' => [
                'false - there are no requirements',
                'true - the employee will see a special signal that the answer should be entered case sensitive',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_NUMERIC], [
            'ru' => [
                '0 - нет требований',
                '1 - можно вводить только цифры',
                '2 - вводить можно любые символы кроме цифр',
            ],
            'en' => [
                '0 - there are no requirements',
                '1 - you can enter only numbers',
                '2 - you can enter any characters except numbers',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_CALC], [
            'ru' => [
                'false - нет требований',
                'true - работник увидит специальный сигнал что на капче изображено математическое выражение и необходимо ввести на него ответ',
            ],
            'en' => [
                'false - there are no requirements',
                'true - the employee will see a special signal on the captcha depicts a mathematical expression and you need to enter the answer',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_LANGUAGE], [
            'ru' => [
                'en - англоязычная очередь',
                'rn - группа стран Россия, Украина, Беларусь, Казахстан',
            ],
            'en' => [
                'en - English turn',
                'rn - a group of countries Russia, Ukraine, Belarus, Kazakhstan',
            ],
        ]);
        $this->wiki->setText(['field', 'main', 'desc', static::ACTION_FIELD_LANGUAGE], [
            'ru' => 'Определяет язык очереди, в которую должна попасть капча.',
            'en' => 'Determines the language of the queue to which you want to get captcha.',
        ]);
        $this->wiki->setText(['menu', 'from_service'], [
            AnticaptchaReCaptchaProxeless::class,
            AnticaptchaReCaptcha::class,
        ]);
    }

    /**
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestRecognize()
    {
        return $this->requestRepeat(static::ACTION_RECOGNIZE, static::DECODE_ACTION_RECOGNIZE, static::PARAM_SPEC_CAPTCHA, static::DECODE_PARAM_CAPTCHA, static::RESPONSE_RECOGNIZE_OK, static::SLEEP_RECOGNIZE, static::RESPONSE_RECOGNIZE_REPEAT, static::DECODE_PARAM_ERROR);
    }

    /**
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestCode()
    {
        return $this->requestRepeat(static::ACTION_UNIVERSAL_WITH_CAPTCHA, static::DECODE_ACTION_GET, static::PARAM_SPEC_CODE, static::DECODE_PARAM_CODE, static::RESPONSE_GET_OK, static::SLEEP_GET, static::RESPONSE_GET_REPEAT, static::DECODE_PARAM_ERROR);
    }

    /**
     * Баланс
     *
     * @return float
     */
    public function getBalance()
    {
        $result = $this->requestUniversal('getbalance');
        if ($result[static::DECODE_PARAM_RESPONSE] != 0) {
            return 0;
        }

        return (float) $result[static::DECODE_PARAM_BALANCE];
    }
}
