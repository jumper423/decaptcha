<?php

namespace jumper423\decaptcha\services;

/**
 * Class Socialink.
 */
class Socialink extends RuCaptcha
{
    protected $host = 'socialink.ru';

    public function init()
    {
        parent::init();
        unset(
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_INSTRUCTIONS],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PINGBACK]
        );
        $this->paramsNames[static::ACTION_FIELD_IS_RUSSIAN] = 'is_russian';
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
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE][static::PARAM_SLUG_ENUM] = [
            0,
            1,
            2,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SOFT_ID][static::PARAM_SLUG_DEFAULT] = 0;

        $this->wiki->setText(['menu', 'from_service'], null);
    }
}
