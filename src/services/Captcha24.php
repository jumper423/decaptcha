<?php

namespace jumper423\decaptcha\services;

/**
 * Class Captcha24.
 */
class Captcha24 extends RuCaptcha
{
    protected $host = 'captcha24.com';

    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PINGBACK]
        );
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC][static::PARAM_SLUG_ENUM] = [
            0,
            1,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE][static::PARAM_SLUG_ENUM] = [
            0,
            1,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SOFT_ID][static::PARAM_SLUG_DEFAULT] = 0;
    }
}
