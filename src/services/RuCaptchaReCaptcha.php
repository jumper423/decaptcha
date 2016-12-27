<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaReCaptcha.
 */
class RuCaptchaReCaptcha extends RuCaptcha
{
    public function init()
    {
        parent::init();

        $this->paramsNames[static::ACTION_FIELD_GOOGLEKEY] = 'googlekey';
        $this->paramsNames[static::ACTION_FIELD_PROXY] = 'proxy';
        $this->paramsNames[static::ACTION_FIELD_PROXYTYPE] = 'proxytype';
        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'userrecaptcha';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_GOOGLEKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_FILE][static::PARAM_SLUG_REQUIRE] = false;
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
