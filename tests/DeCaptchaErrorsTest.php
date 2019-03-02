<?php

use jumper423\decaptcha\core\DeCaptchaErrors;

/**
 * Class DeCaptchaErrorsTest.
 */
class DeCaptchaErrorsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Вы должны слать параметр method в вашем запросе к API, изучите документацию
     * @expectedExceptionCode 7
     */
    public function testErrorNoSuchMethod()
    {
        throw new DeCaptchaErrors('ERROR_NO_SUCH_METHOD', null, DeCaptchaErrors::LANG_RU);
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Ваша капча имеет размер более 100 килобайт: вес файла 5 МБ
     * @expectedExceptionCode 2
     */
    public function testErrorTooBigCaptchaFilesize()
    {
        throw new DeCaptchaErrors('ERROR_TOO_BIG_CAPTCHA_FILESIZE', 'вес файла 5 МБ', DeCaptchaErrors::LANG_RU);
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage NOT_CONFIG
     * @expectedExceptionCode 0
     */
    public function testNotConfig()
    {
        throw new DeCaptchaErrors('NOT_CONFIG');
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage ERROR Code №1555
     * @expectedExceptionCode 1555
     */
    public function testNotConfigNumber()
    {
        throw new DeCaptchaErrors(1555);
    }
}
