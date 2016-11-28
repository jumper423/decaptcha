<?php

namespace jumper423;

/**
 * Ошибки
 *
 * Class DeCaptchaErrors
 * @package jumper423
 */
class DeCaptchaErrors{
    const ERROR_NO_SLOT_AVAILABLE = 'ERROR_NO_SLOT_AVAILABLE';
    const ERROR_ZERO_CAPTCHA_FILESIZE = 'ERROR_ZERO_CAPTCHA_FILESIZE';
    const ERROR_TOO_BIG_CAPTCHA_FILESIZE = 'ERROR_TOO_BIG_CAPTCHA_FILESIZE';
    const ERROR_ZERO_BALANCE = 'ERROR_ZERO_BALANCE';
    const ERROR_IP_NOT_ALLOWED = 'ERROR_IP_NOT_ALLOWED';
    const ERROR_CAPTCHA_UNSOLVABLE = 'ERROR_CAPTCHA_UNSOLVABLE';
    const ERROR_BAD_DUPLICATES = 'ERROR_BAD_DUPLICATES';
    const ERROR_NO_SUCH_METHOD = 'ERROR_NO_SUCH_METHOD';
    const ERROR_IMAGE_TYPE_NOT_SUPPORTED = 'ERROR_IMAGE_TYPE_NOT_SUPPORTED';
    const ERROR_KEY_DOES_NOT_EXIST = 'ERROR_KEY_DOES_NOT_EXIST';
    const ERROR_WRONG_USER_KEY = 'ERROR_WRONG_USER_KEY';
    const ERROR_WRONG_ID_FORMAT = 'ERROR_WRONG_ID_FORMAT';
    const ERROR_WRONG_FILE_EXTENSION = 'ERROR_WRONG_FILE_EXTENSION';

    public $errorsTexts = [
        self::ERROR_NO_SLOT_AVAILABLE => 'Нет свободных работников в данный момент, попробуйте позже либо повысьте свою максимальную ставку здесь',
        self::ERROR_ZERO_CAPTCHA_FILESIZE => 'Размер капчи которую вы загружаете менее 100 байт',
        self::ERROR_TOO_BIG_CAPTCHA_FILESIZE => 'Ваша капча имеет размер более 100 килобайт',
        self::ERROR_ZERO_BALANCE => 'Нулевой либо отрицательный баланс',
        self::ERROR_IP_NOT_ALLOWED => 'Запрос с этого IP адреса с текущим ключом отклонен. Пожалуйста смотрите раздел управления доступом по IP',
        self::ERROR_CAPTCHA_UNSOLVABLE => 'Не смог разгадать капчу',
        self::ERROR_BAD_DUPLICATES => 'Функция 100% распознавания не сработала и-за лимита попыток',
        self::ERROR_NO_SUCH_METHOD => 'Вы должны слать параметр method в вашем запросе к API, изучите документацию',
        self::ERROR_IMAGE_TYPE_NOT_SUPPORTED => 'Невозможно определить тип файла капчи, принимаются только форматы JPG, GIF, PNG',
        self::ERROR_KEY_DOES_NOT_EXIST => 'Использован несуществующий key',
        self::ERROR_WRONG_USER_KEY => 'Неверный формат параметра key, должно быть 32 символа',
        self::ERROR_WRONG_ID_FORMAT => 'Неверный формат ID каптчи. ID должен содержать только цифры',
        self::ERROR_WRONG_FILE_EXTENSION => 'Ваша каптча имеет неверное расширение, допустимые расширения jpg,jpeg,gif,png',
    ];
}