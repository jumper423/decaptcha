<?php

namespace jumper423;

use Exception;

/**
 * Class DeCaptchaAbstract
 * @package jumper423
 */
abstract class DeCaptchaAbstract implements CaptchaInterface
{
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

    public function setApiKey($apiKey)
    {
        if (is_callable($apiKey)) {
            $this->apiKey = $apiKey();
        } else {
            $this->apiKey = $apiKey;
        }
    }

    /**
     * @return void
     */
    abstract function notTrue();

    /**
     * Узнаём путь до файла
     * Если передана ссылка, то скачиваем и кладём во временную директорию
     *
     * @param $fileName
     * @return string
     * @throws Exception
     */
    protected function getFilePath($fileName){
        if (strpos($fileName, 'http://') !== false || strpos($fileName, 'https://') !== false) {
            $current = file_get_contents($fileName);
            if ($current) {
                $path = tempnam(sys_get_temp_dir(), 'captcha');
                if (file_put_contents($path, $current)) {
                    $fileName = $path;
                } else {
                    throw new Exception("Нет доступа для записи файла");
                }
            } else {
                throw new Exception("Файл {$fileName} не загрузился");
            }
        } elseif (!file_exists($fileName)) {
            throw new Exception("Файл {$fileName} не найден");
        }
        return $fileName;
    }

    /**
     * @return string
     */
    protected function getBaseUrl(){
        return "http://{$this->domain}/";
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getActionUrl($action){
        return "{$this->getBaseUrl()}res.php?key={$this->apiKey}&action={$action}&id={$this->captchaId}";
    }

    /**
     * @param string $action
     * @return string
     */
    protected function getResponse($action){
        return file_get_contents($this->getActionUrl($action));
    }

    /**
     * @return string
     */
    protected function getInUrl(){
        return "{$this->getBaseUrl()}in.php";
    }

    /**
     * Результат
     * @return null|string
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * Ошибка
     * @return null|string
     */
    public function error()
    {
        return $this->error;
    }

    /**
     * Проверка на то произошла ли ошибка
     *
     * @param $error
     *
     * @throws Exception
     */
    protected function setError($error)
    {
        if (strpos($error, 'ERROR') !== false) {
            if (defined(CaptchaErrors::class . '::' . $error)) {
                throw new Exception(CaptchaErrors::$error);
            } else {
                throw new Exception($error);
            }
        }
    }

    /**
     * @param $postData
     * @return mixed
     * @throws Exception
     */
    protected function getCurlResponse($postData){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getInUrl());
        if (version_compare(PHP_VERSION, '5.5.0') >= 0 && version_compare(PHP_VERSION, '7.0') < 0) {
            curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception("CURL вернул ошибку: " . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
