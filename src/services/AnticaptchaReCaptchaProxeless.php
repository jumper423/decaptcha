<?php

namespace jumper423\decaptcha\services;

/**
 * Class AnticaptchaReCaptchaProxeless.
 */
class AnticaptchaReCaptchaProxeless extends Anticaptcha
{
    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_FILE],
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->paramsNames[static::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_MAX_LEN]
        );

        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'websiteURL';
        $this->paramsNames[static::ACTION_FIELD_GOOGLEKEY] = 'websiteKey';
        $this->paramsNames[static::ACTION_FIELD_GOOGLETOKEN] = 'websiteSToken';

        $task = &$this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS];
        $task[static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'NoCaptchaTask';
        $task[static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_GOOGLEKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_GOOGLETOKEN] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_GET][static::DECODE_PARAMS][static::DECODE_PARAM_CODE][static::DECODE_PARAM_SETTING_MARKER] = 'solution.gRecaptchaResponse';
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
