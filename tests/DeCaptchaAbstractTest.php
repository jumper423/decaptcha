<?php

/**
 * Class DeCaptchaAbstractTest.
 */
class DeCaptchaAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return PHPUnit_Framework_MockObject_MockObject|\jumper423\decaptcha\core\DeCaptchaAbstract
     */
    public function newInstance()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $abstract->setErrorLang(\jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU);

        return $abstract;
    }

    public function testGetBaseUrl()
    {
        $abstract = $this->newInstance();
        $getBaseUrlCaller = function () {
            $this->domain = 'domain';

            return $this->getBaseUrl();
        };
        $bound = $getBaseUrlCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/', $bound());
    }

//    public function testGetActionUrl()
//    {
//        $abstract = $this->newInstance();
//        $getBaseUrlGetCodeCaller = function () {
//            $this->captchaId = 123;
//
//            return $this->getActionUrl('get_code');
//        };
//        $getBaseUrlGetBalanceCaller = function ($action, $key, $id) {
//            $this->domain = 'domain';
//            $this->setParamSpec(\jumper423\decaptcha\core\DeCaptchaAbstract::PARAM_SPEC_KEY, $key);
//            $this->setParamSpec(\jumper423\decaptcha\core\DeCaptchaAbstract::PARAM_SPEC_CAPTCHA, $id);
//            return $this->getActionUrl('get_balance');
//        };
//        $abstract->setParamSpec(\jumper423\decaptcha\core\DeCaptchaAbstract::PARAM_SPEC_KEY '123456');
//        $bound = $getBaseUrlGetCodeCaller->bindTo($abstract, $abstract);
//        $this->assertEquals('http://domain/res.php?key=123456&action=get_code&id=123', $bound());
//        $bound = $getBaseUrlGetBalanceCaller->bindTo($abstract, $abstract);
//        $this->assertEquals('http://domain/res.php?key=123456&action=get_balance&id=234', $bound());
//    }

    public function testGetFilePath()
    {
        $abstract = $this->newInstance();
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $this->assertEquals(__DIR__.'/data/Captcha.jpg', $bound(__DIR__.'/data/Captcha.jpg'));
        $filePathUpload = $bound('https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha.jpg');
        $file1 = file_get_contents(__DIR__.'/data/Captcha.jpg');
        $file2 = file_get_contents($filePathUpload);
        $this->assertEquals($file1, $file2);
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionCode 16
     */
    public function testGetFilePathErrorFileNotFound()
    {
        $abstract = $this->newInstance();
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $bound(__DIR__.'/data/Captcha1.jpg');
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Файл не загрузился: https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha46.jpg123
     * @expectedExceptionCode 15
     */
    public function testGetFilePathErrorFileIsNotLoaded()
    {
        $abstract = $this->newInstance();
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $bound('https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha46.jpg123');
    }

//    public function testGetResponse()
//    {
//        $abstract = $this->newInstance();
//        $getResponseCaller = function ($val) {
//            $this->domain = 'echo.jsontest.com/aaa/bbb';
//            return $this->getResponse($val);
//        };
//        $bound = $getResponseCaller->bindTo($abstract, $abstract);
//        $res = $bound('');
//        $this->assertEquals('{"res.php":"","aaa":"bbb"}', str_replace("\n", '', str_replace(' ', '', $res)));
//    }

//    public function testExecutionDelayed()
//    {
//        $abstract = $this->newInstance();
//        $executionDelayedCaller = function ($second, $call = null) {
//            return $this->executionDelayed($second, $call);
//        };
//        $bound = $executionDelayedCaller->bindTo($abstract, $abstract);
//        $start = microtime(true);
//        $bound(0);
//        $bound(0.1);
//        $timePassed = microtime(true) - $start;
//        $this->assertTrue(abs($timePassed - 0.1) < 0.035);
//
//        $start = microtime(true);
//        $bound(0.15, function () {
//            sleep(0.2);
//        });
//        $bound(0.1);
//        $timePassed = microtime(true) - $start;
//        $this->assertTrue(abs($timePassed - 0.25) < 0.035);
//
//        $start = microtime(true);
//        $bound(0.15, function () {
//            sleep(0.2);
//        });
//        $bound(0.3);
//        $timePassed = microtime(true) - $start;
//        $this->assertTrue(abs($timePassed - 0.45) < 0.035);
//
//        $this->assertEquals(2, $bound(0, function () {
//            return 2;
//        }));
//        $this->assertEquals(null, $bound(0));
//    }

//    public function testGetInUrl()
//    {
//        $abstract = $this->newInstance();
//        $getInUrlCaller = function () {
//            $this->domain = 'domain';
//            return $this->getInUrl();
//        };
//        $abstract->setApiKey('123456');
//        $bound = $getInUrlCaller->bindTo($abstract, $abstract);
//        $this->assertEquals('http://domain/in.php', $bound());
//    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionCode 4
     */
    public function testIsError()
    {
        $abstract = $this->newInstance();
        $isErrorCaller = function ($val) {
            return $this->isError($val);
        };
        $bound = $isErrorCaller->bindTo($abstract, $abstract);
        $bound('ERROR_IP_NOT_ALLOWED');
    }

    public function testIsErrorNot()
    {
        $abstract = $this->newInstance();
        $isErrorCaller = function ($val) {
            return $this->isError($val);
        };
        $bound = $isErrorCaller->bindTo($abstract, $abstract);
        $this->assertNull($bound('BALANCE:56'));
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionCode 17
     * @expectedExceptionMessage Ошибка CURL: Could
     */
    public function testGetCurlResponseError()
    {
        $abstract = $this->newInstance();
        $getCurlResponseCaller = function ($url, $val) {
            return $this->getCurlResponse($url, $val);
        };
        $bound = $getCurlResponseCaller->bindTo($abstract, $abstract);
        $bound('http://domain', ['protected' => 'value']);
    }

    public function testGetCurlResponse()
    {
        $abstract = $this->newInstance();
        $getCurlResponseCaller = function ($url, $val) {
            return $this->getCurlResponse($url, $val);
        };
        $bound = $getCurlResponseCaller->bindTo($abstract, $abstract);
        $data = $bound('http://httpbin.org/post', ['protected' => 'value']);
        $data = json_decode($data, true);
        $this->assertEquals(['protected' => 'value'], $data['form']);
    }
}
