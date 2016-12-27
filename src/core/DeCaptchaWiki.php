<?php

namespace jumper423\decaptcha\core;

use jumper423\decaptcha\services\RuCaptcha;

/**
 * Class DeCaptchaAbstract.
 */
class DeCaptchaWiki
{
    public function view(){
        $rucaptcha = new RuCaptcha([]);
        /*
         * Markdown | Less | Pretty
            --- | --- | ---
            *Still* | `renders` | **nicely**
            1 | 2 | 3
         *
         * */
        echo " Название | Код | Тип | Обязательное значение | Значение по умолчания | Возможные значения | Описание " . PHP_EOL;
        echo " --- | --- | --- | --- | --- | ---| --- " . PHP_EOL;
        $rr = (new \ReflectionClass($rucaptcha))->getConstants();
//        print_r($rr);
        foreach ($rucaptcha->actions[RuCaptcha::ACTION_RECOGNIZE][RuCaptcha::ACTION_FIELDS] as $param => $setting) {
            if (array_key_exists(RuCaptcha::PARAM_SLUG_NOTWIKI, $setting) && $setting[RuCaptcha::PARAM_SLUG_NOTWIKI] === true) {
                continue;
            }
            echo " {$this->ggg($rr, 'ACTION_FIELD_', $param)} |";
            echo " {$this->ggg($rr, 'ACTION_FIELD_', $param)} |";
            echo " ".substr($this->ggg($rr, 'PARAM_FIELD_TYPE_', $setting[RuCaptcha::PARAM_SLUG_TYPE]), 17) ." |";
            echo " ".(array_key_exists(RuCaptcha::PARAM_SLUG_REQUIRE, $setting) ? '+' : '-') ." |";
            echo " ".(array_key_exists(RuCaptcha::PARAM_SLUG_DEFAULT, $setting) ? $setting[RuCaptcha::PARAM_SLUG_DEFAULT] : '') ." |";
            echo " |";
            echo " ". PHP_EOL;
//            echo " --- | --- | --- | --- | ---| --- " . PHP_EOL;
//            print_r($params);
        }
//        $rr = get_defined_constants(true);
//        print_r(array_keys($rr));
//        print_r($rr);
//        file_put_contents(__DIR__ . '/12331123', json_encode(get_defined_constants(true)));
    }

    public function ggg($constants, $keyMask, $value){
        foreach ($constants as $key => $val) {
            if (stripos($key, $keyMask) !== false && $val === $value) {
                return $key;
            }
        }
        return null;
    }
}
