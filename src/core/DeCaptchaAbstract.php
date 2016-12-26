<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Class DeCaptchaAbstract.
 */
abstract class DeCaptchaAbstract implements DeCaptchaInterface
{
    const RESPONSE_TYPE_STRING = 0;
    const RESPONSE_TYPE_JSON = 1;

    const ACTION_FIELDS = 0;
    const ACTION_URI = 1;
    const ACTION_METHOD = 2;

    const ACTION_METHOD_POST = 0;
    const ACTION_METHOD_GET = 1;

    const DECODE_FORMAT = 0;
    const DECODE_ACTION = 1;
    const DECODE_SEPARATOR = 2;
    const DECODE_PARAMS = 3;
    const DECODE_PARAM_SETTING_MARKER = 4;

    const PARAM_FIELD_TYPE_STRING = 0;
    const PARAM_FIELD_TYPE_INTEGER = 1;
    const PARAM_FIELD_TYPE_MIX = 2;

    const PARAM_SLUG_DEFAULT = 0;
    const PARAM_SLUG_TYPE = 1;
    const PARAM_SLUG_REQUIRE = 2;
    const PARAM_SLUG_SPEC = 3;
    const PARAM_SLUG_VARIABLE = 4;

    const PARAM_SPEC_API_KEY = -1;
    const PARAM_SPEC_FILE = -2;
    const PARAM_SPEC_CAPTCHA = -3;
    const PARAM_SPEC_CODE = -4;

    /**
     * Сервис на который будем загружать капчу.
     *
     * @var string
     */
    protected $host;
    protected $scheme = 'http';
    protected $errorLang = DeCaptchaErrors::LANG_EN;
    protected $lastRunTime = null;
    /** @var DeCaptchaErrors */
    protected $errorObject;
    protected $causeAnError = false;

    protected $limit = [];
    protected $paramsSpec = [];
    protected $params = [];
    protected $limitSettings = [];
    protected $decodeSettings = [];
    protected $actions = [];
    protected $paramsNames = [];

    protected function resetLimits()
    {
        foreach ($this->limitSettings as $action => $value) {
            $this->limit[$action] = $value;
        }
    }

    /**
     * @param $action
     *
     * @return bool
     */
    protected function limitHasNotYetEnded($action)
    {
        return $this->limit[$action]-- > 0;
    }

    /**
     * @param $action
     * @param $data
     *
     * @throws DeCaptchaErrors
     *
     * @return array
     */
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
                foreach (explode($decodeSetting[static::DECODE_SEPARATOR], $data) as $key => $value) {
                    foreach ($decodeSetting[static::DECODE_PARAMS] as $param => $paramSetting) {
                        if ($key === $paramSetting[static::DECODE_PARAM_SETTING_MARKER]) {
                            $values[$param] = $value;
                        }
                    }
                }
                break;
        }

        return $values;
    }

    /**
     * @param $errorLang
     */
    public function setErrorLang($errorLang)
    {
        $this->errorLang = $errorLang;
    }

    /**
     * Узнаём путь до файла
     * Если передана ссылка, то скачиваем и кладём во временную директорию.
     *
     * @param string $fileName
     *
     * @throws Exception
     *
     * @return string
     */
    protected function getFilePath($fileName)
    {
        if (strpos($fileName, 'http://') !== false || strpos($fileName, 'https://') !== false) {
            try {
                $current = file_get_contents($fileName);
            } catch (\Exception $e) {
                throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_FILE_IS_NOT_LOADED, $fileName, $this->errorLang);
            }
            $path = tempnam(sys_get_temp_dir(), 'captcha');
            file_put_contents($path, $current);

            return $path;
        }
        if (file_exists($fileName)) {
            return $fileName;
        }
        throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_FILE_NOT_FOUND, $fileName, $this->errorLang);
    }

    /**
     * @param $action
     *
     * @return string
     */
    protected function getActionUrl($action)
    {
        return $this->getBaseUrl().$this->actions[$action][static::ACTION_URI];
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return "{$this->scheme}://{$this->host}/";
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        if (is_array($params)) {
            foreach ($params as $param => $value) {
                $this->params[$param] = $value;
            }
        }
    }

    /**
     * @param $param
     * @param $value
     */
    public function setParam($param, $value)
    {
        $this->params[$param] = $value;
    }

    /**
     * @param $param
     *
     * @return \CURLFile|mixed|null|string
     */
    public function getParamSpec($param)
    {
        if (!array_key_exists($param, $this->params) || is_null($this->params[$param])) {
            return null;
        }
        switch ($param) {
            case static::PARAM_SPEC_FILE:
                return (version_compare(PHP_VERSION, '5.5.0') >= 0) ? new \CURLFile($this->getFilePath($this->params[$param])) : '@'.$this->getFilePath($this->params[$param]);
            case static::PARAM_SPEC_API_KEY:
                return is_callable($this->params[$param]) ? $this->params[$param]() : $this->params[$param];
            case static::PARAM_SPEC_CAPTCHA:
                return (int) $this->params[$param];
            case static::PARAM_SPEC_CODE:
                return (string) $this->params[$param];
        }

        return null;
    }

    /**
     * @param $action
     *
     * @throws DeCaptchaErrors
     *
     * @return array
     */
    protected function getParams($action)
    {
        if (empty($this->actions[$action])) {
            return [];
        }
        $params = [];
        foreach ($this->actions[$action][static::ACTION_FIELDS] as $field => $settings) {
            $value = null;
            if (array_key_exists($field, $this->params) && (!array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) ^ (array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) && $settings[self::PARAM_SLUG_VARIABLE] === false))) {
                $value = $this->params[$field];
            }
            if (array_key_exists(self::PARAM_SLUG_DEFAULT, $settings)) {
                $value = $settings[self::PARAM_SLUG_DEFAULT];
            }
            if (array_key_exists(self::PARAM_SLUG_SPEC, $settings) && array_key_exists($settings[self::PARAM_SLUG_SPEC], $this->params)) {
                $value = $this->getParamSpec($settings[self::PARAM_SLUG_SPEC]);
            }
            if (is_null($value)) {
                if (array_key_exists(self::PARAM_SLUG_REQUIRE, $settings) && $settings[self::PARAM_SLUG_REQUIRE] === true) {
                    throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_PARAM_REQUIRE, array_key_exists($field, $this->paramsNames) ? $this->paramsNames[$field] : $field, $this->errorLang);
                }
                continue;
            }
            if (array_key_exists($field, $this->paramsNames)) {
                switch ($settings[self::PARAM_SLUG_TYPE]) {
                    case self::PARAM_FIELD_TYPE_INTEGER:
                        $params[$this->paramsNames[$field]] = (int) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_STRING:
                        $params[$this->paramsNames[$field]] = (string) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_MIX:
                        $params[$this->paramsNames[$field]] = $value;
                        break;
                }
            }
        }

        return $params;
    }

    /**
     * @param string $action
     *
     * @return string
     */
    protected function getResponse($action)
    {
        return $this->getCurlResponse($this->getActionUrl($action), $this->getParams($action), $this->actions[$action][static::ACTION_METHOD] === static::ACTION_METHOD_POST);
    }

    /**
     * Задержка выполнения.
     *
     * @param int           $delay    Количество секунд
     * @param \Closure|null $callback
     *
     * @return mixed
     */
    protected function executionDelayed($delay = 0, $callback = null)
    {
        $time = microtime(true);
        $timePassed = $time - $this->lastRunTime;
        if ($timePassed < $delay) {
            usleep(($delay - $timePassed) * 1000000);
        }
        $this->lastRunTime = microtime(true);

        return $callback instanceof \Closure ? $callback($this) : $callback;
    }

    /**
     * @param string $url
     * @param $data
     * @param bool $isPost
     * @param bool $isJson
     *
     * @throws DeCaptchaErrors
     *
     * @return mixed
     */
    protected function getCurlResponse($url, $data, $isPost = true, $isJson = false)
    {
        $ch = curl_init();
        if ($isJson) {
            $data = json_encode($data);
        } elseif (!$isPost) {
            $uri = [];
            foreach ($data as $key => $value) {
                $uri[] = "$key=$value";
            }
            $url .= '?'.implode('&', $uri);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!$isJson && version_compare(PHP_VERSION, '5.5.0') >= 0 && version_compare(PHP_VERSION, '7.0') < 0 && defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, $isPost);
        if ($isPost) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        if ($isJson) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
                'Content-Length: ' . strlen($data)
            ]);
        }
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_CURL, curl_error($ch), $this->errorLang);
        }
        curl_close($ch);

        return $result;
    }

    abstract public function getCode();

    abstract public function getError();
}
