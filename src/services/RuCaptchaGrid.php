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

        unset(
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MAX_LEN]
        );

        $this->paramsNames[static::ACTION_FIELD_RECAPTCHA] = 'recaptcha';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_RECAPTCHA] = [
            static::PARAM_SLUG_DEFAULT    => 1,
            static::PARAM_SLUG_TYPE       => static::PARAM_FIELD_TYPE_INTEGER,
            static::PARAM_SLUG_NOTWIKI    => true,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha Сетка (ReCaptcha v2)',
            'en' => 'RuCaptcha Grid (ReCaptcha v2)',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'Стоимость 1000 распознаний данной капчи - 70 рублей.',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Для решения рекапчи, где нужно выбирать определённые квадраты. В ответ придут номера картинок, на которые надо нажать.
            
Обратите внимание, что рекапчи бывают не только 3 на 3 квадрата, но попадаются и 4 на 4 квадрата. Что бы понять какую именно картинку Вы шлёте, мы смотрим размер в px картинки. Если она 300x300px, то мы накладываем на эту картинку сетку 3х3. Если размер другой - накладываем сетку 4х4. Поэтому не надо склеивать изображение с чем-либо.

Обратите внимание, что необходимо засылать саму картинку рекапчи, а не делать её скриншот.',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_INSTRUCTIONS => 'Where\'s the cat?',
        ]);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaInstruction::class,
            RuCaptchaClick::class,
            RuCaptchaReCaptcha::class,
        ]);
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
