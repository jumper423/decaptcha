<?php

namespace jumper423\decaptcha\core;

/**
 * Class DeCaptchaAbstract.
 */
class DeCaptchaWiki
{
    private $texts = [];
    /**
     * @var DeCaptchaBase
     */
    private $class;
    private $lang = 'en';

    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    public function __construct($class)
    {
        $this->class = $class;
        $this->texts = [
            'constructor_data' => [
                ($this->class)::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
            ],
            'recognize_file'      => true,
            'recognize_data_file' => 'http://site.com/captcha.jpg',
            'recognize_data'      => [
                ($this->class)::ACTION_FIELD_FILE => 'http://site.com/captcha.jpg',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_KEY => [
                'ru' => 'Ключ',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_KEY => [
                'ru' => 'Ключ от учетной записи',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_LANGUAGE => [
                'ru' => 'На каком языке текст на капче',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_FILE => [
                'ru' => 'Картинка',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_FILE => [
                'ru' => 'Путь на файл с картинкой или ссылка на него',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PHRASE => [
                'ru' => 'Несколько слов',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PHRASE => [
                'ru' => 'Работник должен ввести текст с одним или несколькими пробелами',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_REGSENSE => [
                'ru' => 'Регистр',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_REGSENSE => [
                'ru' => 'Работник должен ввсести ответ с учетом регистра',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_NUMERIC => [
                'ru' => 'Символы',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_NUMERIC => [
                'ru' => 'Какие символы используется в капче',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_CALC => [
                'ru' => 'Вычисление',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_CALC => [
                'ru' => 'На капче изображенно математичекая выражение и её необходимо решить',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Длина min',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Минимальная длина капчи',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Длина max',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Максимальная длина капчи',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_QUESTION => [
                'ru' => 'Вопрос',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_QUESTION => [
                'ru' => 'На изображении задан вопрос, работник должен написать ответ',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'Кириллица',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'На изображении присутствуют русские символы',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Символы какого языка размещенны на капче',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Кросс-доменный',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Необходимо для кросс-доменных AJAX запросов в браузерных приложениях.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Инструкция',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Текстовая капча или инструкция для прохождения капчи.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PINGBACK => [
                'ru' => 'Ответ на',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PINGBACK => [
                'ru' => 'Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_LABEL => [
                'ru' => 'От куда',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_LABEL => [
                'ru' => 'Пояснение от куда пришла капча ("vk", "google", "recaptcha", "yandex", "mailru", "yahoo" и т.д.).',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес страницы на которой решается капча.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Google key',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div>',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Google token',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси (http, socks4, ...)',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PROXY => [
                'ru' => 'Адрес прокси',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PROXY => [
                'ru' => 'IP адрес прокси ipv4/ipv6.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин прокси',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин от прокси-сервера.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль прокси',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль от прокси-сервера.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер.',
            ],
            'field_main_name_'.($this->class)::ACTION_FIELD_COOKIES => [
                'ru' => 'Куки',
            ],
            'field_main_desc_'.($this->class)::ACTION_FIELD_COOKIES => [
                'ru' => 'Дополнительные cookies которые мы должны использовать во время взаимодействия с целевой страницей.',
            ],
            'table_th_name' => [
                'ru' => 'Название',
            ],
            'table_th_code' => [
                'ru' => 'Код',
            ],
            'table_th_type' => [
                'ru' => 'Тип',
            ],
            'table_th_req' => [
                'ru' => 'Обязательное',
            ],
            'table_th_def' => [
                'ru' => 'По умолчания',
            ],
            'table_th_enum' => [
                'ru' => 'Возможные значения',
            ],
            'table_th_desc' => [
                'ru' => 'Описание',
            ],
        ];
    }

    /**
     * @param string|array $name
     * @param string|array $value
     */
    public function setText($name, $value)
    {
        if (is_array($name)) {
            $name = implode('_', $name);
        }
        $this->texts[$name] = $value;
    }

    /**
     * @param string|array $name
     * @param string       $separator
     *
     * @return string
     */
    public function getText($name, $separator = '; ')
    {
        $getResult = function ($name, $texts) {
            if (is_array($name)) {
                $name = implode('_', $name);
            }
            if (!isset($texts[$name])) {
                return null;
            }
            if (is_array($texts[$name])) {
                if (isset($texts[$name][$this->lang])) {
                    return $texts[$name][$this->lang];
                }

                return array_values($texts[$name])[0];
            }

            return $texts[$name];
        };
        $result = $getResult($name, $this->texts);
        if (is_array($result)) {
            $result = implode($separator, $result);
        }

        return $result;
    }

    public function viewFields()
    {
        $str = " {$this->getText(['table','th','name'])} | {$this->getText(['table','th','code'])} | {$this->getText(['table','th','type'])} | {$this->getText(['table','th','req'])} | {$this->getText(['table','th','def'])} | {$this->getText(['table','th','enum'])} | {$this->getText(['table','th','desc'])} ".PHP_EOL;
        $str .= ' --- | --- | --- | --- | --- | ---| --- '.PHP_EOL;
        $rr = (new \ReflectionClass($this->class))->getConstants();
        foreach ($this->class->actions[($this->class)::ACTION_RECOGNIZE][($this->class)::ACTION_FIELDS] as $param => $setting) {
            if (array_key_exists(($this->class)::ACTION_FIELDS, $setting) && is_array($setting[($this->class)::ACTION_FIELDS])) {
                foreach ($setting[($this->class)::ACTION_FIELDS] as $param1 => $setting1) {
                    if (array_key_exists(($this->class)::PARAM_SLUG_NOTWIKI, $setting1) && $setting1[($this->class)::PARAM_SLUG_NOTWIKI] === true) {
                        continue;
                    }
                    $str .= $this->viewFieldLine($rr, $param1, $setting1);
                }
            }
            if (array_key_exists(($this->class)::PARAM_SLUG_NOTWIKI, $setting) && $setting[($this->class)::PARAM_SLUG_NOTWIKI] === true) {
                continue;
            }
            $str .= $this->viewFieldLine($rr, $param, $setting);
        }
        return $str;
    }

    public function viewFieldLine($rr, $param, $setting)
    {
        $str = " {$this->getText(['field', 'main','name',$param])} |";
        $str .=" {$this->ggg($rr, 'ACTION_FIELD_', $param)} |";
        $str .=' '.substr($this->ggg($rr, 'PARAM_FIELD_TYPE_', $setting[($this->class)::PARAM_SLUG_TYPE]), 17).' |';
        $str .=' '.(array_key_exists(($this->class)::PARAM_SLUG_REQUIRE, $setting) ? '+' : '-').' |';
        $str .=' '.(array_key_exists(($this->class)::PARAM_SLUG_DEFAULT, $setting) ? $setting[($this->class)::PARAM_SLUG_DEFAULT] : '').' |';
        $str .=" {$this->getText(['field', 'slug', ($this->class)::PARAM_SLUG_ENUM,$param])} |";
        $str .=" {$this->getText(['field', 'main','desc',$param])} |";
        $str .=PHP_EOL;
        return $str;
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
