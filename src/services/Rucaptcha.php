<?php

namespace jumper423\decaptcha\services;

use Exception;
use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Распознавание капчи Rucaptcha
 *
 * Class Rucaptcha
 * @link http://infoblog1.ru/goto/rucaptcha
 * @package jumper423
 */
class Rucaptcha extends DeCaptchaBase
{
    public $domain = "rucaptcha.com";

    /**
     * Запуск распознавания капчи
     *
     * @param string $filename Путь до файла или ссылка на него
     *
     * @return bool
     */
    public function run($filename)
    {
        $this->result = null;
        $this->error = null;
        try {
            $filePath = $this->getFilePath($filename);
            $postData = [
                'method' => 'post',
                'key' => $this->apiKey,
                'file' => (version_compare(PHP_VERSION, '5.5.0') >= 0) ? new \CURLFile($filePath) : '@' . $filePath,
                'phrase' => $this->isPhrase,
                'regsense' => $this->isRegSense,
                'numeric' => $this->isNumeric,
                'min_len' => $this->minLen,
                'max_len' => $this->maxLen,
                'language' => $this->language,
                'soft_id' => 882,
            ];
            $result = $this->getCurlResponse($postData);
            $this->setError($result);
            list(, $this->captchaId) = explode("|", $result);
            $waitTime = 0;
            sleep($this->requestTimeout);
            while (true) {
                $result = $this->getResponse('get');
                $this->setError($result);
                if ($result == "CAPCHA_NOT_READY") {
                    $waitTime += $this->requestTimeout;
                    if ($waitTime > $this->maxTimeout) {
                        break;
                    }
                    sleep($this->requestTimeout);
                } else {
                    $ex = explode('|', $result);
                    if (trim($ex[ 0 ]) == 'OK') {
                        $this->result = trim($ex[ 1 ]);

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
}
