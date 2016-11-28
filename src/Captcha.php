<?php

namespace jumper423;

use Exception;

/**
 * Распознавание капчи
 *
 * Class Captcha
 * @package jumper423
 */
class Captcha implements CaptchaInterface
{
    /**
     * Сервис на который будем загружать капчу
     * @var string
     */
    public $domain = "rucaptcha.com";
    /**
     * Путь до парки временного хранения капч (необходимо если будем передавать ссылку на капчу)
     * @var string
     */
    public $pathTmp = 'captcha';
    /**
     * Ваш API key
     * @var string
     */
    private $apiKey;
    /**
     * false(commenting OFF), true(commenting ON)
     * @var bool
     */
    public $isVerbose = true;
    /**
     * Таймаут проверки ответа
     * @var int
     */
    public $requestTimeout = 5;
    /**
     * Максимальное время ожидания ответа
     * @var int
     */
    public $maxTimeout = 120;
    /**
     * 0 OR 1 - капча из двух или более слов
     * @var int
     */
    public $isPhrase = 0;
    /**
     * 0 OR 1 - регистр ответа важен
     * @var int
     */
    public $isRegSense = 0;
    /**
     * 0 OR 1 OR 2 OR 3 - 0 = параметр не задействован (значение по умолчанию) 1 = капча состоит только из цифр 2 =
     * Капча состоит только из букв 3 = Капча состоит либо только из цифр, либо только из букв.
     * @var int
     */
    public $isNumeric = 0;
    /**
     * 0 если не ограничено, иначе обозначает минимальную длину ответа
     * @var int
     */
    public $minLen = 0;
    /**
     * 0 если не ограничено, иначе обозначает минимальную длину ответа
     * @var int
     */
    public $maxLen = 0;
    /**
     * 0 OR 1 OR 2 0 = параметр не задействован (значение по умолчанию) 1 = капча на кириллице 2 = капча на латинице
     * @var int
     */
    public $language = 0;
    /**
     * Ошибка
     * @var null|string
     */
    private $error = null;
    /**
     * Результат
     * @var null|string
     */
    private $result = null;

    private $captchaId;

    public function setApiKey($apiKey)
    {
        if (is_callable($apiKey)) {
            $this->apiKey = $apiKey();
        } else {
            $this->apiKey = $apiKey;
        }
    }

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
            if (strpos($filename, 'http://') !== false || strpos($filename, 'https://') !== false) {
                $current = file_get_contents($filename);
                if ($current) {
                    $path = tempnam(sys_get_temp_dir(), 'captcha');
                    if (file_put_contents($path, $current)) {
                        $filename = $path;
                    } else {
                        throw new Exception("Нет доступа для записи файла");
                    }
                } else {
                    throw new Exception("Файл {$filename} не загрузился");
                }
            } elseif (!file_exists($filename)) {
                throw new Exception("Файл {$filename} не найден");
            }
            $postData = [
                'method' => 'post',
                'key' => $this->apiKey,
                'file' => (version_compare(PHP_VERSION, '5.5.0') >= 0) ? new \CURLFile($filename) : '@' . $filename,
                'phrase' => $this->isPhrase,
                'regsense' => $this->isRegSense,
                'numeric' => $this->isNumeric,
                'min_len' => $this->minLen,
                'max_len' => $this->maxLen,
                'language' => $this->language,
                'soft_id' => 882,
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://{$this->domain}/in.php");
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
            $this->setError($result);
            list(, $this->captchaId) = explode("|", $result);
            $waitTime = 0;
            sleep($this->requestTimeout);
            while (true) {
                $result = file_get_contents("http://{$this->domain}/res.php?key={$this->apiKey}&action=get&id={$this->captchaId}");
                $this->setError($result);
                if ($result == "CAPCHA_NOT_READY") {
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

    /**
     * Не верно распознана
     */
    public function notTrue()
    {
        file_get_contents("http://{$this->domain}/res.php?key={$this->apiKey}&action=reportbad&id={$this->captchaId}");
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
    private function setError($error)
    {
        if (strpos($error, 'ERROR') !== false) {
            if (defined(CaptchaErrors::class . '::' . $error)) {
                throw new Exception(CaptchaErrors::$error);
            } else {
                throw new Exception($error);
            }
        }
    }
}
