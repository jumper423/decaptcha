<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaManual.
 */
class RuCaptchaInstruction extends RuCaptcha
{
    public function init()
    {
        parent::init();

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS][static::PARAM_SLUG_REQUIRE] = true;
    }
}
