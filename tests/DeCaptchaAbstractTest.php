<?php

class DeCaptchaAbstractTest extends PHPUnit_Framework_TestCase
{
    public function testGetBaseUrl()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
//        $foo->expects($this->any())
//            ->method("baz")
//            ->will($this->returnValue("You called baz!"));
        $getBaseUrlCaller = function () {
            return $this->getBaseUrl();
        };
        $abstract->domain = 'domain';
        $bound = $getBaseUrlCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/', $bound());
    }

    public function testSetApiKey()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $abstract->setApiKey('123456val');
        $apiKeyValCaller = function () {
            return $this->apiKey;
        };
        $bound = $apiKeyValCaller->bindTo($abstract, $abstract);
        $this->assertEquals('123456val', $bound());

        $abstract->setApiKey(function () {
            return '123456' . 'fun';
        });
        $apiKeyFunCaller = function () {
            return $this->apiKey;
        };
        $bound = $apiKeyFunCaller->bindTo($abstract, $abstract);
        $this->assertEquals('123456fun', $bound());
    }

    public function testGetActionUrl()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $getBaseUrlGetCodeCaller = function () {
            $this->captchaId = 123;
            return $this->getActionUrl('get_code');
        };
        $getBaseUrlGetBalanceCaller = function () {
            $this->captchaId = 234;
            return $this->getActionUrl('get_balance');
        };
        $abstract->domain = 'domain';
        $abstract->setApiKey('123456');
        $bound = $getBaseUrlGetCodeCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/res.php?key=123456&action=get_code&id=123', $bound());
        $bound = $getBaseUrlGetBalanceCaller->bindTo($abstract, $abstract);
        $this->assertEquals('http://domain/res.php?key=123456&action=get_balance&id=234', $bound());
    }

    public function testGetFilePath()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $this->assertEquals(__DIR__ . '/data/Captcha.jpg', $bound(__DIR__ . '/data/Captcha.jpg'));
        $filePathUpload = $bound('https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha.jpg');
        $file1 = file_get_contents(__DIR__ . '/data/Captcha.jpg');
        $file2 = file_get_contents($filePathUpload);
        $this->assertEquals($file1, $file2);
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionCode 16
     */
    public function testGetFilePathErrorFileNotFound()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $abstract->errorLang = \jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU;
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $bound(__DIR__ . '/data/Captcha1.jpg');
    }

    /**
     * @expectedException \jumper423\decaptcha\core\DeCaptchaErrors
     * @expectedExceptionMessage Файл не загрузился: https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha46.jpg123
     * @expectedExceptionCode 15
     */
    public function testGetFilePathErrorFileIsNotLoaded()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $abstract->errorLang = \jumper423\decaptcha\core\DeCaptchaErrors::LANG_RU;
        $getFilePathCaller = function ($val) {
            return $this->getFilePath($val);
        };
        $bound = $getFilePathCaller->bindTo($abstract, $abstract);
        $bound('https://upload.wikimedia.org/wikipedia/commons/6/69/Captcha46.jpg123');
    }

    public function testGetResponse()
    {
        $abstract = $this->getMockForAbstractClass(\jumper423\decaptcha\core\DeCaptchaAbstract::class);
        $abstract->domain = 'echo.jsontest.com/aaa/bbb';
        $getResponseCaller = function ($val) {
            return $this->getResponse($val);
        };
        $bound = $getResponseCaller->bindTo($abstract, $abstract);
        $res = $bound('');
        $this->assertEquals('{"res.php":"","aaa":"bbb"}', str_replace("\n", '', str_replace(" ", '', $res)));
    }
}