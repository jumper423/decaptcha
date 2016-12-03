<?php

class DeCaptchaErrorsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Вы должны слать параметр method в вашем запросе к API, изучите документацию
     * @expectedExceptionCode 7
     */
    public function testErrorNoSuchMethod()
    {
        throw new \jumper423\decaptcha\core\DeCaptchaErrors('ERROR_NO_SUCH_METHOD', null, 'ru');
    }
}