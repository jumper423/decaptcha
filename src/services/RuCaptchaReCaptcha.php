<?php

namespace jumper423\decaptcha\services;

/**
 * Class RuCaptchaReCaptcha.
 */
class RuCaptchaReCaptcha extends RuCaptcha
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
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_PINGBACK],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][self::ACTION_FIELD_QUESTION]
        );

        $this->paramsNames[static::ACTION_FIELD_GOOGLEKEY] = 'googlekey';
        $this->paramsNames[static::ACTION_FIELD_PROXY] = 'proxy';
        $this->paramsNames[static::ACTION_FIELD_PROXYTYPE] = 'proxytype';
        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'userrecaptcha';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_GOOGLEKEY] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXY] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PROXYTYPE] = [
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha ReCaptcha v2 без браузера',
            'en' => 'RuCaptcha ReCaptcha v2 without a browser',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => '1000 решений стоят 160 рублей.',
            'en' => '1000 for $2,99',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => 'Данный способ позволяет пройти рекапчу без эмуляции браузера и отправки нам картинок, так же этот способ даёт 100%  прохождение капчи.
            
Где какие данные брать и куда вставлять? 
Посмотрите HTML-код страницы, где Вы встретили капчу: 

1. найдите параметр
data-sitekey=
Это ключ сайта, он постоянен и уникален для каждого сайта (если администратор сайта не поменяет его вручную)

2.найдите форму для текста
```<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none; "></textarea>```
Сюда вам нужно будет вставить ответ от нас.',
            'en' => 'This method allows you to pass the reCAPTCHA without emulation browser and send us pictures, as this method gives 100% passing captcha.
            
Where any information to take and where to insert?
See page HTML-code, where you met the captcha:

1. Locate the parameter
data-sitekey =
This site key, it is constant and unique for each site (if the site administrator does not change it manually)

2.Locate form for text
```<textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none; "></textarea>```
Here you will need to insert a reply from us.',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_GOOGLEKEY => '54as5c6a5s4ca4s56a4sc56a',
            static::ACTION_FIELD_PAGEURL   => 'http://site.com/recaptcha-ex',
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaInstruction::class,
            RuCaptchaGrid::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }
}
