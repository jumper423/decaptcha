<?php

namespace jumper423\decaptcha\services;

/**
 * Class Captcha24.
 */
class Captcha24 extends RuCaptcha
{
    protected $host = 'captcha24.com';

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
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC][static::PARAM_SLUG_ENUM] = [
            0,
            1,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE][static::PARAM_SLUG_ENUM] = [
            0,
            1,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SOFT_ID][static::PARAM_SLUG_DEFAULT] = 927;

        $this->wiki->setText(['service', 'name'], 'Captcha24');
        $this->wiki->setText(['service', 'href'], 'http://captcha24.com/');
        $this->wiki->setText(['service', 'desc'], [
            'ru' => 'captcha24.com - сервис ручного распознавания графических изображений, здесь встречаются те, кому нужно в режиме реального времени разгадывать изображения ( сканы документов, каптчи, другое) и те, кто готов это делать за деньги.

99% работников captcha24 знают русский язык, а потому распознавание документов на русском языке доходит до 95%.',
            'en' => 'captcha24.com service manual recognition of graphic images, there are those who need in real time to unravel the image ( scans of documents, captcha, etc.) and those who are willing to do it for the money. 
            
99% of employees captcha24 know Russian language, but because the recognition of documents in the Russian language comes to 95%.',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => ' ... ',
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
        $this->wiki->setText(['field', 'slug', static::PARAM_SLUG_ENUM, static::ACTION_FIELD_LANGUAGE], [
            'ru' => [
                '0 - параметр не задействован',
                '1 - на капче только кириллические буквы',
            ],
            'en' => [
                '0 - parameter not used',
                '1 - the captcha only Cyrillic letters',
            ],
        ]);
        $this->wiki->setText(['menu', 'from_service'], null);
    }
}
