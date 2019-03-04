<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaErrors;

/**
 * Class RuCaptchaGeeTest.
 */
class RuCaptchaGeeTest extends RuCaptcha
{
    public function init()
    {
        parent::init();

        unset(
            $this->paramsNames[static::ACTION_FIELD_FILE],
            $this->paramsNames[static::ACTION_FIELD_PHRASE],
            $this->paramsNames[static::ACTION_FIELD_REGSENSE],
            $this->paramsNames[static::ACTION_FIELD_NUMERIC],
            $this->paramsNames[static::ACTION_FIELD_MIN_LEN],
            $this->paramsNames[static::ACTION_FIELD_MAX_LEN],
            $this->paramsNames[static::ACTION_FIELD_LANGUAGE],
            $this->paramsNames[static::ACTION_FIELD_LANG],
            $this->paramsNames[static::ACTION_FIELD_QUESTION],
            $this->paramsNames[static::ACTION_FIELD_INSTRUCTIONS],
            $this->paramsNames[static::ACTION_FIELD_CALC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_FILE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PHRASE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_REGSENSE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_NUMERIC],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MIN_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_MAX_LEN],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANGUAGE],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_LANG],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_QUESTION],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_INSTRUCTIONS],
            $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CALC]
        );

        $this->paramsNames[static::ACTION_FIELD_PAGEURL] = 'pageurl';
        $this->paramsNames[static::ACTION_FIELD_GT] = 'gt';
        $this->paramsNames[static::ACTION_FIELD_CHALLENGE] = 'challenge';
        $this->paramsNames[static::ACTION_FIELD_API_SERVER] = 'api_server';

        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_METHOD][static::PARAM_SLUG_DEFAULT] = 'geetest';
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_PAGEURL] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_GT] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_CHALLENGE] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_API_SERVER] = [
            static::PARAM_SLUG_REQUIRE => true,
            static::PARAM_SLUG_TYPE    => static::PARAM_FIELD_TYPE_STRING,
        ];

        $this->wiki->setText(['service', 'name'], [
            'ru' => 'RuCaptcha GeeTest',
            'en' => 'RuCaptcha GeeTest',
        ]);
        $this->wiki->setText(['recognize', 'price'], [
            'ru' => '1000 решений стоят 39 рублей.',
            'en' => '1000 for $0,7',
        ]);
        $this->wiki->setText(['recognize', 'desc'], [
            'ru' => '1) Найти следующие параметры на странице сайта с капчей (обычно их можно найти внутри функции initGeetest):

gt - публичный ключ сайта (статический)
challenge - динамический ключ задания
api_server - домен API (обязателен для некоторых сайтов)

2) Отправьте запрос 

3) Используйте значения, полученные в ответе в запросе к сайту, передавая их в соотстветствующих полях запроса:

geetest_challenge
geetest_validate
geetest_seccode',
            'en' => '1) Find the following parameters on the site page with captcha (they can usually be found inside the initGeetest function):

gt - site public key (static)
challenge - dynamic task key
api_server - API domain (required for some sites)

2) Submit a request

3) Use the values received in the response in the request to the site, passing them in the corresponding request fields:

geetest_challenge
geetest_validate
geetest_seccode',
        ]);
        $this->wiki->setText(['recognize', 'data'], [
            static::ACTION_FIELD_PAGEURL    => 'http://mysite.com/page/with/gettest/',
            static::ACTION_FIELD_GT         => 'f1ab2cdefa3456789012345b6c78d90e',
            static::ACTION_FIELD_CHALLENGE  => '12345678abc90123d45678ef90123a456b',
            static::ACTION_FIELD_API_SERVER => 'api-na.geetest.com',
        ]);
        $this->wiki->setText(['recognize', 'file'], false);
        $this->wiki->setText(['menu', 'from_service'], [
            RuCaptcha::class,
            RuCaptchaClick::class,
            RuCaptchaInstruction::class,
            RuCaptchaGrid::class,
            RuCaptchaReCaptcha::class,
            RuCaptchaFunCaptcha::class,
            RuCaptchaReCaptchaV3::class,
            RuCaptchaKeyCaptcha::class,
        ]);
    }

    public function recognize($additionally = [], $null = null)
    {
        return parent::recognize(null, $additionally);
    }

    /**
     * @param $action
     * @param $data
     *
     * @throws DeCaptchaErrors
     *
     * @return array
     */
    protected function decodeResponse($action, $data)
    {
        if (!array_key_exists($action, $this->decodeSettings[static::DECODE_ACTION])) {
            throw new DeCaptchaErrors('нет action');
        }
        $decodeSetting = $this->decodeSettings[static::DECODE_ACTION][$action];
        $values = [];
        if ($data === '{') {
            $values[static::DECODE_PARAM_RESPONSE] = 'OK';
            $values[static::DECODE_PARAM_CODE] = json_decode($data, true);
        } else {
            foreach (explode($decodeSetting[static::DECODE_SEPARATOR], $data) as $key => $value) {
                foreach ($decodeSetting[static::DECODE_PARAMS] as $param => $paramSetting) {
                    if ($key === $paramSetting[static::DECODE_PARAM_SETTING_MARKER]) {
                        $values[$param] = $value;
                    }
                }
            }
        }

        return $values;
    }
}
