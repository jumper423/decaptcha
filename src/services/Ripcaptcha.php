<?php

namespace jumper423\decaptcha\services;

/**
 * Class Ripcaptcha.
 */
class Ripcaptcha extends RuCaptcha
{
    protected $host = 'ripcaptcha.com';

    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[self::ACTION_FIELD_PHRASE],
            $this->paramsNames[self::ACTION_FIELD_REGSENSE],
            $this->paramsNames[self::ACTION_FIELD_NUMERIC],
            $this->paramsNames[self::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[self::ACTION_FIELD_MAX_LEN],
            $this->paramsNames[self::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[self::ACTION_FIELD_HEADER_ACAO],
            $this->paramsNames[self::ACTION_FIELD_CALC],
            $this->paramsNames[self::ACTION_FIELD_QUESTION],
            $this->paramsNames[self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->paramsNames[self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_HEADER_ACAO],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK]
        );
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_SOFT_ID][self::PARAM_SLUG_DEFAULT] = 0;
    }
}
