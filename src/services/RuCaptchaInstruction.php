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

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha Инструкция',
            'en' => 'RuCaptcha Manual',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Распознание что написанно на картинке с пояснительной инструкцией',
            'en' => 'Recognizing what is written on the picture with the explanatory statement',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_INSTRUCTIONS => 'What\'s in the picture?',
        ]);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaGrid::class,
            RuCaptchaReCaptcha::class,
            RuCaptchaKeyCaptcha::class,
        ]);
    }
}
