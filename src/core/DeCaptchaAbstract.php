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

    /**
     * Сервис на который будем загружать капчу.
     *
     * @var string
     */
    protected $domain;

    protected $errorLang = DeCaptchaErrors::LANG_EN;

    protected $responseType = self::RESPONSE_TYPE_STRING;
    /**
     * Ваш API key.
     *
     * @var string
     */
    protected $apiKey;
    /**
     * @var int
     */
    protected $captchaId;

    protected $inUrl = 'in.php';
    protected $resUrl = 'res.php';

    /**
     * @return void
     */
    abstract public function notTrue();

    public function setErrorLang($errorLang)
    {
        $this->errorLang = $errorLang;
    }

    abstract protected function decodeResponse($data, $type);

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
     * @return string
     */
    protected function getBaseUrl()
    {
        return "http://{$this->domain}/";
    }

    const PARAM_FIELD_TYPE_STRING = 0;
    const PARAM_FIELD_TYPE_INTEGER = 1;

    const PARAM_SLUG_DEFAULT = 0;
    const PARAM_SLUG_TYPE = 1;
    const PARAM_SLUG_REQUIRE = 2;
    const PARAM_SLUG_SPEC = 3;
    const PARAM_SLUG_VARIABLE = 4;

    const PARAM_SPEC_KEY = 0;
    const PARAM_SPEC_FILE = 1;
    const PARAM_SPEC_CAPTCHA = 2;
    const PARAM_SPEC_CODE = 3;

    protected $paramsNames = [];

    protected $paramsSettings = [];

    protected $paramsSpec = [];

    protected $params = [];

    public function setParams($params)
    {
        if (is_array($params)) {
            foreach ($params as $param => $value) {
                $this->params[$param] = $value;
            }
        }
    }

    public function setParamSpec($param, $value)
    {
        $this->paramsSpec[$param] = $value;
    }

    public function getParamSpec($param)
    {
        if (!array_key_exists($param, $this->paramsSpec) || is_null($this->paramsSpec[$param])) {
            return null;
        }
        switch ($param) {
            case static::PARAM_SPEC_FILE:
                return (version_compare(PHP_VERSION, '5.5.0') >= 0) ? new \CURLFile($this->paramsSpec[$param]) : '@'.$this->paramsSpec[$param];
            case static::PARAM_SPEC_KEY:
                return is_callable($this->paramsSpec[$param]) ? $this->paramsSpec[$param]() : $this->paramsSpec[$param];
            case static::PARAM_SPEC_CAPTCHA:
            case static::PARAM_SPEC_CODE:
                return $this->paramsSpec[$param];
        }

        return null;
    }

    protected function getParams($action)
    {
        if (empty($this->paramsSettings[$action])) {
            return [];
        }
        $params = [];
        foreach ($this->paramsSettings[$action] as $field => $settings) {
            $value = null;
            if (array_key_exists($field, $this->params) && (!array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) ^ (array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) && $settings[self::PARAM_SLUG_VARIABLE] === false))) {
                $value = $this->params[$field];
            }
            if (array_key_exists(self::PARAM_SLUG_DEFAULT, $settings)) {
                $value = $settings[self::PARAM_SLUG_DEFAULT];
            }
            if (array_key_exists(self::PARAM_SLUG_SPEC, $settings) && array_key_exists($settings[self::PARAM_SLUG_SPEC], $this->paramsSpec)) {
                $value = $this->getParamSpec($settings[self::PARAM_SLUG_SPEC]);
            }
            if (array_key_exists(self::PARAM_SLUG_REQUIRE, $settings) && $settings[self::PARAM_SLUG_REQUIRE] === true && is_null($value)) {
                throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_PARAM_REQUIRE, array_key_exists($field, $this->paramsNames) ? $this->paramsNames[$field] : $field, $this->errorLang);
            }
            if (array_key_exists($field, $this->paramsNames)) {
                switch ($settings[self::PARAM_SLUG_TYPE]) {
                    case self::PARAM_FIELD_TYPE_INTEGER:
                        $params[$this->paramsNames[$field]] = (int) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_STRING:
                        $params[$this->paramsNames[$field]] = (string) $value;
                        break;
                }
            }
        }

        return $params;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function getActionUrl($data)
    {
        $uri = [];
        foreach ($data as $key => $value) {
            $uri[] = "$key=$value";
        }

        return "{$this->getBaseUrl()}{$this->resUrl}?".implode('&', $uri);
    }

    /**
     * @param string $action
     *
     * @return string
     */
    protected function getResponse($action)
    {
        return file_get_contents($this->getActionUrl($this->getParams($action)));
    }

    /**
     * @return string
     */
    protected function getInUrl()
    {
        return $this->getBaseUrl().$this->inUrl;
    }

    /**
     * Проверка на то произошла ли ошибка.
     *
     * @param $error
     *
     * @throws DeCaptchaErrors
     */
    protected function isError($error)
    {
        if (strpos($error, 'ERROR') !== false) {
            throw new DeCaptchaErrors($error, null, $this->errorLang);
        }
    }

    protected $lastRunTime = null;

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
     * @param $url
     * @param $data
     *
     * @throws DeCaptchaErrors
     *
     * @return mixed
     */
    protected function getCurlResponse($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (version_compare(PHP_VERSION, '5.5.0') >= 0 && version_compare(PHP_VERSION, '7.0') < 0 && defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_CURL, curl_error($ch), $this->errorLang);
        }
        curl_close($ch);

        return $result;
    }
}
