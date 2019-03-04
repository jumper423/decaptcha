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
            $this->paramsNames[static::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[static::ACTION_FIELD_HEADER_ACAO],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_INSTRUCTIONS],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->paramsNames[static::ACTION_FIELD_LANG],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_HEADER_ACAO],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANG]
        );
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SOFT_ID][static::PARAM_SLUG_DEFAULT] = 0;

        $this->wiki->setText(['service', 'name'], 'R.I.P. Captcha ');
        $this->wiki->setText(['service', 'href'], [
            'ru' => 'https://ripcaptcha.com/?loc=ru',
            'en' => 'https://ripcaptcha.com/?loc=en',
        ]);
        $this->wiki->setText(['service', 'desc'], [
            'ru' => 'Мы отлично разгадываем капчи.',
            'en' => 'We solve captchas.',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'Вы платите от $0.70 за 1000 капч',
            'en' => 'You will have to pay $0.70 for 1000 captchas',
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_NUMERIC], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - капча состоит только из цифр',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - captcha consists only of digits',
            ],
        ]);
        $this->wiki->setText(['menu', 'from_service'], null);
    }
}
