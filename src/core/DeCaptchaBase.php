<?php

namespace jumper423\decaptcha\core;

/**
 * Распознавание капчи.
 *
 * Class DeCaptchaBase
 */
class DeCaptchaBase extends DeCaptchaAbstract implements DeCaptchaInterface
{
    const ACTION_RECOGNIZE = 1;
    const ACTION_UNIVERSAL = 2;
    const ACTION_UNIVERSAL_WITH_CAPTCHA = 3;

    const ACTION_FIELD_METHOD = 1;
    const ACTION_FIELD_KEY = 2;
    const ACTION_FIELD_FILE = 3;
    const ACTION_FIELD_PHRASE = 4;
    const ACTION_FIELD_REGSENSE = 5;
    const ACTION_FIELD_NUMERIC = 6;
    const ACTION_FIELD_MIN_LEN = 7;
    const ACTION_FIELD_MAX_LEN = 8;
    const ACTION_FIELD_LANGUAGE = 9;
    const ACTION_FIELD_SOFT_ID = 10;
    const ACTION_FIELD_CAPTCHA_ID = 11;
    const ACTION_FIELD_ACTION = 12;
    const ACTION_FIELD_QUESTION = 13;
    const ACTION_FIELD_CALC = 14;
    const ACTION_FIELD_HEADER_ACAO = 15;
    const ACTION_FIELD_TEXTINSTRUCTIONS = 16;
    const ACTION_FIELD_PINGBACK = 17;

    const RESPONSE_RECOGNIZE_OK = 'OK';
    const RESPONSE_RECOGNIZE_REPEAT = 'ERROR_NO_SLOT_AVAILABLE';
    const RESPONSE_GET_OK = 'OK';
    const RESPONSE_GET_REPEAT = 'CAPCHA_NOT_READY';

    const SLEEP_RECOGNIZE = 5;
    const SLEEP_GET = 2;
    const SLEEP_BETWEEN = 5;

    const DECODE_ACTION_RECOGNIZE = 1;
    const DECODE_ACTION_GET = 2;
    const DECODE_ACTION_UNIVERSAL = 3;

    const DECODE_PARAM_RESPONSE = 1;
    const DECODE_PARAM_CAPTCHA = 2;
    const DECODE_PARAM_CODE = 3;

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
     * @param array $additionally
     *
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    public function recognize($filePath, $additionally = [])
    {
        try {
            $this->resetLimits();
            $additionally[static::PARAM_SPEC_FILE] = $filePath;
            $this->setParams($additionally);

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
     * Универсальная отправка повторяющихся запросов.
     *
     * @param int      $action
     * @param int      $decodeAction
     * @param int      $setParam
     * @param int      $decodeSerParam
     * @param int      $ok
     * @param int      $sleep
     * @param int      $repeat
     * @param int|null $error
     *
     * @throws DeCaptchaErrors
     *
     * @return bool
     */
    protected function requestRepeat($action, $decodeAction, $setParam, $decodeSerParam, $ok, $sleep, $repeat, $error = null)
    {
        if (is_null($error)) {
            $error = static::DECODE_PARAM_RESPONSE;
        }
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
            throw new DeCaptchaErrors($dataRecognize[$error]);
        }
        throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_LIMIT);
    }

    /**
     * Универсальная отправка.
     *
     * @param string $action
     *
     * @return array
     */
    protected function requestUniversal($action)
    {
        $this->setParam(static::ACTION_FIELD_ACTION, $action);
        $response = $this->getResponse(static::ACTION_UNIVERSAL);

        return $this->decodeResponse(static::DECODE_ACTION_UNIVERSAL, $response);
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
