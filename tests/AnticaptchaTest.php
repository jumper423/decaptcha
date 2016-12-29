<?php

use jumper423\decaptcha\services\Anticaptcha;

/**
 * Class AnticaptchaTest.
 */
class AnticaptchaTest extends PHPUnit_Framework_TestCase
{
    public function testRecognize()
    {
        $captcha = new Anticaptcha([
            \jumper423\decaptcha\services\Anticaptcha::ACTION_FIELD_KEY => '5464654645646',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
        if ($captcha->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $captcha->getCode());
        } else {
            $this->assertEquals('Использован несуществующий key', $captcha->getError());
        }
    }

    public function testEnum()
    {
        $captcha = new \jumper423\decaptcha\services\Anticaptcha([
            \jumper423\decaptcha\services\Anticaptcha::ACTION_FIELD_KEY      => '5464654645646',
            \jumper423\decaptcha\services\Anticaptcha::ACTION_FIELD_LANGUAGE => 'ru',
        ]);
        $captcha->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);
        if ($captcha->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $captcha->getCode());
        } else {
            $this->assertEquals('Нет в допустимых значиниях поля: languagePool = ru', $captcha->getError());
        }
    }
}
