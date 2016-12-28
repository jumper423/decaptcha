<?php

namespace jumper423\decaptcha\core;

use jumper423\decaptcha\services\AnticaptchaReCaptcha;
use jumper423\decaptcha\services\RuCaptcha;

/**
 * Class DeCaptchaAbstract.
 */
class DeCaptchaWiki
{
    private $texts = [];

    public function __construct()
    {
        $this->texts = [
            DeCaptchaBase::ACTION_FIELD_KEY => [
                'name' => [
                    'ru' => 'Ключ',
                ],
                'desc' => [
                    'ru' => 'Ключ от учетной записи',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_LANGUAGE => [
                'name' => [
                    'ru' => 'Язык',
                ],
                'desc' => [
                    'ru' => 'На каком языке текст на капче',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_FILE => [
                'name' => [
                    'ru' => 'Картинка',
                ],
                'desc' => [
                    'ru' => 'Путь на файл с картинкой или ссылка на него',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PHRASE => [
                'name' => [
                    'ru' => 'Несколько слов',
                ],
                'desc' => [
                    'ru' => 'Работник должен ввести текст с одним или несколькими пробелами',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_REGSENSE => [
                'name' => [
                    'ru' => 'Регистр',
                ],
                'desc' => [
                    'ru' => 'Работник должен ввсести ответ с учетом регистра',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_NUMERIC => [
                'name' => [
                    'ru' => 'Символы',
                ],
                'desc' => [
                    'ru' => 'Какие символы используется в капче',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_CALC => [
                'name' => [
                    'ru' => 'Вычисление',
                ],
                'desc' => [
                    'ru' => 'На капче изображенно математичекая выражение и её необходимо решить',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_MIN_LEN => [
                'name' => [
                    'ru' => 'Длина min',
                ],
                'desc' => [
                    'ru' => 'Минимальная длина капчи',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_MAX_LEN => [
                'name' => [
                    'ru' => 'Длина max',
                ],
                'desc' => [
                    'ru' => 'Максимальная длина капчи',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_QUESTION => [
                'name' => [
                    'ru' => 'Вопрос',
                ],
                'desc' => [
                    'ru' => 'На изображении задан вопрос, работник должен написать ответ',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_IS_RUSSIAN => [
                'name' => [
                    'ru' => 'Кириллица',
                ],
                'desc' => [
                    'ru' => 'На изображении присутствуют русские символы',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_LANGUAGE => [
                'name' => [
                    'ru' => 'Язык',
                ],
                'desc' => [
                    'ru' => 'Символы какого языка размещенны на капче',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_HEADER_ACAO => [
                'name' => [
                    'ru' => 'Кросс-доменный',
                ],
                'desc' => [
                    'ru' => 'Необходимо для кросс-доменных AJAX запросов в браузерных приложениях.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_INSTRUCTIONS => [
                'name' => [
                    'ru' => 'Инструкция',
                ],
                'desc' => [
                    'ru' => 'Текстовая капча или инструкция для прохождения капчи.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PINGBACK => [
                'name' => [
                    'ru' => 'Ответ на',
                ],
                'desc' => [
                    'ru' => 'Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_LABEL => [
                'name' => [
                    'ru' => 'От куда',
                ],
                'desc' => [
                    'ru' => 'Пояснение от куда пришла капча ("vk", "google", "recaptcha", "yandex", "mailru", "yahoo" и т.д.).',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PAGEURL => [
                'name' => [
                    'ru' => 'Адрес',
                ],
                'desc' => [
                    'ru' => 'Адрес страницы на которой решается капча.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_GOOGLEKEY => [
                'name' => [
                    'ru' => 'Google key',
                ],
                'desc' => [
                    'ru' => 'Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div>',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_GOOGLETOKEN => [
                'name' => [
                    'ru' => 'Google token',
                ],
                'desc' => [
                    'ru' => 'Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PROXYTYPE => [
                'name' => [
                    'ru' => 'Тип прокси',
                ],
                'desc' => [
                    'ru' => 'Тип прокси (http, socks4, ...)',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PROXY => [
                'name' => [
                    'ru' => 'Адрес прокси',
                ],
                'desc' => [
                    'ru' => 'IP адрес прокси ipv4/ipv6.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PROXYPORT => [
                'name' => [
                    'ru' => 'Порт прокси',
                ],
                'desc' => [
                    'ru' => 'Порт прокси.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PROXYLOGIN => [
                'name' => [
                    'ru' => 'Логин прокси',
                ],
                'desc' => [
                    'ru' => 'Логин от прокси-сервера.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_PROXYPASS => [
                'name' => [
                    'ru' => 'Пароль прокси',
                ],
                'desc' => [
                    'ru' => 'Пароль от прокси-сервера.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_USERAGENT => [
                'name' => [
                    'ru' => 'User-Agent браузера',
                ],
                'desc' => [
                    'ru' => 'User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер.',
                ],
            ],
            DeCaptchaBase::ACTION_FIELD_COOKIES => [
                'name' => [
                    'ru' => 'Куки',
                ],
                'desc' => [
                    'ru' => 'Дополнительные cookies которые мы должны использовать во время взаимодействия с целевой страницей.',
                ],
            ],
        ];
    }

    public function view()
    {
        $rucaptcha = new AnticaptchaReCaptcha([]);
        /*
         * Markdown | Less | Pretty
            --- | --- | ---
            *Still* | `renders` | **nicely**
            1 | 2 | 3
         *
         * */
        echo ' Название | Код | Тип | Обязательное | По умолчания | Возможные значения | Описание '.PHP_EOL;
        echo ' --- | --- | --- | --- | --- | ---| --- '.PHP_EOL;
        $rr = (new \ReflectionClass($rucaptcha))->getConstants();
//        print_r($rucaptcha->actions);
        foreach ($rucaptcha->actions[RuCaptcha::ACTION_RECOGNIZE][RuCaptcha::ACTION_FIELDS] as $param => $setting) {
            if (array_key_exists(RuCaptcha::ACTION_FIELDS, $setting) && is_array($setting[RuCaptcha::ACTION_FIELDS])) {
                foreach ($setting[RuCaptcha::ACTION_FIELDS] as $param1 => $setting1) {
                    if (array_key_exists(RuCaptcha::PARAM_SLUG_NOTWIKI, $setting1) && $setting1[RuCaptcha::PARAM_SLUG_NOTWIKI] === true) {
                        continue;
                    }
                    $this->line($rr, $param1, $setting1);
                }
            }
            if (array_key_exists(RuCaptcha::PARAM_SLUG_NOTWIKI, $setting) && $setting[RuCaptcha::PARAM_SLUG_NOTWIKI] === true) {
                continue;
            }
            $this->line($rr, $param, $setting);
//            echo " --- | --- | --- | --- | ---| --- " . PHP_EOL;
//            print_r($params);
        }
//        $rr = get_defined_constants(true);
//        print_r(array_keys($rr));
//        print_r($rr);
//        file_put_contents(__DIR__ . '/12331123', json_encode(get_defined_constants(true)));
    }

    public function line($rr, $param, $setting){
        if (isset($this->texts[$param])) {
            echo " {$this->texts[$param]['name']['ru']} |";
        } else {
            echo ' |';
        }
        echo " {$this->ggg($rr, 'ACTION_FIELD_', $param)} |";
        echo ' '.substr($this->ggg($rr, 'PARAM_FIELD_TYPE_', $setting[RuCaptcha::PARAM_SLUG_TYPE]), 17).' |';
        echo ' '.(array_key_exists(RuCaptcha::PARAM_SLUG_REQUIRE, $setting) ? '+' : '-').' |';
        echo ' '.(array_key_exists(RuCaptcha::PARAM_SLUG_DEFAULT, $setting) ? $setting[RuCaptcha::PARAM_SLUG_DEFAULT] : '').' |';
        echo ' |';
        if (isset($this->texts[$param])) {
            echo " {$this->texts[$param]['desc']['ru']} ";
        } else {
            echo ' ';
        }
        echo PHP_EOL;
    }

    public function ggg($constants, $keyMask, $value)
    {
        foreach ($constants as $key => $val) {
            if (stripos($key, $keyMask) !== false && $val === $value) {
                return $key;
            }
        }

        return null;
    }
}
