<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Распознавание капчи RuCaptcha.
 *
 * Class RuCaptcha
 *
 * @link http://infoblog1.ru/goto/rucaptcha
 */
class RuCaptcha extends DeCaptchaBase
{
    public $domain = 'rucaptcha.com';

    public function init()
    {
        parent::init();
        $this->actions[static::ACTION_RECOGNIZE][static::ACTION_FIELDS][static::ACTION_FIELD_SOFT_ID][static::PARAM_SLUG_DEFAULT] = 882;
    }

    public function getBalance(){
        $this->setParam(static::ACTION_FIELD_ACTION, 'getbalance');
        $response = $this->getResponse(static::ACTION_UNIVERSAL);
        $dataGet = $this->decodeResponse(static::DECODE_ACTION_GET, $response);
        return $dataGet[static::DECODE_PARAM_RESPONSE];
    }
}
