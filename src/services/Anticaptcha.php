<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

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

    const DECODE_PARAM_ERROR = 3;
    const DECODE_PARAM_BALANCE = 4;

    const ACTION_FIELD_TASK = 17;
    const PARAM_FIELD_TYPE_OBJECT = 3;
    const PARAM_FIELD_TYPE_BOOLEAN = 4;

    const ACTION_BALANCE = 3;
    const DECODE_ACTION_BALANCE = 3;

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
            static::ACTION_JSON => true,
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
                ],
                static::ACTION_FIELD_LANGUAGE => [
                    static::PARAM_SLUG_DEFAULT => 'en',
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_TASK => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_OBJECT,
                    static::ACTION_FIELDS      => [
                        static::ACTION_FIELD_METHOD => [
                            static::PARAM_SLUG_DEFAULT => 'ImageToTextTask',
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                        ],
                        static::ACTION_FIELD_FILE => [
                            static::PARAM_SLUG_REQUIRE => true,
                            static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_FILE,
                            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
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
                    ],
                ],
            ],
        ];
        $this->actions[static::ACTION_UNIVERSAL_WITH_CAPTCHA] = [
            static::ACTION_URI    => 'getTaskResult',
            static::ACTION_METHOD => static::ACTION_METHOD_POST,
            static::ACTION_JSON => true,
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
            static::ACTION_JSON => true,
            static::ACTION_FIELDS => [
                static::ACTION_FIELD_KEY => [
                    static::PARAM_SLUG_REQUIRE => true,
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_API_KEY,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
                ],
            ],
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_RECOGNIZE] = [
            static::DECODE_FORMAT    => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS    => [
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
            static::DECODE_FORMAT    => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS    => [
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
            static::DECODE_FORMAT    => static::RESPONSE_TYPE_JSON,
            static::DECODE_PARAMS    => [
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
