<?php

namespace jumper423\decaptcha\core;

/**
 * Interface DeCaptchaInterface.
 */
interface DeCaptchaInterface
{
    /**
     * @return string|array
     */
    public function getCode();

    /**
     * @return string|array
     */
    public function getError();
}
