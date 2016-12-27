<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaGrid.
 */
class RuCaptchaGrid extends RuCaptchaInstruction
{
    public function init()
    {
        parent::init();

        $this->paramsNames[static::ACTION_FIELD_RECAPTCHA] = 'recaptcha';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_RECAPTCHA] = [
            static::PARAM_SLUG_DEFAULT => 1,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_INTEGER,
        ];
    }

    /**
     * @return array
     */
    public function getCode()
    {
        $code = parent::getCode();
        $code = explode(':', $code)[1];

        return explode('/', $code);
    }
}
