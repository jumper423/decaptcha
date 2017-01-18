<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Ошибки.
 *
 * Class DeCaptchaErrors
 */
class DeCaptchaErrors extends Exception
{
    const LANG_RU = 1;
    const LANG_EN = 2;

    const ERROR_ZERO_CAPTCHA_FILESIZE = 1;
    const ERROR_TOO_BIG_CAPTCHA_FILESIZE = 2;
    const ERROR_ZERO_BALANCE = 3;
    const ERROR_IP_NOT_ALLOWED = 4;
    const ERROR_CAPTCHA_UNSOLVABLE = 5;
    const ERROR_BAD_DUPLICATES = 6;
    const ERROR_NO_SUCH_METHOD = 7;
    const ERROR_IMAGE_TYPE_NOT_SUPPORTED = 8;
    const ERROR_KEY_DOES_NOT_EXIST = 9;
    const ERROR_WRONG_USER_KEY = 10;
    const ERROR_WRONG_ID_FORMAT = 11;
    const ERROR_WRONG_FILE_EXTENSION = 12;
    const ERROR_NO_SLOT_AVAILABLE = 13;
    const ERROR_WRITE_ACCESS_FILE = 14;
    const ERROR_FILE_IS_NOT_LOADED = 15;
    const ERROR_FILE_NOT_FOUND = 16;
    const ERROR_PARAM_REQUIRE = 18;
    const ERROR_CAPTCHAIMAGE_BLOCKED = 19;
    const IP_BANNED = 20;
    const ERROR_WRONG_CAPTCHA_ID = 21;
    const REPORT_NOT_RECORDED = 22;
    const ERROR_LIMIT = 23;
    const ERROR_NO_SUCH_CAPCHA_ID = 24;
    const ERROR_EMPTY_COMMENT = 25;
    const ERROR_IP_BLOCKED = 26;
    const ERROR_TASK_ABSENT = 27;
    const ERROR_TASK_NOT_SUPPORTED = 28;
    const ERROR_INCORRECT_SESSION_DATA = 29;
    const ERROR_PROXY_CONNECT_REFUSED = 30;
    const ERROR_PROXY_CONNECT_TIMEOUT = 31;
    const ERROR_PROXY_READ_TIMEOUT = 32;
    const ERROR_PROXY_BANNED = 33;
    const ERROR_PROXY_TRANSPARENT = 34;
    const ERROR_RECAPTCHA_TIMEOUT = 35;
    const ERROR_RECAPTCHA_INVALID_SITEKEY = 36;
    const ERROR_RECAPTCHA_INVALID_DOMAIN = 37;
    const ERROR_RECAPTCHA_OLD_BROWSER = 38;
    const ERROR_RECAPTCHA_STOKEN_EXPIRED = 39;
    const ERROR_PARAM_ENUM = 40;

    public $errorsMessages = [
        self::ERROR_RECAPTCHA_STOKEN_EXPIRED => [
            self::LANG_RU => 'Параметр stoken устарел. Модифицируйте свое приложение, оно должно использовать stoken как можно быстрее',
            self::LANG_EN => 'The stoken parameter is deprecated. Modify your app, it must use stoken as quickly as possible',
        ],
        self::ERROR_RECAPTCHA_OLD_BROWSER => [
            self::LANG_RU => 'Для задачи используется User-Agent неподдерживаемого рекапчей браузера',
            self::LANG_EN => 'For task, you use the User-Agent unsupported by recaptcha browser',
        ],
        self::ERROR_RECAPTCHA_INVALID_DOMAIN => [
            self::LANG_RU => 'Ошибка получаемая от сервера рекапчи. Домен не соответствует sitekey',
            self::LANG_EN => 'Error received from the server recaptcha. Domain does not match the sitekey',
        ],
        self::ERROR_RECAPTCHA_INVALID_SITEKEY => [
            self::LANG_RU => 'Ошибка получаемая от сервера рекапчи. Неверный/невалидный sitekey',
            self::LANG_EN => 'Error received from the server recaptcha. Incorrect/invalid sitekey',
        ],
        self::ERROR_RECAPTCHA_TIMEOUT => [
            self::LANG_RU => 'Таймаут загрузки скрипта рекапчи, проблема либо в медленном прокси, либо в медленном сервере Google',
            self::LANG_EN => 'The timeout for the script to download the recaptcha, the problem is either in the slow proxy or a slow server Google',
        ],
        self::ERROR_PROXY_TRANSPARENT => [
            self::LANG_RU => 'Ошибка проверки прокси. Прокси должен быть не прозрачным, скрывать адрес конечного пользователя',
            self::LANG_EN => 'Error check proxy. Proxy should not be transparent, to hide the address of the end user',
        ],
        self::ERROR_NO_SLOT_AVAILABLE => [
            self::LANG_RU => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
            self::LANG_EN => 'There are no available workers at the moment, try later, or increase your maximum bid here',
        ],
        self::ERROR_ZERO_CAPTCHA_FILESIZE => [
            self::LANG_RU => 'Размер капчи которую вы загружаете менее 100 байт',
            self::LANG_EN => 'The size of the captcha you download less than 100 bytes',
        ],
        self::ERROR_TOO_BIG_CAPTCHA_FILESIZE => [
            self::LANG_RU => 'Ваша капча имеет размер более 100 килобайт',
            self::LANG_EN => 'Your captcha is larger than 100 kilobytes',
        ],
        self::ERROR_ZERO_BALANCE => [
            self::LANG_RU => 'Нулевой либо отрицательный баланс',
            self::LANG_EN => 'A zero or negative balance',
        ],
        self::ERROR_IP_NOT_ALLOWED => [
            self::LANG_RU => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
            self::LANG_EN => 'Request from this IP address with the current key is rejected. Please see section access control by IP',
        ],
        self::ERROR_CAPTCHA_UNSOLVABLE => [
            self::LANG_RU => 'Не смог разгадать капчу',
            self::LANG_EN => 'Couldn\'t solve the captcha',
        ],
        self::ERROR_BAD_DUPLICATES => [
            self::LANG_RU => 'Функция 100% распознавания не сработала из-за лимита попыток',
            self::LANG_EN => 'Function 100% recognition did not work because of the limit of attempts',
        ],
        self::ERROR_NO_SUCH_METHOD => [
            self::LANG_RU => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
            self::LANG_EN => 'You have to send a method parameter in your request to the API, read the documentation',
        ],
        self::ERROR_IMAGE_TYPE_NOT_SUPPORTED => [
            self::LANG_RU => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
            self::LANG_EN => 'It is impossible to determine the file type the captcha only accepts JPG, GIF, PNG',
        ],
        self::ERROR_KEY_DOES_NOT_EXIST => [
            self::LANG_RU => 'Использован несуществующий key',
            self::LANG_EN => 'Used a non-existent key',
        ],
        self::ERROR_WRONG_USER_KEY => [
            self::LANG_RU => 'Неверный формат параметра key, должно быть 32 символа',
            self::LANG_EN => 'Invalid format of key should be 32 characters',
        ],
        self::ERROR_WRONG_ID_FORMAT => [
            self::LANG_RU => 'Неверный формат ID каптчи. ID должен содержать только цифры',
            self::LANG_EN => 'Invalid ID format captcha. ID should contain only numbers',
        ],
        self::ERROR_WRONG_FILE_EXTENSION => [
            self::LANG_RU => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
            self::LANG_EN => 'Your captcha has an invalid extension, valid extensions jpg,jpeg,gif,png',
        ],
        self::ERROR_WRITE_ACCESS_FILE => [
            self::LANG_RU => 'Нет доступа для записи файла',
            self::LANG_EN => 'There is no write access of the file',
        ],
        self::ERROR_FILE_IS_NOT_LOADED => [
            self::LANG_RU => 'Файл не загрузился',
            self::LANG_EN => 'The file is not loaded',
        ],
        self::ERROR_FILE_NOT_FOUND => [
            self::LANG_RU => 'Файл не найден',
            self::LANG_EN => 'File not found',
        ],
        self::ERROR_PARAM_REQUIRE => [
            self::LANG_RU => 'Обязательное поле не заполнено',
            self::LANG_EN => 'Required field is not filled',
        ],
        self::ERROR_CAPTCHAIMAGE_BLOCKED => [
            self::LANG_RU => 'Вы прислали картинку, которую невозможно распознать и которая сохранена у нас в базе, как нераспознаваемая картинка',
            self::LANG_EN => 'You sent me a picture which cannot be recognize, and which we have stored in the database, as unrecognizable picture',
        ],
        self::IP_BANNED => [
            self::LANG_RU => 'IP-адрес, с которого пришёл запрос заблокирован из-за частых обращений с различными неверными ключами',
            self::LANG_EN => 'IP address from which the request came is blocked because of the frequent calls from various incorrect keys',
        ],
        self::ERROR_WRONG_CAPTCHA_ID => [
            self::LANG_RU => 'Вы пытаетесь получить ответ на капчу или пожаловаться на капчу, которая была загружена более 15 минут назад',
            self::LANG_EN => 'You are trying to get an answer to a captcha or to complain about the captcha, which has been downloaded more than 15 minutes ago',
        ],
        self::REPORT_NOT_RECORDED => [
            self::LANG_RU => 'Такой ответ сервер может отдать на жалобу (reportbad), если до этого вы пожаловались на большое количество верных расспознаний',
            self::LANG_EN => 'Such a response, the server may send to the complaint (reportbad), if you\'ve complained about the large number of true discernment',
        ],
        self::ERROR_LIMIT => [
            self::LANG_RU => 'Программные лимиты закончились',
            self::LANG_EN => 'Software limits ended',
        ],
        self::ERROR_NO_SUCH_CAPCHA_ID => [
            self::LANG_RU => 'Капча с таким ID не была найдена в системе. Убедитесь что вы запрашиваете состояние капчи в течение 300 секунд после загрузки',
            self::LANG_EN => 'Captcha with this ID was not found in the system. Make sure you inquire the status of captcha for 300 seconds after boot',
        ],
        self::ERROR_EMPTY_COMMENT => [
            self::LANG_RU => 'Отсутствует комментарий в параметрах конструктора рекапчи',
            self::LANG_EN => 'No comment in the constructor parameters recaptcha',
        ],
        self::ERROR_IP_BLOCKED => [
            self::LANG_RU => 'Доступ к API с этого IP запрещен из-за большого количества ошибок',
            self::LANG_EN => 'API access from this IP is forbidden due to the large number of errors',
        ],
        self::ERROR_TASK_ABSENT => [
            self::LANG_RU => 'Отсутствует задача в методе createTask',
            self::LANG_EN => 'There is no task in the method createTask',
        ],
        self::ERROR_TASK_NOT_SUPPORTED => [
            self::LANG_RU => 'Тип задачи не поддерживается или указан не верно. Речь идет о значении свойства type в объекте типа Task',
            self::LANG_EN => 'The task type is not supported or is not correct. We are talking about the value of the type property in the object of type Task',
        ],
        self::ERROR_INCORRECT_SESSION_DATA => [
            self::LANG_RU => 'Неполные или некорректные данные об эмулируемом пользователе. Все требуемые поля не должны быть пустыми',
            self::LANG_EN => 'Incomplete or incorrect data about the emulated user. All required fields must not be empty',
        ],
        self::ERROR_PROXY_CONNECT_REFUSED => [
            self::LANG_RU => 'Не удалось подключиться к прокси-серверу - отказ в подключении',
            self::LANG_EN => 'Failed to connect to the proxy server refusing connections',
        ],
        self::ERROR_PROXY_CONNECT_TIMEOUT => [
            self::LANG_RU => 'Таймаут подключения к прокси-серверу',
            self::LANG_EN => 'The timeout of the connection to the proxy server',
        ],
        self::ERROR_PROXY_READ_TIMEOUT => [
            self::LANG_RU => 'Таймаут операции чтения прокси-сервера',
            self::LANG_EN => 'Timeout the read operation of the proxy server',
        ],
        self::ERROR_PROXY_BANNED => [
            self::LANG_RU => 'Прокси забанен на целевом сервисе капчи',
            self::LANG_EN => 'Proxies are banned on the target service captcha',
        ],
        self::ERROR_PARAM_ENUM => [
            self::LANG_RU => 'Нет в допустимых значениях поля',
            self::LANG_EN => 'Not in the valid field values',
        ],
    ];

    /**
     * @param string $name
     *
     * @return null|int
     */
    public function isThereSuch($name)
    {
        if (is_string($name) && defined("static::$name")) {
            return constant("static::$name");
        }
        if (is_int($name)) {
            return $name;
        }

        return null;
    }

    /**
     * DeCaptchaErrors constructor.
     *
     * @param string      $alias
     * @param null|string $additionalText
     * @param int         $lang
     */
    public function __construct($alias, $additionalText = null, $lang = self::LANG_EN)
    {
        $code = $this->isThereSuch($alias);
        if (is_null($code)) {
            $message = $alias;
            $code = 0;
        } else {
            $message = !empty($this->errorsMessages[$code]) ? $this->errorsMessages[$code][$lang] : "ERROR Code №$code";
        }
        if ($additionalText !== null) {
            $message .= ": $additionalText";
        }
        parent::__construct($message, $code);
    }
}
