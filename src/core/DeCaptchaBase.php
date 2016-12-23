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
        self::ACTION_RECOGNIZE => [],
        self::ACTION_UNIVERSAL => [],
        self::ACTION_UNIVERSAL_WITH_CAPTCHA => [],
    ];

    protected $decodeSettings = [
        self::DECODE_FORMAT => self::RESPONSE_TYPE_STRING,
        self::DECODE_ACTION => [
            self::DECODE_ACTION_RECOGNIZE => [],
            self::DECODE_ACTION_GET => [],
            self::DECODE_ACTION_BALANCE => [],
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
     * Универсальная отправка повторяющихся запросов
     * @param $action
     * @param $decodeAction
     * @param $setParam
     * @param $decodeSerParam
     * @param $ok
     * @param $sleep
     * @param $repeat
     * @return bool
     * @throws DeCaptchaErrors
     */
    protected function requestRepeat($action, $decodeAction, $setParam, $decodeSerParam, $ok, $sleep, $repeat){
        while ($this->limitHasNotYetEnded($action)) {
            $this->executionDelayed($sleep);
            $response = $this->getResponse($action);
            $dataRecognize = $this->decodeResponse($decodeAction, $response);
            if ($dataRecognize[static::DECODE_PARAM_RESPONSE] === $ok && !empty($dataRecognize[$decodeSerParam])) {
                $this->setParam($setParam, $dataRecognize[$decodeSerParam]);
                $this->executionDelayed(static::SLEEP_BETWEEN);

                return true;
            } elseif ($dataRecognize[static::DECODE_PARAM_RESPONSE] === $repeat) {
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
    protected function requestRecognize()
    {
        return $this->requestRepeat(static::ACTION_RECOGNIZE, static::DECODE_ACTION_RECOGNIZE, static::PARAM_SPEC_CAPTCHA, static::DECODE_PARAM_CAPTCHA, static::RESPONSE_RECOGNIZE_OK, static::SLEEP_RECOGNIZE, static::RESPONSE_RECOGNIZE_REPEAT);
    }

    /**
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestCode()
    {
        return $this->requestRepeat(static::ACTION_UNIVERSAL_WITH_CAPTCHA, static::DECODE_ACTION_GET, static::PARAM_SPEC_CODE, static::DECODE_PARAM_CODE, static::RESPONSE_GET_OK, static::SLEEP_GET, static::RESPONSE_GET_REPEAT);
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
