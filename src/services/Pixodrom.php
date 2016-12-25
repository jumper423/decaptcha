<?php

namespace jumper423\decaptcha\services;

/**
 * Class Pixodrom
 * @package jumper423\decaptcha\services
 */
class Pixodrom extends RuCaptcha
{
    public $domain = 'captcha24.com';

    const ACTION_FIELD_IS_RUSSIAN = 17;
    const ACTION_FIELD_LABEL = 18;

    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[self::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[self::ACTION_FIELD_QUESTION],
            $this->paramsNames[self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->paramsNames[self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK]
        );
        $this->paramsNames[self::ACTION_FIELD_IS_RUSSIAN] = 'is_russian';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_IS_RUSSIAN] = [
            static::PARAM_SLUG_DEFAULT => 0,
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_INTEGER,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LABEL] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_SOFT_ID][self::PARAM_SLUG_DEFAULT] = 0;
    }
}
