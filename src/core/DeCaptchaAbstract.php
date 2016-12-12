<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Class DeCaptchaAbstract
 * @package jumper423
 */
abstract class DeCaptchaAbstract implements DeCaptchaInterface
{
    public $lang = 'en';
    /**
     * Сервис на который будем загружать капчу
     * @var string
     */
    public $domain;
    /**
     * Ваш API key
     * @var string
     */
    protected $apiKey;
    /**
     * false(commenting OFF), true(commenting ON)
     * @var bool
     */
    public $isVerbose;
    /**
     * Таймаут проверки ответа
     * @var int
     */
    public $requestTimeout;
    /**
     * Максимальное время ожидания ответа
     * @var int
     */
    public $maxTimeout;
    /**
     * 0 OR 1 - капча из двух или более слов
     * @var int
     */
    public $isPhrase;
    /**
     * 0 OR 1 - регистр ответа важен
     * @var int
     */
    public $isRegSense;
    /**
     * 0 OR 1 OR 2 OR 3 - 0 = параметр не задействован (значение по умолчанию) 1 = капча состоит только из цифр 2 =
     * Капча состоит только из букв 3 = Капча состоит либо только из цифр, либо только из букв.
     * @var int
     */
    public $isNumeric;
    /**
     * 0 если не ограничено, иначе обозначает минимальную длину ответа
     * @var int
     */
    public $minLen;
    /**
     * 0 если не ограничено, иначе обозначает минимальную длину ответа
     * @var int
     */
    public $maxLen;
    /**
     * 0 OR 1 OR 2 0 = параметр не задействован (значение по умолчанию) 1 = капча на кириллице 2 = капча на латинице
     * @var int
     */
    public $language;
    /**
     * Ошибка
     * @var null|string
     */
    protected $error = null;
    /**
     * Результат
     * @var null|string
     */
    protected $result = null;
    /**
     * @var int
     */
    protected $captchaId;

    const RESPONSE_TYPE_STRING = 0;
    const RESPONSE_TYPE_JSON = 1;

    public $errorLang = DeCaptchaErrors::LANG_EN;

    public $responseType = self::RESPONSE_TYPE_STRING;

    public function setApiKey($apiKey)
    {
        $this->apiKey = is_callable($apiKey) ? $apiKey() : $apiKey;
    }

    /**
     * @return void
     */
    abstract public function notTrue();

    /**
     * Узнаём путь до файла
     * Если передана ссылка, то скачиваем и кладём во временную директорию
     *
     * @param string $fileName
     * @return string
     * @throws Exception
     */
    protected function getFilePath($fileName) {
        if (strpos($fileName, 'http://') !== false || strpos($fileName, 'https://') !== false) {
            $current = @file_get_contents($fileName);
            if (!$current) {
                throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_FILE_IS_NOT_LOADED, $fileName, $this->errorLang);
            }
            $path = tempnam(sys_get_temp_dir(), 'captcha');
            if (!file_put_contents($path, $current)) {
                throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_WRITE_ACCESS_FILE, null, $this->errorLang);
            }
            $fileName = $path;
        } elseif (!file_exists($fileName)) {
            throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_FILE_NOT_FOUND, $fileName, $this->errorLang);
        }
        return $fileName;
    }

    /**
     * @return string
     */
    protected function getBaseUrl() {
        return "http://{$this->domain}/";
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getActionUrl($action) {
        return "{$this->getBaseUrl()}res.php?key={$this->apiKey}&action={$action}&id={$this->captchaId}";
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getResponse($action) {
        return file_get_contents($this->getActionUrl($action));
    }

    /**
     * @return string
     */
    protected function getInUrl() {
        return "{$this->getBaseUrl()}in.php";
    }

    /**
     * Проверка на то произошла ли ошибка
     *
     * @param $error
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
     * Задержка выполнения
     *
     * @param int $delay Количество секунд
     * @param \Closure|null $callback
     * @return mixed
     */
    protected function executionDelayed($delay = 0, $callback = null) {
        $time = microtime(true);
        $timePassed = $time - $this->lastRunTime;
        if ($timePassed < $delay) {
            usleep(($delay - $timePassed) * 1000000);
        }
        $this->lastRunTime = microtime(true);
        return $callback instanceof \Closure ? $callback($this) : $callback;
    }

    /**
     * @param $postData
     * @return string
     * @throws Exception
     */
    protected function getCurlResponse($postData) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getInUrl());
        if (version_compare(PHP_VERSION, '5.5.0') >= 0 && version_compare(PHP_VERSION, '7.0') < 0 && defined('CURLOPT_SAFE_UPLOAD')) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new DeCaptchaErrors(DeCaptchaErrors::ERROR_CURL, curl_error($ch), $this->errorLang);
        }
        curl_close($ch);
        return $result;
    }

    abstract protected function decodeResponse($data, $type, $format = self::RESPONSE_TYPE_STRING);
}
