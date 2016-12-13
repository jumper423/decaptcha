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
    const PARAM_FIELD_METHOD = 'method';
    const PARAM_FIELD_KEY = 'key';
    const PARAM_FIELD_FILE = 'file';
    const PARAM_FIELD_PHRASE = 'phrase';
    const PARAM_FIELD_REGSENSE = 'regsense';
    const PARAM_FIELD_NUMERIC = 'numeric';
    const PARAM_FIELD_MIN_LEN = 'min_len';
    const PARAM_FIELD_MAX_LEN = 'max_len';
    const PARAM_FIELD_LANGUAGE = 'language';
    const PARAM_FIELD_SOFT_ID = 'soft_id';

    const PARAM_FIELD_TYPE_STRING = 0;
    const PARAM_FIELD_TYPE_INTEGER = 1;

    const PARAM_SLUG_DEFAULT = 0;
    const PARAM_SLUG_TYPE = 1;
    const PARAM_SLUG_REQUIRE = 2;
    const PARAM_SLUG_SPEC = 3;
    const PARAM_SLUG_VARIABLE = 4;

    const PARAM_SPEC_KEY = 0;
    const PARAM_SPEC_FILE = 1;

    protected $params = [
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
    ];

    public function recognize($filePath)
    {
        $this->result = null;
        $this->error = null;
        try {
            $filePath = $this->getFilePath($filePath);
            $result = $this->getCurlResponse($this->getPostData($filePath));
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

    /**
     * @param string $filePath
     */
    protected function getPostData($filePath)
    {
        return [
            'method'   => 'post',
            'key'      => $this->apiKey,
            'file'     => (version_compare(PHP_VERSION, '5.5.0') >= 0) ? new \CURLFile($filePath) : '@'.$filePath,
            'phrase'   => $this->isPhrase,
            'regsense' => $this->isRegSense,
            'numeric'  => $this->isNumeric,
            'min_len'  => $this->minLen,
            'max_len'  => $this->maxLen,
            'language' => $this->language,
            'soft_id'  => 882,
        ];
    }

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
