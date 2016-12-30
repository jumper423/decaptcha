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
                $class::ACTION_FIELD_KEY => '94f39af4bb295c40546fba5c932e0d32',
            ],
            'recognize_file'                                    => true,
            'recognize_data_file'                               => 'http://site.com/captcha.jpg',
            'recognize_data'                                    => [],
            'field_main_name_'.$class::ACTION_FIELD_KEY         => [
                'ru' => 'Ключ',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_KEY => [
                'ru' => 'Ключ от учетной записи',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'На каком языке текст на капче',
            ],
            'field_main_name_'.$class::ACTION_FIELD_FILE => [
                'ru' => 'Картинка',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_FILE => [
                'ru' => 'Путь на файл с картинкой или ссылка на него',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PHRASE => [
                'ru' => 'Несколько слов',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PHRASE => [
                'ru' => 'Работник должен ввести текст с одним или несколькими пробелами',
            ],
            'field_main_name_'.$class::ACTION_FIELD_REGSENSE => [
                'ru' => 'Регистр',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_REGSENSE => [
                'ru' => 'Работник должен ввсести ответ с учетом регистра',
            ],
            'field_main_name_'.$class::ACTION_FIELD_NUMERIC => [
                'ru' => 'Символы',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_NUMERIC => [
                'ru' => 'Какие символы используется в капче',
            ],
            'field_main_name_'.$class::ACTION_FIELD_CALC => [
                'ru' => 'Вычисление',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_CALC => [
                'ru' => 'На капче изображенно математичекая выражение и её необходимо решить',
            ],
            'field_main_name_'.$class::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Длина min',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Минимальная длина капчи',
            ],
            'field_main_name_'.$class::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Длина max',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Максимальная длина капчи',
            ],
            'field_main_name_'.$class::ACTION_FIELD_QUESTION => [
                'ru' => 'Вопрос',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_QUESTION => [
                'ru' => 'На изображении задан вопрос, работник должен написать ответ',
            ],
            'field_main_name_'.$class::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'Кириллица',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'На изображении присутствуют русские символы',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Символы какого языка размещенны на капче',
            ],
            'field_main_name_'.$class::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Кросс-доменный',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Необходимо для кросс-доменных AJAX запросов в браузерных приложениях.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Инструкция',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Текстовая капча или инструкция для прохождения капчи.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PINGBACK => [
                'ru' => 'Ответ на',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PINGBACK => [
                'ru' => 'Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LABEL => [
                'ru' => 'От куда',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LABEL => [
                'ru' => 'Пояснение от куда пришла капча ("vk", "google", "recaptcha", "yandex", "mailru", "yahoo" и т.д.).',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес страницы на которой решается капча.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Google key',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div>',
            ],
            'field_main_name_'.$class::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Google token',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси (http, socks4, ...)',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXY => [
                'ru' => 'Адрес прокси',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXY => [
                'ru' => 'IP адрес прокси ipv4/ipv6.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин прокси',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин от прокси-сервера.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль прокси',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль от прокси-сервера.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_COOKIES => [
                'ru' => 'Куки',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_COOKIES => [
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
                'ru' => 'Обяз.', //Обязательное
            ],
            'table_th_def' => [
                'ru' => 'По ум.', //По умолчания
            ],
            'table_th_enum' => [
                'ru' => 'Возможные значения',
            ],
            'table_th_desc' => [
                'ru' => 'Описание',
            ],
            'slug_link' => [
                'ru' => 'Ссылка',
            ],
            'slug_link_to_service' => [
                'ru' => 'Ссылка на сервис',
            ],
            'slug_price' => [
                'ru' => 'Цены',
            ],
            'slug_service_desc' => [
                'ru' => 'Описание сервиса',
            ],
            'slug_recognize_desc' => [
                'ru' => 'Описание распознания',
            ],
            'slug_fields_desc' => [
                'ru' => 'Описание полей',
            ],
            'example' => [
                'ru' => 'Примеры',
            ],
            'example_initialization' => [
                'ru' => 'Инициализация',
            ],
            'example_initialization_desc' => [
                'ru' => 'Указываем ключ, обязательные и дополнительные параметры. Старайтесь по максимуму их заполнить это способствует более быстрому распознанию капчи.',
            ],
            'example_recognize' => [
                'ru' => 'Распознавание',
            ],
            'example_recognize_desc' => [
                'ru' => 'В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.',
            ],
            'example_nottrue' => [
                'ru' => 'Не верно распознано',
            ],
            'example_nottrue_desc' => [
                'ru' => 'Если Вы сможете понять что ответ которые пришёл не верные. Обязательно добавьте ниже написанный код. Это Вам съекономит деньги.',
            ],
            'example_balance' => [
                'ru' => 'Баланс',
            ],
            'example_error_lang_if' => [
                'ru' => true,
                'en' => false,
            ],
            'example_error_lang' => [
                'ru' => 'Язык ошибки',
            ],
            'example_error_lang_desc' => [
                'ru' => 'По умолчанию ошибки на англиском языке, если необходимо переоперелить, сделайте следующее',
            ],
            'example_error_interception' => [
                'ru' => 'Перехват ошибки',
            ],
            'example_error_interception_desc' => [
                'ru' => 'При желании Вы можете перехватывать ошибку, но для этого надо вызвать setCauseAnError',
            ],
            'install' => [
                'ru' => 'Установка',
            ],
            'install_preferred' => [
                'ru' => 'Предпочтительный способ установить это расширение через',
            ],
            'install_start' => [
                'ru' => 'Либо запустить',
            ],
            'install_add' => [
                'ru' => 'или добавить',
            ],
            'install_add_file' => [
                'ru' => 'в файл',
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
     * @return string|array
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
            if ($separator) {
                $result = implode($separator, $result);
            }
        }

        return $result;
    }

    private function viewInstall()
    {
        $class = $this->class;
        $str = "{$this->getText(['install', 'preferred'])} [composer](http://getcomposer.org/download/).".PHP_EOL;
        $str .= PHP_EOL;
        $str .= "{$this->getText(['install', 'start'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= 'php composer.phar require --prefer-dist jumper423/decaptcha "*"'.PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "{$this->getText(['install', 'add'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= '"jumper423/decaptcha": "*"'.PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "{$this->getText(['install', 'add', 'file'])} `composer.json`.".PHP_EOL;

        return $str;
    }

    private function viewExamples()
    {
        $class = $this->class;
        $rc = (new \ReflectionClass($class));

        $str = "#####{$this->getText(['example', 'initialization'])}".PHP_EOL;
        $str .= "{$this->getText(['example', 'initialization', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "use {$rc->getName()};".PHP_EOL;
        $str .= ''.PHP_EOL;
        $str .= '$captcha = new '.$rc->getShortName().'(['.PHP_EOL;
        foreach ($this->texts['constructor_data'] as $key => $val) {
            $str .= "    {$rc->getShortName()}::{$this->getNameConst('ACTION_FIELD_', $key)} => ";
            if (is_string($val)) {
                $str .= "'{$val}'";
            } else {
                $str .= "{$val}";
            }
            $str .= ','.PHP_EOL;
        }
        $str .= ']);'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        $str .= "#####{$this->getText(['example', 'recognize'])}".PHP_EOL;
        $str .= "{$this->getText(['example', 'recognize', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= 'if ($captcha->recognize(';
        if ($this->texts['recognize_file']) {
            $str .= "'{$this->getText(['recognize', 'data', 'file'])}'";
        }
        if ($this->texts['recognize_data']) {
            if ($this->texts['recognize_file']) {
                $str .= ', ';
            }
            $str .= '['.PHP_EOL;
            foreach ($this->texts['recognize_data'] as $key => $val) {
                $str .= "    {$rc->getShortName()}::{$this->getNameConst('ACTION_FIELD_', $key)} => ";
                if (is_string($val)) {
                    $str .= "'{$val}'";
                } else {
                    $str .= "{$val}";
                }
                $str .= ','.PHP_EOL;
            }
            $str .= ']';
        }
        $str .= ')) {'.PHP_EOL;
        $str .= '    $code = $captcha->getCode();'.PHP_EOL;
        $str .= '} else {'.PHP_EOL;
        $str .= '    $error = $captcha->getError();'.PHP_EOL;
        $str .= '}'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        if (in_array('notTrue', get_class_methods($class))) {
            $str .= "#####{$this->getText(['example', 'nottrue'])}".PHP_EOL;
            $str .= "{$this->getText(['example', 'nottrue', 'desc'])}".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$captcha->notTrue();'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        if (in_array('getBalance', get_class_methods($class))) {
            $str .= "#####{$this->getText(['example', 'balance'])}".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$balance = $captcha->getBalance();'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        if ($this->getText(['example', 'error', 'lang', 'if'])) {
            $str .= "#####{$this->getText(['example', 'error', 'lang'])}".PHP_EOL;
            $str .= "{$this->getText(['example', 'error', 'lang', 'desc'])}".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        $str .= "#####{$this->getText(['example', 'error', 'interception'])}".PHP_EOL;
        $str .= "{$this->getText(['example', 'error', 'interception', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= '$captcha->setCauseAnError(true);'.PHP_EOL;
        $str .= PHP_EOL;
        $str .= 'try {'.PHP_EOL;
        $str .= '    $captcha->recognize(';
        if ($this->texts['recognize_file']) {
            $str .= "'{$this->getText(['recognize', 'data', 'file'])}'";
        }
        if ($this->texts['recognize_data']) {
            if ($this->texts['recognize_file']) {
                $str .= ', ';
            }
            $str .= '['.PHP_EOL;
            foreach ($this->texts['recognize_data'] as $key => $val) {
                $str .= "       {$rc->getShortName()}::{$this->getNameConst('ACTION_FIELD_', $key)} => ";
                if (is_string($val)) {
                    $str .= "'{$val}'";
                } else {
                    $str .= "{$val}";
                }
                $str .= ','.PHP_EOL;
            }
            $str .= '    ]';
        }
        $str .= ');'.PHP_EOL;
        $str .= '    $code = $captcha->getCode();'.PHP_EOL;
        $str .= '} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {'.PHP_EOL;
        $str .= '    ...'.PHP_EOL;
        $str .= '}'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        return $str;
    }

    private function viewFields()
    {
        $class = $this->class;
        $str = " {$this->getText(['table', 'th', 'name'])} | {$this->getText(['table', 'th', 'code'])} | {$this->getText(['table', 'th', 'type'])} | {$this->getText(['table', 'th', 'req'])} | {$this->getText(['table', 'th', 'def'])} | {$this->getText(['table', 'th', 'enum'])} | {$this->getText(['table', 'th', 'desc'])} ".PHP_EOL;
        $str .= ' --- | --- | --- | --- | --- | --- | --- '.PHP_EOL;
        foreach ($this->class->actions[$class::ACTION_RECOGNIZE][$class::ACTION_FIELDS] as $param => $setting) {
            if (array_key_exists($class::ACTION_FIELDS, $setting) && is_array($setting[$class::ACTION_FIELDS])) {
                foreach ($setting[$class::ACTION_FIELDS] as $param1 => $setting1) {
                    if (array_key_exists($class::PARAM_SLUG_NOTWIKI, $setting1) && $setting1[$class::PARAM_SLUG_NOTWIKI] === true) {
                        continue;
                    }
                    $str .= $this->viewFieldLine($param1, $setting1);
                }
            }
            if (array_key_exists($class::PARAM_SLUG_NOTWIKI, $setting) && $setting[$class::PARAM_SLUG_NOTWIKI] === true) {
                continue;
            }
            $str .= $this->viewFieldLine($param, $setting);
        }

        return $str;
    }

    private function viewFieldLine($param, $setting)
    {
        $class = $this->class;
        $str = " {$this->getText(['field', 'main', 'name', $param])} |";
        $str .= " {$this->getNameConst('ACTION_FIELD_', $param)} |";
//        if (isset($setting[$class::PARAM_SLUG_TYPE])) {
            $str .= ' '.substr($this->getNameConst('PARAM_FIELD_TYPE_', $setting[$class::PARAM_SLUG_TYPE]), 17).' |';
//        } else {
//            $str .= ' |';
//        }
        $str .= ' '.(array_key_exists($class::PARAM_SLUG_REQUIRE, $setting) ? '+' : '-').' |';
        $str .= ' '.(array_key_exists($class::PARAM_SLUG_DEFAULT, $setting) ? $setting[$class::PARAM_SLUG_DEFAULT] : '').' |';
        $str .= " {$this->getText(['field', 'slug', $class::PARAM_SLUG_ENUM, $param])} |";
        $str .= " {$this->getText(['field', 'main', 'desc', $param])} |";
        $str .= PHP_EOL;

        return $str;
    }

    private function getNameConst($keyMask, $value)
    {
        $class = $this->class;
        $constants = (new \ReflectionClass($class))->getConstants();
        foreach ($constants as $key => $val) {
            if (stripos($key, $keyMask) !== false && $val === $value) {
                return $key;
            }
        }

        return null;
    }

    public function view()
    {
        $str = $this->getText(['service', 'name']).PHP_EOL;
        $str .= '=============='.PHP_EOL;
        $str .= "###{$this->getText(['slug', 'link'])}".PHP_EOL;
        $str .= "[{$this->getText(['slug', 'link', 'to_service'])} {$this->getText(['service', 'name'])}]({$this->getText(['service', 'href'])})".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['slug', 'service', 'desc'])}".PHP_EOL;
        $str .= "{$this->getText(['service', 'desc'])}".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['slug', 'price'])}".PHP_EOL;
        $str .= "{$this->getText(['recognize', 'price'])}".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['slug', 'recognize', 'desc'])}".PHP_EOL;
        $str .= "{$this->getText(['recognize', 'desc'])}".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['install'])}".PHP_EOL;
        $str .= "{$this->viewInstall()}".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['example'])}".PHP_EOL;
        $str .= "{$this->viewExamples()}".PHP_EOL.PHP_EOL;
        $str .= "###{$this->getText(['slug', 'fields', 'desc'])}".PHP_EOL;
        $str .= $this->viewFields().PHP_EOL;

        return $str;
    }

    public function getFileName()
    {
        $class = $this->class;

        return (new \ReflectionClass($class))->getShortName();
    }

    public function save()
    {
        file_put_contents(__DIR__.'/../../docs/'.$this->getFileName().'-'.$this->lang.'.md', $this->view());
    }
}
