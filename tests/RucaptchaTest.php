<?php

/**
 * Class RucaptchaTest.
 */
class RucaptchaTest extends PHPUnit_Framework_TestCase
{
    public function testRecognize()
    {
        $re = new \jumper423\decaptcha\services\TwoCaptcha([
            \jumper423\decaptcha\services\TwoCaptcha::PARAM_SPEC_API_KEY => 'b7e7f1002f0f917ca5a852e1c0312e8f',
        ]);
        if ($re->recognize(__DIR__.'/data/Captcha.jpg')) {
            $this->assertEquals('11111111111111', $re->getCode());
        } else {
            $this->assertEquals('22222222222222', $re->getError());
        }

        $post_data_1 = ['file' => new CURLFile('file.txt')];
        $curl_1 = curl_init();
        curl_setopt($curl_1, CURLOPT_POSTFIELDS, $post_data_1);
        echo "OK\n";

// exactly the same as above + added a reference to 'file' element
        $post_data_2 = ['file' => new CURLFile('file.txt')];
        $ref = &$post_data_2['file']; // ***
        $curl_2 = curl_init();
        curl_setopt($curl_2, CURLOPT_POSTFIELDS, $post_data_2);
        echo "OK\n";
    }
}
