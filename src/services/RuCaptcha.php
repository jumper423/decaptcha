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
        self::ACTION_FIELD_METHOD           => 'method',
        self::ACTION_FIELD_KEY              => 'key',
        self::ACTION_FIELD_FILE             => 'file',
        self::ACTION_FIELD_PHRASE           => 'phrase',
        self::ACTION_FIELD_REGSENSE         => 'regsense',
        self::ACTION_FIELD_NUMERIC          => 'numeric',
        self::ACTION_FIELD_MIN_LEN          => 'min_len',
        self::ACTION_FIELD_MAX_LEN          => 'max_len',
        self::ACTION_FIELD_LANGUAGE         => 'language',
        self::ACTION_FIELD_SOFT_ID          => 'soft_id',
        self::ACTION_FIELD_CAPTCHA_ID       => 'id',
        self::ACTION_FIELD_ACTION           => 'action',
        self::ACTION_FIELD_QUESTION         => 'question',
        self::ACTION_FIELD_HEADER_ACAO      => 'header_acao',
        self::ACTION_FIELD_TEXTINSTRUCTIONS => 'textinstructions',
        self::ACTION_FIELD_PINGBACK         => 'pingback',
        self::ACTION_FIELD_CALC             => 'calc',
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
                    static::PARAM_SLUG_NOTWIKI    => true,
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
                ],
                static::ACTION_FIELD_REGSENSE => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_NUMERIC => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
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
                ],
                static::ACTION_FIELD_QUESTION => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_CALC => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_HEADER_ACAO => [
                    static::PARAM_SLUG_DEFAULT => 0,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
                ],
                static::ACTION_FIELD_TEXTINSTRUCTIONS => [
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_PINGBACK => [
                    static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
                ],
                static::ACTION_FIELD_SOFT_ID => [
                    static::PARAM_SLUG_VARIABLE => false,
                    static::PARAM_SLUG_DEFAULT  => 882,
                    static::PARAM_SLUG_TYPE     => static::PARAM_FIELD_TYPE_INTEGER,
                    static::PARAM_SLUG_NOTWIKI    => true,
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
                    static::PARAM_SLUG_SPEC    => static::PARAM_SPEC_CAPTCHA,
                    static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
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
