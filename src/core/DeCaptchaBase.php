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

    const ACTION_RECOGNIZE = 0;
    const ACTION_UNIVERSAL = 1;
    const ACTION_UNIVERSAL_WITH_CAPTCHA = 2;

    protected $paramsNames = [
        self::PARAM_FIELD_METHOD     => 'method',
        self::PARAM_FIELD_KEY        => 'key',
        self::PARAM_FIELD_FILE       => 'file',
        self::PARAM_FIELD_PHRASE     => 'phrase',
        self::PARAM_FIELD_REGSENSE   => 'regsense',
        self::PARAM_FIELD_NUMERIC    => 'numeric',
        self::PARAM_FIELD_MIN_LEN    => 'min_len',
        self::PARAM_FIELD_MAX_LEN    => 'max_len',
        self::PARAM_FIELD_LANGUAGE   => 'language',
        self::PARAM_FIELD_SOFT_ID    => 'soft_id',
        self::PARAM_FIELD_CAPTCHA_ID => 'id',
        self::PARAM_FIELD_ACTION     => 'action',
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
        ],
    ];

    public function recognize($filePath)
    {
        try {
            $this->setParamSpec(static::PARAM_SPEC_FILE, $this->getFilePath($filePath));
            $result = $this->getCurlResponse($this->getInUrl(), $this->getParams(static::ACTION_RECOGNIZE));
            $this->setError($result);
            list(, $this->captchaId) = explode('|', $result);
            $waitTime = 0;
            sleep($this->requestTimeout);
            while (true) {
                $result = $this->getResponse('get');
                $this->setError($result);
                if ($result == 'CAPCHA_NOT_READY') {
                    $waitTime += $this->requestTimeout;
                    if ($waitTime > $this->maxTimeout) {
                        break;
                    }
                    sleep($this->requestTimeout);
                } else {
                    $ex = explode('|', $result);
                    if (trim($ex[0]) == 'OK') {
                        $this->result = trim($ex[1]);

                        return true;
                    }
                }
            }
            throw new Exception('Лимит времени превышен');
        } catch (Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }
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
    const DECODE_TYPES = 1;
    const DECODE_SEPARATOR = 2;

    const DECODE_TYPE_RECOGNIZE = 0;

    protected $decodeSettings = [
        self::DECODE_FORMAT => self::RESPONSE_TYPE_STRING,
        self::DECODE_TYPES => [
            self::DECODE_TYPE_RECOGNIZE => [
                self::DECODE_SEPARATOR => '|',
            ],
        ],
    ];

    protected function decodeResponse($data, $type, $format = self::RESPONSE_TYPE_STRING)
    {
        $result = [
            'type' => null,
            'data' => null,
        ];
        switch ($this->responseType) {
            case self::RESPONSE_TYPE_STRING:

                if ($type) {
                    $array = explode('|', $this->responseType);
                }

                break;
        }
    }
}
