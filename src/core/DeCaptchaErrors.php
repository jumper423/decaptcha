<?php

namespace jumper423\decaptcha\core;

use Exception;

/**
 * Ошибки
 *
 * Class DeCaptchaErrors
 * @package jumper423
 */
class DeCaptchaErrors extends \Exception {
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

    public $errorsMessages = [
        self::ERROR_NO_SLOT_AVAILABLE => [
            'en' => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
            'ru' => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
        ],
        self::ERROR_ZERO_CAPTCHA_FILESIZE => [
            'en' => 'Размер капчи которую вы загружаете менее 100 байт',
            'ru' => 'Размер капчи которую вы загружаете менее 100 байт',
        ],
        self::ERROR_TOO_BIG_CAPTCHA_FILESIZE => [
            'en' => 'Ваша капча имеет размер более 100 килобайт',
            'ru' => 'Ваша капча имеет размер более 100 килобайт',
        ],
        self::ERROR_ZERO_BALANCE => [
            'en' => 'Нулевой либо отрицательный баланс',
            'ru' => 'Нулевой либо отрицательный баланс',
        ],
        self::ERROR_IP_NOT_ALLOWED => [
            'en' => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
            'ru' => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
        ],
        self::ERROR_CAPTCHA_UNSOLVABLE => [
            'en' => 'Не смог разгадать капчу',
            'ru' => 'Не смог разгадать капчу',
        ],
        self::ERROR_BAD_DUPLICATES => [
            'en' => 'Функция 100% распознавания не сработала и-за лимита попыток',
            'ru' => 'Функция 100% распознавания не сработала и-за лимита попыток',
        ],
        self::ERROR_NO_SUCH_METHOD => [
            'en' => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
            'ru' => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
        ],
        self::ERROR_IMAGE_TYPE_NOT_SUPPORTED => [
            'en' => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
            'ru' => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
        ],
        self::ERROR_KEY_DOES_NOT_EXIST => [
            'en' => 'Использован несуществующий key',
            'ru' => 'Использован несуществующий key',
        ],
        self::ERROR_WRONG_USER_KEY => [
            'en' => 'Неверный формат параметра key, должно быть 32 символа',
            'ru' => 'Неверный формат параметра key, должно быть 32 символа',
        ],
        self::ERROR_WRONG_ID_FORMAT => [
            'en' => 'Неверный формат ID каптчи. ID должен содержать только цифры',
            'ru' => 'Неверный формат ID каптчи. ID должен содержать только цифры',
        ],
        self::ERROR_WRONG_FILE_EXTENSION => [
            'en' => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
            'ru' => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
        ],
    ];

    /**
     * @param $name
     * @return null|int
     */
    public function isThereSuch($name) {
        if (defined("static::$name")) {
            return constant("static::$name");
        }
        return null;
    }

    /**
     * DeCaptchaErrors constructor.
     * @param string $alias
     * @param string $additionalText
     * @param string $lang
     */
    public function __construct($alias, $additionalText = null, $lang = 'en')
    {
        $code = $this->isThereSuch($alias);
        if (is_null($code)) {
            $message = $alias;
            $code = 0;
        }else {
            $message = $this->errorsMessages[$code][$lang];
        }
        if ($additionalText) {
            $message .= ": $additionalText";
        }
        parent::__construct($message, $code);
    }
}