<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Class Anticaptcha
 * @package jumper423\decaptcha\services
 */
class Anticaptcha extends DeCaptchaBase
{
    public $domain = 'api.anti-captcha.com';

    const RESPONSE_REPORTBAD_OK = 'OK_REPORT_RECORDED';

    const ACTION_FIELD_TASK = 17;
    const PARAM_FIELD_TYPE_OBJECT = 3;
    const PARAM_FIELD_TYPE_BOOLEAN = 4;

    protected $paramsNames = [
        self::ACTION_FIELD_KEY => 'clientKey',
        self::ACTION_FIELD_SOFT_ID => 'softId',
        self::ACTION_FIELD_LANGUAGE => 'languagePool',
        self::ACTION_FIELD_TASK => 'task',
        self::ACTION_FIELD_METHOD => 'type',
        self::ACTION_FIELD_FILE => 'body',
        self::ACTION_FIELD_PHRASE => 'phrase',
        self::ACTION_FIELD_REGSENSE => 'case',
        self::ACTION_FIELD_NUMERIC => 'numeric',
        self::ACTION_FIELD_CALC => 'math',
        self::ACTION_FIELD_MIN_LEN => 'minLength',
        self::ACTION_FIELD_MAX_LEN => 'maxLength',


//        self::ACTION_FIELD_METHOD           => 'method',
//        self::ACTION_FIELD_LANGUAGE         => 'language',
//        self::ACTION_FIELD_CAPTCHA_ID       => 'id',
//        self::ACTION_FIELD_ACTION           => 'action',
//        self::ACTION_FIELD_QUESTION         => 'question',
//        self::ACTION_FIELD_HEADER_ACAO      => 'header_acao',
//        self::ACTION_FIELD_TEXTINSTRUCTIONS => 'textinstructions',
//        self::ACTION_FIELD_PINGBACK         => 'pingback',
    ];

    public function init()
    {
        parent::init();

        $this->actions[static::ACTION_RECOGNIZE] = [
            static::ACTION_URI => 'createTask',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_SOFT_ID => [
                    static::PARAM_SLUG_VARIABLE => false,
                    static::PARAM_SLUG_DEFAULT => 882,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_LANGUAGE => [
                    static::PARAM_SLUG_DEFAULT => 'en',
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_TASK => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_OBJECT,
                    static::ACTION_FIELDS => [
                        static::ACTION_FIELD_METHOD => [
                            static::PARAM_SLUG_DEFAULT => 'ImageToTextTask',
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                        ],
                        static::ACTION_FIELD_FILE => [
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_SPEC => static::PARAM_SPEC_FILE,
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                        ],
                        static::ACTION_FIELD_PHRASE => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                        ],
                        static::ACTION_FIELD_REGSENSE => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                        ],
                        static::ACTION_FIELD_NUMERIC => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                        ],
                        static::ACTION_FIELD_CALC => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_BOOLEAN,
                        ],
                        static::ACTION_FIELD_MIN_LEN => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                        ],
                        static::ACTION_FIELD_MAX_LEN => [
                            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                        ],
                    ]
                ],


//                static::ACTION_FIELD_QUESTION => [
//                    static::PARAM_SLUG_DEFAULT => 0,
//                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
//                ],
//                static::ACTION_FIELD_HEADER_ACAO => [
//                    static::PARAM_SLUG_DEFAULT => 0,
//                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
//                ],
//                static::ACTION_FIELD_TEXTINSTRUCTIONS => [
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
//                ],
//                static::ACTION_FIELD_PINGBACK => [
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
//                ],
            ],
        ];
//        $this->actions[static::ACTION_UNIVERSAL] = [
//            static::ACTION_URI => 'getTaskResult',
//            static::ACTION_METHOD => static::ACTION_METHOD_GET,
//            static::ACTION_FIELDS => [
//                static::ACTION_FIELD_KEY => [
//                    static::PARAM_SLUG_REQUIRE => true,
//                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_API_KEY,
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
//                ],
//                static::ACTION_FIELD_ACTION => [
//                    static::PARAM_SLUG_REQUIRE => true,
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
//                ],
//                static::ACTION_FIELD_HEADER_ACAO => [
//                    static::PARAM_SLUG_DEFAULT => 0,
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
//                ],
//                static::ACTION_FIELD_CAPTCHA_ID => [
//                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_CAPTCHA,
//                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
//                ],
//            ],
//        ];
        $this->actions[static::ACTION_UNIVERSAL_WITH_CAPTCHA] = [
            static::ACTION_URI => 'getTaskResult',
            static::ACTION_METHOD => static::ACTION_METHOD_GET,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_CAPTCHA_ID => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC => static::PARAM_SPEC_CAPTCHA,
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
                ],
            ],
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_RECOGNIZE] = [
            static::DECODE_SEPARATOR => '|',
            static::DECODE_PARAMS => [
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
            static::DECODE_PARAMS => [
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
            static::DECODE_PARAMS => [
                static::DECODE_PARAM_RESPONSE => [
                    static::DECODE_PARAM_SETTING_MARKER => 0,
                ],
            ],
        ];
    }

    /**
     * Баланс
     *
     * @return float
     */
    public function getBalance()
    {
        return (float)$this->requestUniversal('getbalance')[static::DECODE_PARAM_RESPONSE];
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
