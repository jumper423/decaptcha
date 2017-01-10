<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Class DeCaptchaAbstract.
 */
abstract class DeCaptchaAbstract implements DeCaptchaInterface
{
    const RESPONSE_TYPE_STRING = 1;
    const RESPONSE_TYPE_JSON = 2;

    const ACTION_FIELDS = 1;
    const ACTION_URI = 2;
    const ACTION_METHOD = 3;
    const ACTION_JSON = 4;

    const ACTION_METHOD_POST = 1;
    const ACTION_METHOD_GET = 2;

    const DECODE_FORMAT = 1;
    const DECODE_ACTION = 2;
    const DECODE_SEPARATOR = 3;
    const DECODE_PARAMS = 4;
    const DECODE_PARAM_SETTING_MARKER = 5;

    const PARAM_FIELD_TYPE_STRING = 1;
    const PARAM_FIELD_TYPE_INTEGER = 2;
    const PARAM_FIELD_TYPE_MIX = 3;
    const PARAM_FIELD_TYPE_OBJECT = 4;
    const PARAM_FIELD_TYPE_BOOLEAN = 5;

    const PARAM_SLUG_DEFAULT = 1;
    const PARAM_SLUG_TYPE = 2;
    const PARAM_SLUG_REQUIRE = 3;
    const PARAM_SLUG_SPEC = 4;
    const PARAM_SLUG_VARIABLE = 5;
    const PARAM_SLUG_CODING = 6;
    const PARAM_SLUG_NOTWIKI = 7;
    const PARAM_SLUG_ENUM = 8;
    const PARAM_SLUG_WIKI = 9;

    const PARAM_SLUG_CODING_BASE64 = 1;

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
            case static::RESPONSE_TYPE_JSON:
                foreach (json_decode($data, true) as $key => $value) {
                    foreach ($decodeSetting[static::DECODE_PARAMS] as $param => $paramSetting) {
                        if (count(explode('.', $paramSetting[static::DECODE_PARAM_SETTING_MARKER])) > 1) {
                            if ($key === explode('.', $paramSetting[static::DECODE_PARAM_SETTING_MARKER])[0]) {
                                if (array_key_exists(explode('.', $paramSetting[static::DECODE_PARAM_SETTING_MARKER])[1], $value)) {
                                    $values[$param] = $value[explode('.', $paramSetting[static::DECODE_PARAM_SETTING_MARKER])[1]];
                                }
                            }
                        }
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
     * @param $spec
     * @param $coding
     *
     * @return \CURLFile|mixed|null|string
     */
    public function getParamSpec($param, $spec = null, $coding = null)
    {
        if (is_null($spec)) {
            $spec = $param;
        }
        if (!array_key_exists($param, $this->params) || is_null($this->params[$param])) {
            if (!array_key_exists($spec, $this->params) || is_null($this->params[$spec])) {
                return null;
            }
            $param = $spec;
        }
        switch ($spec) {
            case static::PARAM_SPEC_FILE:
                switch ($coding) {
                    case static::PARAM_SLUG_CODING_BASE64:
                        return base64_encode(file_get_contents($this->params[$param]));
                }

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
     * @param $field
     *
     * @throws DeCaptchaErrors
     *
     * @return array
     */
    protected function getParams($action, $field = null)
    {
        if (empty($this->actions[$action])) {
            return [];
        }
        $fields = $this->actions[$action][static::ACTION_FIELDS];
        if (!is_null($field)) {
            $fields = $fields[$field][static::ACTION_FIELDS];
        }
        $params = [];
        foreach ($fields as $field => $settings) {
            $value = null;
            if (array_key_exists(self::PARAM_SLUG_DEFAULT, $settings)) {
                $value = $settings[self::PARAM_SLUG_DEFAULT];
            }
            if (array_key_exists($field, $this->params) && (!array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) ^ (array_key_exists(self::PARAM_SLUG_VARIABLE, $settings) && $settings[self::PARAM_SLUG_VARIABLE] === false))) {
                $value = $this->params[$field];
            }
            if (array_key_exists(self::PARAM_SLUG_SPEC, $settings) && array_key_exists($settings[self::PARAM_SLUG_SPEC], $this->params)) {
                $value = $this->getParamSpec($field, $settings[self::PARAM_SLUG_SPEC], array_key_exists(self::PARAM_SLUG_CODING, $settings) ? $settings[self::PARAM_SLUG_CODING] : null);
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
                        $value = (int) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_STRING:
                        $value = (string) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_BOOLEAN:
                        $value = (bool) $value;
                        break;
                    case self::PARAM_FIELD_TYPE_OBJECT:
                        $value = $this->getParams($action, $field);
                        break;
                }
                if (array_key_exists(self::PARAM_SLUG_ENUM, $settings) && !in_array($value, $settings[static::PARAM_SLUG_ENUM])) {
                    throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_PARAM_ENUM, (array_key_exists($field, $this->paramsNames) ? $this->paramsNames[$field] : $field).' = '.$value, $this->errorLang);
                }
                $params[$this->paramsNames[$field]] = $value;
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
        return $this->curlResponse(
            $this->getActionUrl($action),
            $this->getParams($action),
            array_key_exists(static::ACTION_METHOD, $this->actions[$action]) && $this->actions[$action][static::ACTION_METHOD] === static::ACTION_METHOD_POST,
            array_key_exists(static::ACTION_JSON, $this->actions[$action]) && $this->actions[$action][static::ACTION_JSON] === true
        );
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
     * @param array  $data
     * @param bool   $isPost
     * @param bool   $isJson
     *
     * @throws DeCaptchaErrors
     *
     * @return string
     */
    protected function curlResponse($url, $data, $isPost = true, $isJson = false)
    {
        $curl = curl_init();
        if ($isJson) {
            $data = json_encode($data);
        } elseif (!$isPost) {
            $uri = [];
            foreach ($data as $key => $value) {
                $uri[] = "$key=$value";
            }
            $url .= '?'.implode('&', $uri);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        if (!$isJson && version_compare(PHP_VERSION, '5.5.0') >= 0 && version_compare(PHP_VERSION, '7.0') < 0 && defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($curl, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, $isPost);
        if ($isPost) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        if ($isJson) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json; charset=utf-8',
                'Accept: application/json',
                'Content-Length: '.strlen($data),
            ]);
        }
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_CURL, curl_error($curl), $this->errorLang);
        }
        curl_close($curl);

        return $result;
    }

    abstract public function getCode();

    abstract public function getError();
}
