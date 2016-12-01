<?php

namespace jumper423\decaptcha\core;

/**
 * Interface DeCaptchaInterface
 * @package jumper423\decaptcha
 */
interface DeCaptchaInterface
{
    /**
     * @param string $filePath
     * @return bool
     */
    public function recognize($filePath);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @return string
     */
    public function getError();
}