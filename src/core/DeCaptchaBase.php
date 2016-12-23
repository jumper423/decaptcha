<?php

namespace jumper423\decaptcha\core;

/**
 * Распознавание капчи.
 *
 * Class DeCaptchaBase
 */
class DeCaptchaBase extends DeCaptchaAbstract implements DeCaptchaInterface
{
    const ACTION_RECOGNIZE = 0;
    const ACTION_UNIVERSAL = 1;
    const ACTION_UNIVERSAL_WITH_CAPTCHA = 2;

    const ACTION_FIELD_METHOD = 0;
    const ACTION_FIELD_KEY = 1;
    const ACTION_FIELD_FILE = 2;
    const ACTION_FIELD_PHRASE = 3;
    const ACTION_FIELD_REGSENSE = 4;
    const ACTION_FIELD_NUMERIC = 5;
    const ACTION_FIELD_MIN_LEN = 6;
    const ACTION_FIELD_MAX_LEN = 7;
    const ACTION_FIELD_LANGUAGE = 8;
    const ACTION_FIELD_SOFT_ID = 9;
    const ACTION_FIELD_CAPTCHA_ID = 10;
    const ACTION_FIELD_ACTION = 11;
    const ACTION_FIELD_QUESTION = 12;
    const ACTION_FIELD_CALC = 13;
    const ACTION_FIELD_HEADER_ACAO = 14;
    const ACTION_FIELD_TEXTINSTRUCTIONS = 15;
    const ACTION_FIELD_PINGBACK = 16;

    const RESPONSE_RECOGNIZE_OK = 'OK';
    const RESPONSE_RECOGNIZE_REPEAT = 'ERROR_NO_SLOT_AVAILABLE';
    const RESPONSE_GET_OK = 'OK';
    const RESPONSE_GET_REPEAT = 'CAPCHA_NOT_READY';

    const SLEEP_RECOGNIZE = 5;
    const SLEEP_GET = 2;
    const SLEEP_BETWEEN = 5;

    const DECODE_ACTION_RECOGNIZE = 0;
    const DECODE_ACTION_GET = 1;
    const DECODE_ACTION_BALANCE = 2;

    const DECODE_PARAM_RESPONSE = 0;
    const DECODE_PARAM_CAPTCHA = 1;
    const DECODE_PARAM_CODE = 2;

    protected $actions = [
        self::ACTION_RECOGNIZE              => [],
        self::ACTION_UNIVERSAL              => [],
        self::ACTION_UNIVERSAL_WITH_CAPTCHA => [],
    ];

    protected $decodeSettings = [
        self::DECODE_FORMAT => self::RESPONSE_TYPE_STRING,
        self::DECODE_ACTION => [
            self::DECODE_ACTION_RECOGNIZE => [],
            self::DECODE_ACTION_GET       => [],
            self::DECODE_ACTION_BALANCE   => [],
        ],
    ];

    protected $limitSettings = [
        self::ACTION_RECOGNIZE              => 3,
        self::ACTION_UNIVERSAL_WITH_CAPTCHA => 20,
    ];

    /**
     * DeCaptchaBase constructor.
     *
     * @param $params
     */
    public function __construct($params)
    {
        $this->setParams($params);
        $this->init();
    }

    public function init()
    {
    }

    /**
     * @param $filePath
     *
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    public function recognize($filePath)
    {
        try {
            $this->resetLimits();
            $this->setParam(static::PARAM_SPEC_FILE, $this->getFilePath($filePath));

            return $this->requestRecognize() && $this->requestCode();
        } catch (DeCaptchaErrors $e) {
            if ($this->causeAnError) {
                throw $e;
            }
            $this->errorObject = $e;

            return false;
        }
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
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestRecognize()
    {
        while ($this->limitHasNotYetEnded(static::ACTION_RECOGNIZE)) {
            $this->executionDelayed(static::SLEEP_RECOGNIZE);
            $response = $this->getResponse(static::ACTION_RECOGNIZE);
            $dataRecognize = $this->decodeResponse(static::DECODE_ACTION_RECOGNIZE, $response);
            if ($dataRecognize[static::DECODE_PARAM_RESPONSE] === static::RESPONSE_RECOGNIZE_OK && !empty($dataRecognize[static::DECODE_PARAM_CAPTCHA])) {
                $this->setParam(static::PARAM_SPEC_CAPTCHA, $dataRecognize[static::DECODE_PARAM_CAPTCHA]);
                $this->executionDelayed(static::SLEEP_BETWEEN);

                return true;
            } elseif ($dataRecognize[static::DECODE_PARAM_RESPONSE] === static::RESPONSE_RECOGNIZE_REPEAT) {
                continue;
            }
            throw new DeCaptchaErrors($dataRecognize[static::DECODE_PARAM_RESPONSE]);
        }
        throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_LIMIT);
    }

    /**
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestCode()
    {
        while ($this->limitHasNotYetEnded(static::ACTION_UNIVERSAL_WITH_CAPTCHA)) {
            $this->executionDelayed(static::SLEEP_GET);
            $response = $this->getResponse(static::ACTION_UNIVERSAL_WITH_CAPTCHA);
            $dataGet = $this->decodeResponse(static::DECODE_ACTION_GET, $response);
            if ($dataGet[static::DECODE_PARAM_RESPONSE] === static::RESPONSE_GET_OK && !empty($dataGet[static::DECODE_PARAM_CODE])) {
                $this->setParam(static::PARAM_SPEC_CODE, $dataGet[static::DECODE_PARAM_CODE]);

                return true;
            } elseif ($dataGet[static::DECODE_PARAM_RESPONSE] === static::RESPONSE_GET_REPEAT) {
                continue;
            }
            throw new DeCaptchaErrors($dataGet[static::DECODE_PARAM_RESPONSE]);
        }
        throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_LIMIT);
    }

    /**
     * @return \CURLFile|mixed|null|string
     */
    public function getCode()
    {
        return $this->getParamSpec(static::PARAM_SPEC_CODE);
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->errorObject->getMessage();
    }

    /**
     * @param bool $causeAnError
     */
    public function setCauseAnError($causeAnError)
    {
        $this->causeAnError = $causeAnError;
    }
}
