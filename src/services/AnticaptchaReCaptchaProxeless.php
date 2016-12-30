<?php

namespace jumper423\decaptcha\services;

/**
 * Class AnticaptchaReCaptchaProxeless.
 */
class AnticaptchaReCaptchaProxeless extends Anticaptcha
{
    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_FILE],
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_PINGBACK],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS][self::ACTION_FIELD_MAX_LEN]
        );

        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'websiteURL';
        $this->paramsNames[static::ACTION_FIELD_GOOGLEKEY] = 'websiteKey';
        $this->paramsNames[static::ACTION_FIELD_GOOGLETOKEN] = 'websiteSToken';

        $task = &$this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_TASK][static::ACTION_FIELDS];
        $task[static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'NoCaptchaTask';
        $task[static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_GOOGLEKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $task[static::ACTION_FIELD_GOOGLETOKEN] = [
            static::PARAM_SLUG_TYPE => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->decodeSettings[static::DECODE_ACTION][static::DECODE_ACTION_GET][static::DECODE_PARAMS][static::DECODE_PARAM_CODE][static::DECODE_PARAM_SETTING_MARKER] = 'solution.gRecaptchaResponse';

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'AntiCaptcha ReCaptcha v2 без браузера',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => 'Стоимость Рекапчи: от 2 USD за 1000 решений.',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Вам не нужно эмулировать браузер и запускать яваскрипты.
            
Вы присылаете нам значение "sitekey".

Мы передаем вам "g-recaptcha-response" и вы просто делаете сабмит формы с этим параметром.

Объект содержит данные о задаче на решение рекапчи гугла в браузере на компьютере работника. 
Такая задача будет выполняться нашим сервисом с использованием наших собственных прокси-серверов и/или с IP адресов работников. 
Стоимость решения такой задачи на 10% выше, чем у AnticaptchaReCaptcha, так как на нас ложится проблема обхода лимитов на количество решений рекапч с 1 IP адреса.',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
            static::ACTION_FIELD_PAGEURL   => 'http://site.com/recaptcha-ex',
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu','from_service'], [
            Anticaptcha::class,
            AnticaptchaReCaptcha::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
