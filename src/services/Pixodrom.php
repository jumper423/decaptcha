<?php

namespace jumper423\decaptcha\services;

/**
 * Class Pixodrom.
 */
class Pixodrom extends RuCaptcha
{
    protected $host = 'pixodrom.com';

    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[self::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[self::ACTION_FIELD_QUESTION],
            $this->paramsNames[self::ACTION_FIELD_INSTRUCTIONS],
            $this->paramsNames[self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK]
        );
        $this->paramsNames[self::ACTION_FIELD_IS_RUSSIAN] = 'is_russian';
        $this->paramsNames[self::ACTION_FIELD_LABEL] = 'label';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_IS_RUSSIAN] = [
            static::PARAM_SLUG_DEFAULT => 0,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
            static::PARAM_SLUG_ENUM    => [
                0,
                1,
            ],
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC][static::PARAM_SLUG_ENUM] = [
            0,
            1,
            2,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LABEL] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_SOFT_ID][self::PARAM_SLUG_DEFAULT] = 0;
    }
}
