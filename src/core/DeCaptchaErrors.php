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
    const ERROR_CURL = 17;
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

    public $errorsMessages = [
        self::ERROR_RECAPTCHA_STOKEN_EXPIRED => [
            self::LANG_RU => 'Параметр stoken устарел. Модифицируйте свое приложение, оно должно использовать stoken как можно быстрее.',
            self::LANG_EN => 'Параметр stoken устарел. Модифицируйте свое приложение, оно должно использовать stoken как можно быстрее.',
        ],
        self::ERROR_RECAPTCHA_OLD_BROWSER => [
            self::LANG_RU => 'Для задачи используется User-Agent неподдерживаемого рекапчей браузера.',
            self::LANG_EN => 'Для задачи используется User-Agent неподдерживаемого рекапчей браузера.',
        ],
        self::ERROR_RECAPTCHA_INVALID_DOMAIN => [
            self::LANG_RU => 'Ошибка получаемая от сервера рекапчи. Домен не соответствует sitekey.',
            self::LANG_EN => 'Ошибка получаемая от сервера рекапчи. Домен не соответствует sitekey.',
        ],
        self::ERROR_RECAPTCHA_INVALID_SITEKEY => [
            self::LANG_RU => 'Ошибка получаемая от сервера рекапчи. Неверный/невалидный sitekey.',
            self::LANG_EN => 'Ошибка получаемая от сервера рекапчи. Неверный/невалидный sitekey.',
        ],
        self::ERROR_RECAPTCHA_TIMEOUT => [
            self::LANG_RU => 'Таймаут загрузки скрипта рекапчи, проблема либо в медленном прокси, либо в медленном сервере Google',
            self::LANG_EN => 'Таймаут загрузки скрипта рекапчи, проблема либо в медленном прокси, либо в медленном сервере Google',
        ],
        self::ERROR_PROXY_TRANSPARENT => [
            self::LANG_RU => 'Ошибка проверки прокси. Прокси должен быть не прозрачным, скрывать адрес конечного пользователя.',
            self::LANG_EN => 'Ошибка проверки прокси. Прокси должен быть не прозрачным, скрывать адрес конечного пользователя.',
        ],
        self::ERROR_NO_SLOT_AVAILABLE => [
            self::LANG_RU => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
            self::LANG_EN => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
        ],
        self::ERROR_ZERO_CAPTCHA_FILESIZE => [
            self::LANG_RU => 'Размер капчи которую вы загружаете менее 100 байт',
            self::LANG_EN => 'Размер капчи которую вы загружаете менее 100 байт',
        ],
        self::ERROR_TOO_BIG_CAPTCHA_FILESIZE => [
            self::LANG_RU => 'Ваша капча имеет размер более 100 килобайт',
            self::LANG_EN => 'Ваша капча имеет размер более 100 килобайт',
        ],
        self::ERROR_ZERO_BALANCE => [
            self::LANG_RU => 'Нулевой либо отрицательный баланс',
            self::LANG_EN => 'Нулевой либо отрицательный баланс',
        ],
        self::ERROR_IP_NOT_ALLOWED => [
            self::LANG_RU => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
            self::LANG_EN => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
        ],
        self::ERROR_CAPTCHA_UNSOLVABLE => [
            self::LANG_RU => 'Не смог разгадать капчу',
            self::LANG_EN => 'Не смог разгадать капчу',
        ],
        self::ERROR_BAD_DUPLICATES => [
            self::LANG_RU => 'Функция 100% распознавания не сработала и-за лимита попыток',
            self::LANG_EN => 'Функция 100% распознавания не сработала и-за лимита попыток',
        ],
        self::ERROR_NO_SUCH_METHOD => [
            self::LANG_RU => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
            self::LANG_EN => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
        ],
        self::ERROR_IMAGE_TYPE_NOT_SUPPORTED => [
            self::LANG_RU => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
            self::LANG_EN => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
        ],
        self::ERROR_KEY_DOES_NOT_EXIST => [
            self::LANG_RU => 'Использован несуществующий key',
            self::LANG_EN => 'Использован несуществующий key',
        ],
        self::ERROR_WRONG_USER_KEY => [
            self::LANG_RU => 'Неверный формат параметра key, должно быть 32 символа',
            self::LANG_EN => 'Неверный формат параметра key, должно быть 32 символа',
        ],
        self::ERROR_WRONG_ID_FORMAT => [
            self::LANG_RU => 'Неверный формат ID каптчи. ID должен содержать только цифры',
            self::LANG_EN => 'Неверный формат ID каптчи. ID должен содержать только цифры',
        ],
        self::ERROR_WRONG_FILE_EXTENSION => [
            self::LANG_RU => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
            self::LANG_EN => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
        ],
        self::ERROR_WRITE_ACCESS_FILE => [
            self::LANG_RU => 'Нет доступа для записи файла',
            self::LANG_EN => 'Нет доступа для записи файла',
        ],
        self::ERROR_FILE_IS_NOT_LOADED => [
            self::LANG_RU => 'Файл не загрузился',
            self::LANG_EN => 'Файл не загрузился',
        ],
        self::ERROR_FILE_NOT_FOUND => [
            self::LANG_RU => 'Файл не найден',
            self::LANG_EN => 'Файл не найден',
        ],
        self::ERROR_CURL => [
            self::LANG_RU => 'Ошибка CURL',
            self::LANG_EN => 'Ошибка CURL',
        ],
        self::ERROR_PARAM_REQUIRE => [
            self::LANG_RU => 'Обязательное поле не заполнено',
            self::LANG_EN => 'Обязательное поле не заполнено',
        ],
        self::ERROR_CAPTCHAIMAGE_BLOCKED => [
            self::LANG_RU => 'Вы прислали картинку, которую невозможно распознать и которая сохранена у нас в базе, как нераспознаваемая картинка.',
            self::LANG_EN => 'Вы прислали картинку, которую невозможно распознать и которая сохранена у нас в базе, как нераспознаваемая картинка.',
        ],
        self::IP_BANNED => [
            self::LANG_RU => 'IP-адрес, с которого пришёл запрос заблокирован из-за частых обращений с различными неверными ключами.',
            self::LANG_EN => 'IP-адрес, с которого пришёл запрос заблокирован из-за частых обращений с различными неверными ключами.',
        ],
        self::ERROR_WRONG_CAPTCHA_ID => [
            self::LANG_RU => 'Вы пытаетесь получить ответ на капчу или пожаловаться на капчу, которая была загружена более 15 минут назад',
            self::LANG_EN => 'Вы пытаетесь получить ответ на капчу или пожаловаться на капчу, которая была загружена более 15 минут назад',
        ],
        self::REPORT_NOT_RECORDED => [
            self::LANG_RU => 'Такой ответ сервер может отдать на жалобу (reportbad), если до этого вы пожаловались на большое количество верных распознаний',
            self::LANG_EN => 'Такой ответ сервер может отдать на жалобу (reportbad), если до этого вы пожаловались на большое количество верных распознаний',
        ],
        self::ERROR_LIMIT => [
            self::LANG_RU => 'Программные лимиты закончились',
            self::LANG_EN => 'Программные лимиты закончились',
        ],
        self::ERROR_NO_SUCH_CAPCHA_ID => [
            self::LANG_RU => 'Капча с таким ID не была найдена в системе. Убедитесь что вы запрашиваете состояние капчи в течение 300 секунд после загрузки.',
            self::LANG_EN => 'Капча с таким ID не была найдена в системе. Убедитесь что вы запрашиваете состояние капчи в течение 300 секунд после загрузки.',
        ],
        self::ERROR_EMPTY_COMMENT => [
            self::LANG_RU => 'Отсутствует комментарий в параметрах конструктора рекапчи.',
            self::LANG_EN => 'Отсутствует комментарий в параметрах конструктора рекапчи.',
        ],
        self::ERROR_IP_BLOCKED => [
            self::LANG_RU => 'Доступ к API с этого IP запрещен из-за большого количества ошибок.',
            self::LANG_EN => 'Доступ к API с этого IP запрещен из-за большого количества ошибок.',
        ],
        self::ERROR_TASK_ABSENT => [
            self::LANG_RU => 'Отсутствует задача в методе createTask.',
            self::LANG_EN => 'Отсутствует задача в методе createTask.',
        ],
        self::ERROR_TASK_NOT_SUPPORTED => [
            self::LANG_RU => 'Тип задачи не поддерживается или указан не верно. Речь идет о значении свойства type в объекте типа Task.',
            self::LANG_EN => 'Тип задачи не поддерживается или указан не верно. Речь идет о значении свойства type в объекте типа Task.',
        ],
        self::ERROR_INCORRECT_SESSION_DATA => [
            self::LANG_RU => 'Неполные или некорректные данные об эмулируемом пользователе. Все требуемые поля не должны быть пустыми.',
            self::LANG_EN => 'Неполные или некорректные данные об эмулируемом пользователе. Все требуемые поля не должны быть пустыми.',
        ],
        self::ERROR_PROXY_CONNECT_REFUSED => [
            self::LANG_RU => 'Не удалось подключиться к прокси-серверу - отказ в подключении',
            self::LANG_EN => 'Не удалось подключиться к прокси-серверу - отказ в подключении',
        ],
        self::ERROR_PROXY_CONNECT_TIMEOUT => [
            self::LANG_RU => 'Таймаут подключения к прокси-серверу',
            self::LANG_EN => 'Таймаут подключения к прокси-серверу',
        ],
        self::ERROR_PROXY_READ_TIMEOUT => [
            self::LANG_RU => 'Таймаут операции чтения прокси-сервера.',
            self::LANG_EN => 'Таймаут операции чтения прокси-сервера.',
        ],
        self::ERROR_PROXY_BANNED => [
            self::LANG_RU => 'Прокси забанен на целевом сервисе капчи',
            self::LANG_EN => 'Прокси забанен на целевом сервисе капчи',
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
