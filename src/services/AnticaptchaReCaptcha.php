<?php

namespace jumper423\decaptcha\services;

/**
 * Class AnticaptchaReCaptcha.
 */
class AnticaptchaReCaptcha extends AnticaptchaReCaptchaProxeless
{
    public function init()
    {
        parent::init();

        $this->paramsNames[static::ACTION_FIELD_PROXYTYPE] = 'proxyType';
        $this->paramsNames[static::ACTION_FIELD_PROXY] = 'proxyAddress';
        $this->paramsNames[static::ACTION_FIELD_PROXYPORT] = 'proxyPort';
        $this->paramsNames[static::ACTION_FIELD_PROXYLOGIN] = 'proxyLogin';
        $this->paramsNames[static::ACTION_FIELD_PROXYPASS] = 'proxyPassword';
        $this->paramsNames[static::ACTION_FIELD_USERAGENT] = 'userAgent';
        $this->paramsNames[static::ACTION_FIELD_COOKIES] = 'cookies';

        $task = &$this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS];
        $task[static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'NoCaptchaTask';
        $task[static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
            static::PARAM_SLUG_ENUM    => [
                'http',
                'socks4',
                'socks5',
            ],
        ];
        $task[static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_PROXYPORT] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
        ];
        $task[static::ACTION_FIELD_PROXYLOGIN] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_PROXYPASS] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_USERAGENT] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_COOKIES] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'AntiCaptcha ReCaptcha v2 без браузера (с прокси)',
            'en' => 'AntiCaptcha ReCaptcha v2 without a browser (with a proxy)',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Вам не нужно эмулировать браузер и запускать яваскрипты.
            
Вы присылаете нам значение "sitekey".

Мы передаем вам "g-recaptcha-response" и вы просто делаете сабмит формы с этим параметром.

Объект содержит данные о задаче на решение рекапчи гугла в браузере на компьютере работника. Для обеспечения универсальности решения этого вида капчи нам необходимо использовать все данные, которые вы используете во время автоматизации заполнения формы на целевом сайте, включая прокси, user-agent браузера и cookies. Это позволит избежать любых проблем при изменении гуглом кода своей капчи.

Наша система решения выстроена таким образом, что браузер работника не получает данные о ваших прокси-серверах, cookies, и других данных. Все эти данные хранятся на нашем сервере и стираются после выполнения задания. Машина работника не имеет доступа к этим данным и взаимодействует исключительно с нашими серверами.

Перед выполнением задания система проверяет работоспособность вашего прокси-сервера и только после этого передает задачу работнику. Прокси должен обязательно обработать тестовый запрос в течение 5 секунд, иначе задача пометится ошибкой ERROR_PROXY_TIMEOUT и будет отменена.

Капча может решаться довольно долго по сравнению с обычной капчей, но это компенсируется тем, что полученный g-captcha-response действует еще 120 секунд после того, как работник решил капчу.',
            'en' => 'You don\'t need to emulate a browser and run the Java-scripts. 
            
You send us the value "sitekey". We give you "g-recaptcha-response" and you just make a submit form with this option. 

The object contains information about a task on the solution of the recaptcha of Google in the browser on the computer of the employee. To ensure the universality of solutions of this type of captcha, we need to use all the data you use automation to fill out a form on the trust website, including a proxy, the user-agent of browser and cookies. This will avoid any problems if you change the Google code to your captcha. 

Our system solutions are designed in such a way that the browser of the employee does not receive information about your proxy servers, cookies, and other data. All this data is stored on our server and are erased after the job. Machine employee does not have access to this data and communicates only with our servers. 

Before performing the task, the system checks the performance of your proxy server, and only then passes the task to the worker. Proxies must be sure to handle the probe request within 5 seconds, otherwise the problem of litter bug ERROR_PROXY_TIMEOUT and will be canceled.

Captcha can be solved for a long time compared with the usual CAPTCHA, but this is offset by the fact that the resulting g-captcha-response effect another 120 seconds after an employee has decided captcha.',
        ]);
        $this->wiki->setText(['constructor', 'data'], [
            static::ACTION_FIELD_KEY         => '94f39af4bb295c40546fba5c932e0d32',
            static::ACTION_FIELD_PROXYTYPE   => 'http',
            static::ACTION_FIELD_PROXY       => '88.45.12.43',
            static::ACTION_FIELD_PROXYPORT   => '8080',
            static::ACTION_FIELD_USERAGENT   => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
            static::ACTION_FIELD_PAGEURL   => 'http://site.com/recaptcha-ex',
        ]);
        $this->wiki->setText(['menu', 'from_service'], [
            Anticaptcha::class,
            AnticaptchaReCaptchaProxeless::class,
        ]);
    }
}
