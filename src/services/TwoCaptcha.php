<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Распознавание капчи TwoCaptcha.
 *
 * Class TwoCaptcha
 *
 * @link http://infoblog1.ru/goto/rucaptcha
 */
class TwoCaptcha extends DeCaptchaBase
{
    public $domain = '2captcha.com';
}
