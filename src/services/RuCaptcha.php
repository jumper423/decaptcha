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
}
