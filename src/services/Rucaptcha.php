<?php

namespace jumper423\decaptcha\services;

use jumper423\decaptcha\core\DeCaptchaBase;

/**
 * Распознавание капчи Rucaptcha.
 *
 * Class Rucaptcha
 *
 * @link http://infoblog1.ru/goto/rucaptcha
 */
class Rucaptcha extends DeCaptchaBase
{
    public $domain = 'rucaptcha.com';
}
