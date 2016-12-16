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

    public $errorsMessages = [
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
        if ($additionalText) {
            $message .= ": $additionalText";
        }
        parent::__construct($message, $code);
    }
}
