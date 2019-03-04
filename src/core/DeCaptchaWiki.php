<?php

namespace jumper423\decaptcha\core;

/**
 * Class DeCaptchaAbstract.
 */
class DeCaptchaWiki
{
    protected $texts = [];
    /**
     * @var DeCaptchaBase
     */
    protected $class;
    protected $lang = 'en';

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
            'recognize_file'                            => true,
            'recognize_data_file'                       => 'http://site.com/captcha.jpg',
            'recognize_data'                            => [],
            'field_main_name_'.$class::ACTION_FIELD_KEY => [
                'ru' => 'Ключ',
                'en' => 'Key',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_KEY => [
                'ru' => 'Ключ от учетной записи',
                'en' => 'Key account',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
                'en' => 'Language',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'На каком языке текст на капче',
                'en' => 'What language the text on the captcha',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LANG => [
                'ru' => 'Код языка',
                'en' => 'Language code',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LANG => [
                'ru' => 'См. список поддерживаемых языков. https://rucaptcha.com/api-rucaptcha#language',
                'en' => 'See the list of supported languages. https://2captcha.com/api-rucaptcha#language',
            ],
            'field_main_name_'.$class::ACTION_FIELD_FILE => [
                'ru' => 'Картинка',
                'en' => 'Picture',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_FILE => [
                'ru' => 'Путь на файл с картинкой или ссылка на него',
                'en' => 'The path to the picture file or link to it',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PHRASE => [
                'ru' => 'Несколько слов',
                'en' => 'A few words',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PHRASE => [
                'ru' => 'Работник должен ввести текст с одним или несколькими пробелами',
                'en' => 'The worker must enter text with one or more spaces',
            ],
            'field_main_name_'.$class::ACTION_FIELD_REGSENSE => [
                'ru' => 'Регистр',
                'en' => 'Register',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_REGSENSE => [
                'ru' => 'Работник должен ввести ответ с учетом регистра',
                'en' => 'The worker must enter the answer case sensitive',
            ],
            'field_main_name_'.$class::ACTION_FIELD_NUMERIC => [
                'ru' => 'Символы',
                'en' => 'Characters',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_NUMERIC => [
                'ru' => 'Какие символы используется в капче',
                'en' => 'What are the symbols used in captcha',
            ],
            'field_main_name_'.$class::ACTION_FIELD_CALC => [
                'ru' => 'Вычисление',
                'en' => 'Calculation',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_CALC => [
                'ru' => 'На капче изображенно математичекая выражение и её необходимо решить',
                'en' => 'The captcha shows matematicheskaya expression and must be addressed',
            ],
            'field_main_name_'.$class::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Длина min',
                'en' => 'Length min',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_MIN_LEN => [
                'ru' => 'Минимальная длина капчи',
                'en' => 'The minimum length of captcha',
            ],
            'field_main_name_'.$class::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Длина max',
                'en' => 'Length max',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_MAX_LEN => [
                'ru' => 'Максимальная длина капчи',
                'en' => 'The maximum length of the captcha',
            ],
            'field_main_name_'.$class::ACTION_FIELD_QUESTION => [
                'ru' => 'Вопрос',
                'en' => 'Question',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_QUESTION => [
                'ru' => 'На изображении задан вопрос, работник должен написать ответ',
                'en' => 'The image asked, the employee must write the answer',
            ],
            'field_main_name_'.$class::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'Кириллица',
                'en' => 'Cyrillic',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_IS_RUSSIAN => [
                'ru' => 'На изображении присутствуют русские символы',
                'en' => 'In the image there are Russian characters',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Язык',
                'en' => 'Language',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LANGUAGE => [
                'ru' => 'Символы какого языка размещенны на капче',
                'en' => 'The symbols of the language posted on the captcha',
            ],
            'field_main_name_'.$class::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Кросс-доменный',
                'en' => 'Cross-domain',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_HEADER_ACAO => [
                'ru' => 'Необходимо для кросс-доменных AJAX запросов в браузерных приложениях.',
                'en' => 'Need for cross-domain AJAX requests in browser-based applications.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Инструкция',
                'en' => 'Manual',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_INSTRUCTIONS => [
                'ru' => 'Текстовая капча или инструкция для прохождения капчи.',
                'en' => 'Text captcha or manual to pass the captcha.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PINGBACK => [
                'ru' => 'Ответ на',
                'en' => 'Response to',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PINGBACK => [
                'ru' => 'Указание для сервера, что после распознания изображения, нужно отправить ответ на указанный адрес.',
                'en' => 'Note to server, after recognizing the image, you need to send a reply to the specified address.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_LABEL => [
                'ru' => 'От куда',
                'en' => 'From where',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_LABEL => [
                'ru' => 'Пояснение от куда пришла капча ("vk", "google", "recaptcha", "yandex", "mailru", "yahoo" и т.д.).',
                'en' => 'Clarification from where came the captcha ("vk", "google", "recaptcha", "yandex", "Google", "yahoo", etc.).',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес',
                'en' => 'Link',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PAGEURL => [
                'ru' => 'Адрес страницы на которой решается капча.',
                'en' => 'The address of the page where the captcha is solved.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Google key',
                'en' => 'Google key',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_GOOGLEKEY => [
                'ru' => 'Ключ-индентификатор рекапчи на целевой странице. <div class="g-recaptcha" data-sitekey="ВОТ_ЭТОТ"></div>',
                'en' => 'Key-the identifier of the recaptcha on the landing page. <div class="g-recaptcha" data-sitekey="THIS"></div>',
            ],
            'field_main_name_'.$class::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Google token',
                'en' => 'Google token',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_GOOGLETOKEN => [
                'ru' => 'Секретный токен для предыдущей версии рекапчи. В большинстве случаев сайты используют новую версию и этот токен не требуется. Секретный токен генерируется на сервере Google и вставляется на страницу в атрибуте data-stoken. Выглядит это примерно так: <script type="text/javascript" src="...." data-type="normal"  data-ray="..." async data-sitekey="..." data-stoken="ВОТ_ЭТОТ"></script> Токен действует пару минут после генерации, затем нужно снова зайти на страницу и получить его.',
                'en' => 'The secret token for the previous version of recaptcha. In most cases, sites use the new version and this token is not required. The secret token is generated on a Google server and inserted into the page in the attribute data-stoken. It looks like this: <script type="text/javascript" src="...." data-type="normal" data-ray="..." async data-sitekey="..." data-stoken="THIS"></script> the Token is valid a few minutes after generation, then you need to go back to the page and get it.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_INVISIBLE => [
                'ru' => 'Невидимая ReCaptcha',
                'en' => 'Invisible ReCaptcha',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_INVISIBLE => [
                'ru' => '1 — говорит нам, что на сайте невидимая ReCaptcha. 0 — обычная ReCaptcha.',
                'en' => '1 - tells us that the site is invisible ReCaptcha. 0 - regular ReCaptcha.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_SSC_USER_ID => [
                'ru' => 'Параметра s_s_c_user_id',
                'en' => 'Parameter s_s_c_user_id',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_SSC_USER_ID => [
                'ru' => 'Значение параметра s_s_c_user_id, найденное на странице',
                'en' => 'The value of the s_s_c_user_id parameter found on the page',
            ],
            'field_main_name_'.$class::ACTION_FIELD_SSC_SESSION_ID => [
                'ru' => 'Параметра s_s_c_session_id',
                'en' => 'Parameter s_s_c_session_id',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_SSC_SESSION_ID => [
                'ru' => 'Значение параметра s_s_c_session_id, найденное на странице',
                'en' => 'The value of the s_s_c_session_id parameter found on the page',
            ],
            'field_main_name_'.$class::ACTION_FIELD_SSC_WEB_SERVER_SIGN => [
                'ru' => 'Параметра s_s_c_web_server_sign',
                'en' => 'Parameter s_s_c_web_server_sign',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_SSC_WEB_SERVER_SIGN => [
                'ru' => 'Значение параметра s_s_c_web_server_sign, найденное на странице',
                'en' => 'The value of the s_s_c_web_server_sign parameter found on the page',
            ],
            'field_main_name_'.$class::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => [
                'ru' => 'Параметра s_s_c_web_server_sign2',
                'en' => 'Parameter s_s_c_web_server_sign2',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_SSC_WEB_SERVER_SIGN2 => [
                'ru' => 'Значение параметра s_s_c_web_server_sign2, найденное на странице',
                'en' => 'The value of the s_s_c_web_server_sign2 parameter found on the page',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PUBLICKEY => [
                'ru' => 'Параметра data-pkey',
                'en' => 'Parameter data-pkey',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PUBLICKEY => [
                'ru' => 'Найти div с FunCaptcha и посмотреть на значение параметра data-pkey или же найти элемент с именем (name) fc-token, а из его значения вырезать ключ, который указан после pk',
                'en' => 'Find a div with FunCaptcha and look at the value of the data-pkey parameter, or find an element with the name (name) fc-token, and cut the key from its value after the pk',
            ],
            'field_main_name_'.$class::ACTION_FIELD_NOJS => [
                'ru' => 'Истользовать JS',
                'en' => 'Истользовать JS',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_NOJS => [
                'ru' => 'Говорит нам решать FunCaptcha с выключенным javascript. Может быть использован в случае, если нормальный метод по какой-то причине не срабатывает. Важно: имейте в виду, что в этом случае мы вернём только часть токена. Выше описано, что делать в этом случае.',
                'en' => 'Tells us to solve FunCaptcha with javascript turned off. It can be used in case the normal method for some reason does not work. Important: keep in mind that in this case we will return only part of the token. The above is what to do in this case.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_MIN_SCORE => [
                'ru' => 'Минимальный рейтинг',
                'en' => 'Min rating',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_MIN_SCORE => [
                'ru' => 'Требуемое значение рейтинга (score). На текущий момент сложно получить токен со score выше 0.3',
                'en' => 'Required rating value (score). Currently it is difficult to get a token with a score above 0.3',
            ],
            'field_main_name_'.$class::ACTION_FIELD_GT => [
                'ru' => 'Параметр gt',
                'en' => 'gt parameter',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_GT => [
                'ru' => 'Значение параметра gt найденное на сайте',
                'en' => 'The value of the api_server parameter found on the site',
            ],
            'field_main_name_'.$class::ACTION_FIELD_CHALLENGE => [
                'ru' => 'Параметр challenge',
                'en' => 'challenge parameter',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_CHALLENGE => [
                'ru' => 'Значение параметра challenge найденное на сайте',
                'en' => 'The value of the api_server parameter found on the site',
            ],
            'field_main_name_'.$class::ACTION_FIELD_API_SERVER => [
                'ru' => 'Параметр api_server',
                'en' => 'api_server parameter',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_API_SERVER => [
                'ru' => 'Значение параметра api_server найденное на сайте',
                'en' => 'The value of the api_server parameter found on the site',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси',
                'en' => 'The proxy type',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYTYPE => [
                'ru' => 'Тип прокси (http, socks4, ...)',
                'en' => 'The proxy type (http, socks4, ...)',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXY => [
                'ru' => 'Адрес прокси',
                'en' => 'The proxy address',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXY => [
                'ru' => 'IP адрес прокси ipv4/ipv6.',
                'en' => 'IP address of the proxy ipv4/ipv6.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси',
                'en' => 'Proxy port',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYPORT => [
                'ru' => 'Порт прокси.',
                'en' => 'Proxy port.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин прокси',
                'en' => 'Login proxy',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYLOGIN => [
                'ru' => 'Логин от прокси-сервера.',
                'en' => 'Login from proxy server.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль прокси',
                'en' => 'Password proxy',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_PROXYPASS => [
                'ru' => 'Пароль от прокси-сервера.',
                'en' => 'The password for the proxy server.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера',
                'en' => 'User-Agent browser',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_USERAGENT => [
                'ru' => 'User-Agent браузера, используемый в эмуляции. Необходимо использовать подпись современного браузера, иначе Google будет возвращать ошибку, требуя обновить браузер.',
                'en' => 'User-Agent browser used in emulation. You must use the signature modern browser, otherwise Google will return an error requiring you to upgrade your browser.',
            ],
            'field_main_name_'.$class::ACTION_FIELD_COOKIES => [
                'ru' => 'Куки',
                'en' => 'Cookies',
            ],
            'field_main_desc_'.$class::ACTION_FIELD_COOKIES => [
                'ru' => 'Дополнительные cookies которые мы должны использовать во время взаимодействия с целевой страницей.',
                'en' => 'Additional cookies which we should use during the interaction with the target page.',
            ],
            'table_th_name' => [
                'ru' => 'Название',
                'en' => 'Name',
            ],
            'table_th_code' => [
                'ru' => 'Код',
                'en' => 'Code',
            ],
            'table_th_type' => [
                'ru' => 'Тип',
                'en' => 'Type',
            ],
            'table_th_req' => [
                'ru' => 'Обяз.', //Обязательное
                'en' => 'Req.', //Required
            ],
            'table_th_def' => [
                'ru' => 'По ум.', //По умолчания
                'en' => 'By def.', //By default
            ],
            'table_th_enum' => [
                'ru' => 'Возможные значения',
                'en' => 'Possible values',
            ],
            'table_th_desc' => [
                'ru' => 'Описание',
                'en' => 'Description',
            ],
            'slug_link' => [
                'ru' => 'Ссылка',
                'en' => 'Link',
            ],
            'slug_link_to_service' => [
                'ru' => 'Ссылка на сервис',
                'en' => 'The link to the service',
            ],
            'slug_price' => [
                'ru' => 'Цены',
                'en' => 'Prices',
            ],
            'slug_service_desc' => [
                'ru' => 'Описание сервиса',
                'en' => 'The description of the service',
            ],
            'slug_recognize_desc' => [
                'ru' => 'Описание распознания',
                'en' => 'Description recognition',
            ],
            'slug_fields_desc' => [
                'ru' => 'Описание полей',
                'en' => 'A description of the fields',
            ],
            'example' => [
                'ru' => 'Примеры',
                'en' => 'Examples',
            ],
            'example_initialization' => [
                'ru' => 'Инициализация',
                'en' => 'Initialization',
            ],
            'example_initialization_desc' => [
                'ru' => 'Указываем ключ, обязательные и дополнительные параметры. Старайтесь по максимуму их заполнить это способствует более быстрому распознанию капчи.',
                'en' => 'Specify the key mandatory and optional parameters. Try the best to fill this promotes more rapid recognition of captcha.',
            ],
            'example_recognize' => [
                'ru' => 'Распознавание',
                'en' => 'Recognition',
            ],
            'example_recognize_desc' => [
                'ru' => 'В первом параметре передаём ссылку или путь на файл с картинкой, во второй параметры распознания при необходимости переопределения тех которые были переданы при инициализации.',
                'en' => 'In the first parameter, pass the link or path to the picture file in the second parameters of the recognition if necessary, override those which were transferred during the initialization.',
            ],
            'example_nottrue' => [
                'ru' => 'Не верно распознано',
                'en' => 'Not correctly recognized',
            ],
            'example_nottrue_desc' => [
                'ru' => 'Если Вы сможете понять что ответ которые пришёл не верные. Обязательно добавьте ниже написанный код. Это Вам съекономит деньги.',
                'en' => 'If You can understand that the answer which did not come true. Be sure to add below written code. It will save You money.',
            ],
            'example_balance' => [
                'ru' => 'Баланс',
                'en' => 'Balance',
            ],
            'example_error_lang_if' => [
                'ru' => true,
                'en' => false,
            ],
            'example_error_lang' => [
                'ru' => 'Язык ошибки',
                'en' => 'Language errors',
            ],
            'example_error_lang_desc' => [
                'ru' => 'По умолчанию ошибки на англиском языке, если необходимо переоперелить, сделайте следующее',
                'en' => 'Default error in English, if you want to properlyt, do the following',
            ],
            'example_error_interception' => [
                'ru' => 'Перехват ошибки',
                'en' => 'Intercept errors',
            ],
            'example_error_interception_desc' => [
                'ru' => 'При желании Вы можете перехватывать ошибку, но для этого надо вызвать setCauseAnError',
                'en' => 'If you wish, You can catch the error, but you need to call setCauseAnError',
            ],
            'install' => [
                'ru' => 'Установка',
                'en' => 'Installation',
            ],
            'install_preferred' => [
                'ru' => 'Предпочтительный способ установить это расширение через',
                'en' => 'The preferred way to install this extension via',
            ],
            'install_start' => [
                'ru' => 'Либо запустить',
                'en' => 'Or you can run',
            ],
            'install_add' => [
                'ru' => 'или добавить',
                'en' => 'or add',
            ],
            'install_add_file' => [
                'ru' => 'в файл',
                'en' => 'in file',
            ],
            'slug_menu' => [
                'ru' => 'Меню',
                'en' => 'Menu',
            ],
            'slug_menu_main' => [
                'ru' => 'Главная',
                'en' => 'Main',
            ],
            'slug_menu_another' => [
                'ru' => 'Documentation in English language',
                'en' => 'Документация на русском языке',
            ],
            'slug_menu_anchor' => [
                'ru' => 'Якоря',
                'en' => 'Anchor',
            ],
            'slug_menu_from_service' => [
                'ru' => 'Другой функционал от сервиса',
                'en' => 'Other functionality from the service',
            ],
        ];
    }

    /**
     * @param string|array      $name
     * @param string|array|bool $value
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

    protected function viewInstall()
    {
        $str = "{$this->getText(['install', 'preferred'])} [composer](http://getcomposer.org/download/).".PHP_EOL;
        $str .= PHP_EOL;
        $str .= "{$this->getText(['install', 'start'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= 'composer require --prefer-dist jumper423/decaptcha "*"'.PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "{$this->getText(['install', 'add'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= '"jumper423/decaptcha": "*"'.PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "{$this->getText(['install', 'add', 'file'])} `composer.json`.".PHP_EOL;

        return $str;
    }

    protected function viewExamples()
    {
        $class = $this->class;
        $reflection = (new \ReflectionClass($class));

        $str = "__{$this->getText(['example', 'initialization'])}__".PHP_EOL;
        $str .= "{$this->getText(['example', 'initialization', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= "use {$reflection->getName()};".PHP_EOL;
        $str .= ''.PHP_EOL;
        $str .= '$captcha = new '.$reflection->getShortName().'(['.PHP_EOL;
        foreach ($this->texts['constructor_data'] as $key => $val) {
            $str .= "    {$reflection->getShortName()}::{$this->getNameConst('ACTION_FIELD_', $key)} => ";
            $str .= is_string($val) ? "'{$val}'" : $val;
            $str .= ','.PHP_EOL;
        }
        $str .= ']);'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        $str .= "__{$this->getText(['example', 'recognize'])}__".PHP_EOL;
        $str .= "{$this->getText(['example', 'recognize', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= 'if ($captcha->recognize(';
        $str .= $this->getRecognizeFile();
        $str .= $this->getRecognizeData();
        $str .= ')) {'.PHP_EOL;
        $str .= '    $code = $captcha->getCode();'.PHP_EOL;
        $str .= '} else {'.PHP_EOL;
        $str .= '    $error = $captcha->getError();'.PHP_EOL;
        $str .= '}'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        if (in_array('notTrue', get_class_methods($class))) {
            $str .= "__{$this->getText(['example', 'nottrue'])}__".PHP_EOL;
            $str .= "{$this->getText(['example', 'nottrue', 'desc'])}".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$captcha->notTrue();'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        if (in_array('getBalance', get_class_methods($class))) {
            $str .= "__{$this->getText(['example', 'balance'])}__".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$balance = $captcha->getBalance();'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        if ($this->getText(['example', 'error', 'lang', 'if'])) {
            $str .= "__{$this->getText(['example', 'error', 'lang'])}__".PHP_EOL;
            $str .= "{$this->getText(['example', 'error', 'lang', 'desc'])}".PHP_EOL;
            $str .= '```'.PHP_EOL;
            $str .= '$captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);'.PHP_EOL;
            $str .= '```'.PHP_EOL;
        }

        $str .= "__{$this->getText(['example', 'error', 'interception'])}__".PHP_EOL;
        $str .= "{$this->getText(['example', 'error', 'interception', 'desc'])}".PHP_EOL;
        $str .= '```'.PHP_EOL;
        $str .= '$captcha->setCauseAnError(true);'.PHP_EOL;
        $str .= PHP_EOL;
        $str .= 'try {'.PHP_EOL;
        $str .= '    $captcha->recognize(';
        $str .= $this->getRecognizeFile();
        $str .= $this->getRecognizeData();
        $str .= ');'.PHP_EOL;
        $str .= '    $code = $captcha->getCode();'.PHP_EOL;
        $str .= '} catch (\jumper423\decaptcha\core\DeCaptchaErrors $e) {'.PHP_EOL;
        $str .= '    ...'.PHP_EOL;
        $str .= '}'.PHP_EOL;
        $str .= '```'.PHP_EOL;

        return $str;
    }

    protected function getRecognizeData()
    {
        $class = $this->class;
        $reflection = (new \ReflectionClass($class));
        $str = '';
        if ($this->texts['recognize_data']) {
            if ($this->texts['recognize_file']) {
                $str .= ', ';
            }
            $str .= '['.PHP_EOL;
            foreach ($this->texts['recognize_data'] as $key => $val) {
                $str .= "       {$reflection->getShortName()}::{$this->getNameConst('ACTION_FIELD_', $key)} => ";
                $str .= is_string($val) ? "'{$val}'" : $val;
                $str .= ','.PHP_EOL;
            }
            $str .= '    ]';
        }

        return $str;
    }

    protected function getRecognizeFile()
    {
        if (!$this->texts['recognize_file']) {
            return '';
        }

        return "'{$this->getText(['recognize', 'data', 'file'])}'";
    }

    protected function viewFields()
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

    protected function viewFieldLine($param, $setting)
    {
        $class = $this->class;
        $str = " {$this->getText(['field', 'main', 'name', $param])} |";
        $str .= " {$this->getNameConst('ACTION_FIELD_', $param)} |";
        $str .= ' '.substr($this->getNameConst('PARAM_FIELD_TYPE_', $setting[$class::PARAM_SLUG_TYPE]), 17).' |';
        $str .= ' '.(array_key_exists($class::PARAM_SLUG_REQUIRE, $setting) ? '+' : '-').' |';
        $str .= ' '.(array_key_exists($class::PARAM_SLUG_DEFAULT, $setting) ? $setting[$class::PARAM_SLUG_DEFAULT] : '').' |';
        $str .= " {$this->getText(['field', 'slug', $class::PARAM_SLUG_ENUM, $param])} |";
        $str .= " {$this->getText(['field', 'main', 'desc', $param])} |";
        $str .= PHP_EOL;

        return $str;
    }

    protected function viewMenu()
    {
        $str = "+ [{$this->getText(['slug', 'menu', 'main'])}](../docs/README-{$this->lang}.md)".PHP_EOL;
        $str .= "+ [{$this->getText(['slug', 'menu', 'another'])}](../docs/".$this->getFileName($this->lang == 'ru' ? 'en' : 'ru').')'.PHP_EOL;
        $str .= "+ {$this->getText(['slug', 'menu', 'anchor'])}".PHP_EOL;
        foreach ([
                     ['slug', 'link'],
                     ['slug', 'service', 'desc'],
                     ['slug', 'price'],
                     ['slug', 'recognize', 'desc'],
                     ['install'],
                     ['example'],
                     ['slug', 'fields', 'desc'],
                 ] as $anchor) {
            $str .= "  + [{$this->getText($anchor)}](#".implode('-', explode(' ', ($this->lang === 'en' ? mb_strtolower($this->getText($anchor)) : $this->getText($anchor)))).')'.PHP_EOL;
        }
        if ($this->getText(['menu', 'from_service'])) {
            $str .= "+ {$this->getText(['slug', 'menu', 'from_service'])}".PHP_EOL;
            foreach ($this->texts['menu_from_service'] as $fromServiceClass) {
                $fromServiceObject = new $fromServiceClass([]);
                $fromServiceObjectWiki = $fromServiceObject->getWiki($this->lang);
                $str .= "  + [{$fromServiceObjectWiki->getText(['service', 'name'])}](../docs/{$fromServiceObjectWiki->getFileName()})".PHP_EOL;
            }
        }

        return $str;
    }

    protected function getNameConst($keyMask, $value)
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
        $str .= "{$this->getText(['slug', 'menu'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= $this->viewMenu().PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['slug', 'link'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "[{$this->getText(['slug', 'link', 'to_service'])} {$this->getText(['service', 'name'])}]({$this->getText(['service', 'href'])})".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['slug', 'service', 'desc'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->getText(['service', 'desc'])}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['slug', 'price'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->getText(['recognize', 'price'])}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['slug', 'recognize', 'desc'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->getText(['recognize', 'desc'])}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['install'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->viewInstall()}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['example'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= "{$this->viewExamples()}".PHP_EOL.PHP_EOL;
        $str .= "{$this->getText(['slug', 'fields', 'desc'])}".PHP_EOL;
        $str .= '--------------'.PHP_EOL;
        $str .= $this->viewFields().PHP_EOL;

        return $str;
    }

    public function getFileName($lang = null)
    {
        if (is_null($lang)) {
            $lang = $this->lang;
        }
        $class = $this->class;

        return (new \ReflectionClass($class))->getShortName().'-'.$lang.'.md';
    }

    public function save()
    {
        file_put_contents(__DIR__.'/../../docs/'.$this->getFileName(), $this->view());
    }
}
