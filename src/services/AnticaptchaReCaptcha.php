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

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD] = [
            static::PARAM_SLUG_DEFAULT => 'NoCaptchaTaskProxyless',
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYPORT] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYLOGIN] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYPASS] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_USERAGENT] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][static::ACTION_FIELD_COOKIES] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
    }
}
