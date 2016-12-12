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
    public $domain = 'rucaptcha.com';
    public $isVerbose = true;
    public $requestTimeout = 5;
    public $maxTimeout = 120;
    public $isPhrase = 0;
    public $isRegSense = 0;
    public $isNumeric = 0;
    public $minLen = 0;
    public $maxLen = 0;
    public $language = 0;

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
