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
            $this->paramsNames[static::ACTION_FIELD_LANG],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANG]
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

        $this->wiki->setText(['service', 'name'], 'SociaLink');
        $this->wiki->setText(['service', 'href'], 'http://www.socialink.ru/?key=84333');
        $this->wiki->setText(['service', 'desc'], [
            'ru' => 'Распознавание капч, капчи на русском языке, в любое время суток, начисление заработка в онлайне',
            'en' => 'Recognition of captcha, captcha in Russian, at any time of the day, the accrual of earnings online',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'От 18 до 44 руб. за 1000 капч в зависимости от нагрузки',
            'en' => 'Starting from 0.5 USD for 1000 solved CAPTCHAs',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Расшифровка капч с картики. Необходимо указать файл с картинкой или ссылку на него.',
            'en' => 'Decrypt the captcha with image. You must specify a file with a picture or a link to it.',
        ]);
    }
}
