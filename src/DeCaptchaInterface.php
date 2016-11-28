<?php

namespace jumper423;

interface DeCaptchaInterface
{
    public function run($filename);

    public function result();

    public function error();
}