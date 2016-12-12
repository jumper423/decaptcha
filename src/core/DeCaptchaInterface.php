<?php

namespace jumper423\decaptcha\core;

/**
 * Interface DeCaptchaInterface.
 */
interface DeCaptchaInterface
{
    /**
     * @param string $filePath
     *
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
