<?php

namespace jumper423\decaptcha\services;

/**
 * Class Captcha24
 * @package jumper423\decaptcha\services
 */
class Captcha24 extends RuCaptcha
{
    public $domain = 'captcha24.com';

    public function init()
    {
        parent::init();
        unset(
            $this->paramsNames[self::ACTION_FIELD_QUESTION],
            $this->paramsNames[self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->paramsNames[self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_TEXTINSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK]
        );
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_SOFT_ID][self::PARAM_SLUG_DEFAULT] = 0;
    }
}
