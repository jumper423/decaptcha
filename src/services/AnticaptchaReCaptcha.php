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
        $task[static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'NoCaptchaTaskProxyless';
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
    }
}
