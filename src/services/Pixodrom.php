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

        $this->wiki->setText(['service', 'name'], 'Pixodrom');
        $this->wiki->setText(['service', 'href'], 'http://pixodrom.com/');
        $this->wiki->setText(['service', 'desc'], [
            'ru' => ' ... ',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => ' ... ',
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_NUMERIC], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - капча состоит только из цифр',
                '2 - в капче нет цифр',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - captcha consists only of digits',
                '2 - the captcha has no numbers',
            ],
        ]);
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_IS_RUSSIAN], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - на изображении присутствуют русские символы',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - in the image there are Russian characters',
            ],
        ]);
        $this->wiki->setText(['menu', 'from_service'], null);
    }
}
