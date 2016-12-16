<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Распознавание капчи.
 *
 * Class DeCaptchaBase
 */
class DeCaptchaBase extends DeCaptchaAbstract implements DeCaptchaInterface
{
    const PARAM_FIELD_METHOD = 0;
    const PARAM_FIELD_KEY = 1;
    const PARAM_FIELD_FILE = 2;
    const PARAM_FIELD_PHRASE = 3;
    const PARAM_FIELD_REGSENSE = 4;
    const PARAM_FIELD_NUMERIC = 5;
    const PARAM_FIELD_MIN_LEN = 6;
    const PARAM_FIELD_MAX_LEN = 7;
    const PARAM_FIELD_LANGUAGE = 8;
    const PARAM_FIELD_SOFT_ID = 9;
    const PARAM_FIELD_CAPTCHA_ID = 10;
    const PARAM_FIELD_ACTION = 11;
    const PARAM_FIELD_QUESTION = 12;
    const PARAM_FIELD_CALC = 13;
    const PARAM_FIELD_HEADER_ACAO = 14;
    const PARAM_FIELD_TEXTINSTRUCTIONS = 15;
    const PARAM_FIELD_PINGBACK = 16;

    const ACTION_RECOGNIZE = 0;
    const ACTION_UNIVERSAL = 1;
    const ACTION_UNIVERSAL_WITH_CAPTCHA = 2;

    protected $paramsNames = [
        self::PARAM_FIELD_METHOD               => 'method',
        self::PARAM_FIELD_KEY                  => 'key',
        self::PARAM_FIELD_FILE                 => 'file',
        self::PARAM_FIELD_PHRASE               => 'phrase',
        self::PARAM_FIELD_REGSENSE             => 'regsense',
        self::PARAM_FIELD_NUMERIC              => 'numeric',
        self::PARAM_FIELD_MIN_LEN              => 'min_len',
        self::PARAM_FIELD_MAX_LEN              => 'max_len',
        self::PARAM_FIELD_LANGUAGE             => 'language',
        self::PARAM_FIELD_SOFT_ID              => 'soft_id',
        self::PARAM_FIELD_CAPTCHA_ID           => 'id',
        self::PARAM_FIELD_ACTION               => 'action',
        self::PARAM_FIELD_QUESTION             => 'question',
        self::PARAM_FIELD_HEADER_ACAO          => 'header_acao',
        self::PARAM_FIELD_TEXTINSTRUCTIONS     => 'textinstructions',
        self::PARAM_FIELD_PINGBACK             => 'pingback',
    ];

    protected $paramsSettings = [
        self::ACTION_RECOGNIZE => [
            self::PARAM_FIELD_METHOD => [
                self::PARAM_SLUG_DEFAULT => 'post',
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_KEY => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_SPEC    => self::PARAM_SPEC_KEY,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_FILE => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_SPEC    => self::PARAM_SPEC_FILE,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_PHRASE => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_REGSENSE => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_NUMERIC => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_MIN_LEN => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_MAX_LEN => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_LANGUAGE => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_QUESTION => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_CALC => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_HEADER_ACAO => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_TEXTINSTRUCTIONS => [
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_PINGBACK => [
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_SOFT_ID => [
                self::PARAM_SLUG_VARIABLE => false,
                self::PARAM_SLUG_TYPE     => self::PARAM_FIELD_TYPE_INTEGER,
            ],
        ],
        self::ACTION_UNIVERSAL => [
            self::PARAM_FIELD_KEY => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_SPEC    => self::PARAM_SPEC_KEY,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_ACTION => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_HEADER_ACAO => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
        ],
        self::ACTION_UNIVERSAL_WITH_CAPTCHA => [
            self::PARAM_FIELD_KEY => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_SPEC    => self::PARAM_SPEC_KEY,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_CAPTCHA_ID => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_SPEC    => self::PARAM_SPEC_CAPTCHA,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
            self::PARAM_FIELD_ACTION => [
                self::PARAM_SLUG_REQUIRE => true,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_STRING,
            ],
            self::PARAM_FIELD_HEADER_ACAO => [
                self::PARAM_SLUG_DEFAULT => 0,
                self::PARAM_SLUG_TYPE    => self::PARAM_FIELD_TYPE_INTEGER,
            ],
        ],
    ];

    protected $code;

    protected $limitSettings = [
        self::ACTION_RECOGNIZE => 3,
        self::ACTION_UNIVERSAL_WITH_CAPTCHA => 20,
    ];

    protected $limit = [];

    protected function clearLimit(){
        foreach ($this->limitSettings as $action => $value) {
            $this->limit[$action] = $value;
        }
    }

    public function recognize($filePath)
    {
        try {
            $this->clearLimit();
            $this->setParamSpec(static::PARAM_SPEC_FILE, $this->getFilePath($filePath));
            $response = $this->getCurlResponse($this->getInUrl(), $this->getParams(static::ACTION_RECOGNIZE));
            $data = $this->decodeResponse(static::DECODE_ACTION_RECOGNIZE, $response);
            if ($data[static::DECODE_PARAM_RESPONSE] === 'OK' && !empty($data[static::DECODE_PARAM_CAPTCHA])) {
                $this->setParamSpec(static::PARAM_SPEC_CAPTCHA, $data[static::DECODE_PARAM_CAPTCHA]);
            } else {
                if ($data[static::DECODE_PARAM_RESPONSE] === 'ERROR_NO_SLOT_AVAILABLE' && $this->limit[static::ACTION_RECOGNIZE] > 0) {
                    $this->limit[static::ACTION_RECOGNIZE]--;
                    return $this->recognize($filePath);
                }
                throw new DeCaptchaErrors($data[static::DECODE_PARAM_RESPONSE]);
            }
            while ($this->limit[static::ACTION_UNIVERSAL_WITH_CAPTCHA] > 0) {
                $response = $this->getResponse(static::ACTION_UNIVERSAL_WITH_CAPTCHA);
                $data = $this->decodeResponse(static::DECODE_ACTION_GET, $response);
                if ($data[static::DECODE_PARAM_RESPONSE] === 'OK' && !empty($data[static::DECODE_PARAM_CODE])) {
                    $this->code = $data[static::DECODE_PARAM_CODE];
                    return true;
                } else {
                    $this->limit[static::ACTION_UNIVERSAL_WITH_CAPTCHA]--;
                    if ($data[static::DECODE_PARAM_RESPONSE] === 'CAPCHA_NOT_READY' && $this->limit[static::ACTION_UNIVERSAL_WITH_CAPTCHA] > 0) {
                        continue;
                    }
                    throw new DeCaptchaErrors($data[static::DECODE_PARAM_RESPONSE]);
                }
            }
        } catch (Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }
        return false;
    }

    public function getCode()
    {
    }

    public function getError()
    {
    }

    /**
     * Запуск распознавания капчи.
     *
     * @deprecated
     *
     * @param string $filePath Путь до файла или ссылка на него
     *
     * @return bool
     */
    public function run($filePath)
    {
        return $this->recognize($filePath);
    }

    /**
     * Не верно распознана.
     */
    public function notTrue()
    {
        $this->getResponse('reportbad');
    }

    const DECODE_FORMAT = 0;
    const DECODE_ACTION = 1;
    const DECODE_SEPARATOR = 2;
    const DECODE_PARAMS = 3;
    const DECODE_PARAM_SETTING_MARKER = 4;

    const DECODE_ACTION_RECOGNIZE = 0;
    const DECODE_ACTION_GET = 1;

    const DECODE_PARAM_RESPONSE = 0;
    const DECODE_PARAM_CAPTCHA = 1;
    const DECODE_PARAM_CODE = 2;

    protected $decodeSettings = [
        self::DECODE_FORMAT => self::RESPONSE_TYPE_STRING,
        self::DECODE_ACTION => [
            self::DECODE_ACTION_RECOGNIZE => [
                self::DECODE_SEPARATOR => '|',
                self::DECODE_PARAMS    => [
                    self::DECODE_PARAM_RESPONSE => [
                        self::DECODE_PARAM_SETTING_MARKER => 0,
                    ],
                    self::DECODE_PARAM_CAPTCHA => [
                        self::DECODE_PARAM_SETTING_MARKER => 1,
                    ],
                ],
            ],
            self::DECODE_ACTION_GET => [
                self::DECODE_SEPARATOR => '|',
                self::DECODE_PARAMS    => [
                    self::DECODE_PARAM_RESPONSE => [
                        self::DECODE_PARAM_SETTING_MARKER => 0,
                    ],
                    self::DECODE_PARAM_CODE => [
                        self::DECODE_PARAM_SETTING_MARKER => 1,
                    ],
                ],
            ],
        ],
    ];

    protected function decodeResponse($action, $data)
    {
        if (!array_key_exists($action, $this->decodeSettings[static::DECODE_ACTION])) {
            throw new DeCaptchaErrors('нет action');
        }
        $decodeSetting = $this->decodeSettings[static::DECODE_ACTION][$action];
        $decodeFormat = array_key_exists(static::DECODE_FORMAT, $decodeSetting) ?
            $decodeSetting[static::DECODE_FORMAT] :
            $this->decodeSettings[static::DECODE_FORMAT];
        $values = [];
        switch ($decodeFormat) {
            case static::RESPONSE_TYPE_STRING:
                foreach (explode($decodeFormat[static::DECODE_SEPARATOR], $data) as $key => $value) {
                    foreach ($decodeFormat[static::DECODE_PARAMS] as $param => $paramKey) {
                        if ($key === $paramKey) {
                            $values[$param] = $value;
                        }
                    }
                }
                break;
        }

        return $values;
    }
}
