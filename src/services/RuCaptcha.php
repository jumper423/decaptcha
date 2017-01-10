<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Распознавание капчи RuCaptcha.
 *
 * Class RuCaptcha
 *
 * @link http://infoblog1.ru/goto/rucaptcha
 */
class RuCaptcha extends DeCaptchaBase
{
    protected $host = 'rucaptcha.com';

    const RESPONSE_REPORTBAD_OK = 'OK_REPORT_RECORDED';

    protected $paramsNames = [
        self::ACTION_FIELD_METHOD       => 'method',
        self::ACTION_FIELD_KEY          => 'key',
        self::ACTION_FIELD_FILE         => 'file',
        self::ACTION_FIELD_PHRASE       => 'phrase',
        self::ACTION_FIELD_REGSENSE     => 'regsense',
        self::ACTION_FIELD_NUMERIC      => 'numeric',
        self::ACTION_FIELD_MIN_LEN      => 'min_len',
        self::ACTION_FIELD_MAX_LEN      => 'max_len',
        self::ACTION_FIELD_LANGUAGE     => 'language',
        self::ACTION_FIELD_SOFT_ID      => 'soft_id',
        self::ACTION_FIELD_CAPTCHA_ID   => 'id',
        self::ACTION_FIELD_ACTION       => 'action',
        self::ACTION_FIELD_QUESTION     => 'question',
        self::ACTION_FIELD_HEADER_ACAO  => 'header_acao',
        self::ACTION_FIELD_INSTRUCTIONS => 'textinstructions',
        self::ACTION_FIELD_PINGBACK     => 'pingback',
        self::ACTION_FIELD_CALC         => 'calc',
    ];

    public function init()
    {
        parent::init();

        $this->actions[static::ACTION_RECOGNIZE] = [
            static::ACTION_URI    => 'in.php',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_METHOD => [
                    static::PARAM_SLUG_DEFAULT => 'post',
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                    static::PARAM_SLUG_NOTWIKI => true,
                ],
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_FILE => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_FILE,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_MIX,
                ],
                static::ACTION_FIELD_PHRASE => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                    ],
                ],
                static::ACTION_FIELD_REGSENSE => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                    ],
                ],
                static::ACTION_FIELD_NUMERIC => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                        2,
                        3,
                    ],
                ],
                static::ACTION_FIELD_MIN_LEN => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_MAX_LEN => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_LANGUAGE => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                        2,
                    ],
                ],
                static::ACTION_FIELD_QUESTION => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                    ],
                ],
                static::ACTION_FIELD_CALC => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                    ],
                ],
                static::ACTION_FIELD_HEADER_ACAO => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_ENUM    => [
                        0,
                        1,
                    ],
                ],
                static::ACTION_FIELD_INSTRUCTIONS => [
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_PINGBACK => [
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_SOFT_ID => [
                    static::PARAM_SLUG_VARIABLE => false,
                    static::PARAM_SLUG_DEFAULT  => 882,
                    static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_NOTWIKI  => true,
                ],
            ],
        ];
        $this->actions[static::ACTION_UNIVERSAL] = [
            static::ACTION_URI    => 'res.php',
            static::ACTION_METHOD => static::ACTION_METHOD_GET,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_ACTION => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_HEADER_ACAO => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_CAPTCHA_ID => [
                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_CAPTCHA,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                ],
            ],
        ];
        $this->actions[static::ACTION_UNIVERSAL_WITH_CAPTCHA] = [
            static::ACTION_URI    => 'res.php',
            static::ACTION_METHOD => static::ACTION_METHOD_GET,
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
                static::ACTION_FIELD_ACTION => [
                    static::PARAM_SLUG_REQUIRE  => true,
                    static::PARAM_SLUG_DEFAULT  => 'get',
                    static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_STRING,
                    static::PARAM_SLUG_VARIABLE => false,
                ],
                static::ACTION_FIELD_HEADER_ACAO => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
            ],
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_RECOGNIZE] = [
            static::DECODE_SEPARATOR => '|',
            static::DECODE_PARAMS    => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 0,
                ],
                static::DECODE_PARAM_CAPTCHA => [
                    static::DECODE_PARAM_SETTING_MARKER => 1,
                ],
            ],
        ];
        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_GET] = [
            static::DECODE_SEPARATOR => '|',
            static::DECODE_PARAMS    => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 0,
                ],
                static::DECODE_PARAM_CODE => [
                    static::DECODE_PARAM_SETTING_MARKER => 1,
                ],
            ],
        ];
        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_UNIVERSAL] = [
            static::DECODE_SEPARATOR => '|',
            static::DECODE_PARAMS    => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 0,
                ],
            ],
        ];

        $this->wiki->setText(['service', 'name'], 'RuCaptcha');
        $this->wiki->setText(['service', 'href'], 'http://infoblog1.ru/goto/rucaptcha');
        $this->wiki->setText(['service', 'desc'], [
            'ru' => 'RuCaptcha.com — антикапча-сервис ручного распознавания изображений, здесь встречаются те, кому нужно в режиме реального времени распознать текст с отсканированных документов, бланков, капч и те, кто хочет заработать на вводе текста с экрана. 

В системе работают русскоязычные и англоязычные работники.

Cервис антикапчи RuCaptcha.com не только поддерживает стандартное API на равне с сервисами pixodrom, antigate, anti-captcha и других, но и предоставляет расширенный фукнционал пополняющийся под каждый виток борьбы с автоматизацией. API RuCaptcha поддерживает решение ReCaptcha v2 (где нужно кликнуть по картинкам), ClickCaptcha (где нужно кликнуть в определённые точки) и Rotatecaptcha (FunCaptcha и другие капчи, которые нужно крутить).',
            'en' => 'RuCaptcha.com - antikapchu service manual image recognition, there are those who need real-time to recognize text from scanned documents, forms, and captures those who want to earn on entering text from the screen.

The system works the Russian-speaking and English-speaking staff.

Tuning anticaptcha RuCaptcha.com not only supports API standard on par with pixodrom services, antigate, anti-captcha and others, but also provides advanced functional replenishing at each round of combat automation. API RuCaptcha supports the decision ReCaptcha v2 (where you need to click on the pictures), ClickCaptcha (where you need to click on certain points) and Rotatecaptcha (FunCaptcha other CAPTCHA, you need to twist).',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'От 18 до 44 руб. за 1000 капч в зависимости от нагрузки',
            'en' => 'Starting from 0.5 USD for 1000 solved CAPTCHAs',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Расшифровка капч с картики. Необходимо указать файл с картинкой или ссылку на него.',
            'en' => 'Decrypt the captcha with image. You must specify a file with a picture or a link to it.',
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_PHRASE], [
            'ru' => [
                '0 - одно слово',
                '1 - каптча имеет два слова',
            ],
            'en' => [
                '0 - one word',
                '1 - captcha has two words',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_REGSENSE], [
            'ru' => [
                '0 - регистр ответа не имеет значения',
                '1 - регистр ответа имеет значение',
            ],
            'en' => [
                '0 - the case of the answer is irrelevant',
                '1 - the register response value',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_NUMERIC], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - капча состоит только из цифр',
                '2 - капча состоит только из букв',
                '3 - капча состоит либо только из цифр, либо только из букв',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - captcha consists only of digits',
                '2 - captcha consists only of letters',
                '3 - captcha consists of either only numbers or only letters',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_LANGUAGE], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - на капче только кириллические буквы',
                '2 - на капче только латинские буквы',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - the captcha only Cyrillic letters',
                '2 - displayed in a CAPTCHA latin characters only',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_QUESTION], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - работник должен написать ответ',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - the employee must write the answer',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_CALC], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - работнику нужно совершить математическое действие с капчи',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - the worker needs to perform a mathematical operation with captcha',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_HEADER_ACAO], [
            'ru' => [
                '0 - значение по умолчанию',
                '1 - in.php передаст Access-Control-Allow-Origin: * параметр в заголовке ответа',
            ],
            'en' => [
                '0 - the default value',
                '1 - in.php will transfer Access-Control-Allow-Origin: * parameter in response header',
            ],
        ]);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptchaInstruction::class,
            RuCaptchaClick::class,
            RuCaptchaGrid::class,
            RuCaptchaReCaptcha::class,
        ]);
    }

    /**
     * Баланс
     *
     * @return float
     */
    public function getBalance()
    {
        return (float) $this->requestUniversal('getbalance')[static::DECODE_PARAM_RESPONSE];
    }

    /**
     * Не верно распознана.
     *
     * @return bool
     */
    public function notTrue()
    {
        return $this->requestUniversal('reportbad')[static::DECODE_PARAM_RESPONSE] === static::RESPONSE_REPORTBAD_OK;
    }
}
